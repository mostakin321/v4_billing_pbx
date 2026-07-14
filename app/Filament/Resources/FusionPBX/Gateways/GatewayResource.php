<?php

namespace App\Filament\Resources\FusionPBX\Gateways;

use App\Filament\Resources\FusionPBX\Gateways\Pages;
use App\Filament\Resources\FusionPBX\Gateways\Schemas;
use App\Filament\Resources\FusionPBX\Gateways\Tables;
use App\Models\FusionPBX\Gateway;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class GatewayResource extends Resource
{
    protected static ?string $slug = 'gateway';
    protected static \UnitEnum|string|null $navigationGroup = 'SIP & Gateways';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?int $navigationSort = 1;
protected static ?string $model = Gateway::class;
    protected static ?string $modelLabel = 'Gateway';

    protected static ?string $pluralModelLabel = 'Gateways';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $form): Schema
    {
        return Schemas\GatewayForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\GatewaysTable::configure($table);
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
            'index' => Pages\ListGateways::route('/'),
            'create' => Pages\CreateGateway::route('/create'),
            'edit' => Pages\EditGateway::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'SIP & Gateways';
    }

}
