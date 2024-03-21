<div class="window_content">
    @if (! $events)
    <p class="misc_notif">Lisää tapahtumia skenaarioon admin-paneelin kautta</p>
    @else
    @php
    $json_data = json_decode($events->data);
    @endphp
    @if (count($json_data) > 0)
    @foreach ($json_data as $event)
    <div class="character_box">
            <p class="info_button_icon"><i class="fa-solid fa-calendar-days"></i></p>
            <p class="info_button_name">{{$event->name}}</p>

    <div class="character_info" style="display: none;">
            <p>{{$event->description}}</p>
    </div>

    </div>
    @endforeach
    @else
    <p class="misc_notif">Lisää tapahtumia skenaarioon admin-paneelin kautta</p>
    @endif
    @endif
</div>