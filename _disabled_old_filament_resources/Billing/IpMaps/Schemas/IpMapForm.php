<?php
namespace App\Filament\Resources\Billing\IpMaps\Schemas;
use App\Models\Billing\Account;
use App\Models\Billing\Pricelist;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class IpMapForm {
    public static function configure(Schema $form): Schema {
        return $form->schema([
            Tabs::make('IP Map')->columnSpanFull()->tabs([
                Tabs\Tab::make('Information')
                    ->icon('heroicon-o-server')
                    ->schema([
                        Section::make('IP Authentication Mapping')
                            ->description('Map an IP address to an account for IP-based authentication.')
                            ->icon('heroicon-o-identification')
                            ->columns(3)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->required()->placeholder('Office IP')
                                    ->helperText('Friendly name for this IP mapping.'),

                                TextInput::make('ip')
                                    ->label('IP Address')
                                    ->required()->placeholder('192.168.1.100 or 10.0.0.0/24')
                                    ->helperText('IP address or CIDR range for authentication.'),

                                TextInput::make('prefix')
                                    ->label('Prefix')
                                    ->placeholder('880')
                                    ->helperText('Optional prefix for this IP.'),

                                Select::make('accountid')
                                    ->label('Account')
                                    ->options(fn() => Account::where('status', 0)
                                        ->where('deleted', 0)
                                        ->get()->mapWithKeys(fn($a) => [
                                            $a->id => $a->number . ' — ' . ($a->company_name ?: $a->first_name)
                                        ]))
                                    ->required()->searchable()
                                    ->helperText('Account authenticated by this IP.'),

                                Select::make('pricelist_id')
                                    ->label('Rate Plan Override')
                                    ->options(fn() => collect([0 => 'Use Account Default'])
                                        ->merge(Pricelist::where('status', 0)->pluck('name', 'id')))
                                    ->default(0)->searchable()
                                    ->helperText('Override rate plan for calls from this IP.'),

                                TextInput::make('context')
                                    ->label('Context')
                                    ->default('default')
                                    ->helperText('FreeSWITCH dialplan context.'),

                                Select::make('status')
                                    ->options([0 => 'Active', 1 => 'Inactive'])
                                    ->default(0),
                            ]),
                    ]),
            ]),
            Section::make('Record Info')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(2)
                ->schema([
                    Placeholder::make('created')->label('Created')
                        ->content(fn($record) => $record?->created_date
                            ? Carbon::parse($record->created_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('modified')->label('Modified')
                        ->content(fn($record) => $record?->last_modified_date
                            ? Carbon::parse($record->last_modified_date)->diffForHumans() : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
