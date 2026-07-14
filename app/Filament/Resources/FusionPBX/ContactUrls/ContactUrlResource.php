<?php

namespace App\Filament\Resources\FusionPBX\ContactUrls;

use App\Filament\Resources\FusionPBX\ContactUrls\Pages;
use App\Filament\Resources\FusionPBX\ContactUrls\Schemas;
use App\Filament\Resources\FusionPBX\ContactUrls\Tables;
use App\Models\FusionPBX\ContactUrl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactUrlResource extends Resource
{
    protected static ?string $slug = 'contact-url';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?int $navigationSort = 12;
protected static ?string $model = ContactUrl::class;
    protected static ?string $modelLabel = 'Contact Url';

    protected static ?string $pluralModelLabel = 'Contact Urls';

    protected static ?string $recordTitleAttribute = 'contact_url_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactUrlForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactUrlsTable::configure($table);
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
            'index' => Pages\ListContactUrls::route('/'),
            'create' => Pages\CreateContactUrl::route('/create'),
            'edit' => Pages\EditContactUrl::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
