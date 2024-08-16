<div class="window_content">
    @if (is_null($scenario->description))
        <p class="misc_notif">Lisää kuvaus skenaarioon admin-paneelin kautta</p>
    @else
    <div class="long_text_format">
        {!! $scenario->description !!}
    </div>
    @endif
</div>
