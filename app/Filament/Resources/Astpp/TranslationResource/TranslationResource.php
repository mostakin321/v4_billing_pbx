<?php

namespace App\Filament\Resources\Astpp\TranslationResource;

use App\Filament\Resources\Astpp\TranslationResource\Pages;
use App\Filament\Resources\Astpp\TranslationResource\Schemas\TranslationForm;
use App\Filament\Resources\Astpp\TranslationResource\Tables\TranslationTable;
use App\Models\Astpp\Translation;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class TranslationResource extends Resource
{
    protected static ?string $model = Translation::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Translations'; }
    public static function getModelLabel(): string { return 'Translations'; }
    public static function getPluralModelLabel(): string { return 'Translations'; }
    public static function getNavigationSort(): ?int { return 66; }

    public static function form(Schema $schema): Schema
    {
        return TranslationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TranslationTable::configure($table);
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
            'index' => Pages\ListTranslationRecords::route('/'),
            'create' => Pages\CreateTranslation::route('/create'),
            'edit' => Pages\EditTranslation::route('/{record}/edit'),
        ];
    }
}
