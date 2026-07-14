<?php

namespace App\Filament\Resources\Astpp\LoginActivityReportResource;

use App\Filament\Resources\Astpp\LoginActivityReportResource\Pages;
use App\Filament\Resources\Astpp\LoginActivityReportResource\Schemas\LoginActivityReportForm;
use App\Filament\Resources\Astpp\LoginActivityReportResource\Tables\LoginActivityReportTable;
use App\Models\Astpp\LoginActivityReport;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class LoginActivityReportResource extends Resource
{
    protected static ?string $model = LoginActivityReport::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Login Activity Report'; }
    public static function getModelLabel(): string { return 'Login Activity Report'; }
    public static function getPluralModelLabel(): string { return 'Login Activity Report'; }
    public static function getNavigationSort(): ?int { return 37; }

    public static function form(Schema $schema): Schema
    {
        return LoginActivityReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LoginActivityReportTable::configure($table);
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
            'index' => Pages\ListLoginActivityReportRecords::route('/'),
            'create' => Pages\CreateLoginActivityReport::route('/create'),
            'edit' => Pages\EditLoginActivityReport::route('/{record}/edit'),
        ];
    }
}
