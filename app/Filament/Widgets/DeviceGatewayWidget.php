<?php
namespace App\Filament\Widgets;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
class DeviceGatewayWidget extends Widget
{
    protected string $view = 'filament.widgets.device-gateway-widget';
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 1;
    protected static ?string $pollingInterval = '30s';
    public function getViewData(): array
    {
        return [
            'total_devices'      => DB::connection('astpp')->table('sip_devices')->count(),
            'registered_devices' => DB::connection('astpp')->table('sip_devices')->where('status', 0)->count(),
            'gateways'           => DB::connection('astpp')->table('gateways')->select('id','name','status')->orderBy('name')->limit(8)->get(),
            'low_balance'        => DB::connection('astpp')->table('accounts')->where('deleted',0)->where('status',0)->whereIn('type',[0,1])->whereRaw('balance <= notify_credit_limit AND notify_credit_limit > 0')->select('number','balance','company_name','first_name')->orderBy('balance')->limit(5)->get(),
            'recent_refills'     => DB::connection('astpp')->table('payment_transaction')->join('accounts','payment_transaction.accountid','=','accounts.id')->select('accounts.number','accounts.company_name','payment_transaction.amount','payment_transaction.date')->orderByDesc('payment_transaction.date')->limit(5)->get(),
        ];
    }
}
