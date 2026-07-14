<?php

namespace App\Filament\Resources\FusionPBX\ConferenceProfileParams;

use App\Filament\Resources\FusionPBX\ConferenceProfileParams\Pages;
use App\Filament\Resources\FusionPBX\ConferenceProfileParams\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceProfileParams\Tables;
use App\Models\FusionPBX\ConferenceProfileParam;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceProfileParamResource extends Resource
{
    protected static ?string $slug = 'conference-profile-param';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-code-bracket';
    protected static ?int $navigationSort = 8;
protected static ?string $model = ConferenceProfileParam::class;
    protected static ?string $modelLabel = 'Conference Profile Param';

    protected static ?string $pluralModelLabel = 'Conference Profile Params';

    protected static ?string $recordTitleAttribute = 'conference_profile_param_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceProfileParamForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceProfileParamsTable::configure($table);
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
            'index' => Pages\ListConferenceProfileParams::route('/'),
            'create' => Pages\CreateConferenceProfileParam::route('/create'),
            'edit' => Pages\EditConferenceProfileParam::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
