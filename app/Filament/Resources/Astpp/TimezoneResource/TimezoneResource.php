<?php

namespace App\Filament\Resources\Astpp\TimezoneResource;

use App\Filament\Resources\Astpp\TimezoneResource\Pages;
use App\Filament\Resources\Astpp\TimezoneResource\Schemas\TimezoneForm;
use App\Filament\Resources\Astpp\TimezoneResource\Tables\TimezoneTable;
use App\Models\Astpp\Timezone;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class TimezoneResource extends Resource
{
    protected static ?string $model = Timezone::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'Timezone'; }
    public static function getModelLabel(): string { return 'Timezone'; }
    public static function getPluralModelLabel(): string { return 'Timezone'; }
    public static function getNavigationSort(): ?int { return 65; }

    public static function form(Schema $schema): Schema
    {
        return TimezoneForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TimezoneTable::configure($table);
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
            'index' => Pages\ListTimezoneRecords::route('/'),
            'create' => Pages\CreateTimezone::route('/create'),
            'edit' => Pages\EditTimezone::route('/{record}/edit'),
        ];
    }
}
