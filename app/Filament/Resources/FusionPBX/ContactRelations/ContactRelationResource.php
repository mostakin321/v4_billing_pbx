<?php

namespace App\Filament\Resources\FusionPBX\ContactRelations;

use App\Filament\Resources\FusionPBX\ContactRelations\Pages;
use App\Filament\Resources\FusionPBX\ContactRelations\Schemas;
use App\Filament\Resources\FusionPBX\ContactRelations\Tables;
use App\Models\FusionPBX\ContactRelation;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactRelationResource extends Resource
{
    protected static ?string $slug = 'contact-relation';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-top-right-on-square';
    protected static ?int $navigationSort = 10;
protected static ?string $model = ContactRelation::class;
    protected static ?string $modelLabel = 'Contact Relation';

    protected static ?string $pluralModelLabel = 'Contact Relations';

    protected static ?string $recordTitleAttribute = 'contact_relation_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactRelationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactRelationsTable::configure($table);
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
            'index' => Pages\ListContactRelations::route('/'),
            'create' => Pages\CreateContactRelation::route('/create'),
            'edit' => Pages\EditContactRelation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
