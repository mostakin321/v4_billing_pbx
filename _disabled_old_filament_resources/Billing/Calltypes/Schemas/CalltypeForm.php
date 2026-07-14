<?php
namespace App\Filament\Resources\Billing\Calltypes\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CalltypeForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Call Type')->columns(2)->schema([
                TextInput::make('call_type')
                    ->label('Call Type')->required()
                    ->placeholder('CLI')->helperText('e.g. CLI, Non-CLI, IP Phone'),

                TextInput::make('description')
                    ->label('Description')->required()
                    ->default('')
                    ->placeholder('Caller ID presented calls'),

                Select::make('status')
                    ->options([0 => 'Active', 1 => 'Inactive'])
                    ->default(0),
            ]),
        ]);
    }
}
