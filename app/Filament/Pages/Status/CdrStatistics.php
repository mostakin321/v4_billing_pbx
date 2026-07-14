<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class CdrStatistics extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'CDR Statistics';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 40;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.cdr-statistics'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('show calls count as json');
        $this->output = $result['ok'] ? $result['output'] : 'ESL not available or no data.';
    }
}
