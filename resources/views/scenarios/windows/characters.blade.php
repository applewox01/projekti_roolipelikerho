<div class="window_content">
        @if (count($characters) == 0)
        <p class="misc_notif">Lisää pelaajia skenaarioon admin-paneelin kautta</p>
        @else
        @foreach ($characters as $character)
        <div class="character_box">
                <div class="info_area">
                <i class="fas fa-user-alt"></i>
                <h3 class="info_button_name">{{$character->name}}</h3>
                <i class="fa fa-arrow-circle-down hide_character_box"></i>
                </div>
        <div class="character_info">
                <div class="info_name_character">
                <p class="character_highlighted_p">Rotu: </p><div class="gap"></div><p class="info_name_character_p"> {{$character->race}}</p>
                </div>
                <div class="info_name_character">
                <p class="character_highlighted_p">LVL: </p><div class="gap"></div><p class="info_name_character_p"> {{$character->level}}</p>
                </div>
                <div class="info_name_character">
                <p class="character_highlighted_p">Luokka: </p><div class="gap"></div><p class="info_name_character_p"> {{$character->class}}</p>
                </div>
                <div class="info_name_character">
                <p class="character_highlighted_p">Pelaajan nimi: </p><div class="gap"></div><p class="info_name_character_p"> {{$character->player_name}}</p>
                </div>
                @if (Storage::disk('public')->exists($character->attachment))
                <a href="{{Storage::url($character->attachment)}}"><p class="info_name_character">Hahmolomake</p></a>
                @else
                <p class="info_name_character attachment_not_found_character">Hahmolomaketta ei löydetty</p>
                @endif
                <div class="character_notes">
                <p class="character_highlighted_p font_notes">Muistiinpanot:</p>
                <p class="char_notes_p">{!! $character->notes !!}</p>
                </div>  
        </div>

        </div>
        @endforeach
        @endif

</div>
