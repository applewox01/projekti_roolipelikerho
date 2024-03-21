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
            <p style="margin: 0;  margin-top: 5px; margin-bottom: 5px;"><i style="font-size: 24px;" class="	fas fa-door-open"></i></p>
            <p style="margin: 0; text-overflow: ellipsis; overflow: hidden; ">{{$room->name}}</p>

            <div class="character_info" style="display: none;">
                    <p>{{$room->description}}</p>
            </div>

    </div>
    @endforeach
    @else
    <p class="misc_notif">Lisää paikkoja skenaarioon admin-paneelin kautta</p>
    @endif

    @endif
</div>