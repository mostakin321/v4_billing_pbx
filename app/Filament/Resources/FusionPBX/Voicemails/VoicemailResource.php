<?php

namespace App\Filament\Resources\FusionPBX\Voicemails;

use App\Filament\Resources\FusionPBX\Voicemails\Pages;
use App\Filament\Resources\FusionPBX\Voicemails\Schemas;
use App\Filament\Resources\FusionPBX\Voicemails\Tables;
use App\Models\FusionPBX\Voicemail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class VoicemailResource extends Resource
{
    protected static ?string $slug = 'voicemail';
    protected static \UnitEnum|string|null $navigationGroup = 'Voicemail';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-inbox';
    protected static ?int $navigationSort = 1;
protected static ?string $model = Voicemail::class;
    protected static ?string $modelLabel = 'Voicemail';

    protected static ?string $pluralModelLabel = 'Voicemails';

    protected static ?string $recordTitleAttribute = 'voicemail_description';

    public static function form(Schema $form): Schema
    {
        return Schemas\VoicemailForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\VoicemailsTable::configure($table);
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
            'index' => Pages\ListVoicemails::route('/'),
            'create' => Pages\CreateVoicemail::route('/create'),
            'edit' => Pages\EditVoicemail::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
