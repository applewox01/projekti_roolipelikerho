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
    <script src="{{asset('assets/js/windows.js')}}"></script>
    @if (isset($name))
    <title>{{$name}}</title>
    @else
    <title>ID: {{$id}}</title>
    @endif
</head>
<body>
    @if ($errors->has('load_scenario'))
    <div class="display_block">
    <h3 class="no-margin">Ongelma ladatessa skeenarion tietoja:</h3>
    <code>
        {{$errors->first('load_scenario')}}
    </code>
    <a href="{{ route('index') }}"><p class="no-margin"><i class="fa-solid fa-dungeon"></i>Palaa kiltaan</p></a>
    <p class="no-margin">tai</p>
    <a href="{{ route('scenario', ['id' => $id]) }}"><p class="no-margin">Lataa sivu uudelleen</p></a>
</div>
    @else
    <aside id="panel">
            <p class="scenario_name">{{$name}}</p>
        <section id="icons">
            <div class="icon-box" id="characters">
                <h2><i class="fa-solid fa-people-line"></i></h2>
                <p>Pelaajat</p>
            </div>            
            <br>
            <div class="icon-box" id="npcs">
                <h2><i class="fa-solid fa-person"></i></h2>
                <p>NPC:t</p>
            </div>
            <br>
            <div class="icon-box" id="monsters">
                <h2><i class="fa-solid fa-dragon"></i></h2>
                <p>Hirviöt</p>
            </div>
            <br>
            <div class="icon-box" id="description">
                <h2><i class="fa-solid fa-book-open"></i></h2>
                <p>Kuvaus</p>
            </div>
            <br>
            <div class="icon-box" id="background_info">
                <h2><a><i class="fa-solid fa-book"></i></a></h2>
                <p>Taustatiedot</p>
            </div>
            <!--<br>
            <div class="icon-box" id="map">
                <h2><a><i class="fa-solid fa-map-location-dot"></i></a></h2>
                <p>Kartta</a></p>
            </div>-->
            <br>
            <div class="icon-box" id="rooms">
                <h2><a><i class="fa-solid fa-signs-post"></i></h2>
                <p>Paikat</p>
            </div>
            <br>
            <div class="icon-box" id="events">
                <h2><a><i class="fa-solid fa-calendar-days"></i></h2>
                <p>Tapahtumat</p>
            </div>
            <br>
            <div class="icon-box" id="attachments">
                <h2><i class="fa-solid fa-paperclip"></i></h2>
                <p>Liitteet</p>
            </div>
            <br>
            <div class="exit-box">
                <a href="{{route('index')}}">
                    <h2><i class="fa-solid fa-dungeon"></i></h2>
                    <p>Takaisin kiltaan</p>
                </a>
            </div>
        </section>
    </aside>
        <main>

            @php
                $windows = array(["background_info","Taustatiedot"],
                ["characters","Pelaajat"],
                ["npcs","NPC:t"],
                ["monsters","Hirviöt"],
                ["attachments","Liitteet"],
                ["events","Tapahtumat"],
                ["rooms","Paikat"],
                ["description","Kuvaus"])
            @endphp
            @foreach ($windows as $window) 
            <div class="moveable_window" id="{{$window[0]}}_window">
                <div class="window_info">
                    <p class="window_name">{{$window[1]}}</p>
                        <div class="move_window"><i class="fas">&#xf0b2;</i></div>
                        <div class="hide_window"><i class="material-icons">&#xe5ce;</i></div>
                        <div class="close_window"><i class="fa">&#xf00d;</i></div>
                </div>
                    @include("scenarios.windows.".$window[0])
            </div>
            @endforeach

        </main>
        <div id="mobile_version">
            @foreach ($windows as $window) 
            <div>
                <div class="window_info">
                    <p class="window_name">{{$window[1]}}</p>
                </div>
                    @include("scenarios.windows.".$window[0])
            </div>
            @endforeach
            <div class="exit-box-mobile">
                <a href="{{route('index')}}">
                    <h2><i class="fa-solid fa-dungeon"></i></h2>
                    <p>Takaisin kiltaan</p>
                </a>
            </div>
        </div>
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