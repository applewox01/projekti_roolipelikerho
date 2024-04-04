<div class="window_content">
    @if (count($attachments_urls) == 0)
    <p class="misc_notif">Liitä liitteitä skenaarioon admin-paneelin kautta</p>
    @else
    @php
    @endphp
    @foreach ($attachments_urls as $url)
    <div @if (file_exists(public_path($url)))
        class="character_box"
        @else
        class="character_box_error"
        @endif>
        @if (file_exists(public_path($url)))
            <p><img src="{{asset($url)}}" class="attachment_icon"></p>
        @else
            <p class="info_button_name">404 ({{$url}})</p>
        @endif
    <div class="character_info" >
        @if (file_exists(public_path($url)))
            <p><img src="{{asset($url)}}"></p>
        @else
            <div class="white_icon_tfpx"><i class="material-icons">attach_file</i></div>
            <!--<img class="placeholder_for_404" src="{{--asset("assets/css/scenarios/textures/placeholder404.PNG")--}}">-->
        @endif
    </div>

    </div>
    @endforeach
    @endif 
</div>