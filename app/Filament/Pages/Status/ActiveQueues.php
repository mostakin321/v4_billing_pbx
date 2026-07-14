<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class ActiveQueues extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $navigationLabel = 'Active Queues';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 18;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.active-queues'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('callcenter_config queue list');
        $this->output = $result['ok'] ? $result['output'] : 'Error: '.$result['error'];
    }
}
