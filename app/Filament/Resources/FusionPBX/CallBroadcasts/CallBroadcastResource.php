<?php

namespace App\Filament\Resources\FusionPBX\CallBroadcasts;

use App\Filament\Resources\FusionPBX\CallBroadcasts\Pages;
use App\Filament\Resources\FusionPBX\CallBroadcasts\Schemas;
use App\Filament\Resources\FusionPBX\CallBroadcasts\Tables;
use App\Models\FusionPBX\CallBroadcast;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class CallBroadcastResource extends Resource
{
    protected static ?string $slug = 'call-broadcast';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';
    protected static ?int $navigationSort = 13;
protected static ?string $model = CallBroadcast::class;
    protected static ?string $modelLabel = 'Call Broadcast';

    protected static ?string $pluralModelLabel = 'Call Broadcasts';

    protected static ?string $recordTitleAttribute = 'call_broadcast_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\CallBroadcastForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\CallBroadcastsTable::configure($table);
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
            'index' => Pages\ListCallBroadcasts::route('/'),
            'create' => Pages\CreateCallBroadcast::route('/create'),
            'edit' => Pages\EditCallBroadcast::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
