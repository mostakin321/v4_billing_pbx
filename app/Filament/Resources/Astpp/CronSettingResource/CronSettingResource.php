<?php

namespace App\Filament\Resources\Astpp\CronSettingResource;

use App\Filament\Resources\Astpp\CronSettingResource\Pages;
use App\Filament\Resources\Astpp\CronSettingResource\Schemas\CronSettingForm;
use App\Filament\Resources\Astpp\CronSettingResource\Tables\CronSettingTable;
use App\Models\Astpp\CronSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CronSettingResource extends Resource
{
    protected static ?string $model = CronSetting::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Cron Settings'; }
    public static function getModelLabel(): string { return 'Cron Settings'; }
    public static function getPluralModelLabel(): string { return 'Cron Settings'; }
    public static function getNavigationSort(): ?int { return 22; }

    public static function form(Schema $schema): Schema
    {
        return CronSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CronSettingTable::configure($table);
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
            'index' => Pages\ListCronSettingRecords::route('/'),
            'create' => Pages\CreateCronSetting::route('/create'),
            'edit' => Pages\EditCronSetting::route('/{record}/edit'),
        ];
    }
}
