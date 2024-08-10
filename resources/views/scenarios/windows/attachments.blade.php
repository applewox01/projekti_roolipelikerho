<div class="window_content">
    @php
        $i = 0;
        $attachments_urls = [];

        foreach ($attachments as $attachment) {
            $json_data = json_decode($attachment->data, true);
            foreach ($json_data as $attachmentGroup) {
                foreach ($attachmentGroup['attachments'] as $attachmentItem) {
                    $attachments_urls[] = [
                        'name' => $attachmentGroup['name'],
                        'filename' => $attachmentItem['filename'],
                        'path' => Storage::disk('public')->url($attachmentItem['path']),
                        'exists' => Storage::disk('public')->exists($attachmentItem['path'])
                    ];
                }
            }
        }
    @endphp

    @if (empty($attachments_urls))
        <p class="misc_notif">Lisää liitteitä skenaarioon admin-paneelin kautta</p>
    @else
        @foreach ($attachments_urls as $url)
            @if ($url['exists'])
                <div id="full_{{$i}}" class="full_image">
                    <div class="full_image_info">
                        <p>{{ $url['name'] }}</p>
                    </div>
                    <div class="full_image_icon">
                        <img src="{{ $url['path'] }}">
                    </div>
                </div>
            @endif
            @php
                $i++;
            @endphp
        @endforeach
    @endif
</div>
