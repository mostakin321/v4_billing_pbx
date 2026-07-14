<?php

namespace App\Filament\Resources\FusionPBX\ContactAttachments;

use App\Filament\Resources\FusionPBX\ContactAttachments\Pages;
use App\Filament\Resources\FusionPBX\ContactAttachments\Schemas;
use App\Filament\Resources\FusionPBX\ContactAttachments\Tables;
use App\Models\FusionPBX\ContactAttachment;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactAttachmentResource extends Resource
{
    protected static ?string $slug = 'contact-attachment';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paper-clip';
    protected static ?int $navigationSort = 9;
protected static ?string $model = ContactAttachment::class;
    protected static ?string $modelLabel = 'Contact Attachment';

    protected static ?string $pluralModelLabel = 'Contact Attachments';

    protected static ?string $recordTitleAttribute = 'contact_attachment_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactAttachmentForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactAttachmentsTable::configure($table);
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
            'index' => Pages\ListContactAttachments::route('/'),
            'create' => Pages\CreateContactAttachment::route('/create'),
            'edit' => Pages\EditContactAttachment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
