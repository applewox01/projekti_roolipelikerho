<div class="window_content">
        @if (is_null($scenario->admin_desc))
            <p class="misc_notif">Lisää kuvaus skenaarioon admin-paneelin kautta</p>
        @else
        <div class="long_text_format">
            {!! $scenario->admin_desc !!}
        </div>
        @endif
</div>
