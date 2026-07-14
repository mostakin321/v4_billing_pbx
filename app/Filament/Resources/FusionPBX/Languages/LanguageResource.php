<?php

namespace App\Filament\Resources\FusionPBX\Languages;

use App\Filament\Resources\FusionPBX\Languages\Pages;
use App\Filament\Resources\FusionPBX\Languages\Schemas;
use App\Filament\Resources\FusionPBX\Languages\Tables;
use App\Models\FusionPBX\Language;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class LanguageResource extends Resource
{
    protected static ?string $slug = 'language';
    protected static \UnitEnum|string|null $navigationGroup = 'Phrases';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-language';
    protected static ?int $navigationSort = 3;
protected static ?string $model = Language::class;
    protected static ?string $modelLabel = 'Language';

    protected static ?string $pluralModelLabel = 'Languages';

    protected static ?string $recordTitleAttribute = 'language_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\LanguageForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\LanguagesTable::configure($table);
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
            'index' => Pages\ListLanguages::route('/'),
            'create' => Pages\CreateLanguage::route('/create'),
            'edit' => Pages\EditLanguage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
