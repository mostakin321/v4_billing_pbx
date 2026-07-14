<?php

namespace App\Filament\Resources\FusionPBX\CallCenterAgents;

use App\Filament\Resources\FusionPBX\CallCenterAgents\Pages;
use App\Filament\Resources\FusionPBX\CallCenterAgents\Schemas;
use App\Filament\Resources\FusionPBX\CallCenterAgents\Tables;
use App\Models\FusionPBX\CallCenterAgent;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class CallCenterAgentResource extends Resource
{
    protected static ?string $slug = 'call-center-agent';
    protected static \UnitEnum|string|null $navigationGroup = 'Call Center';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?int $navigationSort = 2;
protected static ?string $model = CallCenterAgent::class;
    protected static ?string $modelLabel = 'Call Center Agent';

    protected static ?string $pluralModelLabel = 'Call Center Agents';

    protected static ?string $recordTitleAttribute = 'call_center_agent_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\CallCenterAgentForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\CallCenterAgentsTable::configure($table);
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
            'index' => Pages\ListCallCenterAgents::route('/'),
            'create' => Pages\CreateCallCenterAgent::route('/create'),
            'edit' => Pages\EditCallCenterAgent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Call Center';
    }

}
