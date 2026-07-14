<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class AgentStatus extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Agent Status';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 17;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.agent-status'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('callcenter_config agent list');
        $this->output = $result['ok'] ? $result['output'] : 'Error: '.$result['error'];
    }
}
