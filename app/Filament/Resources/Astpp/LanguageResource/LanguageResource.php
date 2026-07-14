<?php

namespace App\Filament\Resources\Astpp\LanguageResource;

use App\Filament\Resources\Astpp\LanguageResource\Pages;
use App\Filament\Resources\Astpp\LanguageResource\Schemas\LanguageForm;
use App\Filament\Resources\Astpp\LanguageResource\Tables\LanguageTable;
use App\Models\Astpp\Language;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class LanguageResource extends Resource
{
    protected static ?string $model = Language::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Languages'; }
    public static function getModelLabel(): string { return 'Languages'; }
    public static function getPluralModelLabel(): string { return 'Languages'; }
    public static function getNavigationSort(): ?int { return 34; }

    public static function form(Schema $schema): Schema
    {
        return LanguageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LanguageTable::configure($table);
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
            'index' => Pages\ListLanguageRecords::route('/'),
            'create' => Pages\CreateLanguage::route('/create'),
            'edit' => Pages\EditLanguage::route('/{record}/edit'),
        ];
    }
}
