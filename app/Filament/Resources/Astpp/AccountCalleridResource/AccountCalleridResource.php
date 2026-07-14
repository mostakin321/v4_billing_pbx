<?php

namespace App\Filament\Resources\Astpp\AccountCalleridResource;

use App\Filament\Resources\Astpp\AccountCalleridResource\Pages;
use App\Filament\Resources\Astpp\AccountCalleridResource\Schemas\AccountCalleridForm;
use App\Filament\Resources\Astpp\AccountCalleridResource\Tables\AccountCalleridTable;
use App\Models\Astpp\AccountCallerid;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class AccountCalleridResource extends Resource
{
    protected static ?string $model = AccountCallerid::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Accounts Callerid'; }
    public static function getModelLabel(): string { return 'Accounts Callerid'; }
    public static function getPluralModelLabel(): string { return 'Accounts Callerid'; }
    public static function getNavigationSort(): ?int { return 4; }

    public static function form(Schema $schema): Schema
    {
        return AccountCalleridForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountCalleridTable::configure($table);
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
            'index' => Pages\ListAccountCalleridRecords::route('/'),
            'create' => Pages\CreateAccountCallerid::route('/create'),
            'edit' => Pages\EditAccountCallerid::route('/{record}/edit'),
        ];
    }
}
