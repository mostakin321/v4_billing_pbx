<?php

namespace App\Filament\Resources\FusionPBX\RingGroupDestinations;

use App\Filament\Resources\FusionPBX\RingGroupDestinations\Pages;
use App\Filament\Resources\FusionPBX\RingGroupDestinations\Schemas;
use App\Filament\Resources\FusionPBX\RingGroupDestinations\Tables;
use App\Models\FusionPBX\RingGroupDestination;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class RingGroupDestinationResource extends Resource
{
    protected static ?string $slug = 'ring-group-destination';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-right';
    protected static ?int $navigationSort = 4;
protected static ?string $model = RingGroupDestination::class;
    protected static ?string $modelLabel = 'Ring Group Destination';

    protected static ?string $pluralModelLabel = 'Ring Group Destinations';

    protected static ?string $recordTitleAttribute = 'destination_number';

    public static function form(Schema $form): Schema
    {
        return Schemas\RingGroupDestinationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\RingGroupDestinationsTable::configure($table);
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
            'index' => Pages\ListRingGroupDestinations::route('/'),
            'create' => Pages\CreateRingGroupDestination::route('/create'),
            'edit' => Pages\EditRingGroupDestination::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
