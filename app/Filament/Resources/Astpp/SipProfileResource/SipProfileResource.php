<?php

namespace App\Filament\Resources\Astpp\SipProfileResource;

use App\Filament\Resources\Astpp\SipProfileResource\Pages;
use App\Filament\Resources\Astpp\SipProfileResource\Schemas\SipProfileForm;
use App\Filament\Resources\Astpp\SipProfileResource\Tables\SipProfileTable;
use App\Models\Astpp\SipProfile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class SipProfileResource extends Resource
{
    protected static ?string $model = SipProfile::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP PBX'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'SIP Profiles'; }
    public static function getModelLabel(): string { return 'SIP Profiles'; }
    public static function getPluralModelLabel(): string { return 'SIP Profiles'; }
    public static function getNavigationSort(): ?int { return 59; }

    public static function form(Schema $schema): Schema
    {
        return SipProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SipProfileTable::configure($table);
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
            'index' => Pages\ListSipProfileRecords::route('/'),
            'create' => Pages\CreateSipProfile::route('/create'),
            'edit' => Pages\EditSipProfile::route('/{record}/edit'),
        ];
    }
}
