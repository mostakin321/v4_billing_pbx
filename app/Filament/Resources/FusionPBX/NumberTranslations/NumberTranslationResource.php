<?php

namespace App\Filament\Resources\FusionPBX\NumberTranslations;

use App\Filament\Resources\FusionPBX\NumberTranslations\Pages;
use App\Filament\Resources\FusionPBX\NumberTranslations\Schemas;
use App\Filament\Resources\FusionPBX\NumberTranslations\Tables;
use App\Models\FusionPBX\NumberTranslation;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class NumberTranslationResource extends Resource
{
    protected static ?string $slug = 'number-translation';
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?int $navigationSort = 6;
protected static ?string $model = NumberTranslation::class;
    protected static ?string $modelLabel = 'Number Translation';

    protected static ?string $pluralModelLabel = 'Number Translations';

    protected static ?string $recordTitleAttribute = 'number_translation_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\NumberTranslationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\NumberTranslationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNumberTranslations::route('/'),
            'create' => Pages\CreateNumberTranslation::route('/create'),
            'edit' => Pages\EditNumberTranslation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Dialplan';
    }

}
