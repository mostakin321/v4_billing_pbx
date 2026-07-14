<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrJsons;

use App\Filament\Resources\FusionPBX\XmlCdrJsons\Pages;
use App\Filament\Resources\FusionPBX\XmlCdrJsons\Schemas;
use App\Filament\Resources\FusionPBX\XmlCdrJsons\Tables;
use App\Models\FusionPBX\XmlCdrJson;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class XmlCdrJsonResource extends Resource
{
    protected static ?string $slug = 'xml-cdr-json';
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-code-bracket';
    protected static ?int $navigationSort = 4;
protected static ?string $model = XmlCdrJson::class;
    protected static ?string $modelLabel = 'Xml Cdr Json';

    protected static ?string $pluralModelLabel = 'Xml Cdr Jsons';

    protected static ?string $recordTitleAttribute = 'xml_cdr_json_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\XmlCdrJsonForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\XmlCdrJsonsTable::configure($table);
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
            'index' => Pages\ListXmlCdrJsons::route('/'),
            'create' => Pages\CreateXmlCdrJson::route('/create'),
            'edit' => Pages\EditXmlCdrJson::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
