<?php

namespace App\Filament\Resources\Astpp\CliGroupResource;

use App\Filament\Resources\Astpp\CliGroupResource\Pages;
use App\Filament\Resources\Astpp\CliGroupResource\Schemas\CliGroupForm;
use App\Filament\Resources\Astpp\CliGroupResource\Tables\CliGroupTable;
use App\Models\Astpp\CliGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CliGroupResource extends Resource
{
    protected static ?string $model = CliGroup::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Cli Group'; }
    public static function getModelLabel(): string { return 'Cli Group'; }
    public static function getPluralModelLabel(): string { return 'Cli Group'; }
    public static function getNavigationSort(): ?int { return 18; }

    public static function form(Schema $schema): Schema
    {
        return CliGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CliGroupTable::configure($table);
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
            'index' => Pages\ListCliGroupRecords::route('/'),
            'create' => Pages\CreateCliGroup::route('/create'),
            'edit' => Pages\EditCliGroup::route('/{record}/edit'),
        ];
    }
}
