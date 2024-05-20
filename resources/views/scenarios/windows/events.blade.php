<div class="window_content">
        @if (count($events) == 0)
                <p class="misc_notif">Lisää tapahtumia skenaarioon admin-paneelin kautta</p>
        @else
        @foreach ($events as $event)
        @php
            $json_data = $event->data;
        @endphp
        @foreach ($json_data as $event_data)
        <div class="character_box">

                <div class="info_area">
                <i class="fa-solid fa-calendar-days"></i>
                <h3 class="info_button_name">{{$event_data['name']}}</h3>
        </div>

        <div class="character_info">
                <p>{{$event_data['description']}}</p>
        </div>

        </div>
        @endforeach
        @endforeach
        @endif
    </div>
