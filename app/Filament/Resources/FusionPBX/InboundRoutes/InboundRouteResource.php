<?php

namespace App\Filament\Resources\FusionPBX\InboundRoutes;

use App\Filament\Resources\FusionPBX\InboundRoutes\Pages;
use App\Filament\Resources\FusionPBX\InboundRoutes\Schemas\InboundRouteForm;
use App\Filament\Resources\FusionPBX\InboundRoutes\Tables\InboundRoutesTable;
use App\Models\FusionPBX\Destination;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InboundRouteResource extends Resource
{
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?int $navigationSort = 2;
protected static ?string $model                = Destination::class;
    protected static ?string $navigationLabel      = 'Inbound Routes';
    protected static ?string $modelLabel           = 'Inbound Route';
    protected static ?string $pluralModelLabel     = 'Inbound Routes';
protected static ?string $recordTitleAttribute = 'destination_number';
    protected static ?string $slug                 = 'inbound-routes';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('destination_type', 'inbound');
    }

    public static function form(Schema $form): Schema
    {
        return InboundRouteForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return InboundRoutesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInboundRoutes::route('/'),
            'create' => Pages\CreateInboundRoute::route('/create'),
            'edit'   => Pages\EditInboundRoute::route('/{record}/edit'),
        ];
    }
}
