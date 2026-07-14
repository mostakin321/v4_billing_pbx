<?php

namespace App\Filament\Resources\Astpp\CdrsStagingResource;

use App\Filament\Resources\Astpp\CdrsStagingResource\Pages;
use App\Filament\Resources\Astpp\CdrsStagingResource\Schemas\CdrsStagingForm;
use App\Filament\Resources\Astpp\CdrsStagingResource\Tables\CdrsStagingTable;
use App\Models\Astpp\CdrsStaging;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CdrsStagingResource extends Resource
{
    protected static ?string $model = CdrsStaging::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP CDR'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'CDRs Staging'; }
    public static function getModelLabel(): string { return 'CDRs Staging'; }
    public static function getPluralModelLabel(): string { return 'CDRs Staging'; }
    public static function getNavigationSort(): ?int { return 16; }

    public static function form(Schema $schema): Schema
    {
        return CdrsStagingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CdrsStagingTable::configure($table);
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
            'index' => Pages\ListCdrsStagingRecords::route('/'),
            'create' => Pages\CreateCdrsStaging::route('/create'),
            'edit' => Pages\EditCdrsStaging::route('/{record}/edit'),
        ];
    }
}
