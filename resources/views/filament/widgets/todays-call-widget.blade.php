<x-filament-widgets::widget>
    <x-filament::section>
        @php $d = $this->getViewData(); @endphp
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-bold">Today's Call</h3>
            <span class="text-xs text-gray-400">Avg Talk: {{ $d['avg_talk'] }}</span>
        </div>
        <div class="grid grid-cols-3 gap-2 text-center">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-2">
                <div class="text-xl font-bold">{{ number_format($d['total']) }}</div>
                <div class="text-xs text-gray-500">Total Calls</div>
                <div class="text-xs text-gray-400">{{ $d['duration'] }}</div>
                <div class="text-xs text-red-400">${{ $d['spent'] }}</div>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-2">
                <div class="text-xl font-bold text-green-600">{{ number_format($d['answered']) }}</div>
                <div class="text-xs text-gray-500">Answered</div>
            </div>
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-2">
                <div class="text-xl font-bold text-blue-600">{{ number_format($d['outbound']) }}</div>
                <div class="text-xs text-gray-500">Outbound</div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
