<?php
namespace App\Filament\Resources\Astpp\SipDeviceResource\Schemas;
use App\Models\Astpp\Account;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
class SipDeviceForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('SIP Device')->icon('heroicon-o-device-phone-mobile')->columns(3)->schema([
                TextInput::make('username')->label('SIP Username')->required()->unique(ignoreRecord:true)->placeholder('1001'),
                TextInput::make('sip_password')->label('SIP Password')->password()->revealable()
                    ->placeholder('Leave blank to keep existing')->dehydrated(false)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record?->dir_params) {
                            $component->state(json_decode($record->dir_params, true)['password'] ?? '');
                        }
                    }),
                Select::make('accountid')->label('Account')
                    ->options(fn() => collect([0=>'— None —'])->merge(Account::where('status',0)->where('deleted',0)->whereIn('type',[0,1,3])->get()->mapWithKeys(fn($a) => [$a->id => $a->number.' — '.($a->company_name ?: $a->first_name)])))
                    ->searchable()->default(0),
                Select::make('reseller_id')->label('Reseller')
                    ->options(fn() => collect([0=>'— None —'])->merge(Account::where('type',3)->where('status',0)->pluck('company_name','id')))
                    ->searchable()->default(0),
                Select::make('sip_profile_id')->label('SIP Profile')
                    ->options(fn() => collect([0=>'Default'])->merge(DB::table('sip_profiles')->where('status',0)->pluck('name','id')->toArray()))
                    ->default(0),
                Select::make('call_waiting')->label('Call Waiting')->options([0=>'Enabled',1=>'Disabled'])->default(0),
                Select::make('status')->options([0=>'Active',1=>'Inactive'])->default(0),
            ]),
            Section::make('Voicemail')->icon('heroicon-o-microphone')->columns(3)->schema([
                TextInput::make('vm_password')->label('VM PIN')->placeholder('1234')->dehydrated(false)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record?->dir_params) { $component->state(json_decode($record->dir_params, true)['vm-password'] ?? ''); }
                    }),
                TextInput::make('vm_mailto')->label('VM Email')->email()->placeholder('user@example.com')->dehydrated(false)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record?->dir_params) { $component->state(json_decode($record->dir_params, true)['vm-mailto'] ?? ''); }
                    }),
                Select::make('vm_enabled')->label('Voicemail')->options(['true'=>'Enabled','false'=>'Disabled'])->default('true')->dehydrated(false)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record?->dir_params) { $component->state(json_decode($record->dir_params, true)['vm-enabled'] ?? 'true'); }
                    }),
            ]),
            Section::make('Caller ID (dir_vars)')->icon('heroicon-o-identification')->columns(2)->schema([
                TextInput::make('effective_caller_id_name')->label('Effective Caller ID Name')
                    ->placeholder('ASTPP')->dehydrated(false)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record?->dir_vars) { $component->state(json_decode($record->dir_vars, true)['effective_caller_id_name'] ?? ''); }
                    }),
                TextInput::make('effective_caller_id_number')->label('Effective Caller ID Number')
                    ->placeholder('1234567890')->dehydrated(false)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record?->dir_vars) { $component->state(json_decode($record->dir_vars, true)['effective_caller_id_number'] ?? ''); }
                    }),
            ]),
        ]);
    }
}
