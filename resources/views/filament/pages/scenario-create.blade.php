<x-filament-panels::page>
    <div>
        <form wire:submit="create">
            {{ $this->form }}

            <x-filament::button
                    color="info"
                    icon="heroicon-o-plus"
                    labeled-from="sm"
                    tag="button"
                    type="submit"
                >
                Luo Skenaario
            </x-filament::button>
        </form>

        <x-filament-actions::modals />
    </div>
</x-filament-panels::page>
