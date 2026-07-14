<?php

namespace App\Filament\Resources\FusionPBX\OutboundRoutes;

use App\Filament\Resources\FusionPBX\OutboundRoutes\Pages;
use App\Filament\Resources\FusionPBX\OutboundRoutes\Schemas\OutboundRouteEditForm;
use App\Filament\Resources\FusionPBX\OutboundRoutes\Tables\OutboundRoutesTable;
use App\Models\FusionPBX\OutboundRoute;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class OutboundRouteResource extends Resource
{
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static ?int $navigationSort = 3;
protected static ?string $model                = OutboundRoute::class;
    protected static ?string $navigationLabel      = 'Outbound Routes';
    protected static ?string $modelLabel           = 'Outbound Route';
    protected static ?string $pluralModelLabel     = 'Outbound Routes';
protected static ?string $recordTitleAttribute = 'dialplan_name';
    protected static ?string $slug                 = 'outbound-routes';

    public static function form(Schema $form): Schema
    {
        // Edit page uses simplified dialplan form
        return OutboundRouteEditForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return OutboundRoutesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOutboundRoutes::route('/'),
            'create' => Pages\CreateOutboundRoute::route('/create'),
            'edit'   => Pages\EditOutboundRoute::route('/{record}/edit'),
        ];
    }
}
