<?php

namespace App\Filament\Resources\FusionPBX\MusicOnHolds;

use App\Filament\Resources\FusionPBX\MusicOnHolds\Pages;
use App\Filament\Resources\FusionPBX\MusicOnHolds\Schemas;
use App\Filament\Resources\FusionPBX\MusicOnHolds\Tables;
use App\Models\FusionPBX\MusicOnHold;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class MusicOnHoldResource extends Resource
{
    protected static ?string $slug = 'music-on-hold';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-musical-note';
    protected static ?int $navigationSort = 11;
protected static ?string $model = MusicOnHold::class;
    protected static ?string $modelLabel = 'Music On Hold';

    protected static ?string $pluralModelLabel = 'Music On Holds';

    protected static ?string $recordTitleAttribute = 'music_on_hold_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\MusicOnHoldForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\MusicOnHoldsTable::configure($table);
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
            'index' => Pages\ListMusicOnHolds::route('/'),
            'create' => Pages\CreateMusicOnHold::route('/create'),
            'edit' => Pages\EditMusicOnHold::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
