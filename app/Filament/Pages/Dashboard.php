<?php
namespace App\Filament\Pages;

use App\Filament\Widgets\BillingStatsWidget;
use App\Filament\Widgets\TodaysCallWidget;
use App\Filament\Widgets\ConcurrentCallsWidget;
use App\Filament\Widgets\DeviceGatewayWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        return 'heroicon-o-home';
    }

    public function getWidgets(): array
    {
        return [
            BillingStatsWidget::class,
            TodaysCallWidget::class,
            ConcurrentCallsWidget::class,
            DeviceGatewayWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'sm'      => 2,
            'lg'      => 4,
        ];
    }
}
