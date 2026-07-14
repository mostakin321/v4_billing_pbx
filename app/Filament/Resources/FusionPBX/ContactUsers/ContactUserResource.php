<?php

namespace App\Filament\Resources\FusionPBX\ContactUsers;

use App\Filament\Resources\FusionPBX\ContactUsers\Pages;
use App\Filament\Resources\FusionPBX\ContactUsers\Schemas;
use App\Filament\Resources\FusionPBX\ContactUsers\Tables;
use App\Models\FusionPBX\ContactUser;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactUserResource extends Resource
{
    protected static ?string $slug = 'contact-user';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-plus';
    protected static ?int $navigationSort = 7;
protected static ?string $model = ContactUser::class;
    protected static ?string $modelLabel = 'Contact User';

    protected static ?string $pluralModelLabel = 'Contact Users';

    protected static ?string $recordTitleAttribute = 'contact_user_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactUserForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactUsersTable::configure($table);
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
            'index' => Pages\ListContactUsers::route('/'),
            'create' => Pages\CreateContactUser::route('/create'),
            'edit' => Pages\EditContactUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
