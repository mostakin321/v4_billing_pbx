<?php
namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Filament\Customer\Pages\CustomerDashboard;
use App\Filament\Customer\Pages\CustomerLogin;
use App\Filament\Customer\Resources\Cdrs\CustomerCdrResource;
use App\Filament\Customer\Resources\Invoices\CustomerInvoiceResource;
use App\Filament\Customer\Resources\Dids\CustomerDidResource;
use App\Filament\Customer\Widgets\CustomerBalanceWidget;
use App\Filament\Customer\Widgets\CustomerStatsWidget;

class CustomerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('customer')
            ->path('customer')
            ->login(CustomerLogin::class)
            ->colors(['primary' => Color::Green])
            ->brandName('Customer Portal')
            ->darkMode(true)

            ->pages([
                CustomerDashboard::class,
            ])

            ->resources([
                CustomerCdrResource::class,
                CustomerInvoiceResource::class,
                CustomerDidResource::class,
            ])

            ->widgets([
                CustomerBalanceWidget::class,
                CustomerStatsWidget::class,
            ])

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('customer');
    }
}
