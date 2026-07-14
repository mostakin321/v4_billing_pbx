<x-filament-widgets::widget>
    <x-filament::section>
        @php $d = $this->getViewData(); @endphp
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold">Account Overview</h2>
                <span class="px-2 py-1 text-xs rounded-full {{ $d['status'] === 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $d['status'] }}
                </span>
            </div>
            <div class="text-sm text-gray-500">{{ $d['name'] }} — {{ $d['number'] }}</div>
            <div class="text-xs text-gray-400">{{ $d['email'] }}</div>
            <hr/>
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-3">
                    <div class="text-2xl font-bold text-green-600">${{ number_format($d['balance'], 4) }}</div>
                    <div class="text-xs text-gray-500 mt-1">Balance</div>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl p-3">
                    <div class="text-2xl font-bold text-yellow-600">${{ number_format($d['credit_limit'], 2) }}</div>
                    <div class="text-xs text-gray-500 mt-1">Credit Limit</div>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-3">
                    <div class="text-2xl font-bold text-blue-600">${{ number_format($d['available'], 4) }}</div>
                    <div class="text-xs text-gray-500 mt-1">Available</div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
