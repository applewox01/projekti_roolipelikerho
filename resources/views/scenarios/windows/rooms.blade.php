<div class="window_content">
    @if (! $rooms)
    <p class="misc_notif">Lisää paikkoja skenaarioon admin-paneelin kautta</p>
    @else
        @php
        $json_data = json_decode($rooms->data);
        @endphp
        @if (count($json_data) > 0)
        @foreach ($json_data as $room) 
        <div class="character_box">
            <p class="info_button_icon"><i class="fas fa-door-open"></i></p>
            <p class="info_button_name">{{$room->name}}</p>

            <div class="character_info">
                    <p>{{$room->description}}</p>
            </div>

    </div>
    @endforeach
    @else
    <p class="misc_notif">Lisää paikkoja skenaarioon admin-paneelin kautta</p>
    @endif

    @endif
</div>