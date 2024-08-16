<div class="window_content">
    @if (count($rooms) == 0)
        <p class="misc_notif">Lisää paikkoja skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($rooms as $room)
            @php
                $json_data = json_decode($room->data, true);
            @endphp
            @if (empty($json_data))
                <p class="misc_notif">Lisää paikkoja skenaarioon admin-paneelin kautta</p>
            @else
                @foreach ($json_data as $room_data)
                    <div class="character_box">
                        <div class="info_area">
                            <i class="fas fa-door-open"></i>
                            <h3 class="info_button_name">{{ $room_data['name'] }}</h3>
                            <i class="fa fa-arrow-circle-down hide_character_box"></i>
                        </div>
                        <div class="character_info">
                            <div class="long_text_format">
                            <p>{!! $room_data['description'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    @endif
</div>
