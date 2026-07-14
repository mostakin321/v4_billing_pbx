<?php

namespace App\Filament\Resources\FusionPBX\CallCenterTiers;

use App\Filament\Resources\FusionPBX\CallCenterTiers\Pages;
use App\Filament\Resources\FusionPBX\CallCenterTiers\Schemas;
use App\Filament\Resources\FusionPBX\CallCenterTiers\Tables;
use App\Models\FusionPBX\CallCenterTier;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class CallCenterTierResource extends Resource
{
    protected static ?string $slug = 'call-center-tier';
    protected static \UnitEnum|string|null $navigationGroup = 'Call Center';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bars-3-bottom-left';
    protected static ?int $navigationSort = 3;
protected static ?string $model = CallCenterTier::class;
    protected static ?string $modelLabel = 'Call Center Tier';

    protected static ?string $pluralModelLabel = 'Call Center Tiers';

    protected static ?string $recordTitleAttribute = 'queue_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\CallCenterTierForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\CallCenterTiersTable::configure($table);
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
            'index' => Pages\ListCallCenterTiers::route('/'),
            'create' => Pages\CreateCallCenterTier::route('/create'),
            'edit' => Pages\EditCallCenterTier::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Call Center';
    }

}
