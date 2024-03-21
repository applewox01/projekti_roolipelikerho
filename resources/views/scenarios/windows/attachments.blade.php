<div class="window_content">
    @if (count($attachments_urls) == 0)
    <p class="misc_notif">Liitä liitteitä skenaarioon admin-paneelin kautta</p>
    @else
    @php
    @endphp
    @foreach ($attachments_urls as $url)
    <div class="character_box">
        @if (file_exists(public_path($url)))
            <p><img src="{{asset($url)}}" style="border-radius: 15px; width: 100%; height: fit-content;"></p>
        @else
            <p class="info_button_name">404 ({{$url}})</p>
        @endif
    <div class="character_info" style="display: none;">
            <p><img src="{{asset($url)}}"></p>
    </div>

    </div>
    @endforeach
    @endif 
</div>