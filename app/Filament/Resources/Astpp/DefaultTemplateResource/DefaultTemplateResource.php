<?php

namespace App\Filament\Resources\Astpp\DefaultTemplateResource;

use App\Filament\Resources\Astpp\DefaultTemplateResource\Pages;
use App\Filament\Resources\Astpp\DefaultTemplateResource\Schemas\DefaultTemplateForm;
use App\Filament\Resources\Astpp\DefaultTemplateResource\Tables\DefaultTemplateTable;
use App\Models\Astpp\DefaultTemplate;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class DefaultTemplateResource extends Resource
{
    protected static ?string $model = DefaultTemplate::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Default Templates'; }
    public static function getModelLabel(): string { return 'Default Templates'; }
    public static function getPluralModelLabel(): string { return 'Default Templates'; }
    public static function getNavigationSort(): ?int { return 24; }

    public static function form(Schema $schema): Schema
    {
        return DefaultTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DefaultTemplateTable::configure($table);
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
            'index' => Pages\ListDefaultTemplateRecords::route('/'),
            'create' => Pages\CreateDefaultTemplate::route('/create'),
            'edit' => Pages\EditDefaultTemplate::route('/{record}/edit'),
        ];
    }
}
