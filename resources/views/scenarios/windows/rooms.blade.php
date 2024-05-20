<div class="window_content">
        @if (count($rooms) == 0)
        <p class="misc_notif">Lisää paikkoja skenaarioon admin-paneelin kautta</p>
        @else
        @foreach ($rooms as $room)
        @php
            $json_data = $room->data;
        @endphp
        @foreach ($json_data as $room_data)
        <div class="character_box">
            <div class="info_area">
            <i class="fas fa-door-open"></i>
            <h3 class="info_button_name">{{$room_data['name']}}</h3>
            </div>
            <div class="character_info">
                    <p>{{$room_data['description']}}</p>
            </div>

    </div>
    @endforeach
    @endforeach

    @endif
</div>
