<?php
namespace App\Filament\Resources\Billing\LowBalance;
use App\Models\Billing\Account;
use App\Services\Billing\UserBillingService;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class LowBalanceResource extends Resource {
    protected static ?string $model          = Account::class;
    public static function getNavigationGroup(): ?string { return 'CDRs & Billing'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-exclamation-triangle'; }
    public static function getNavigationLabel(): string { return 'Low Balance'; }
    public static function getNavigationSort(): ?int { return 4; }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder {
        // Show accounts where balance <= notify_credit_limit (ASTPP logic)
        return parent::getEloquentQuery()
            ->where('status', 0)
            ->where('deleted', 0)
            ->whereIn('type', [0, 1, 3])
            ->where(function($q) {
                $q->whereRaw('posttoexternal = 0 AND balance <= notify_credit_limit')
                  ->orWhereRaw('posttoexternal = 1 AND (credit_limit - balance) <= notify_credit_limit');
            });
    }

    public static function form(Schema $form): Schema { return $form->schema([]); }
    public static function table(Table $table): Table { return Tables\LowBalanceTable::configure($table); }
    public static function canCreate(): bool { return false; }
    public static function getPages(): array {
        return ['index' => Pages\ListLowBalance::route('/')];
    }
}
