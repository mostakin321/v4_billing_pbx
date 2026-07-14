<?php

namespace App\Filament\Resources\FusionPBX\Modules;

use App\Filament\Resources\FusionPBX\Modules\Pages;
use App\Filament\Resources\FusionPBX\Modules\Schemas;
use App\Filament\Resources\FusionPBX\Modules\Tables;
use App\Models\FusionPBX\Module;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ModuleResource extends Resource
{
    protected static ?string $slug = 'module';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?int $navigationSort = 4;
protected static ?string $model = Module::class;
    protected static ?string $modelLabel = 'Module';

    protected static ?string $pluralModelLabel = 'Modules';

    protected static ?string $recordTitleAttribute = 'module_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\ModuleForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ModulesTable::configure($table);
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
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
