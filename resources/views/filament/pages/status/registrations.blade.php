<x-filament-panels::page>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
        <div class="p-4 flex items-center justify-between border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                    {{ $count }} registration{{ $count !== 1 ? 's' : '' }}
                </span>
                <span class="text-xs text-gray-400">Updated {{ $lastUpdate }}</span>
            </div>
        </div>
        @if($error)
            <div class="p-4 text-red-500 text-sm">{{ $error }}</div>
        @elseif(count($registrations) === 0)
            <div class="p-8 text-center text-gray-400">No active registrations</div>
        @else
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300">User</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300">Realm</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300">URL</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300">Expires</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300">LAN IP</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300">User Agent</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $reg)
                <tr class="border-t border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-white">{{ $reg['reg_user'] ?? '' }}</td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $reg['realm'] ?? '' }}</td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300 text-xs">{{ $reg['url'] ?? '' }}</td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $reg['expires'] ?? '' }}</td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $reg['lan_ip'] ?? '' }}</td>
                    <td class="px-4 py-3 text-gray-500 text-xs">{{ $reg['user_agent'] ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-filament-panels::page>
