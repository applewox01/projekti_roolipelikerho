<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/scenarios/scenario-window.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="{{asset('assets/js/scenario.js')}}"></script>
    @if (isset($name))
    <title>{{$name}}</title>
    @else
    <title>ID: {{$id}}</title>
    @endif
</head>
<body>
    @if ($errors->has('load_scenario'))
    <div style="display: block;">
    <h3 style="margin: 0;">Ongelma ladatessa skeenarion tietoja:</h3>
    <code style="background-color: white;">
        {{$errors->first('load_scenario')}}
    </code>
    <a href="{{ route('index') }}"><p style="margin: 0;"><i class="fa-solid fa-dungeon"></i>Palaa kiltaan</p></a>
    <p style="margin: 0;">tai</p>
    <a href="{{ route('scenario', ['id' => $id]) }}"><p style="margin: 0;">Lataa sivu uudelleen</p></a>
</div>
    @else
    <aside id="panel">
            <p style="text-align: center">{{$name}}</p>
        <section id="icons">
            <div class="icon-box" id="pelaajat">
                <h2><i class="fa-solid fa-people-line"></i></h2>
                <p>Pelaajat</p>
            </div>            
            <br>
            <div class="icon-box" id="npc">
                <h2><i class="fa-solid fa-person"></i></h2>
                <p>NPC:t</p>
            </div>
            <br>
            <div class="icon-box" id="hirviot">
                <h2><i class="fa-solid fa-dragon"></i></h2>
                <p>Hirviöt</p>
            </div>
            <br>
            <div class="icon-box" id="kuvaus">
                <h2><i class="fa-solid fa-book-open"></i></h2>
                <p>Kuvaus</p>
            </div>
            <br>
            <div class="icon-box" id="taustatiedot">
                <h2><a><i class="fa-solid fa-book"></i></a></h2>
                <p>Taustatiedot</p>
            </div>
            <br>
            <div class="icon-box" id="kartta">
                <h2><a><i class="fa-solid fa-map-location-dot"></i></a></h2>
                <p>Kartta</a></p>
            </div>
            <br>
            <div class="icon-box" id="paikat">
                <h2><a><i class="fa-solid fa-signs-post"></i></h2>
                <p>Paikat</p>
            </div>
            <br>
            <div class="icon-box" id="tapahtumat">
                <h2><a><i class="fa-solid fa-calendar-days"></i></h2>
                <p>Tapahtumat</p>
            </div>
            <br>
            <div class="icon-box" id="liitteet">
                <h2><i class="fa-solid fa-paperclip"></i></h2>
                <p>Liitteet</p>
            </div>
            <br>
            <div class="icon-box">
                <a href="{{route('index')}}" style="color: black; text-decoration: none;">
                    <h2><i class="fa-solid fa-dungeon"></i></h2>
                    <p>Takaisin kiltaan</p>
                </a>
            </div>
        </section>
    </aside>
        <main>


            <div class="moveable_window" id="taustatiedot_window" style="display: none;">
                <div class="window_info">
                    <p class="window_name">Taustatiedot</p>
                        <div class="move_window"><i style="font-size: 30px; text-align: center;" class="fas">&#xf0b2;</i></div>
                        <div class="hide_window"><i style="font-size: 30px; text-align: center;" class="material-icons">&#xe5ce;</i></div>
                        <div class="close_window"><i style="font-size: 30px; text-align: center;" class="fa">&#xf00d;</i></div>
                </div>
                    @include("scenarios.windows.background_info")
            </div>

        </main>
        @endif
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script>
            const notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top',
                },
            });
            @if($errors->any())
                notyf.error({
                    message: '{{ $errors->first() }}',
                    dismissible: true
                })
            @endif
            @if(session('success'))
                notyf.success({
                    message: '{{ session('success') }}',
                    dismissible: true
                })
            @endif
        </script>
</body>
</html>