<?php
namespace App\Filament\Pages\Status;

use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Contracts\Support\Htmlable;

class Registrations extends Page
{
    public function getView(): string
    {
        return 'filament.pages.status.registrations';
    }

    protected static string|\BackedEnum|null $navigationIcon  = 'heroicon-o-device-phone-mobile';
    protected static ?string $navigationLabel = 'Registrations';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int    $navigationSort  = 160;

    public array   $registrations = [];
    public int     $count         = 0;
    public ?string $error         = null;
    public string  $lastUpdate    = '';
    public string  $search        = '';

    public function getTitle(): string|Htmlable { return 'Registrations'; }

    public function mount(): void { $this->refresh(); }

    public function refresh(): void
    {
        $result = FreeSwitchEsl::run('show registrations as json');
        $this->lastUpdate = now()->format('H:i:s');

        if (!$result['ok']) {
            $this->error = $result['error'];
            $this->registrations = [];
            $this->count = 0;
            return;
        }

        $this->error = null;
        $raw = $result['output'];
        $parsed = [];

        if (!empty($raw) && str_contains($raw, '{')) {
            $json = substr($raw, strpos($raw, '{'));
            $data = json_decode($json, true);
            if (isset($data['rows'])) {
                $parsed = $data['rows'];
            }
        } elseif (!empty($raw) && !str_contains($raw, '{')) {
            // Parse table format: reg_user|realm|token|url|expires|...
            foreach (explode("\n", $raw) as $line) {
                $line = trim($line);
                if (!$line || str_starts_with($line, 'reg_user') || str_starts_with($line, '=')) continue;
                $parts = explode('|', $line);
                if (count($parts) >= 4) {
                    $parsed[] = [
                        'reg_user' => trim($parts[0]),
                        'realm'    => trim($parts[1]),
                        'url'      => trim($parts[3] ?? ''),
                        'expires'  => trim($parts[4] ?? ''),
                        'lan_ip'   => trim($parts[7] ?? ''),
                        'user_agent'=> trim($parts[10] ?? ''),
                    ];
                }
            }
        }

        // Apply search filter
        if ($this->search) {
            $s = strtolower($this->search);
            $parsed = array_filter($parsed, fn($r) =>
                str_contains(strtolower($r['reg_user'] ?? ''), $s) ||
                str_contains(strtolower($r['realm']    ?? ''), $s) ||
                str_contains(strtolower($r['url']      ?? ''), $s)
            );
        }

        $this->registrations = array_values($parsed);
        $this->count = count($this->registrations);
    }

    public function updatedSearch(): void { $this->refresh(); }

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
            'registrations' => $this->registrations,
            'count'         => $this->count,
            'error'         => $this->error,
            'lastUpdate'    => $this->lastUpdate,
        ];
    }
}
