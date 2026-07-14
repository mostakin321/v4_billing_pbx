<?php

namespace App\Filament\Resources\Astpp\MailDetailResource;

use App\Filament\Resources\Astpp\MailDetailResource\Pages;
use App\Filament\Resources\Astpp\MailDetailResource\Schemas\MailDetailForm;
use App\Filament\Resources\Astpp\MailDetailResource\Tables\MailDetailTable;
use App\Models\Astpp\MailDetail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class MailDetailResource extends Resource
{
    protected static ?string $model = MailDetail::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'Mail Details'; }
    public static function getModelLabel(): string { return 'Mail Details'; }
    public static function getPluralModelLabel(): string { return 'Mail Details'; }
    public static function getNavigationSort(): ?int { return 38; }

    public static function form(Schema $schema): Schema
    {
        return MailDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MailDetailTable::configure($table);
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
            'index' => Pages\ListMailDetailRecords::route('/'),
            'create' => Pages\CreateMailDetail::route('/create'),
            'edit' => Pages\EditMailDetail::route('/{record}/edit'),
        ];
    }
}
