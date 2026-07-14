<?php
namespace App\Filament\Widgets;

use App\Services\FreeSwitchEsl;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ActiveCallsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected ?string $pollingInterval = '10s';
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Active calls from ESL (cached for 10s)
        $activeCalls = Cache::remember('widget:active_calls', 10, function () {
            $result = FreeSwitchEsl::run('show calls count');
            if (!$result['ok']) return 0;
            preg_match('/(\d+)\s+total/', $result['output'], $m);
            return (int)($m[1] ?? 0);
        });

        // Registrations count
        $registrations = Cache::remember('widget:registrations', 30, function () {
            $result = FreeSwitchEsl::run('show registrations count');
            if (!$result['ok']) return 0;
            preg_match('/(\d+)\s+total/', $result['output'], $m);
            return (int)($m[1] ?? 0);
        });

        // Today's CDR stats
        $today = Cache::remember('widget:cdr_today', 60, function () {
            try {
                return DB::connection('fusionpbx')
                    ->table('v_xml_cdr')
                    ->whereDate('start_stamp', today())
                    ->selectRaw('COUNT(*) as total, SUM(CASE WHEN missed_call THEN 1 ELSE 0 END) as missed, SUM(billsec) as billsec')
                    ->first();
            } catch (\Throwable) {
                return (object)['total' => 0, 'missed' => 0, 'billsec' => 0];
            }
        });

        // Call center agents online
        $agentsOnline = Cache::remember('widget:agents_online', 30, function () {
            $result = FreeSwitchEsl::run('callcenter_config agent list');
            if (!$result['ok']) return '—';
            $online = substr_count($result['output'], 'Available');
            $total  = max(1, substr_count($result['output'], "\n") - 3);
            return "{$online}/{$total}";
        });

        $totalBillsec = (int)($today->billsec ?? 0);
        $talkTime = sprintf('%dh %dm', intdiv($totalBillsec, 3600), intdiv($totalBillsec % 3600, 60));

        return [
            Stat::make('Active Calls', $activeCalls)
                ->description('Live calls right now')
                ->icon('heroicon-o-phone-arrow-up-right')
                ->color($activeCalls > 0 ? 'success' : 'gray'),

            Stat::make('Registrations', $registrations)
                ->description('SIP endpoints registered')
                ->icon('heroicon-o-device-phone-mobile')
                ->color('info'),

            Stat::make("Today's Calls", $today->total ?? 0)
                ->description(($today->missed ?? 0).' missed')
                ->icon('heroicon-o-chart-bar')
                ->color('primary'),

            Stat::make('Talk Time Today', $talkTime)
                ->description('Total billed seconds')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('CC Agents', $agentsOnline)
                ->description('Available / Total')
                ->icon('heroicon-o-user-group')
                ->color('success'),
        ];
    }
}
