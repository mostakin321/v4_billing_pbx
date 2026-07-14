<x-filament-widgets::widget>
    <x-filament::section>
        @php $d = $this->getViewData(); @endphp
        <div class="space-y-4">
            <div>
                <div class="flex justify-between mb-2"><h3 class="text-sm font-bold">Device</h3><a href="/admin/billing/sip-devices" class="text-xs text-primary-500">View all</a></div>
                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded p-2"><div class="text-2xl font-bold">{{ $d['total_devices'] }}</div><div class="text-xs text-gray-500">Total</div></div>
                    <div class="bg-green-50 dark:bg-green-900/20 rounded p-2"><div class="text-2xl font-bold text-green-600">{{ $d['registered_devices'] }}</div><div class="text-xs text-gray-500">Registered</div></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2"><h3 class="text-sm font-bold">Gateways</h3><a href="/admin/billing/gateways" class="text-xs text-primary-500">View all</a></div>
                @forelse($d['gateways'] as $gw)
                <div class="flex justify-between text-sm py-1 border-b border-gray-100 dark:border-gray-700">
                    <span>{{ $gw->name }}</span>
                    <span class="{{ $gw->status==0?'text-green-500':'text-red-500' }}">{{ $gw->status==0?'▲ Up':'▼ Down' }}</span>
                </div>
                @empty<div class="text-xs text-gray-400 text-center py-2">No gateways</div>@endforelse
            </div>
            <div>
                <div class="flex justify-between mb-2"><h3 class="text-sm font-bold">Low Balance</h3><a href="/admin/billing/low-balance" class="text-xs text-primary-500">View all</a></div>
                @forelse($d['low_balance'] as $acc)
                <div class="flex justify-between text-xs py-1"><span>{{ $acc->company_name ?: $acc->first_name }} ({{ $acc->number }})</span><span class="text-red-500 font-bold">${{ number_format($acc->balance,4) }}</span></div>
                @empty<div class="text-xs text-gray-400 text-center py-2">None</div>@endforelse
            </div>
            <div>
                <h3 class="text-sm font-bold mb-2">Recent Refills</h3>
                @forelse($d['recent_refills'] as $r)
                <div class="flex justify-between text-xs py-1 border-b border-gray-100 dark:border-gray-700"><span>{{ $r->company_name ?: $r->number }}</span><span class="text-green-500 font-bold">+${{ number_format($r->amount,4) }}</span></div>
                @empty<div class="text-xs text-gray-400 text-center py-2">None</div>@endforelse
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
