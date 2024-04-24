<div class="window_content">
    @php
        $i = 0;
        $attachments_urls = [];

        foreach ($attachments as $attachment) {
            $json_data = $attachment->data;
            foreach ($json_data as $attachment_data) {
                $attachments_urls[] = [$attachment_data, Storage::disk('local')->url($attachment_data)];
            }
        }
    @endphp

    @if (empty($attachments_urls))
        <p class="misc_notif">Liitä liitteitä skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($attachments_urls as $url)
            @if (Storage::disk('local')->exists($url[0]))
                <div id="full_{{$i}}" class="full_image">
                    <div class="full_image_info">
                        <div class="close_image"><i class="fa">&#xf00d;</i></div>
                        <p>{{ $url[0] }}</p>
                    </div>
                    <p class="full_image_icon"><img src="{{ $url[1] }}"></p>
                </div>
            @endif
            @php
                $i++;
            @endphp
        @endforeach

        <div class="image_grid">
            @foreach ($attachments_urls as $url)
                <div @if (Storage::disk('local')->exists($url[0]))
                    class="image_box" id="{{$i}}"
                    @else
                    class="image_box_error"
                    @endif>
                    @if (Storage::disk('local')->exists($url[0]))
                        <p class="attachment_icon"><img src="{{ $url[1] }}"></p>
                    @else
                        <p class="image_error_icon"><i class="fas fa-file"></i></p>
                    @endif
                    <p class="image_name">{{ $url[0] }}</p>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    @endif
</div>
