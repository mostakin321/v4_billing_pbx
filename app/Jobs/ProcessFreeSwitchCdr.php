<?php
namespace App\Jobs;
use App\Models\Billing\BillingCdr;
use App\Services\Billing\CGRatesClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFreeSwitchCdr implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct(public array $event) { $this->onQueue(config('billing.cdr_queue')); }
    public function handle(CGRatesClient $client): void
    {
        $account = $this->event['accountcode'] ?? $this->event['sip_from_user'] ?? $this->event['caller_id_number'] ?? 'unknown';
        $dest = $this->event['destination_number'] ?? $this->event['called_number'] ?? '';
        $uuid = $this->event['uuid'] ?? $this->event['variable_uuid'] ?? (string) str()->uuid();
        $usage = (int)($this->event['billsec'] ?? $this->event['duration'] ?? 0);
        $direction = str_starts_with((string)($this->event['sofia_profile_name'] ?? ''), 'external') ? 'termination' : 'origination';
        $payload = [
            'Direction' => $direction === 'termination' ? '*in' : '*out',
            'Category' => 'call', 'RequestType' => '*raw', 'ToR' => '*monetary',
            'Tenant' => config('billing.tenant'), 'Account' => $account, 'Subject' => $account,
            'Destination' => $dest, 'SetupTime' => $this->event['start_stamp'] ?? now()->toDateTimeString(),
            'AnswerTime' => $this->event['answer_stamp'] ?? now()->toDateTimeString(),
            'Usage' => $usage.'s', 'OriginID' => $uuid,
        ];
        $row = BillingCdr::updateOrCreate(['origin_id'=>$uuid], ['tenant'=>config('billing.tenant'),'account'=>$account,'subject'=>$account,'destination'=>$dest,'direction'=>$direction,'gateway'=>$this->event['gateway'] ?? null,'setup_time'=>now(),'answer_time'=>now(),'usage_seconds'=>$usage,'status'=>'queued','raw'=>$this->event]);
        $result = $client->processCdr($payload);
        $row->update(['status'=>'rated','cgrates_response'=>$result]);
    }
}
