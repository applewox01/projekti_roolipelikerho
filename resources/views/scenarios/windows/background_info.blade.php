<div class="window_content">
        @if (empty($scenario->background_info))
            <p class="misc_notif">Lisää taustatiedot skenaarioon admin-paneelin kautta</p>
        @else
            <p class="info_plain_text">
                {!! $scenario->background_info !!}
            </p>
        @endif
</div>
