<?php
namespace App\Filament\Resources\Astpp\ProductResource\Schemas;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
class ProductForm {
    public static function configure(Schema $form): Schema {
        return $form->schema([
            Section::make('Product')->columns(3)->schema([
                TextInput::make('name')->required(),
                Select::make('product_category')->label('Category')
                    ->options([1=>'Package',2=>'Subscription',3=>'Refill',4=>'DID'])
                    ->default(1)->required(),
                Select::make('status')->options([0=>'Active',1=>'Inactive'])->default(0),
            ]),
            Section::make('Pricing')->columns(3)->schema([
                TextInput::make('price')->label('Sell Price ($)')->numeric()->default(0),
                TextInput::make('buy_cost')->label('Buy Cost ($)')->numeric()->default(0),
                TextInput::make('setup_fee')->label('Setup Fee ($)')->numeric()->default(0),
                Select::make('billing_type')->options([1=>'One-time',2=>'Recurring',3=>'Monthly'])->default(1),
                TextInput::make('billing_days')->numeric()->default(30),
                TextInput::make('free_minutes')->label('Free Minutes')->numeric()->default(0),
                Textarea::make('description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
