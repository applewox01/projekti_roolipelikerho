<div class="window_content">
    @if ($monsters)
    @php
    $json_data = json_decode($monsters->data);
    @endphp
        @foreach ($json_data as $monster) 
        <div class="character_box">
            <p class="info_button_icon"><i class="fa-solid fa-dragon"></i></p>
            <p class="info_button_name">{{$monster->name}}</p>

            <div class="character_info" style="display: none;">

                    <div class="monster_info_flexbox">
                    <p class="monster_info_icon"><i class="fas fa-star"></i></p>
                    <p>{{$monster->xp}}</p>
                    </div>
                    <div class="monster_info_flexbox">
                    <p class="monster_info_icon"><i class="fa fa-heart"></i></p>
                    <p>{{$monster->hp}}</p>
                    </div>
                    <div class="monster_info_flexbox">
                    <p class="monster_info_icon"><i class="fa fa-shield"></i></p>
                    <p>{{$monster->defense}}</p>
                    </div>

                    <a href="{{$monster->link}}">{{$monster->link}}</a>
                    <p>{{$monster->misc_info}}</p>
            </div>

    </div>
    @endforeach
    @else
    <p class="misc_notif">Lisää hirviöitä skenaarioon admin-paneelin kautta</p>
    @endif
</div>