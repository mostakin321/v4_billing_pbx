<?php

namespace App\Filament\Resources\FusionPBX\FollowMeDestinations;

use App\Filament\Resources\FusionPBX\FollowMeDestinations\Pages;
use App\Filament\Resources\FusionPBX\FollowMeDestinations\Schemas;
use App\Filament\Resources\FusionPBX\FollowMeDestinations\Tables;
use App\Models\FusionPBX\FollowMeDestination;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FollowMeDestinationResource extends Resource
{
    protected static ?string $slug = 'follow-me-destination';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';
    protected static ?int $navigationSort = 8;
protected static ?string $model = FollowMeDestination::class;
    protected static ?string $modelLabel = 'Follow Me Destination';

    protected static ?string $pluralModelLabel = 'Follow Me Destinations';

    protected static ?string $recordTitleAttribute = 'follow_me_destination_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\FollowMeDestinationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FollowMeDestinationsTable::configure($table);
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
            'index' => Pages\ListFollowMeDestinations::route('/'),
            'create' => Pages\CreateFollowMeDestination::route('/create'),
            'edit' => Pages\EditFollowMeDestination::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
