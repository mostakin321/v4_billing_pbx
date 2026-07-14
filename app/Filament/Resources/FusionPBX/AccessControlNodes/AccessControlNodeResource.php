<?php

namespace App\Filament\Resources\FusionPBX\AccessControlNodes;

use App\Filament\Resources\FusionPBX\AccessControlNodes\Pages;
use App\Filament\Resources\FusionPBX\AccessControlNodes\Schemas;
use App\Filament\Resources\FusionPBX\AccessControlNodes\Tables;
use App\Models\FusionPBX\AccessControlNode;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class AccessControlNodeResource extends Resource
{
    protected static ?string $slug = 'access-control-node';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';
    protected static ?int $navigationSort = 3;
protected static ?string $model = AccessControlNode::class;
    protected static ?string $modelLabel = 'Access Control Node';

    protected static ?string $pluralModelLabel = 'Access Control Nodes';

    protected static ?string $recordTitleAttribute = 'access_control_node_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\AccessControlNodeForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\AccessControlNodesTable::configure($table);
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
            'index' => Pages\ListAccessControlNodes::route('/'),
            'create' => Pages\CreateAccessControlNode::route('/create'),
            'edit' => Pages\EditAccessControlNode::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
