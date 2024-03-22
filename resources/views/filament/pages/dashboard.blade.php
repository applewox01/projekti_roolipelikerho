<x-filament-panels::page>
    <div>
        @livewire(StatsOverview::class)
    </div>
    <div>
        {{ $this->table }}
    </div>
</x-filament-panels::page>
