<?php

namespace App\Filament\Resources\FusionPBX\SipProfiles;

use App\Filament\Resources\FusionPBX\SipProfiles\Pages;
use App\Filament\Resources\FusionPBX\SipProfiles\Schemas;
use App\Filament\Resources\FusionPBX\SipProfiles\Tables;
use App\Models\FusionPBX\SipProfile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class SipProfileResource extends Resource
{
    protected static ?string $slug = 'sip-profile';
    protected static \UnitEnum|string|null $navigationGroup = 'SIP & Gateways';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-server';
    protected static ?int $navigationSort = 2;
protected static ?string $model = SipProfile::class;
    protected static ?string $modelLabel = 'Sip Profile';

    protected static ?string $pluralModelLabel = 'Sip Profiles';

    protected static ?string $recordTitleAttribute = 'sip_profile_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\SipProfileForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\SipProfilesTable::configure($table);
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
            'index' => Pages\ListSipProfiles::route('/'),
            'create' => Pages\CreateSipProfile::route('/create'),
            'edit' => Pages\EditSipProfile::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'SIP & Gateways';
    }

}
