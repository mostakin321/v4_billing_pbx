<?php

namespace App\Filament\Resources\FusionPBX\ContactPhones;

use App\Filament\Resources\FusionPBX\ContactPhones\Pages;
use App\Filament\Resources\FusionPBX\ContactPhones\Schemas;
use App\Filament\Resources\FusionPBX\ContactPhones\Tables;
use App\Models\FusionPBX\ContactPhone;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactPhoneResource extends Resource
{
    protected static ?string $slug = 'contact-phone';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone';
    protected static ?int $navigationSort = 2;
protected static ?string $model = ContactPhone::class;
    protected static ?string $modelLabel = 'Contact Phone';

    protected static ?string $pluralModelLabel = 'Contact Phones';

    protected static ?string $recordTitleAttribute = 'contact_phone_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactPhoneForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactPhonesTable::configure($table);
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
            'index' => Pages\ListContactPhones::route('/'),
            'create' => Pages\CreateContactPhone::route('/create'),
            'edit' => Pages\EditContactPhone::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
