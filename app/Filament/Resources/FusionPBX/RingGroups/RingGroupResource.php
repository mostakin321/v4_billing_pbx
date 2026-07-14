<?php

namespace App\Filament\Resources\FusionPBX\RingGroups;

use App\Filament\Resources\FusionPBX\RingGroups\Pages;
use App\Filament\Resources\FusionPBX\RingGroups\Schemas;
use App\Filament\Resources\FusionPBX\RingGroups\Tables;
use App\Models\FusionPBX\RingGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class RingGroupResource extends Resource
{
    protected static ?string $slug = 'ring-group';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 3;
protected static ?string $model = RingGroup::class;
    protected static ?string $modelLabel = 'Ring Group';

    protected static ?string $pluralModelLabel = 'Ring Groups';

    protected static ?string $recordTitleAttribute = 'ring_group_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\RingGroupForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\RingGroupsTable::configure($table);
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
            'index' => Pages\ListRingGroups::route('/'),
            'create' => Pages\CreateRingGroup::route('/create'),
            'edit' => Pages\EditRingGroup::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
