<?php

namespace App\Filament\Resources\FusionPBX\FollowMes;

use App\Filament\Resources\FusionPBX\FollowMes\Pages;
use App\Filament\Resources\FusionPBX\FollowMes\Schemas;
use App\Filament\Resources\FusionPBX\FollowMes\Tables;
use App\Models\FusionPBX\FollowMe;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FollowMeResource extends Resource
{
    protected static ?string $slug = 'follow-me';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-right-circle';
    protected static ?int $navigationSort = 7;
protected static ?string $model = FollowMe::class;
    protected static ?string $modelLabel = 'Follow Me';

    protected static ?string $pluralModelLabel = 'Follow Mes';

    protected static ?string $recordTitleAttribute = 'follow_me_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\FollowMeForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FollowMesTable::configure($table);
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
            'index' => Pages\ListFollowMes::route('/'),
            'create' => Pages\CreateFollowMe::route('/create'),
            'edit' => Pages\EditFollowMe::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
