<?php
namespace App\Filament\Resources\Astpp\OrderResource\Schemas;
use App\Models\Astpp\Account;
use App\Models\Astpp\Product;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
class OrderForm {
    public static function configure(Schema $form): Schema {
        return $form->schema([
            Tabs::make('Order')->columnSpanFull()->tabs([
                Tabs\Tab::make('Basic Information')
                    ->icon('heroicon-o-shopping-cart')
                    ->schema([
                        Section::make('Order Details')
                            ->description('Assign a product to a customer account.')
                            ->icon('heroicon-o-identification')
                            ->columns(3)
                            ->schema([
                                Select::make('category')
                                    ->label('Category')
                                    ->options([1=>'Package',2=>'Subscription',3=>'Refill',4=>'DID'])
                                    ->default(1)->live()
                                    ->helperText('Select the category. By default Package is selected.'),

                                Select::make('reseller_id')
                                    ->label('Reseller')
                                    ->options(fn() => collect([0=>'Admin (None)'])
                                        ->merge(Account::where('type',3)->where('status',0)->pluck('company_name','id')))
                                    ->default(0)->searchable()->live()
                                    ->helperText('Listing of resellers.'),

                                Select::make('accountid')
                                    ->label('Account')
                                    ->options(fn(Get $get) => Account::where('status',0)->where('deleted',0)
                                        ->where('type',0)
                                        ->when((int)($get('reseller_id')??0)>0,
                                            fn($q)=>$q->where('reseller_id',$get('reseller_id')))
                                        ->get()->mapWithKeys(fn($a)=>[$a->id=>$a->number.' — '.($a->company_name?:$a->first_name)]))
                                    ->required()->searchable()
                                    ->helperText('Listing of accounts.'),

                                Select::make('product_id')
                                    ->label('Product')
                                    ->options(fn(Get $get) => Product::where('status',0)->where('is_deleted',0)
                                        ->when((int)($get('category')??0)>0,
                                            fn($q)=>$q->where('product_category',$get('category')))
                                        ->pluck('name','id'))
                                    ->required()->searchable()->live()
                                    ->afterStateUpdated(function(Get $get, Set $set, ?int $state){
                                        if(!$state) return;
                                        $p = Product::find($state);
                                        if($p){
                                            $set('price',       $p->price);
                                            $set('setup_fee',   $p->setup_fee);
                                            $set('billing_type',$p->billing_type);
                                            $set('billing_days',$p->billing_days);
                                        }
                                    })
                                    ->helperText('Listing of packages.'),

                                Select::make('payment_gateway')
                                    ->label('Payment By')
                                    ->options(['account'=>'Account Balance','manual'=>'Manual','paypal'=>'PayPal','stripe'=>'Stripe'])
                                    ->default('account')
                                    ->helperText('The payment method.'),

                                Select::make('payment_status')
                                    ->options(['completed'=>'Completed','pending'=>'Pending','failed'=>'Failed'])
                                    ->default('completed'),
                            ]),
                    ]),

                Tabs\Tab::make('Product Details')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Section::make('Product Information')
                            ->icon('heroicon-o-gift')
                            ->columns(3)
                            ->schema([
                                TextInput::make('price')->label('Price ($)')->numeric()->default(0)
                                    ->helperText('Price for the selected package.'),
                                TextInput::make('setup_fee')->label('Setup Fee ($)')->numeric()->default(0)
                                    ->helperText('One time applicable fee for the product.'),
                                Select::make('billing_type')
                                    ->options([1=>'One-time',2=>'Recurring',3=>'Monthly'])->default(1)
                                    ->helperText('Billing type of selected package.'),
                                TextInput::make('billing_days')->label('Billing Days')->numeric()->default(30)
                                    ->helperText('Total availability time for the package.'),
                                DateTimePicker::make('order_date')->label('Order Date')->default(now()),
                            ]),
                    ]),
            ]),
            Section::make('Record Info')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(2)
                ->schema([
                    Placeholder::make('order_id_info')->label('Order ID')
                        ->content(fn($record) => $record?->order_id ?? '—'),
                    Placeholder::make('created_info')->label('Order Date')
                        ->content(fn($record) => $record?->order_date
                            ? Carbon::parse($record->order_date)->format('M j, Y H:i') : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
