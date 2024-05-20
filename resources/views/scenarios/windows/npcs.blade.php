<div class="window_content">
    @if (count($npcs) == 0)
        <p class="misc_notif">Lisää NPC:itä skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($npcs as $npc)
            @php
                $json_data = $npc->data;
            @endphp
            @if (empty($json_data))
            <p class="misc_notif">Lisää NPC:itä skenaarioon admin-paneelin kautta</p>
            @else
            @foreach ($json_data as $npc_data)
                <div class="character_box">
                    <div class="info_area">
                    <i class="fa-solid fa-person"></i>
                    <h3 class="info_button_name">{{$npc_data['name']}}</h3>
                    </div>

                    <div class="character_info">
                        <p>{{$npc_data['description']}}</p>
                    </div>
                </div>
            @endforeach
            @endif
        @endforeach
    @endif
</div>
