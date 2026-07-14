<x-filament-panels::page>
    <div class="flex justify-end mb-4">
        <x-filament::button wire:click="refresh" icon="heroicon-o-arrow-path" color="gray">Refresh</x-filament::button>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
        @php
            $lines = array_values(array_filter(explode("\n", trim($output)), fn($l) => trim($l) && !str_starts_with(trim($l), '+OK')));
            $headers = [];
            $rows = [];
            if (count($lines) > 0) {
                $headers = explode('|', trim($lines[0]));
                foreach (array_slice($lines, 1) as $line) {
                    $rows[] = explode('|', trim($line));
                }
            }
        @endphp
        @if(count($rows) > 0)
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        @foreach($headers as $h)
                        <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 capitalize whitespace-nowrap">
                            {{ str_replace('_', ' ', trim($h)) }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr class="border-t border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        @foreach($row as $cell)
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300 whitespace-nowrap">{{ trim($cell) }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-8 text-center text-gray-400">
                <p class="text-lg font-medium">No data available</p>
                @if($output)
                <pre class="text-xs mt-3 text-left bg-gray-50 dark:bg-gray-700 p-3 rounded overflow-x-auto">{{ $output }}</pre>
                @endif
            </div>
        @endif
    </div>
</x-filament-panels::page>
