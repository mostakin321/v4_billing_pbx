<?php

namespace App\Filament\Resources\FusionPBX\ConferenceProfiles;

use App\Filament\Resources\FusionPBX\ConferenceProfiles\Pages;
use App\Filament\Resources\FusionPBX\ConferenceProfiles\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceProfiles\Tables;
use App\Models\FusionPBX\ConferenceProfile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceProfileResource extends Resource
{
    protected static ?string $slug = 'conference-profile';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-identification';
    protected static ?int $navigationSort = 7;
protected static ?string $model = ConferenceProfile::class;
    protected static ?string $modelLabel = 'Conference Profile';

    protected static ?string $pluralModelLabel = 'Conference Profiles';

    protected static ?string $recordTitleAttribute = 'conference_profile_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceProfileForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceProfilesTable::configure($table);
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
            'index' => Pages\ListConferenceProfiles::route('/'),
            'create' => Pages\CreateConferenceProfile::route('/create'),
            'edit' => Pages\EditConferenceProfile::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
