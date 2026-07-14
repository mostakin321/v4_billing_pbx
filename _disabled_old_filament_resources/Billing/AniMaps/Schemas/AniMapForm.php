<?php
namespace App\Filament\Resources\Billing\AniMaps\Schemas;
use App\Models\Billing\Account;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class AniMapForm {
    public static function configure(Schema $form): Schema {
        return $form->schema([
            Tabs::make('ANI Map')->columnSpanFull()->tabs([
                Tabs\Tab::make('Information')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Section::make('Caller ID Mapping')
                            ->description('Map an inbound caller number to a specific account. Used for ANI-based authentication.')
                            ->icon('heroicon-o-identification')
                            ->columns(3)
                            ->schema([
                                TextInput::make('number')
                                    ->label('Caller Number (ANI)')
                                    ->required()
                                    ->placeholder('+8801712345678')
                                    ->helperText('Inbound caller number to map to account.'),

                                Select::make('accountid')
                                    ->label('Account')
                                    ->options(fn() => Account::where('status', 0)
                                        ->where('deleted', 0)
                                        ->get()->mapWithKeys(fn($a) => [
                                            $a->id => $a->number . ' — ' . ($a->company_name ?: $a->first_name)
                                        ]))
                                    ->required()->searchable()
                                    ->helperText('Account this caller number belongs to.'),

                                Select::make('reseller_id')
                                    ->label('Reseller')
                                    ->options(fn() => collect([0 => 'Admin'])
                                        ->merge(Account::where('type', 3)->where('status', 0)
                                            ->pluck('company_name', 'id')))
                                    ->default(0)->searchable(),

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
                        ->content(fn($record) => $record?->creation_date
                            ? Carbon::parse($record->creation_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('modified')->label('Modified')
                        ->content(fn($record) => $record?->last_modified_date
                            ? Carbon::parse($record->last_modified_date)->diffForHumans() : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
