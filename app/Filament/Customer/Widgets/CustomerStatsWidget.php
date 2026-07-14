<?php
namespace App\Filament\Customer\Widgets;

use App\Services\Billing\StatsService;
use Filament\Widgets\Widget;

class CustomerStatsWidget extends Widget
{
    protected string $view = 'filament.customer.widgets.stats-widget';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;
    protected static ?string $pollingInterval = '60s';

    public function getViewData(): array
    {
        $customer = auth('customer')->user();
        $service  = app(StatsService::class);

        return [
            'today' => $service->getToday($customer->id),
            'month' => $service->getThisMonth($customer->id),
        ];
    }
}
