<?php

namespace App\Filament\Resources\FusionPBX\ContactEmails;

use App\Filament\Resources\FusionPBX\ContactEmails\Pages;
use App\Filament\Resources\FusionPBX\ContactEmails\Schemas;
use App\Filament\Resources\FusionPBX\ContactEmails\Tables;
use App\Models\FusionPBX\ContactEmail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactEmailResource extends Resource
{
    protected static ?string $slug = 'contact-email';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-at-symbol';
    protected static ?int $navigationSort = 3;
protected static ?string $model = ContactEmail::class;
    protected static ?string $modelLabel = 'Contact Email';

    protected static ?string $pluralModelLabel = 'Contact Emails';

    protected static ?string $recordTitleAttribute = 'contact_email_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactEmailForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactEmailsTable::configure($table);
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
            'index' => Pages\ListContactEmails::route('/'),
            'create' => Pages\CreateContactEmail::route('/create'),
            'edit' => Pages\EditContactEmail::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
