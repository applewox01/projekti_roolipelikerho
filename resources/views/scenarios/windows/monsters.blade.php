<div class="window_content">
    @if (count($monsters) == 0)
        <p class="misc_notif">Lisää hirviöitä skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($monsters as $monster)
            @php
                $json_data = json_decode($monster->data, true);
            @endphp
            @if (empty($json_data))
                <p class="misc_notif">Lisää hirviöitä skenaarioon admin-paneelin kautta</p>
            @else
                @foreach ($json_data as $monster_data)
                    <div class="character_box">
                        <div class="info_area">
                            <i class="fa-solid fa-dragon"></i>
                            <h3 class="info_button_name">{{ $monster_data['name'] }}</h3>
                            <i class="fa fa-arrow-circle-down hide_character_box"></i>
                        </div>

                        <div class="character_info">
                            <div class="monster_info_flexbox">
                                <i class="fa fa-heart"></i>
                                <p>{{ $monster_data['hp'] }}</p>
                            </div>
                            <div class="monster_info_flexbox">
                                <i class="fa fa-shield"></i>
                                <p>{{ $monster_data['defense'] }}</p>
                            </div>
                            <div class="monster_info_flexbox">
                                <p>XP</p>
                                <p>{{ $monster_data['xp'] }}</p>
                            </div>
                            <div class="long_text_format">
                                <p>{!! $monster_data['attack_info'] !!}</p>
                            </div>
                            <div class="long_text_format">
                            <p>{!! $monster_data['misc_info'] !!}</p>
                            </div>
                            <p>Linkki: <a href="{{ $monster_data['link'] }}">{{ $monster_data['link'] }}</a></p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    @endif
</div>
