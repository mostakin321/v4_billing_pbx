<?php
namespace App\Filament\Resources\Astpp\AccessNumberResource\Schemas;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
class AccessNumberForm {
    public static function configure(Schema $form): Schema {
        return $form->schema([
            Tabs::make('Access Number')->columnSpanFull()->tabs([
                Tabs\Tab::make('Information')
                    ->icon('heroicon-o-phone-arrow-down-left')
                    ->schema([
                        Section::make('Access Number Details')
                            ->description('Local access numbers customers dial to use the VoIP service.')
                            ->icon('heroicon-o-identification')
                            ->columns(3)
                            ->schema([
                                TextInput::make('access_number')
                                    ->label('Access Number')
                                    ->required()
                                    ->placeholder('+8809611234567')
                                    ->helperText('Local number customers dial to access the system.'),
                                Select::make('country_id')
                                    ->label('Country')
                                    ->options(fn() => DB::table('countrycode')
                                        ->orderBy('country')->pluck('country', 'id'))
                                    ->searchable()->nullable()
                                    ->helperText('Country this access number belongs to.'),
                                Select::make('status')
                                    ->options([0 => 'Active', 1 => 'Inactive'])
                                    ->default(0),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(2)->columnSpanFull()
                                    ->helperText('Description for this access number.'),
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
