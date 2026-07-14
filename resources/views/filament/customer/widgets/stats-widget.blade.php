<x-filament-widgets::widget>
    <x-filament::section>
        @php $d = $this->getViewData(); $today = $d['today']; $month = $d['month']; @endphp
        <div class="space-y-3">
            <h2 class="text-lg font-bold">My Call Stats</h2>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-500 text-xs">
                        <th class="text-left py-1">Metric</th>
                        <th class="text-center py-1">Today</th>
                        <th class="text-center py-1">This Month</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr><td class="py-2 font-medium text-yellow-600">ASR (%)</td><td class="text-center">{{ number_format($today['asr'],2) }}%</td><td class="text-center">{{ number_format($month['asr'],2) }}%</td></tr>
                    <tr><td class="py-2 font-medium text-blue-600">ACD</td><td class="text-center">{{ $today['acd_fmt'] }}</td><td class="text-center">{{ $month['acd_fmt'] }}</td></tr>
                    <tr><td class="py-2 font-medium text-pink-600">Total Calls</td><td class="text-center">{{ number_format($today['total_calls']) }}</td><td class="text-center">{{ number_format($month['total_calls']) }}</td></tr>
                    <tr><td class="py-2 font-medium text-gray-600">Minutes</td><td class="text-center">{{ number_format($today['minutes'],0) }}</td><td class="text-center">{{ number_format($month['minutes'],0) }}</td></tr>
                    <tr><td class="py-2 font-medium">Spent</td><td class="text-center text-red-500">${{ number_format($today['debit'],4) }}</td><td class="text-center text-red-500">${{ number_format($month['debit'],4) }}</td></tr>
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
