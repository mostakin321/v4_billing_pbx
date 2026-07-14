<?php

namespace App\Filament\Resources\FusionPBX\VoicemailGreetings;

use App\Filament\Resources\FusionPBX\VoicemailGreetings\Pages;
use App\Filament\Resources\FusionPBX\VoicemailGreetings\Schemas;
use App\Filament\Resources\FusionPBX\VoicemailGreetings\Tables;
use App\Models\FusionPBX\VoicemailGreeting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class VoicemailGreetingResource extends Resource
{
    protected static ?string $slug = 'voicemail-greeting';
    protected static \UnitEnum|string|null $navigationGroup = 'Voicemail';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-speaker-wave';
    protected static ?int $navigationSort = 3;
protected static ?string $model = VoicemailGreeting::class;
    protected static ?string $modelLabel = 'Voicemail Greeting';

    protected static ?string $pluralModelLabel = 'Voicemail Greetings';

    protected static ?string $recordTitleAttribute = 'voicemail_greeting_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\VoicemailGreetingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\VoicemailGreetingsTable::configure($table);
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
            'index' => Pages\ListVoicemailGreetings::route('/'),
            'create' => Pages\CreateVoicemailGreeting::route('/create'),
            'edit' => Pages\EditVoicemailGreeting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
