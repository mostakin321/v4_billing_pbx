<?php

namespace App\Filament\Resources\FusionPBX\Contacts;

use App\Filament\Resources\FusionPBX\Contacts\Pages;
use App\Filament\Resources\FusionPBX\Contacts\Schemas;
use App\Filament\Resources\FusionPBX\Contacts\Tables;
use App\Models\FusionPBX\Contact;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $slug = 'contact';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-book-open';
    protected static ?int $navigationSort = 1;
protected static ?string $model = Contact::class;
    protected static ?string $modelLabel = 'Contact';

    protected static ?string $pluralModelLabel = 'Contacts';

    protected static ?string $recordTitleAttribute = 'contact_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactsTable::configure($table);
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
