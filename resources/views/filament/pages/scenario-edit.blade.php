<x-filament-panels::page>
    <div>
        <form wire:submit="update">
            {{ $this->form }}

            <br>
            <x-filament::button
                    color="info"
                    icon="heroicon-o-plus"
                    labeled-from="sm"
                    tag="button"
                    type="submit"
                >
                Päivitä
            </x-filament::button>
        </form>

        <x-filament-actions::modals />
    </div>
</x-filament-panels::page>
