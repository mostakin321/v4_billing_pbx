<?php

namespace App\Filament\Resources\FusionPBX\Vars;

use App\Filament\Resources\FusionPBX\Vars\Pages;
use App\Filament\Resources\FusionPBX\Vars\Schemas;
use App\Filament\Resources\FusionPBX\Vars\Tables;
use App\Models\FusionPBX\FpbxVar;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class VarResource extends Resource
{
    protected static ?string $slug = 'var';
    protected static \UnitEnum|string|null $navigationGroup = 'SIP & Gateways';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-code-bracket-square';
    protected static ?int $navigationSort = 6;
protected static ?string $model = FpbxVar::class;
    protected static ?string $modelLabel = 'Var';

    protected static ?string $pluralModelLabel = 'Vars';

    protected static ?string $recordTitleAttribute = 'var_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\VarForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\VarsTable::configure($table);
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
            'index' => Pages\ListVars::route('/'),
            'create' => Pages\CreateVar::route('/create'),
            'edit' => Pages\EditVar::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'SIP & Gateways';
    }

}
