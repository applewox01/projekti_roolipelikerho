<div class="window_content">
        @if (is_null($admin_desc))
            <p class="misc_notif">Lisää kuvaus skenaarioon admin-paneelin kautta</p>
        @else
        <p class="info_plain_text">
            {{$admin_desc}}
        </p>
        @endif
</div>