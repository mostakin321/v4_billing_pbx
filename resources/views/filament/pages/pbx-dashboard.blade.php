<x-filament-panels::page>
    <div class="grid gap-6">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="text-sm text-gray-500">Calls Today</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($stats['calls_today'] ?? 0) }}</div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="text-sm text-gray-500">Extensions</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($stats['extensions'] ?? 0) }}</div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="text-sm text-gray-500">Gateways</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($stats['gateways'] ?? 0) }}</div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="text-sm text-gray-500">Dialplans</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($stats['dialplans'] ?? 0) }}</div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="text-sm text-gray-500">Call Center Queues</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($stats['cc_queues'] ?? 0) }}</div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="border-b border-gray-100 px-6 py-4">
                <div class="text-lg font-semibold text-gray-900">Quick Links</div>
                <div class="text-sm text-gray-500">Jump to the most-used FusionPBX areas</div>
            </div>

            <div class="grid grid-cols-1 gap-4 p-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach(($links ?? []) as $link)
                    <a href="{{ $link['url'] }}"
                       class="group rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:border-[color:var(--kazitel-accent)] hover:shadow-md">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-base font-semibold text-gray-900 group-hover:text-[color:var(--kazitel-accent)]">
                                    {{ $link['label'] }}
                                </div>
                                <div class="mt-1 text-sm text-gray-500">
                                    {{ $link['description'] }}
                                </div>
                            </div>
                            <div class="text-xs rounded-full bg-gray-100 px-2 py-1 text-gray-600 group-hover:bg-[color:var(--kazitel-accent)] group-hover:text-black">
                                {{ $link['group'] }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-filament-panels::page>
