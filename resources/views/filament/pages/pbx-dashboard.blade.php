<x-filament-panels::page>
    <div class="grid gap-6">
        <x-filament::section>
            <x-slot name="heading">Quick Links</x-slot>
            <x-slot name="description">Jump to the most-used FusionPBX areas</x-slot>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                @foreach(($links ?? []) as $link)
                    <a href="{{ $link['url'] }}"
                       class="fi-section group rounded-xl border p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-base font-semibold">
                                    {{ $link['label'] }}
                                </div>
                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $link['description'] }}
                                </div>
                            </div>
                            <x-filament::badge>
                                {{ $link['group'] }}
                            </x-filament::badge>
                        </div>
                    </a>
                @endforeach
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
