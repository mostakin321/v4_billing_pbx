<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class SystemStatus extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-server';
    protected static ?string $navigationLabel = 'System Status';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 30;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.system-status'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('status');
        $this->output = $result['ok'] ? $result['output'] : 'Error: '.$result['error'];
    }
}
