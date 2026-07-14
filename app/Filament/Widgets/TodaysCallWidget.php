<?php
namespace App\Filament\Widgets;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
class TodaysCallWidget extends Widget
{
    protected string $view = 'filament.widgets.todays-call-widget';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;
    protected static ?string $pollingInterval = '30s';
    public function getViewData(): array
    {
        $stats = DB::connection('astpp')->table('cdrs')->whereDate('callstart', now()->toDateString())
            ->selectRaw("COUNT(*) as total, SUM(CASE WHEN disposition='ANSWERED' THEN 1 ELSE 0 END) as answered, SUM(CASE WHEN call_direction='outbound' THEN 1 ELSE 0 END) as outbound, SUM(billseconds) as total_seconds, SUM(debit) as spent, SUM(CASE WHEN disposition='ANSWERED' THEN billseconds ELSE 0 END) as answered_seconds")->first();
        $total=$stats->total??0; $answered=$stats->answered??0; $seconds=$stats->total_seconds??0;
        $avgSec=$answered>0?(int)round($stats->answered_seconds/$answered):0;
        return ['total'=>$total,'answered'=>$answered,'outbound'=>$stats->outbound??0,'duration'=>sprintf('%02d:%02d:%02d',intdiv($seconds,3600),intdiv($seconds%3600,60),$seconds%60),'avg_talk'=>sprintf('%d:%02d',intdiv($avgSec,60),$avgSec%60),'spent'=>number_format($stats->spent??0,4)];
    }
}
