<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrExtensions;

use App\Filament\Resources\FusionPBX\XmlCdrExtensions\Pages;
use App\Filament\Resources\FusionPBX\XmlCdrExtensions\Schemas;
use App\Filament\Resources\FusionPBX\XmlCdrExtensions\Tables;
use App\Models\FusionPBX\XmlCdrExtension;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class XmlCdrExtensionResource extends Resource
{
    protected static ?string $slug = 'xml-cdr-extension';
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone-arrow-up-right';
    protected static ?int $navigationSort = 2;
protected static ?string $model = XmlCdrExtension::class;
    protected static ?string $modelLabel = 'Xml Cdr Extension';

    protected static ?string $pluralModelLabel = 'Xml Cdr Extensions';

    protected static ?string $recordTitleAttribute = 'xml_cdr_extension_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\XmlCdrExtensionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\XmlCdrExtensionsTable::configure($table);
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
            'index' => Pages\ListXmlCdrExtensions::route('/'),
            'create' => Pages\CreateXmlCdrExtension::route('/create'),
            'edit' => Pages\EditXmlCdrExtension::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
