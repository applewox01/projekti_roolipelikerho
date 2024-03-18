<div class="window_content" style="width: 400px; height: 200px; max-width: 400px; max-height: 600px;">

<div>
        @foreach ($characters as $character)
        <div class="character_box">
                <p style="margin: 0;  margin-top: 5px; margin-bottom: 5px;"><i style="font-size: 24px;" class="fas fa-user-alt"></i></p>
                <p style="margin: 0; text-overflow: ellipsis; overflow: hidden; ">{{$character->name}}</p>

        <div class="character_info" style="display: none;">
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
        <div id="add_character">
                <p style="margin: 0; margin-top: 5px; margin-bottom: 5px;"><i style="font-size: 24px;" class="fas fa-user-plus"></i></p>

                <div id="unassigned_list" style="display: none">
                        @foreach ($unassigned_characters as $unassigned)
                        <div class="add_character_box">
                        <p style="margin: 0;  margin-top: 5px; margin-bottom: 5px;"><i style="font-size: 24px;" class="fas fa-user-alt"></i></p>
                        <p style="margin: 0; text-overflow: ellipsis; overflow: hidden; ">{{$unassigned->name}}</p>
                        </div>
                        @endforeach
                </div>

        </div>
</div>

</div>