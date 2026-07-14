<?php
namespace App\Filament\Resources\Astpp\TrunkResource\Schemas;

use App\Models\Astpp\Account;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;

class TrunkForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Section::make('Basic Information')->icon('heroicon-o-server')->columns(3)->schema([

                TextInput::make('name')->label('Name *')->required()
                    ->placeholder('YourTrunk')
                    ->helperText('Name of the trunk for identification'),

                Select::make('provider_id')->label('Provider *')
                    ->options(fn() => collect(['0' => '--Select--'])
                        ->merge(Account::where('type', 2)->where('status', 0)->where('deleted', 0)
                            ->get()->mapWithKeys(fn($a) => [
                                $a->id => 'ASTPP(' . $a->number . ')'
                            ])))
                    ->searchable()->required()
                    ->helperText('Provider account associated with this trunk'),

                Select::make('gateway_id')->label('Gateway Name *')
                    ->options(fn() => collect(['0' => '--Select--'])
                        ->merge(DB::table('gateways')->where('status', 0)->pluck('name', 'id')))
                    ->searchable()->required()
                    ->helperText('Gateway where calls will be terminated'),

                Select::make('failover_gateway_id')->label('Failover GW Name #1')
                    ->options(fn() => collect(['0' => '--Select--'])
                        ->merge(DB::table('gateways')->where('status', 0)->pluck('name', 'id')))
                    ->searchable()->default(0)
                    ->helperText('Second attempt if primary gateway is down'),

                Select::make('failover_gateway_id1')->label('Failover GW Name #2')
                    ->options(fn() => collect(['0' => '--Select--'])
                        ->merge(DB::table('gateways')->where('status', 0)->pluck('name', 'id')))
                    ->searchable()->default(0)
                    ->helperText('Third attempt if failover #1 is also down'),

                Select::make('localization_id')->label('Localization')
                    ->options(fn() => collect(['0' => '--Select--'])
                        ->merge(DB::table('localization')->pluck('name', 'id')->toArray()))
                    ->searchable()->default(0),

                Select::make('sip_cid_type')->label('Remote ID')
                    ->options([
                        'none'              => 'None',
                        'P-Asserted-Identity' => 'P-Asserted-Identity',
                        'Remote-Party-ID'   => 'Remote-Party-ID',
                        'P-Preferred-Identity' => 'P-Preferred-Identity',
                    ])
                    ->default('none')
                    ->helperText('Used for authentication'),
            ]),

            Section::make('Settings')->icon('heroicon-o-cog-6-tooth')->columns(3)->schema([

                TextInput::make('codec')->label('Codecs')
                    ->placeholder('PCMA,G729,PCMU')
                    ->helperText('Comma-separated codec list to send to termination'),

                TextInput::make('leg_timeout')->label('Call Timeout (sec.)')
                    ->numeric()->default(30)
                    ->helperText('Ring timeout in seconds'),

                TextInput::make('maxchannels')->label('Concurrent Calls')
                    ->numeric()->default(0)
                    ->helperText('Max concurrent calls (0 = unlimited)'),

                TextInput::make('cps')->label('CPS')
                    ->numeric()->default(0)
                    ->helperText('Max calls per second (0 = unlimited)'),

                TextInput::make('precedence')->label('Priority')
                    ->numeric()->default(0)
                    ->helperText('Lower = higher priority in dialplan'),

                Select::make('status')->label('Status')
                    ->options([0 => 'Active', 1 => 'Inactive'])
                    ->default(0)->required(),
            ]),
        ]);
    }
}
