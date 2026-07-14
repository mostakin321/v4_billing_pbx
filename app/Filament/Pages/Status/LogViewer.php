<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class LogViewer extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Log Viewer';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 60;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.log-viewer'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('show log as json');
        $this->output = $result['ok'] ? $result['output'] : 'ESL not available or no data.';
    }
}
