<?php

namespace App\Filament\Resources\FusionPBX\DashboardGroups;

use App\Filament\Resources\FusionPBX\DashboardGroups\Pages;
use App\Filament\Resources\FusionPBX\DashboardGroups\Schemas;
use App\Filament\Resources\FusionPBX\DashboardGroups\Tables;
use App\Models\FusionPBX\DashboardGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DashboardGroupResource extends Resource
{
    protected static ?string $slug = 'dashboard-group';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?int $navigationSort = 14;
protected static ?string $model = DashboardGroup::class;
    protected static ?string $modelLabel = 'Dashboard Group';

    protected static ?string $pluralModelLabel = 'Dashboard Groups';

    protected static ?string $recordTitleAttribute = 'dashboard_group_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DashboardGroupForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DashboardGroupsTable::configure($table);
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
            'index' => Pages\ListDashboardGroups::route('/'),
            'create' => Pages\CreateDashboardGroup::route('/create'),
            'edit' => Pages\EditDashboardGroup::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
