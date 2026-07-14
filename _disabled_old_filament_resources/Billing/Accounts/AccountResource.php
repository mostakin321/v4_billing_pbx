<?php

namespace App\Filament\Resources\Billing\Accounts;

use App\Models\Billing\Account;
use App\Services\Billing\CGRatesService;
use App\Services\Billing\UserBillingService;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class AccountResource extends Resource
{
    protected static ?string $model           = Account::class;
    public static function getNavigationGroup(): ?string { return 'Billing'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-users'; }
    public static function getNavigationLabel(): string { return 'Accounts'; }
    public static function getNavigationSort(): ?int { return 1; }

    public static function form(Schema $form): Schema
    {
        return Schemas\AccountForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\AccountsTable::configure($table);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $q = parent::getEloquentQuery()->where('deleted', 0);
        return app(UserBillingService::class)->applyScope($q, auth()->user());
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit'   => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
