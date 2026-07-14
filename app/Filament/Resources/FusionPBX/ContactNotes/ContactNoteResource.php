<?php

namespace App\Filament\Resources\FusionPBX\ContactNotes;

use App\Filament\Resources\FusionPBX\ContactNotes\Pages;
use App\Filament\Resources\FusionPBX\ContactNotes\Schemas;
use App\Filament\Resources\FusionPBX\ContactNotes\Tables;
use App\Models\FusionPBX\ContactNote;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactNoteResource extends Resource
{
    protected static ?string $slug = 'contact-note';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?int $navigationSort = 5;
protected static ?string $model = ContactNote::class;
    protected static ?string $modelLabel = 'Contact Note';

    protected static ?string $pluralModelLabel = 'Contact Notes';

    protected static ?string $recordTitleAttribute = 'contact_note_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactNoteForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactNotesTable::configure($table);
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
            'index' => Pages\ListContactNotes::route('/'),
            'create' => Pages\CreateContactNote::route('/create'),
            'edit' => Pages\EditContactNote::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
