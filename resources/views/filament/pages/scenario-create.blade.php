<x-filament-panels::page>
    <div>
        <form wire:submit="create">
            {{ $this->form }}

            <br>
            @foreach($npcs as $index => $npc)
            <label for="npcs.{{ $index }}">NPC {{ $index + 1 }}</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="npcs.{{ $index }}.name"
                    id="npcs.{{ $index }}"
                />
            </x-filament::input.wrapper>
            <br>
            <label for="description.{{ $index }}">NPC:n {{ $index + 1 }} Kuvaus</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="npcs.{{ $index }}.description"
                    id="description.{{ $index }}"
                />
            </x-filament::input.wrapper>
            <br>
            <x-filament::button
                color="danger"
                icon="heroicon-o-x-mark"
                wire:click.prevent="removeNpc({{ $index }})"
                labeled-from="sm"
                tag="button"
                type="button"
            >
            Poista NPC
            </x-filament::button>
            <br><br>
            @endforeach
            <br>

            @foreach($monsters as $index => $npc)

            <label for="monsters.{{ $index }}">Hirviö {{ $index + 1 }}</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="monsters.{{ $index }}.name"
                    id="monsters.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>

            <label for="attack_info.{{ $index }}">Hirviö:n {{ $index + 1 }} Taistelutiedot</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="monsters.{{ $index }}.attack_info"
                    id="monstr.attack_info.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>

            <label for="monstr.misc_info.{{ $index }}">Hirviö:n {{ $index + 1 }} Lisätiedot</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="monsters.{{ $index }}.misc_info"
                    id="monstr.misc_info.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>

            <label for="monstr.defense.{{ $index }}">Hirviö:n {{ $index + 1 }} Puolustus</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="monsters.{{ $index }}.defense"
                    id="monstr.defense.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>

            <label for="monstr.hp.{{ $index }}">Hirviö:n {{ $index + 1 }} Osumapisteet</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="monsters.{{ $index }}.hp"
                    id="monstr.hp.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>

            <label for="monstr.xp.{{ $index }}">Hirviö:n {{ $index + 1 }} XP</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="monsters.{{ $index }}.xp"
                    id="monstr.xp.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>

            <label for="monstr.link.{{ $index }}">Hirviö:n {{ $index + 1 }} Linkki</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="monsters.{{ $index }}.link"
                    id="monstr.link.{{ $index }}"
                />
            </x-filament::input.wrapper>

            <br>

            <x-filament::button
                color="danger"
                icon="heroicon-o-x-mark"
                wire:click.prevent="removeMonster({{ $index }})"
                labeled-from="sm"
                tag="button"
                type="button"
            >
            Poista Hirviö
            </x-filament::button>
            <br><br>
            @endforeach
            <br>

            @foreach($places as $index => $npc)
            <label for="place.{{ $index }}">Paikka {{ $index + 1 }}</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="places.{{ $index }}.name"
                    id="place.{{ $index }}"
                />
            </x-filament::input.wrapper>
            <br>
            <label for="plc.description.{{ $index }}">Paikan {{ $index + 1 }} Kuvaus</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="places.{{ $index }}.description"
                    id="plc.description.{{ $index }}"
                />
            </x-filament::input.wrapper>
            <br>
            <x-filament::button
                color="danger"
                icon="heroicon-o-x-mark"
                wire:click.prevent="removePlace({{ $index }})"
                labeled-from="sm"
                tag="button"
                type="button"
            >
            Poista Paikka
            </x-filament::button>
            <br><br>
            @endforeach
            <br>

            @foreach($events as $index => $npc)
            <label for="events.{{ $index }}">Tapahtuma {{ $index + 1 }}</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="events.{{ $index }}.name"
                    id="events.{{ $index }}"
                />
            </x-filament::input.wrapper>
            <br>
            <label for="evnt.description.{{ $index }}">Tapahtuman {{ $index + 1 }} Kuvaus</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="events.{{ $index }}.description"
                    id="evnt.description.{{ $index }}"
                />
            </x-filament::input.wrapper>
            <br>
            <x-filament::button
                color="danger"
                icon="heroicon-o-x-mark"
                wire:click.prevent="removePlace({{ $index }})"
                labeled-from="sm"
                tag="button"
                type="button"
            >
            Poista Paikka
            </x-filament::button>
            <br><br>
            @endforeach
            <br>

            <x-filament::button
                    color="info"
                    icon="heroicon-o-plus"
                    wire:click.prevent="addNpcField"
                    labeled-from="sm"
                    tag="button"
                    type="button"
                >
                Uusi NPC
            </x-filament::button>
            <x-filament::button
                    color="info"
                    icon="heroicon-o-plus"
                    wire:click.prevent="addMonsterField"
                    labeled-from="sm"
                    tag="button"
                    type="button"
                >
                Uusi Hirviö
            </x-filament::button>
            <x-filament::button
                    color="info"
                    icon="heroicon-o-plus"
                    wire:click.prevent="addPlaceField"
                    labeled-from="sm"
                    tag="button"
                    type="button"
                >
                Uusi Paikka
            </x-filament::button>
            <x-filament::button
                    color="info"
                    icon="heroicon-o-plus"
                    wire:click.prevent="addEventField"
                    labeled-from="sm"
                    tag="button"
                    type="button"
                >
                Uusi Tapahtuma
            </x-filament::button>
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
