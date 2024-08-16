<div class="window_content">
        @if (empty($scenario->background_info))
            <p class="misc_notif">Lisää taustatiedot skenaarioon admin-paneelin kautta</p>
        @else
        <div class="long_text_format">
                {!! $scenario->background_info !!}
                </div>
        @endif
</div>
