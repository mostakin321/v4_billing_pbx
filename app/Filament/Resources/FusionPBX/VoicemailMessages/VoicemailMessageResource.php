<?php

namespace App\Filament\Resources\FusionPBX\VoicemailMessages;

use App\Filament\Resources\FusionPBX\VoicemailMessages\Pages;
use App\Filament\Resources\FusionPBX\VoicemailMessages\Schemas;
use App\Filament\Resources\FusionPBX\VoicemailMessages\Tables;
use App\Models\FusionPBX\VoicemailMessage;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class VoicemailMessageResource extends Resource
{
    protected static ?string $slug = 'voicemail-message';
    protected static \UnitEnum|string|null $navigationGroup = 'Voicemail';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';
    protected static ?int $navigationSort = 2;
protected static ?string $model = VoicemailMessage::class;
    protected static ?string $modelLabel = 'Voicemail Message';

    protected static ?string $pluralModelLabel = 'Voicemail Messages';

    protected static ?string $recordTitleAttribute = 'voicemail_message_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\VoicemailMessageForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\VoicemailMessagesTable::configure($table);
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
            'index' => Pages\ListVoicemailMessages::route('/'),
            'create' => Pages\CreateVoicemailMessage::route('/create'),
            'edit' => Pages\EditVoicemailMessage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
