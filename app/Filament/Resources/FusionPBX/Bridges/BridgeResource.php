<?php

namespace App\Filament\Resources\FusionPBX\Bridges;

use App\Filament\Resources\FusionPBX\Bridges\Pages;
use App\Filament\Resources\FusionPBX\Bridges\Schemas;
use App\Filament\Resources\FusionPBX\Bridges\Tables;
use App\Models\FusionPBX\Bridge;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class BridgeResource extends Resource
{
    protected static ?string $slug = 'bridge';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?int $navigationSort = 12;
protected static ?string $model = Bridge::class;
    protected static ?string $modelLabel = 'Bridge';

    protected static ?string $pluralModelLabel = 'Bridges';

    protected static ?string $recordTitleAttribute = 'bridge_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\BridgeForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\BridgesTable::configure($table);
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
            'index' => Pages\ListBridges::route('/'),
            'create' => Pages\CreateBridge::route('/create'),
            'edit' => Pages\EditBridge::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Dialplan';
    }

}
