<div class="window_content">
    @php
    $i = 0;
    $attachments_urls = array();
    $json_data = json_decode($attachments->data);
    foreach ($json_data as $attachment) {
        array_push($attachments_urls, [$attachment, Storage::url($attachment)]);
    }
    @endphp
    @if (count($attachments_urls) == 0)
    <p class="misc_notif">Liitä liitteitä skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($attachments_urls as $url)
        @if (file_exists(public_path($url[1])))
        <div  id="full_{{$i}}" class="full_image">
            <div class="full_image_info">
                <div class="close_image"><i class="fa">&#xf00d;</i></div>
                <p>{{$url[0]}}</p>
            </div>
            <p class="full_image_icon"><img src="{{asset($url[1])}}"></p>
        </div>
        @endif
        @endforeach
    <div class="image_grid">
    @foreach ($attachments_urls as $url)
    <div @if (file_exists(public_path($url[1])))
        class="image_box"
        id="{{$i}}"
        @else
        class="character_box_error"
        @endif>
        @if (file_exists(public_path($url[1])))
            <p class="attachment_icon"><img src="{{asset($url[1])}}"></p>
        @else
            <p class="info_button_name">404</p>
        @endif
        <p class="image_name">{{$url[0]}}</p>
    </div>
    @php
    $i++;
    @endphp
    @endforeach
    @endif
</div> 
</div>