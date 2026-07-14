<x-filament-panels::page>

    {{-- CGRateS status banner --}}
    <div class="mb-4 rounded-lg px-4 py-3 text-sm font-medium
        {{ $cgratesOnline ? 'bg-green-50 text-green-800 border border-green-200' : 'bg-red-50 text-red-800 border border-red-200' }}">
        @if ($cgratesOnline)
            ✅ CGRateS is <strong>online</strong> — real-time billing active
        @else
            ⚠️ CGRateS is <strong>offline</strong> — local DB billing only (calls may still complete)
        @endif
    </div>

    {{-- Stats grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
        @php
        $cards = [
            ['label' => 'Total Accounts',    'value' => number_format($totalAccts),                  'color' => 'blue'],
            ['label' => 'Resellers',          'value' => number_format($resellers),                   'color' => 'purple'],
            ['label' => 'Customers',          'value' => number_format($customers),                   'color' => 'indigo'],
            ['label' => 'Total Balance',      'value' => '$' . number_format($totalBalance, 2),        'color' => 'green'],
            ['label' => 'Low Balance (<$5)',  'value' => number_format($lowBalance),                  'color' => 'yellow'],
            ['label' => 'Zero / Negative',   'value' => number_format($zeroBalance),                 'color' => 'red'],
            ['label' => 'Calls Today',        'value' => number_format($callsToday),                  'color' => 'teal'],
            ['label' => 'Revenue Today',      'value' => '$' . number_format($revenueToday, 2),        'color' => 'emerald'],
            ['label' => 'Calls This Month',   'value' => number_format($callsMonth),                  'color' => 'sky'],
            ['label' => 'Revenue This Month', 'value' => '$' . number_format($revenueMonth, 2),        'color' => 'cyan'],
        ];
        @endphp

        @foreach ($cards as $card)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4">
            <div class="text-xs text-gray-500 uppercase tracking-wide mb-1">{{ $card['label'] }}</div>
            <div class="text-2xl font-bold text-gray-800">{{ $card['value'] }}</div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent transactions --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="px-4 py-3 border-b border-gray-100 font-semibold text-gray-700">
                Recent Transactions
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                        <tr>
                            <th class="px-3 py-2 text-left">Account</th>
                            <th class="px-3 py-2 text-left">Type</th>
                            <th class="px-3 py-2 text-right">Amount</th>
                            <th class="px-3 py-2 text-right">Balance</th>
                            <th class="px-3 py-2 text-left">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($recentTransactions as $tx)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 font-mono text-xs">{{ $tx->account?->number ?? '—' }}</td>
                            <td class="px-3 py-2">
                                <span class="px-1.5 py-0.5 rounded text-xs font-medium
                                    {{ in_array($tx->type, ['topup','credit','refund','bonus']) ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $tx->type }}
                                </span>
                            </td>
                            <td class="px-3 py-2 text-right {{ (float)$tx->amount >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                ${{ number_format(abs((float)$tx->amount), 4) }}
                            </td>
                            <td class="px-3 py-2 text-right text-gray-600">
                                ${{ number_format((float)$tx->balance_after, 4) }}
                            </td>
                            <td class="px-3 py-2 text-gray-400 text-xs">
                                {{ \Carbon\Carbon::parse($tx->created_at)->diffForHumans() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent CDRs --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="px-4 py-3 border-b border-gray-100 font-semibold text-gray-700">
                Recent CDRs
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                        <tr>
                            <th class="px-3 py-2 text-left">Account</th>
                            <th class="px-3 py-2 text-left">Destination</th>
                            <th class="px-3 py-2 text-right">Sec</th>
                            <th class="px-3 py-2 text-right">Cost</th>
                            <th class="px-3 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($recentCdrs as $cdr)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 font-mono text-xs">{{ $cdr->account_number }}</td>
                            <td class="px-3 py-2 font-mono text-xs">{{ $cdr->destination_number }}</td>
                            <td class="px-3 py-2 text-right">{{ $cdr->billed_seconds }}</td>
                            <td class="px-3 py-2 text-right text-red-600">${{ number_format((float)$cdr->call_cost, 4) }}</td>
                            <td class="px-3 py-2">
                                <span class="px-1.5 py-0.5 rounded text-xs font-medium
                                    {{ $cdr->status === 'ANSWERED' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $cdr->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-filament-panels::page>
