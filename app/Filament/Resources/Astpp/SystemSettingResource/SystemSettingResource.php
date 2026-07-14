<?php

namespace App\Filament\Resources\Astpp\SystemSettingResource;

use App\Filament\Resources\Astpp\SystemSettingResource\Pages;
use App\Filament\Resources\Astpp\SystemSettingResource\Schemas\SystemSettingForm;
use App\Filament\Resources\Astpp\SystemSettingResource\Tables\SystemSettingTable;
use App\Models\Astpp\SystemSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class SystemSettingResource extends Resource
{
    protected static ?string $model = SystemSetting::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'System'; }
    public static function getModelLabel(): string { return 'System'; }
    public static function getPluralModelLabel(): string { return 'System'; }
    public static function getNavigationSort(): ?int { return 62; }

    public static function form(Schema $schema): Schema
    {
        return SystemSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SystemSettingTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $model = $query->getModel();
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        if (in_array('deleted', $columns, true)) {
            $query->where('deleted', 0);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystemSettingRecords::route('/'),
            'create' => Pages\CreateSystemSetting::route('/create'),
            'edit' => Pages\EditSystemSetting::route('/{record}/edit'),
        ];
    }
}
