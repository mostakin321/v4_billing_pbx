<?php

namespace App\Filament\Resources\FusionPBX\DatabaseTransactions\Schemas;

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

class DatabaseTransactionForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Database Transaction')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('app_name')
                        ->label('App Name')->placeholder('app name'),
                    TextInput::make('transaction_code')
                        ->label('Transaction Code')->placeholder('transaction code'),
                    TextInput::make('transaction_address')
                        ->label('Transaction Address')->placeholder('transaction address'),
                    TextInput::make('transaction_type')
                        ->label('Transaction Type')->placeholder('transaction type'),
                    TextInput::make('transaction_date')
                        ->label('Transaction Date')->placeholder('transaction date'),
                    TextInput::make('transaction_old')
                        ->label('Transaction Old')->placeholder('transaction old'),
                    TextInput::make('transaction_new')
                        ->label('Transaction New')->placeholder('transaction new'),
                    TextInput::make('transaction_result')
                        ->label('Transaction Result')->placeholder('transaction result'),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('domain_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->domain_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->domain_uuid.'</code>')
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
