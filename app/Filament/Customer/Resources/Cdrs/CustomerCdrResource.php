<?php
namespace App\Filament\Customer\Resources\Cdrs;

use App\Models\Billing\BillingCdr;
use App\Filament\Customer\Resources\Cdrs\Pages\ListCustomerCdrs;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;

class CustomerCdrResource extends Resource
{
    protected static ?string $model = BillingCdr::class;

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-phone-arrow-up-right'; }
    public static function getNavigationLabel(): string { return 'Call Records'; }
    public static function getNavigationSort(): ?int { return 2; }
    public static function canCreate(): bool { return false; }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $customer = auth('customer')->user();
        return parent::getEloquentQuery()->where('accountid', $customer->id);
    }

    public static function form(Schema $form): Schema { return $form->schema([]); }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('callerid')->label('From')->searchable()->copyable(),
            TextColumn::make('callednum')->label('To')->searchable()->copyable()->weight(FontWeight::Bold),
            TextColumn::make('callstart')->label('Date/Time')->dateTime('M j, Y H:i:s')->sortable(),
            TextColumn::make('billseconds')->label('Duration (sec)')->sortable(),
            TextColumn::make('debit')->label('Cost')->money('usd')->sortable(),
            TextColumn::make('disposition')->label('Status')->badge()
                ->color(fn($state): string => $state === 'ANSWERED' ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('disposition')
                ->options(['ANSWERED'=>'Answered','FAILED'=>'Failed','BUSY'=>'Busy']),
        ])
        ->defaultSort('callstart','desc');
    }

    public static function getPages(): array
    {
        return ['index' => ListCustomerCdrs::route('/')];
    }
}
