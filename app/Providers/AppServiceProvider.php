<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FusionPBX\Gateway;
use App\Observers\FusionPBX\GatewayObserver;
use App\Services\Billing\BillingService;
use App\Services\Billing\UserBillingService;
use App\Services\Billing\CGRatesService;
use App\Services\Billing\StatsService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BillingService::class);
        $this->app->singleton(UserBillingService::class);
        $this->app->singleton(CGRatesService::class);
        $this->app->singleton(StatsService::class);
    }

    public function boot(): void
    {
        Gateway::observe(GatewayObserver::class);
    }
}
