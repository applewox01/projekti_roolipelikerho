<x-filament-panels::page>
    <div>
        <form wire:submit="update">
            {{ $this->form }}

            <br>
            @foreach($attachments as $index => $attachments)

            <label for="attachment.{{ $index }}">Liite {{ $index + 1 }}</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="attachments.{{ $index }}"
                    id="attachment.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>
            <x-filament::button
                color="danger"
                icon="heroicon-o-x-mark"
                wire:click.prevent="removeAttachment({{ $index }})"
                labeled-from="sm"
                tag="button"
                type="button"
            >
            Poista Liite
            </x-filament::button>
            <br><br>
            @endforeach
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
