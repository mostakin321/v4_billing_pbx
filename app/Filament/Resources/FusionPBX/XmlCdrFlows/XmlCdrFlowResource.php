<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrFlows;

use App\Filament\Resources\FusionPBX\XmlCdrFlows\Pages;
use App\Filament\Resources\FusionPBX\XmlCdrFlows\Schemas;
use App\Filament\Resources\FusionPBX\XmlCdrFlows\Tables;
use App\Models\FusionPBX\XmlCdrFlow;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class XmlCdrFlowResource extends Resource
{
    protected static ?string $slug = 'xml-cdr-flow';
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrows-pointing-out';
    protected static ?int $navigationSort = 3;
protected static ?string $model = XmlCdrFlow::class;
    protected static ?string $modelLabel = 'Xml Cdr Flow';

    protected static ?string $pluralModelLabel = 'Xml Cdr Flows';

    protected static ?string $recordTitleAttribute = 'xml_cdr_flow_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\XmlCdrFlowForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\XmlCdrFlowsTable::configure($table);
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
            'index' => Pages\ListXmlCdrFlows::route('/'),
            'create' => Pages\CreateXmlCdrFlow::route('/create'),
            'edit' => Pages\EditXmlCdrFlow::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
