<?php

namespace App\Filament\Widgets;

use App\Models\FusionPBX\CallCenterQueue;
use App\Models\FusionPBX\Dialplan;
use App\Models\FusionPBX\Extension;
use App\Models\FusionPBX\Gateway;
use App\Models\FusionPBX\XmlCdr;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PbxStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();

        return [
            Stat::make('Calls Today', XmlCdr::where('start_stamp', '>=', $today)->count())
                ->icon('heroicon-o-phone'),
            Stat::make('Extensions', Extension::count())
                ->icon('heroicon-o-user'),
            Stat::make('Gateways', Gateway::count())
                ->icon('heroicon-o-arrows-right-left'),
            Stat::make('Dialplans', Dialplan::count())
                ->icon('heroicon-o-squares-2x2'),
            Stat::make('Call Center Queues', CallCenterQueue::count())
                ->icon('heroicon-o-phone-arrow-up-right'),
        ];
    }
}
