<?php

namespace App\Filament\Resources\Astpp\SpeedDialResource;

use App\Filament\Resources\Astpp\SpeedDialResource\Pages;
use App\Filament\Resources\Astpp\SpeedDialResource\Schemas\SpeedDialForm;
use App\Filament\Resources\Astpp\SpeedDialResource\Tables\SpeedDialTable;
use App\Models\Astpp\SpeedDial;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class SpeedDialResource extends Resource
{
    protected static ?string $model = SpeedDial::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Speed Dial'; }
    public static function getModelLabel(): string { return 'Speed Dial'; }
    public static function getPluralModelLabel(): string { return 'Speed Dial'; }
    public static function getNavigationSort(): ?int { return 60; }

    public static function form(Schema $schema): Schema
    {
        return SpeedDialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpeedDialTable::configure($table);
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
            'index' => Pages\ListSpeedDialRecords::route('/'),
            'create' => Pages\CreateSpeedDial::route('/create'),
            'edit' => Pages\EditSpeedDial::route('/{record}/edit'),
        ];
    }
}
