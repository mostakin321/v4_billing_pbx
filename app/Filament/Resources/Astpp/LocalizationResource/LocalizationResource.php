<?php

namespace App\Filament\Resources\Astpp\LocalizationResource;

use App\Filament\Resources\Astpp\LocalizationResource\Pages;
use App\Filament\Resources\Astpp\LocalizationResource\Schemas\LocalizationForm;
use App\Filament\Resources\Astpp\LocalizationResource\Tables\LocalizationTable;
use App\Models\Astpp\Localization;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class LocalizationResource extends Resource
{
    protected static ?string $model = Localization::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Localization'; }
    public static function getModelLabel(): string { return 'Localization'; }
    public static function getPluralModelLabel(): string { return 'Localization'; }
    public static function getNavigationSort(): ?int { return 36; }

    public static function form(Schema $schema): Schema
    {
        return LocalizationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocalizationTable::configure($table);
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
            'index' => Pages\ListLocalizationRecords::route('/'),
            'create' => Pages\CreateLocalization::route('/create'),
            'edit' => Pages\EditLocalization::route('/{record}/edit'),
        ];
    }
}
