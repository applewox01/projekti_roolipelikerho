<div class="window_content">
    @if (count($events) == 0)
        <p class="misc_notif">Lisää tapahtumia skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($events as $event)
            @php
                $json_data = json_decode($event->data, true);
            @endphp
            @if (empty($json_data))
                <p class="misc_notif">Lisää tapahtumia skenaarioon admin-paneelin kautta</p>
            @else
                @foreach ($json_data as $event_data)
                    <div class="character_box">
                        <div class="info_area">
                            <i class="fa-solid fa-calendar-days"></i>
                            <h3 class="info_button_name">{{ $event_data['name'] }}</h3>
                            <i class="fa fa-arrow-circle-down hide_character_box"></i>
                        </div>

                        <div class="character_info">
                            <div class="long_text_format">
                            <p>{!! $event_data['description'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    @endif
</div>
