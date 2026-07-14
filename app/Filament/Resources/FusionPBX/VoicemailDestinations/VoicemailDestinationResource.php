<?php

namespace App\Filament\Resources\FusionPBX\VoicemailDestinations;

use App\Filament\Resources\FusionPBX\VoicemailDestinations\Pages;
use App\Filament\Resources\FusionPBX\VoicemailDestinations\Schemas;
use App\Filament\Resources\FusionPBX\VoicemailDestinations\Tables;
use App\Models\FusionPBX\VoicemailDestination;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class VoicemailDestinationResource extends Resource
{
    protected static ?string $slug = 'voicemail-destination';
    protected static \UnitEnum|string|null $navigationGroup = 'Voicemail';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';
    protected static ?int $navigationSort = 5;
protected static ?string $model = VoicemailDestination::class;
    protected static ?string $modelLabel = 'Voicemail Destination';

    protected static ?string $pluralModelLabel = 'Voicemail Destinations';

    protected static ?string $recordTitleAttribute = 'voicemail_destination_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\VoicemailDestinationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\VoicemailDestinationsTable::configure($table);
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
            'index' => Pages\ListVoicemailDestinations::route('/'),
            'create' => Pages\CreateVoicemailDestination::route('/create'),
            'edit' => Pages\EditVoicemailDestination::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
