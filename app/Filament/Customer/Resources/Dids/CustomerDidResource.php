<?php
namespace App\Filament\Customer\Resources\Dids;

use App\Models\Billing\Did;
use App\Filament\Customer\Resources\Dids\Pages\ListCustomerDids;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\FontWeight;

class CustomerDidResource extends Resource
{
    protected static ?string $model = Did::class;

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-phone-arrow-down-left'; }
    public static function getNavigationLabel(): string { return 'My DIDs'; }
    public static function getNavigationSort(): ?int { return 4; }
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
            TextColumn::make('number')->label('DID Number')->searchable()->copyable()->weight(FontWeight::Bold),
            TextColumn::make('city')->label('City')->default('—'),
            TextColumn::make('monthlycost')->label('Monthly')->money('usd'),
            TextColumn::make('cost')->label('Rate/Min')->money('usd'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->defaultSort('number');
    }

    public static function getPages(): array
    {
        return ['index' => ListCustomerDids::route('/')];
    }
}
