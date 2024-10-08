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
   <title>{{ $scenario->name }}</title>

   @vite(['resources/js/scenarios/scenario.js', 'resources/js/scenarios/windows.js'])
</head>
<body>
    @if ($errors->has('load_scenario'))
    <div class="error_page">
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
            <p class="scenario_name">{{ $scenario->name }}</p>
        <section id="icons">
            <div class="icon-box" id="description">
                <h2><i class="fa-solid fa-book-open"></i></h2>
                <p>kuvaus</p>
            </div>
            <div class="icon-box" id="characters">
                <h2><i class="fa-solid fa-people-line"></i></h2>
                <p>Pelaajat</p>
            </div>
            <div class="icon-box" id="npcs">
                <h2><i class="fa-solid fa-person"></i></h2>
                <p>NPC:t</p>
            </div>
            <div class="icon-box" id="monsters">
                <h2><i class="fa-solid fa-dragon"></i></h2>
                <p>Hirviöt</p>
            </div>
            <div class="icon-box" id="admin_desc">
                <h2><i class="fa-solid fa-book-open"></i></h2>
                <p>Ylläpidon kuvaus</p>
            </div>
            <div class="icon-box" id="background_info">
                <h2><a><i class="fa-solid fa-book"></i></a></h2>
                <p>Taustatiedot</p>
            </div>
            <!--<br>
            <div class="icon-box" id="map">
                <h2><a><i class="fa-solid fa-map-location-dot"></i></a></h2>
                <p>Kartta</a></p>
            </div>-->
            <div class="icon-box" id="rooms">
                <h2><i class="fa-solid fa-signs-post"></i></h2>
                <p>Paikat</p>
            </div>
            <div class="icon-box" id="events">
                <h2><i class="fa-solid fa-calendar-days"></i></h2>
                <p>Tapahtumat</p>
            </div>
            <div class="icon-box" id="attachments">
                <h2><i class="fa-solid fa-paperclip"></i></h2>
                <p>Liitteet</p>
            </div>
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
            $windows = array(
                ["description","Kuvaus"],
                ["background_info","Taustatiedot"],
                ["characters","Pelaajat"],
                ["npcs","NPC:t"],
                ["monsters","Hirviöt"],
                ["attachments","Liitteet"],
                ["events","Tapahtumat"],
                ["rooms","Paikat"],
                ["admin_desc","Ylläpidon kuvaus"]
            );
            @endphp
            @foreach ($windows as $window)
            <div class="moveable_window" id="{{$window[0]}}_window">
                <div class="window_info">
                    <p class="move_window">{{$window[1]}}</p>
                        <div class="hide_window"><i class="material-icons">&#xe5ce;</i></div>
                        <div class="close_window"><i class="fa">&#xf00d;</i></div>
                </div>
                    @include("scenarios.windows.".$window[0])
            </div>
            @endforeach

        </main>
        <div id="mobile_version">
            @php
                array_splice($windows, 4, 1);
            @endphp
            @foreach ($windows as $window)
            <div class="mobile_window">
                <div class="window_info">
                    <p class="window_name">{{$window[1]}}</p>
                </div>
                    @include("scenarios.windows.".$window[0])
            </div>
            @endforeach
            <div id="exit-box-mobile">
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
