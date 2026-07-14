<?php

namespace App\Filament\Resources\FusionPBX\EmailQueueAttachments;

use App\Filament\Resources\FusionPBX\EmailQueueAttachments\Pages;
use App\Filament\Resources\FusionPBX\EmailQueueAttachments\Schemas;
use App\Filament\Resources\FusionPBX\EmailQueueAttachments\Tables;
use App\Models\FusionPBX\EmailQueueAttachment;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class EmailQueueAttachmentResource extends Resource
{
    protected static ?string $slug = 'email-queue-attachment';
    protected static \UnitEnum|string|null $navigationGroup = 'Email';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paper-clip';
    protected static ?int $navigationSort = 2;
protected static ?string $model = EmailQueueAttachment::class;
    protected static ?string $modelLabel = 'Email Queue Attachment';

    protected static ?string $pluralModelLabel = 'Email Queue Attachments';

    protected static ?string $recordTitleAttribute = 'email_queue_attachment_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\EmailQueueAttachmentForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\EmailQueueAttachmentsTable::configure($table);
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
            'index' => Pages\ListEmailQueueAttachments::route('/'),
            'create' => Pages\CreateEmailQueueAttachment::route('/create'),
            'edit' => Pages\EditEmailQueueAttachment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Messaging';
    }

}
