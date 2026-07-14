<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrs;

use App\Filament\Resources\FusionPBX\XmlCdrs\Pages;
use App\Filament\Resources\FusionPBX\XmlCdrs\Schemas;
use App\Filament\Resources\FusionPBX\XmlCdrs\Tables;
use App\Models\FusionPBX\XmlCdr;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class XmlCdrResource extends Resource
{
    protected static ?string $slug = 'xml-cdr';
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?int $navigationSort = 1;
protected static ?string $model = XmlCdr::class;
    protected static ?string $modelLabel = 'Xml Cdr';

    protected static ?string $pluralModelLabel = 'Xml Cdrs';

    protected static ?string $recordTitleAttribute = 'destination_number';

    public static function form(Schema $form): Schema
    {
        return Schemas\XmlCdrForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\XmlCdrsTable::configure($table);
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
            'index' => Pages\ListXmlCdrs::route('/'),
            'create' => Pages\CreateXmlCdr::route('/create'),
            'edit' => Pages\EditXmlCdr::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
