<?php

namespace App\Filament\Resources\FusionPBX\Domains;

use App\Filament\Resources\FusionPBX\Domains\Pages;
use App\Filament\Resources\FusionPBX\Domains\Schemas;
use App\Filament\Resources\FusionPBX\Domains\Tables;
use App\Models\FusionPBX\Domain;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DomainResource extends Resource
{
    protected static ?string $slug = 'domain';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?int $navigationSort = 9;
protected static ?string $model = Domain::class;
    protected static ?string $modelLabel = 'Domain';

    protected static ?string $pluralModelLabel = 'Domains';

    protected static ?string $recordTitleAttribute = 'domain_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DomainForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DomainsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDomains::route('/'),
            'create' => Pages\CreateDomain::route('/create'),
            'edit' => Pages\EditDomain::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
