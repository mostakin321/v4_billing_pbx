<?php

namespace App\Filament\Resources\FusionPBX\CallFlows;

use App\Filament\Resources\FusionPBX\CallFlows\Pages;
use App\Filament\Resources\FusionPBX\CallFlows\Schemas;
use App\Filament\Resources\FusionPBX\CallFlows\Tables;
use App\Models\FusionPBX\CallFlow;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class CallFlowResource extends Resource
{
    protected static ?string $slug = 'call-flow';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrows-pointing-in';
    protected static ?int $navigationSort = 6;
protected static ?string $model = CallFlow::class;
    protected static ?string $modelLabel = 'Call Flow';

    protected static ?string $pluralModelLabel = 'Call Flows';

    protected static ?string $recordTitleAttribute = 'call_flow_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\CallFlowForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\CallFlowsTable::configure($table);
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
            'index' => Pages\ListCallFlows::route('/'),
            'create' => Pages\CreateCallFlow::route('/create'),
            'edit' => Pages\EditCallFlow::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Dialplan';
    }

}
