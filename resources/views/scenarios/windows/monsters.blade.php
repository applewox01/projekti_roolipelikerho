<div class="window_content">
    @if (count($monsters) == 0)
        <p class="misc_notif">Lisää hirviöitä skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($monsters as $monster)
        @php
            $json_data = $monster->data;
        @endphp
        @if (empty($json_data))
        <p class="misc_notif">Lisää hirviöitä skenaarioon admin-paneelin kautta</p>
        @else
            @foreach ($json_data as $monters_data)
            <div class="character_box">
                <div class="info_area">
                <i class="fa-solid fa-dragon"></i>
                <h3 class="info_button_name">{{$monters_data['name']}}</h3>
                </div>

                <div class="character_info">

                        <div class="monster_info_flexbox">
                        <i class="fa fa-star"></i>
                        <p>{{$monters_data['xp']}}</p>
                        </div>
                        <div class="monster_info_flexbox">
                        <i class="fa fa-heart"></i>
                        <p>{{$monters_data['hp']}}</p>
                        </div>
                        <div class="monster_info_flexbox">
                        <i class="fa fa-shield"></i>
                        <p>{{$monters_data['defense']}}</p>
                        </div>

                        <a href="{{$monters_data['link']}}">{{$monters_data['link']}}</a>
                        <p>{{$monters_data['misc_info']}}</p>
                </div>
            @endforeach
                @endif
    </div>
    @endforeach
    @endif
</div>
