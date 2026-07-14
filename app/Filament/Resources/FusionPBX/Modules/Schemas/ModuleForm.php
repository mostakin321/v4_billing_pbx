<?php
namespace App\Filament\Resources\FusionPBX\Modules\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Module')->columns(2)->schema([
                TextInput::make('module_label')->label('Label')->required(),
                TextInput::make('module_name')->label('Module Name')->required()
                    ->placeholder('e.g. mod_sofia'),
                TextInput::make('module_category')->label('Category')
                    ->placeholder('e.g. endpoints'),
                TextInput::make('module_order')->label('Order')->numeric()->default(0),
                Select::make('module_enabled')->label('Enabled')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Select::make('module_default_enabled')->label('Default Enabled')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Textarea::make('module_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
