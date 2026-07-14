<?php

namespace App\Services\Billing;

class StatsService
{
    public function getStats(...$args): array
    {
        return $this->emptyStats();
    }

    public function getToday(...$args): array
    {
        return $this->emptyStats();
    }

    public function getThisMonth(...$args): array
    {
        return $this->emptyStats();
    }

    public function getYesterday(...$args): array
    {
        return $this->emptyStats();
    }

    public function getLastMonth(...$args): array
    {
        return $this->emptyStats();
    }

    public function formatSeconds(int $s): string
    {
        return sprintf('%d:%02d', intdiv($s, 60), $s % 60);
    }

    private function emptyStats(): array
    {
        return [
            'total_calls' => 0,
            'answered' => 0,
            'failed' => 0,
            'asr' => 0,
            'acd' => 0,
            'acd_fmt' => '0:00',
            'mcd' => 0,
            'mcd_fmt' => '0:00',
            'debit' => 0,
            'cost' => 0,
            'profit' => 0,
            'minutes' => 0,
        ];
    }
}
