<?php

namespace App\Filament\Resources\FusionPBX\EmailQueues;

use App\Filament\Resources\FusionPBX\EmailQueues\Pages;
use App\Filament\Resources\FusionPBX\EmailQueues\Schemas;
use App\Filament\Resources\FusionPBX\EmailQueues\Tables;
use App\Models\FusionPBX\EmailQueue;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class EmailQueueResource extends Resource
{
    protected static ?string $slug = 'email-queue';
    protected static \UnitEnum|string|null $navigationGroup = 'Email';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-queue-list';
    protected static ?int $navigationSort = 1;
protected static ?string $model = EmailQueue::class;
    protected static ?string $modelLabel = 'Email Queue';

    protected static ?string $pluralModelLabel = 'Email Queues';

    protected static ?string $recordTitleAttribute = 'email_queue_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\EmailQueueForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\EmailQueuesTable::configure($table);
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
            'index' => Pages\ListEmailQueues::route('/'),
            'create' => Pages\CreateEmailQueue::route('/create'),
            'edit' => Pages\EditEmailQueue::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Messaging';
    }

}
