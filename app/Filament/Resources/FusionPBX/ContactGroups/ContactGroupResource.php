<?php

namespace App\Filament\Resources\FusionPBX\ContactGroups;

use App\Filament\Resources\FusionPBX\ContactGroups\Pages;
use App\Filament\Resources\FusionPBX\ContactGroups\Schemas;
use App\Filament\Resources\FusionPBX\ContactGroups\Tables;
use App\Models\FusionPBX\ContactGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactGroupResource extends Resource
{
    protected static ?string $slug = 'contact-group';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 6;
protected static ?string $model = ContactGroup::class;
    protected static ?string $modelLabel = 'Contact Group';

    protected static ?string $pluralModelLabel = 'Contact Groups';

    protected static ?string $recordTitleAttribute = 'contact_group_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactGroupForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactGroupsTable::configure($table);
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
            'index' => Pages\ListContactGroups::route('/'),
            'create' => Pages\CreateContactGroup::route('/create'),
            'edit' => Pages\EditContactGroup::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
