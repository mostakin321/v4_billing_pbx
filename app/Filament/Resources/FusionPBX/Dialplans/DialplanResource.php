<?php
namespace App\Filament\Resources\FusionPBX\Dialplans;
use App\Filament\Resources\FusionPBX\Dialplans\Pages;
use App\Filament\Resources\FusionPBX\Dialplans\Schemas;
use App\Filament\Resources\FusionPBX\Dialplans\Tables;
use App\Models\FusionPBX\Dialplan;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class DialplanResource extends Resource
{
    protected static ?string $slug = 'dialplan';
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?int $navigationSort = 4;
protected static ?string $model                = Dialplan::class;
    protected static ?string $navigationLabel      = 'Dialplan Manager';
    protected static ?string $modelLabel           = 'Dialplan';
    protected static ?string $pluralModelLabel     = 'Dialplans';
protected static ?string $recordTitleAttribute = 'dialplan_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DialplanForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DialplansTable::configure($table);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDialplans::route('/'),
            'create' => Pages\CreateDialplan::route('/create'),
            'edit'   => Pages\EditDialplan::route('/{record}/edit'),
        ];
    }
}
