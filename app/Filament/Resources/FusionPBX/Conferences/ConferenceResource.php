<?php

namespace App\Filament\Resources\FusionPBX\Conferences;

use App\Filament\Resources\FusionPBX\Conferences\Pages;
use App\Filament\Resources\FusionPBX\Conferences\Schemas;
use App\Filament\Resources\FusionPBX\Conferences\Tables;
use App\Models\FusionPBX\Conference;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceResource extends Resource
{
    protected static ?string $slug = 'conference';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 2;
protected static ?string $model = Conference::class;
    protected static ?string $modelLabel = 'Conference';

    protected static ?string $pluralModelLabel = 'Conferences';

    protected static ?string $recordTitleAttribute = 'conference_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferencesTable::configure($table);
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
            'index' => Pages\ListConferences::route('/'),
            'create' => Pages\CreateConference::route('/create'),
            'edit' => Pages\EditConference::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
