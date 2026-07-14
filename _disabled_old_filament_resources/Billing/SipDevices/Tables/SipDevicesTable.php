<?php
namespace App\Filament\Resources\Billing\SipDevices\Tables;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\DB;
class SipDevicesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('username')->label('SIP Username')->searchable()->sortable()->weight(FontWeight::Bold)->copyable(),
            TextColumn::make('accountid')->label('Account')->formatStateUsing(fn($state) => $state ? DB::table('accounts')->where('id',$state)->value('number') ?? '—' : '—')->badge()->color('info'),
            TextColumn::make('codec')->label('Codecs')->default('—'),
            TextColumn::make('call_waiting')->label('Call Waiting')->formatStateUsing(fn($state): string => $state ? 'Yes' : 'No')->badge()->color(fn($state): string => $state ? 'success' : 'gray'),
            TextColumn::make('status')->badge()->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
            TextColumn::make('creation_date')->label('Created')->dateTime('M j, Y')->sortable(),
        ])
        ->filters([SelectFilter::make('status')->options([0=>'Active',1=>'Inactive'])])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('id','desc');
    }
}
