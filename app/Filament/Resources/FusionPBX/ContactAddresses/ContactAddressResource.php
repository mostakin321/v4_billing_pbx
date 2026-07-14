<?php

namespace App\Filament\Resources\FusionPBX\ContactAddresses;

use App\Filament\Resources\FusionPBX\ContactAddresses\Pages;
use App\Filament\Resources\FusionPBX\ContactAddresses\Schemas;
use App\Filament\Resources\FusionPBX\ContactAddresses\Tables;
use App\Models\FusionPBX\ContactAddress;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactAddressResource extends Resource
{
    protected static ?string $slug = 'contact-address';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';
    protected static ?int $navigationSort = 4;
protected static ?string $model = ContactAddress::class;
    protected static ?string $modelLabel = 'Contact Address';

    protected static ?string $pluralModelLabel = 'Contact Addresses';

    protected static ?string $recordTitleAttribute = 'contact_address_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactAddressForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactAddressesTable::configure($table);
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
            'index' => Pages\ListContactAddresses::route('/'),
            'create' => Pages\CreateContactAddress::route('/create'),
            'edit' => Pages\EditContactAddress::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
