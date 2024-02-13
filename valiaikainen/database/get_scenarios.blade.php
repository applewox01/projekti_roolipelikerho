<?php
    use Illuminate\Support\Facades\DB;

    $skenaariot = DB::table('scenarios')->get();
    foreach ($skenaariot as $skenaario) {
        echo '<section class="adventure-box">';
        echo '<h2><a><i class="fa-solid fa-scroll"></i>'.$skenaario->name.'</a></h2>';
        echo '<p class="adventure-stats"> Lvl '.$skenaario->lvl_lowest.'-'.$skenaario->lvl_highest.', '.$skenaario->plr_least.'-'.$skenaario->plr_most.' hahmoa</p>';
        echo '<p class="adventure-desc">'.$skenaario->description.'</p>';
        echo '</section>';
    };
