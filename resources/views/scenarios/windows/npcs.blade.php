<div class="window_content">
    @if (count($npcs) == 0)
        <p class="misc_notif">Lisää NPC:itä skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($npcs as $npc)
            @php
                $json_data = $npc->data;
            @endphp
            @foreach ($json_data as $npc_data)
                <div class="character_box">
                    <p class="info_button_icon"><i class="fa-solid fa-person"></i></p>
                    <p class="info_button_name">{{$npc_data['name']}}</p>
                    <div class="character_info">
                        <p>{{$npc_data['description']}}</p>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endif
</div>
