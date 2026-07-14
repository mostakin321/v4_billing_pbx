<?php

namespace App\Filament\Resources\FusionPBX\Notifications;

use App\Filament\Resources\FusionPBX\Notifications\Pages;
use App\Filament\Resources\FusionPBX\Notifications\Schemas;
use App\Filament\Resources\FusionPBX\Notifications\Tables;
use App\Models\FusionPBX\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class NotificationResource extends Resource
{
    protected static ?string $slug = 'notification';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bell';
    protected static ?int $navigationSort = 15;
protected static ?string $model = Notification::class;
    protected static ?string $modelLabel = 'Notification';

    protected static ?string $pluralModelLabel = 'Notifications';

    protected static ?string $recordTitleAttribute = 'notification_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\NotificationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\NotificationsTable::configure($table);
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Messaging';
    }

}
