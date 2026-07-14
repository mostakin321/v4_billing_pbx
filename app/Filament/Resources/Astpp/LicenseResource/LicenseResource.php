<?php

namespace App\Filament\Resources\Astpp\LicenseResource;

use App\Filament\Resources\Astpp\LicenseResource\Pages;
use App\Filament\Resources\Astpp\LicenseResource\Schemas\LicenseForm;
use App\Filament\Resources\Astpp\LicenseResource\Tables\LicenseTable;
use App\Models\Astpp\License;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class LicenseResource extends Resource
{
    protected static ?string $model = License::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'License'; }
    public static function getModelLabel(): string { return 'License'; }
    public static function getPluralModelLabel(): string { return 'License'; }
    public static function getNavigationSort(): ?int { return 35; }

    public static function form(Schema $schema): Schema
    {
        return LicenseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LicenseTable::configure($table);
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
            'index' => Pages\ListLicenseRecords::route('/'),
            'create' => Pages\CreateLicense::route('/create'),
            'edit' => Pages\EditLicense::route('/{record}/edit'),
        ];
    }
}
