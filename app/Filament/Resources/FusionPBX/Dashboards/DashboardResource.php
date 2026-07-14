<?php

namespace App\Filament\Resources\FusionPBX\Dashboards;

use App\Filament\Resources\FusionPBX\Dashboards\Pages;
use App\Filament\Resources\FusionPBX\Dashboards\Schemas;
use App\Filament\Resources\FusionPBX\Dashboards\Tables;
use App\Models\FusionPBX\Dashboard;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DashboardResource extends Resource
{
    protected static ?string $slug = 'dashboard';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-plus';
    protected static ?int $navigationSort = 13;
protected static ?string $model = Dashboard::class;
    protected static ?string $modelLabel = 'Dashboard';

    protected static ?string $pluralModelLabel = 'Dashboards';

    protected static ?string $recordTitleAttribute = 'dashboard_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DashboardForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DashboardsTable::configure($table);
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
            'index' => Pages\ListDashboards::route('/'),
            'create' => Pages\CreateDashboard::route('/create'),
            'edit' => Pages\EditDashboard::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
