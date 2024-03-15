<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/scenarios/scenario-window.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('assets/js/drag_windows.js')}}"></script>
    <title>Skenaario</title>
</head>
<body>
    <aside id="panel">
        <header id="scenario-name">
            <a>Skenaarion nimi</a>
        </header>
        <br>
        <section id="icons">
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-people-line"></i></a></h2>
                <p><a>Pelaajat</a></p>
            </div>            
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-person"></i></a></h2>
                <p><a>NPC:t</a></p>
            </div>
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-dragon"></i></a></h2>
                <p><a>Hirviöt</a></p>
            </div>
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-book-open"></i></a></h2>
                <p><a>Kuvaus</a></p>
            </div>
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-book"></i></a></h2>
                <p><a>Tausta-
                    tiedot</a></p>
            </div>
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-map-location-dot"></i></a></h2>
                <p><a>Kartta</a></p>
            </div>
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-signs-post"></i></a></h2>
                <p><a>Paikat</a></p>
            </div>
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-calendar-days"></i></a></h2>
                <p><a>Tapah-
                    tumat</a></p>
            </div>
            <br>
            <div class="icon-box">
                <h2><a><i class="fa-solid fa-paperclip"></i></a></h2>
                <p><a>Liitteet</a></p>
            </div>
            <br>
            <div class="icon-box">
                <a href="{{route('index')}}">
                    <h2><i class="fa-solid fa-dungeon"></i></h2>
                    <p>Takaisin kiltaan</p>
                </a>
            </div>
        </section>
    </aside>
        <main>

            <div class="moveable_window">
                <div class="window_info">
                    <p class="window_name">Esimerkki</p>
                        <div class="move_window"><i style="font-size: 30px; text-align: center;" class="fas">&#xf0b2;</i></div>
                        <div class="hide_window"><i style="font-size: 30px; text-align: center;" class="material-icons">&#xe5ce;</i></div>
                        <div class="close_window"><i style="font-size: 30px; text-align: center;" class="fa">&#xf00d;</i></div>
                </div>
                <div class="window_content" style="width: 200px; height: 100px;">
                    <p>Hello world</p>
                </div>
            </div>

        </main>
</body>
</html>