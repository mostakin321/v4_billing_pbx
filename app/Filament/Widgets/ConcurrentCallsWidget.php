<?php
namespace App\Filament\Widgets;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
class ConcurrentCallsWidget extends Widget
{
    protected string $view = 'filament.widgets.concurrent-calls-widget';
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 1;
    protected static ?string $pollingInterval = '10s';
    public function getViewData(): array
    {
        return ['concurrent'=>(int)DB::connection('astpp')->table('accounts')->sum('inuse'),'total_accounts'=>DB::connection('astpp')->table('accounts')->where('deleted',0)->where('status',0)->count(),'total_outstanding'=>number_format((float)DB::connection('astpp')->table('accounts')->where('deleted',0)->where('status',0)->where('posttoexternal',0)->where('balance','<=',0)->sum(DB::raw('ABS(balance)')),4)];
    }
}
