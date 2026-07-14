<?php
namespace App\Filament\Resources\FusionPBX\Permissions\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Permission')->columns(2)->schema([
                TextInput::make('application_name')->label('Application Name')->required()
                    ->placeholder('e.g. gateways'),
                TextInput::make('permission_name')->label('Permission Name')->required()
                    ->placeholder('e.g. gateway_add'),
                Textarea::make('permission_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
