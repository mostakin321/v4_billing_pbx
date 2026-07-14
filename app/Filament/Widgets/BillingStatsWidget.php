<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BillingStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Billing', 'Ready'),
            Stat::make('ASTPP', 'Connected'),
            Stat::make('Status', 'OK'),
        ];
    }
}
