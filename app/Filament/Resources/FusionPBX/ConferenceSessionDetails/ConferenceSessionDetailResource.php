<?php

namespace App\Filament\Resources\FusionPBX\ConferenceSessionDetails;

use App\Filament\Resources\FusionPBX\ConferenceSessionDetails\Pages;
use App\Filament\Resources\FusionPBX\ConferenceSessionDetails\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceSessionDetails\Tables;
use App\Models\FusionPBX\ConferenceSessionDetail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceSessionDetailResource extends Resource
{
    protected static ?string $slug = 'conference-session-detail';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?int $navigationSort = 10;
protected static ?string $model = ConferenceSessionDetail::class;
    protected static ?string $modelLabel = 'Conference Session Detail';

    protected static ?string $pluralModelLabel = 'Conference Session Details';

    protected static ?string $recordTitleAttribute = 'username';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceSessionDetailForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceSessionDetailsTable::configure($table);
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
            'index' => Pages\ListConferenceSessionDetails::route('/'),
            'create' => Pages\CreateConferenceSessionDetail::route('/create'),
            'edit' => Pages\EditConferenceSessionDetail::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
