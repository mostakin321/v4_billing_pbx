<?php

namespace App\Filament\Resources\FusionPBX\AccessControls;

use App\Filament\Resources\FusionPBX\AccessControls\Pages;
use App\Filament\Resources\FusionPBX\AccessControls\Schemas;
use App\Filament\Resources\FusionPBX\AccessControls\Tables;
use App\Models\FusionPBX\AccessControl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class AccessControlResource extends Resource
{
    protected static ?string $slug = 'access-control';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-lock-closed';
    protected static ?int $navigationSort = 2;
protected static ?string $model = AccessControl::class;
    protected static ?string $modelLabel = 'Access Control';

    protected static ?string $pluralModelLabel = 'Access Controls';

    protected static ?string $recordTitleAttribute = 'access_control_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\AccessControlForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\AccessControlsTable::configure($table);
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
            'index' => Pages\ListAccessControls::route('/'),
            'create' => Pages\CreateAccessControl::route('/create'),
            'edit' => Pages\EditAccessControl::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
