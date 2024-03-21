<div class="window_content">
    @if(! $npcs)
    <p class="misc_notif">Lisää NPC:itä skenaarioon admin-paneelin kautta</p>
    @else
        @php
        $json_data = json_decode($npcs->data);
        @endphp
        @foreach ($json_data as $npc) 
        <div class="character_box">
            <p class="info_button_icon"><i class="fa-solid fa-person"></i></p>
            <p class="info_button_name">{{$npc->name}}</p>

            <div class="character_info" style="display: none;">
                    <p>{{$npc->description}}</p>
            </div>

    </div>
    @endforeach
    @endif
</div>