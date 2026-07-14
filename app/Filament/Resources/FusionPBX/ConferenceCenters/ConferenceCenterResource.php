<?php

namespace App\Filament\Resources\FusionPBX\ConferenceCenters;

use App\Filament\Resources\FusionPBX\ConferenceCenters\Pages;
use App\Filament\Resources\FusionPBX\ConferenceCenters\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceCenters\Tables;
use App\Models\FusionPBX\ConferenceCenter;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceCenterResource extends Resource
{
    protected static ?string $slug = 'conference-center';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office';
    protected static ?int $navigationSort = 1;
protected static ?string $model = ConferenceCenter::class;
    protected static ?string $modelLabel = 'Conference Center';

    protected static ?string $pluralModelLabel = 'Conference Centers';

    protected static ?string $recordTitleAttribute = 'conference_center_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceCenterForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceCentersTable::configure($table);
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
            'index' => Pages\ListConferenceCenters::route('/'),
            'create' => Pages\CreateConferenceCenter::route('/create'),
            'edit' => Pages\EditConferenceCenter::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
