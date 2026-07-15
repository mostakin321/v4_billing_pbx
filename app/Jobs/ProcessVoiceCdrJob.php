<?php

namespace App\Jobs;

use App\Models\UnifiedCdr;
use App\Services\Billing\RatingService;
use App\Services\Wallet\WalletService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessVoiceCdrJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public array $payload) {}

    public function handle(RatingService $rating, WalletService $wallet): void
    {
        $cost = $rating->getVoiceCost($this->payload);

        UnifiedCdr::updateOrCreate(
            ['xml_cdr_uuid' => $this->payload['xml_cdr_uuid']],
            [
                'cgrates_account_id' => $this->payload['cgrates_account_id'],
                'domain_uuid' => $this->payload['domain_uuid'] ?? null,
                'extension_uuid' => $this->payload['extension_uuid'] ?? null,
                'domain_name' => $this->payload['domain_name'] ?? null,
                'direction' => $this->payload['direction'],
                'caller_id_number' => $this->payload['caller_id_number'],
                'destination_number' => $this->payload['destination_number'],
                'start_epoch' => $this->payload['start_epoch'],
                'answer_epoch' => $this->payload['answer_epoch'] ?? null,
                'end_epoch' => $this->payload['end_epoch'],
                'start_stamp' => Carbon::parse($this->payload['start_stamp']),
                'answer_stamp' => !empty($this->payload['answer_stamp']) ? Carbon::parse($this->payload['answer_stamp']) : null,
                'end_stamp' => Carbon::parse($this->payload['end_stamp']),
                'duration' => (int) $this->payload['duration'],
                'billsec' => (int) $this->payload['billsec'],
                'cost' => $cost,
                'hangup_cause' => $this->payload['hangup_cause'],
            ]
        );

        if ($cost > 0) {
            $wallet->debit(
                $this->payload['cgrates_account_id'],
                $cost,
                $this->payload['xml_cdr_uuid'],
                'Voice CDR debit'
            );
        }
    }
}
