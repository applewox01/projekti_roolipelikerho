<div class="window_content">
        @if (is_null($background_info))
            <p class="misc_notif">Lisää taustatiedot skenaarioon admin-paneelin kautta</p>
        @else
            <p class="info_plain_text">
            {{$background_info}}
            </p>
        @endif
</div>