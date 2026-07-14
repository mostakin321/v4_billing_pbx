<?php
namespace App\Filament\Resources\FusionPBX\AccessControls\Schemas;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class AccessControlForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Access Control')->columns(2)->schema([
                TextInput::make('access_control_name')->label('Name')->required()
                    ->placeholder('e.g. providers'),
                Select::make('access_control_default')->label('Default')
                    ->options(['allow'=>'Allow','deny'=>'Deny'])
                    ->default('deny')->native(false),
                Textarea::make('access_control_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
