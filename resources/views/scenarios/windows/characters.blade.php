<div class="window_content">
        @if (count($characters) == 0)
        <p class="misc_notif">Lisää pelaajia skenaarioon admin-paneelin kautta</p>
        @else
        @foreach ($characters as $character)
        <div class="character_box">
                <div class="info_area">
                <i class="fas fa-user-alt"></i>
                <h3 class="info_button_name">{{$character->name}}</h3>
                </div>
        <div class="character_info">
                <p class="info_name">Rotu:</p>
                <p>{{$character->race}}</p>
                <p class="info_name">LVL:</p>
                <p>{{$character->level}}</p>
                <p class="info_name">Luokka:</p>
                <p>{{$character->class}}</p>
                <p class="info_name">Pelaajan nimi:</p>
                <p>{{$character->player_name}}</p>
                <p class="info_name">Muistiinpanot:</p>
                <p>{{$character->notes}}</p>
        </div>

        </div>
        @endforeach
        @endif

</div>
