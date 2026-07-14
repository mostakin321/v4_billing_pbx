<?php

namespace App\Filament\Pages\Status;

use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;

class ActiveCalls extends Page
{
    public function getView(): string
    {
        return 'filament.pages.status.active-calls';
    }

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone-arrow-up-right';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?string $navigationLabel = 'Active Calls';
    protected static ?int $navigationSort = 10;

    public array $calls = [];
    public int $callCount = 0;
    public ?string $error = null;
    public string $lastUpdate = '';
    public string $output = '';

    public function getTitle(): string|Htmlable
    {
        return 'Active Calls';
    }

    public function mount(): void
    {
        $this->refresh();
    }

    public function refresh(): void
    {
        $result = FreeSwitchEsl::run('show channels as json');
        $this->lastUpdate = now()->format('H:i:s');

        if (!$result['ok']) {
            $this->error = $result['error'];
            $this->calls = [];
            $this->callCount = 0;
            return;
        }

        $this->error = null;
        $raw = $result['output'];
        $this->output = $raw;

        $cached = Cache::get('active_calls', []);
        $parsed = [];

        if (!empty($raw) && str_contains($raw, '{')) {
            $start = strpos($raw, '{');
            $end = strrpos($raw, '}');
            $json = $end !== false ? substr($raw, $start, $end - $start + 1) : substr($raw, $start);
            $data = json_decode($json, true);

            $rows = $data['rows'] ?? [];

            foreach ($rows as $row) {
                $uuid = $row['uuid'] ?? $row['call_uuid'] ?? uniqid('call_', true);
                $parsed[$uuid] = $row;
            }
        }

        foreach ($cached as $uuid => $cacheData) {
            if (!isset($parsed[$uuid])) {
                $parsed[$uuid] = $cacheData;
            } else {
                $parsed[$uuid] = array_merge($cacheData, $parsed[$uuid]);
            }
        }

        $this->calls = array_values($parsed);
        $this->callCount = count($this->calls);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label('Refresh')
                ->icon('heroicon-o-arrow-path')
                ->action('refresh')
                ->color('gray'),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'calls' => $this->calls,
            'callCount' => $this->callCount,
            'error' => $this->error,
            'lastUpdate' => $this->lastUpdate,
            'output' => $this->output,
        ];
    }

    public function getPollingInterval(): ?string
    {
        return '5s';
    }
}
