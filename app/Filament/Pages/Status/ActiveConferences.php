<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class ActiveConferences extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Active Conferences';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 15;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.active-conferences'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('conference list');
        $this->output = $result['ok'] ? $result['output'] : 'Error: '.$result['error'];
    }
}
