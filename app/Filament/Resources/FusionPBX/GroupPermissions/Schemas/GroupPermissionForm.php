<?php
namespace App\Filament\Resources\FusionPBX\GroupPermissions\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GroupPermissionForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Group Permission')->columns(2)->schema([
                TextInput::make('group_name')->label('Group Name')->required()
                    ->placeholder('e.g. admin'),
                TextInput::make('permission_name')->label('Permission Name')->required()
                    ->placeholder('e.g. gateway_add'),
                Select::make('permission_assigned')->label('Assigned')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Select::make('permission_protected')->label('Protected')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('false')->native(false),
            ]),
        ]);
    }
}
