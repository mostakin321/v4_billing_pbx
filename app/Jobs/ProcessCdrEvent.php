<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Processes a CDR event received from FreeSWITCH ESL (CHANNEL_HANGUP_COMPLETE).
 * Stores the CDR into v_xml_cdr if not already present, then triggers notifications.
 */
class ProcessCdrEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 3;
    public int $timeout = 60;
    public int $backoff = 5;

    public function __construct(private readonly array $event)
    {
        $this->onQueue(config('freeswitch.queues.events', 'freeswitch-events'));
    }

    public function handle(): void
    {
        $uuid = $this->event['Unique-ID'] ?? $this->event['uuid'] ?? null;
        if (!$uuid) return;

        $direction   = $this->event['Call-Direction']      ?? $this->event['direction']   ?? '';
        $callerNum   = $this->event['Caller-Caller-ID-Number'] ?? $this->event['caller_id_number'] ?? '';
        $callerName  = $this->event['Caller-Caller-ID-Name']   ?? $this->event['caller_id_name']   ?? '';
        $destination = $this->event['Caller-Destination-Number'] ?? $this->event['destination_number'] ?? '';
        $hangup      = $this->event['Hangup-Cause']   ?? $this->event['hangup_cause']   ?? '';
        $billsec     = (float)($this->event['billsec'] ?? $this->event['variable_billsec'] ?? 0);
        $duration    = (float)($this->event['duration'] ?? $this->event['variable_duration'] ?? 0);
        $domainName  = $this->event['variable_domain_name'] ?? $this->event['domain_name'] ?? '';
        $domainUuid  = $this->event['variable_domain_uuid'] ?? $this->event['domain_uuid'] ?? '';
        $context     = $this->event['Caller-Context']      ?? $this->event['context']     ?? '';

        // Upsert into v_xml_cdr
        $exists = DB::connection('fusionpbx')
            ->table('v_xml_cdr')
            ->where('call_uuid', $uuid)
            ->exists();

        if (!$exists && $domainUuid) {
            try {
                DB::connection('fusionpbx')->table('v_xml_cdr')->insert([
                    'xml_cdr_uuid'       => $uuid,
                    'call_uuid'          => $uuid,
                    'domain_uuid'        => $domainUuid ?: null,
                    'domain_name'        => $domainName,
                    'direction'          => $direction,
                    'context'            => $context,
                    'caller_id_name'     => $callerName,
                    'caller_id_number'   => $callerNum,
                    'destination_number' => $destination,
                    'hangup_cause'       => $hangup,
                    'duration'           => $duration,
                    'billsec'            => $billsec,
                    'missed_call'        => ($billsec == 0 && $hangup !== 'ORIGINATOR_CANCEL'),
                    'start_stamp'        => now(),
                ]);
            } catch (\Throwable $e) {
                Log::warning("ProcessCdrEvent insert: ".$e->getMessage());
            }
        }

        // Dispatch missed call notification if applicable
        $missedCall = ($billsec == 0 && $hangup !== 'ORIGINATOR_CANCEL');
        if ($missedCall && $destination) {
            dispatch(new SendMissedCallNotification($this->event));
        }
    }
}
