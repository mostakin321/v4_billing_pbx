<?php
namespace App\Filament\Resources\FusionPBX\UserSettings\Schemas;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class UserSettingForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('User Setting')->columns(2)->schema([
                TextInput::make('user_setting_category')->label('Category')->required()
                    ->placeholder('e.g. voicemail'),
                TextInput::make('user_setting_subcategory')->label('Subcategory')
                    ->placeholder('e.g. enabled'),
                TextInput::make('user_setting_name')->label('Name')->required()
                    ->placeholder('e.g. boolean'),
                TextInput::make('user_setting_value')->label('Value')
                    ->placeholder('e.g. true'),
                TextInput::make('user_setting_order')->label('Order')->numeric()->default(0),
                Select::make('user_setting_enabled')->label('Enabled')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Textarea::make('user_setting_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
