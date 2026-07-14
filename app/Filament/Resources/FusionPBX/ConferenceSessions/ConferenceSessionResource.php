<?php

namespace App\Filament\Resources\FusionPBX\ConferenceSessions;

use App\Filament\Resources\FusionPBX\ConferenceSessions\Pages;
use App\Filament\Resources\FusionPBX\ConferenceSessions\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceSessions\Tables;
use App\Models\FusionPBX\ConferenceSession;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceSessionResource extends Resource
{
    protected static ?string $slug = 'conference-session';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clock';
    protected static ?int $navigationSort = 9;
protected static ?string $model = ConferenceSession::class;
    protected static ?string $modelLabel = 'Conference Session';

    protected static ?string $pluralModelLabel = 'Conference Sessions';

    protected static ?string $recordTitleAttribute = 'conference_session_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceSessionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceSessionsTable::configure($table);
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
            'index' => Pages\ListConferenceSessions::route('/'),
            'create' => Pages\CreateConferenceSession::route('/create'),
            'edit' => Pages\EditConferenceSession::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
