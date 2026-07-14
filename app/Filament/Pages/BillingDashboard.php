<?php

namespace App\Filament\Pages;

use App\Models\Billing\Account;
use App\Models\Billing\BillingCdr;
use App\Models\Billing\BillingTransaction;
use App\Services\Billing\CGRatesService;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class BillingDashboard extends Page
{
    protected static ?string $navigationLabel = 'Billing Dashboard';
    protected static \UnitEnum|string|null $navigationGroup = 'Billing';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';
    protected static ?int $navigationSort = 0;

    protected string $view = 'filament.pages.billing-dashboard';

    public bool $cgratesOnline = false;

    public function mount(): void
    {
        try {
            $this->cgratesOnline = app(CGRatesService::class)->ping();
        } catch (\Throwable) {
            $this->cgratesOnline = false;
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sync_all')
                ->label('Sync All → CGRateS')
                ->icon('heroicon-o-arrow-path')
                ->color('info')
                ->action(function (): void {
                    $cgr = app(CGRatesService::class);
                    $ok = $fail = 0;

                    Account::where('status', 0)->where('deleted', 0)
                        ->chunkById(100, function ($accounts) use ($cgr, &$ok, &$fail) {
                            foreach ($accounts as $a) {
                                $cgr->syncAccount($a) ? $ok++ : $fail++;
                            }
                        });

                    Notification::make()->title('CGRateS Bulk Sync')
                        ->body("✅ {$ok} synced  ❌ {$fail} failed")
                        ->success()->send();
                })
                ->requiresConfirmation(),
        ];
    }

    protected function getViewData(): array
    {
        $today = Carbon::today();

        $totalBalance = Account::where('status', 0)->where('deleted', 0)->sum('balance');
        $lowBalance = Account::where('status', 0)->where('deleted', 0)
            ->where('balance', '<', 5)->count();
        $zeroBalance = Account::where('status', 0)->where('deleted', 0)
            ->where('balance', '<=', 0)->count();
        $totalAccts = Account::where('status', 0)->where('deleted', 0)->count();
        $resellers = Account::where('type', 3)->where('deleted', 0)->count();
        $customers = Account::where('type', 0)->where('deleted', 0)->count();

        $callsToday = BillingCdr::whereDate('callstart', $today)->count();
        $revenueToday = BillingCdr::whereDate('callstart', $today)->sum('cost');
        $callsMonth = BillingCdr::whereMonth('callstart', $today->month)
            ->whereYear('callstart', $today->year)->count();
        $revenueMonth = BillingCdr::whereMonth('callstart', $today->month)
            ->whereYear('callstart', $today->year)->sum('cost');

        $recentTransactions = BillingTransaction::with('account')
            ->orderBy('created_at', 'desc')->limit(10)->get();
        $recentCdrs = BillingCdr::orderBy('callstart', 'desc')->limit(10)->get();

        return compact(
            'totalBalance', 'lowBalance', 'zeroBalance', 'totalAccts',
            'resellers', 'customers',
            'callsToday', 'revenueToday', 'callsMonth', 'revenueMonth',
            'recentTransactions', 'recentCdrs'
        );
    }
}
