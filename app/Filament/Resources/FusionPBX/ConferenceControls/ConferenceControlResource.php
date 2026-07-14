<?php

namespace App\Filament\Resources\FusionPBX\ConferenceControls;

use App\Filament\Resources\FusionPBX\ConferenceControls\Pages;
use App\Filament\Resources\FusionPBX\ConferenceControls\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceControls\Tables;
use App\Models\FusionPBX\ConferenceControl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceControlResource extends Resource
{
    protected static ?string $slug = 'conference-control';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?int $navigationSort = 5;
protected static ?string $model = ConferenceControl::class;
    protected static ?string $modelLabel = 'Conference Control';

    protected static ?string $pluralModelLabel = 'Conference Controls';

    protected static ?string $recordTitleAttribute = 'conference_control_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceControlForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceControlsTable::configure($table);
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
            'index' => Pages\ListConferenceControls::route('/'),
            'create' => Pages\CreateConferenceControl::route('/create'),
            'edit' => Pages\EditConferenceControl::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
