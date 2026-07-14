<?php

namespace App\Filament\Resources\Astpp\AccountUnverifiedResource;

use App\Filament\Resources\Astpp\AccountUnverifiedResource\Pages;
use App\Filament\Resources\Astpp\AccountUnverifiedResource\Schemas\AccountUnverifiedForm;
use App\Filament\Resources\Astpp\AccountUnverifiedResource\Tables\AccountUnverifiedTable;
use App\Models\Astpp\AccountUnverified;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class AccountUnverifiedResource extends Resource
{
    protected static ?string $model = AccountUnverified::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'Account Unverified'; }
    public static function getModelLabel(): string { return 'Account Unverified'; }
    public static function getPluralModelLabel(): string { return 'Account Unverified'; }
    public static function getNavigationSort(): ?int { return 2; }

    public static function form(Schema $schema): Schema
    {
        return AccountUnverifiedForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountUnverifiedTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $model = $query->getModel();
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        if (in_array('deleted', $columns, true)) {
            $query->where('deleted', 0);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccountUnverifiedRecords::route('/'),
            'create' => Pages\CreateAccountUnverified::route('/create'),
            'edit' => Pages\EditAccountUnverified::route('/{record}/edit'),
        ];
    }
}
