<x-filament-panels::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <div class="mt-6 flex gap-3">
            <x-filament::button type="submit" color="primary">
                Save Outbound Route
            </x-filament::button>
            <x-filament::button
                tag="a"
                href="{{ \App\Filament\Resources\FusionPBX\OutboundRoutes\OutboundRouteResource::getUrl('index') }}"
                color="gray">
                Cancel
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
