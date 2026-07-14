<?php

namespace App\Filament\Resources\FusionPBX\MenuItems\Schemas;

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

class MenuItemForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Menu Item')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('menu_item_title')
                        ->label('Menu Item Title')->placeholder('menu item title'),
                    TextInput::make('menu_item_link')
                        ->label('Menu Item Link')->placeholder('menu item link'),
                    TextInput::make('menu_item_icon')
                        ->label('Menu Item Icon')->placeholder('menu item icon'),
                    TextInput::make('menu_item_icon_color')
                        ->label('Menu Item Icon Color')->placeholder('menu item icon color'),
                    TextInput::make('menu_item_category')
                        ->label('Menu Item Category')->placeholder('menu item category'),
                    Textarea::make('menu_item_description')
                        ->label('Menu Item Description')->rows(2)->columnSpanFull(),
                    TextInput::make('menu_item_add_user')
                        ->label('Menu Item Add User')->placeholder('menu item add user'),
                    TextInput::make('menu_item_add_date')
                        ->label('Menu Item Add Date')->placeholder('menu item add date'),
                    TextInput::make('menu_item_mod_user')
                        ->label('Menu Item Mod User')->placeholder('menu item mod user'),
                    TextInput::make('menu_item_mod_date')
                        ->label('Menu Item Mod Date')->placeholder('menu item mod date'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('menu_item_order')
                        ->label('Menu Item Order')
                        ->numeric(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('menu_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->menu_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->menu_uuid.'</code>')
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
