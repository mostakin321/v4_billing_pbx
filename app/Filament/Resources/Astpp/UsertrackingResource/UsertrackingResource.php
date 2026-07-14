<?php

namespace App\Filament\Resources\Astpp\UsertrackingResource;

use App\Filament\Resources\Astpp\UsertrackingResource\Pages;
use App\Filament\Resources\Astpp\UsertrackingResource\Schemas\UsertrackingForm;
use App\Filament\Resources\Astpp\UsertrackingResource\Tables\UsertrackingTable;
use App\Models\Astpp\Usertracking;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class UsertrackingResource extends Resource
{
    protected static ?string $model = Usertracking::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Usertracking'; }
    public static function getModelLabel(): string { return 'Usertracking'; }
    public static function getPluralModelLabel(): string { return 'Usertracking'; }
    public static function getNavigationSort(): ?int { return 69; }

    public static function form(Schema $schema): Schema
    {
        return UsertrackingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsertrackingTable::configure($table);
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
            'index' => Pages\ListUsertrackingRecords::route('/'),
            'create' => Pages\CreateUsertracking::route('/create'),
            'edit' => Pages\EditUsertracking::route('/{record}/edit'),
        ];
    }
}
