<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class EmailQueueStatus extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Email Queue Status';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 50;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.email-queue'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('show channels as json');
        $this->output = $result['ok'] ? $result['output'] : 'ESL not available or no data.';
    }
}
