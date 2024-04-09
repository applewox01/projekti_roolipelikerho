<div class="window_content">
    @if (count($attachments_urls) == 0)
    <p class="misc_notif">Liitä liitteitä skenaarioon admin-paneelin kautta</p>
    @else
    @php
    $i = 0;
    @endphp
        @foreach ($attachments_urls as $url)
        @if (file_exists(public_path($url)))
        <div  id="full_{{$i}}" class="full_image">
            <div class="full_image_info">
                <div class="close_image"><i class="fa">&#xf00d;</i></div>
                <p>{{$url}}</p>
            </div>
            <p style="margin: 0;"><img style="height: 100%; width: 100%;" src="{{asset($url)}}"></p>
        </div>
        @endif
        @endforeach
    <div class="image_grid">
    @foreach ($attachments_urls as $url)
    <div @if (file_exists(public_path($url)))
        class="image_box"
        id="{{$i}}"
        @else
        class="character_box_error"
        @endif>
        @if (file_exists(public_path($url)))
            <p><img src="{{asset($url)}}" class="attachment_icon"></p>
        @else
            <p class="info_button_name">404 ({{$url}})</p>
        @endif
    </div>
    @php
    $i++;
    @endphp
    @endforeach
    @endif
</div> 
</div>