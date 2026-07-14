<?php
namespace App\Filament\Pages\Status;
use App\Services\FreeSwitchEsl;
use Filament\Pages\Page;
class SipStatus extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-signal';
    protected static ?string $navigationLabel = 'SIP Status';
    protected static \UnitEnum|string|null $navigationGroup = 'Status';
    protected static ?int $navigationSort = 20;
    public string $output = '';
    public function getView(): string { return 'filament.pages.status.sip-status'; }
    public function mount(): void { $this->refresh(); }
    public function refresh(): void {
        $result = FreeSwitchEsl::run('sofia status');
        $this->output = $result['ok'] ? $result['output'] : 'Error: '.$result['error'];
    }
}
