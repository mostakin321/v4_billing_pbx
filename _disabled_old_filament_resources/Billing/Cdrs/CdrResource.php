<?php
namespace App\Filament\Resources\Billing\Cdrs;
use App\Models\Billing\BillingCdr;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CdrResource extends Resource
{
    protected static ?string $model           = BillingCdr::class;
    public static function getNavigationGroup(): ?string { return 'CDRs & Billing'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-phone-arrow-up-right'; }
    public static function getNavigationLabel(): string { return 'Call Records'; }
    public static function getNavigationSort(): ?int { return 1; }

    public static function form(Schema $form): Schema { return $form->schema([]); }
    public static function table(Table $table): Table { return Tables\CdrsTable::configure($table); }
    public static function canCreate(): bool { return false; }

    public static function getPages(): array
    {
        return ['index' => Pages\ListCdrs::route('/')];
    }
}
