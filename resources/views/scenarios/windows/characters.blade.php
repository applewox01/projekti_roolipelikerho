<div class="window_content">
        @if ($character_relations->count() == 0)
        <p class="misc_notif">Liitä pelaajia skenaarioon admin-paneelin kautta</p>
        @else
        @foreach ($characters as $character)
        <div class="character_box">
                <p class="info_button_icon"><i class="fas fa-user-alt"></i></p>
                <p class="info_button_name">{{$character->name}}</p>

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
        <!--<div id="add_character">
                <p style="margin: 0; margin-top: 5px; margin-bottom: 5px;"><i style="font-size: 24px;" class="fas fa-user-plus"></i></p>

                <div id="unassigned_list" style="display: none">
                        <div class="add_character_box" id="">
                        <p style="margin: 0;  margin-top: 5px; margin-bottom: 5px;"><i style="font-size: 24px;" class="fas fa-user-alt"></i></p>
                        <p style="margin: 0; text-overflow: ellipsis; overflow: hidden; "></p>
                        </div
                </div>

        </div>-->

</div>
