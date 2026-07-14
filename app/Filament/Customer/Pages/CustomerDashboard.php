<?php
namespace App\Filament\Customer\Pages;

use Filament\Pages\Dashboard;
use App\Filament\Customer\Widgets\CustomerBalanceWidget;
use App\Filament\Customer\Widgets\CustomerStatsWidget;

class CustomerDashboard extends Dashboard
{

    public static function getNavigationLabel(): string { return 'Dashboard'; }

    public function getWidgets(): array
    {
        return [
            CustomerBalanceWidget::class,
            CustomerStatsWidget::class,
        ];
    }

    public function getColumns(): int|array { return 2; }
}
