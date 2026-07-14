<?php

namespace App\Filament\Resources\FusionPBX\SipProfileDomains;

use App\Filament\Resources\FusionPBX\SipProfileDomains\Pages;
use App\Filament\Resources\FusionPBX\SipProfileDomains\Schemas;
use App\Filament\Resources\FusionPBX\SipProfileDomains\Tables;
use App\Models\FusionPBX\SipProfileDomain;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class SipProfileDomainResource extends Resource
{
    protected static ?string $slug = 'sip-profile-domain';
    protected static \UnitEnum|string|null $navigationGroup = 'SIP & Gateways';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?int $navigationSort = 4;
protected static ?string $model = SipProfileDomain::class;
    protected static ?string $modelLabel = 'Sip Profile Domain';

    protected static ?string $pluralModelLabel = 'Sip Profile Domains';

    protected static ?string $recordTitleAttribute = 'sip_profile_domain_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\SipProfileDomainForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\SipProfileDomainsTable::configure($table);
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
            'index' => Pages\ListSipProfileDomains::route('/'),
            'create' => Pages\CreateSipProfileDomain::route('/create'),
            'edit' => Pages\EditSipProfileDomain::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'SIP & Gateways';
    }

}
