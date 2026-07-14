<?php

namespace App\Filament\Resources\FusionPBX\ContactSettings\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ContactSettingForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Contact Setting')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    Select::make('contact_setting_enabled')
                        ->label('Contact Setting Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('contact_setting_description')
                        ->label('Contact Setting Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('contact_setting_category')
                        ->label('Contact Setting Category')->placeholder('contact setting category'),
                    TextInput::make('contact_setting_subcategory')
                        ->label('Contact Setting Subcategory')->placeholder('contact setting subcategory'),
                    TextInput::make('contact_setting_name')
                        ->label('Contact Setting Name')->placeholder('contact setting name'),
                    TextInput::make('contact_setting_value')
                        ->label('Contact Setting Value')->placeholder('contact setting value'),
                    TextInput::make('contact_setting_order')
                        ->label('Contact Setting Order')
                        ->numeric(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('contact_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->contact_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->contact_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn ($record) => $record?->insert_date
                            ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Last Updated')
                        ->content(fn ($record) => $record?->update_date
                            ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
                ])
                ->visibleOn('edit'),
        ]);
    }
}
