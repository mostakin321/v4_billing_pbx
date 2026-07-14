<?php

namespace App\Filament\Resources\FusionPBX\ConferenceControlDetails;

use App\Filament\Resources\FusionPBX\ConferenceControlDetails\Pages;
use App\Filament\Resources\FusionPBX\ConferenceControlDetails\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceControlDetails\Tables;
use App\Models\FusionPBX\ConferenceControlDetail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceControlDetailResource extends Resource
{
    protected static ?string $slug = 'conference-control-detail';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?int $navigationSort = 6;
protected static ?string $model = ConferenceControlDetail::class;
    protected static ?string $modelLabel = 'Conference Control Detail';

    protected static ?string $pluralModelLabel = 'Conference Control Details';

    protected static ?string $recordTitleAttribute = 'conference_control_detail_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceControlDetailForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceControlDetailsTable::configure($table);
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
            'index' => Pages\ListConferenceControlDetails::route('/'),
            'create' => Pages\CreateConferenceControlDetail::route('/create'),
            'edit' => Pages\EditConferenceControlDetail::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
