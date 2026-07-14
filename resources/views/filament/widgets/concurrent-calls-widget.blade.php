<x-filament-widgets::widget>
    <x-filament::section>
        @php $d = $this->getViewData(); @endphp
        <h3 class="text-sm font-bold mb-2">Concurrent Calls</h3>
        <div class="text-5xl font-bold text-center text-green-500 py-3">{{ $d['concurrent'] }}</div>
        <div class="mt-3 pt-3 border-t border-gray-100 dark:border-gray-700 space-y-1">
            <div class="flex justify-between text-xs"><span class="text-gray-500">Total Accounts</span><span class="font-semibold">{{ number_format($d['total_accounts']) }}</span></div>
            <div class="flex justify-between text-xs"><span class="text-gray-500">Total Prepaid Outstanding</span><span class="font-semibold text-orange-500">${{ $d['total_outstanding'] }}</span></div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
