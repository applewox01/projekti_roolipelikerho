<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin='anonymous'></script>
    <title>Seikkailijoiden kilta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/index/app.js', 'resources/js/lib/aos.js'])
</head>
<body class="antialiased bg-black raleway-font">
    <div>
        <div
            class="hidden lg:flex absolute top-0 left-0 w-36 h-36 blur-[140px] bg-gradient-to-r from-blue-600 to-blue-300 rounded-3xl z-[-1]">
        </div>
        <div
            class="hidden lg:flex absolute top-96 right-0 w-48 h-48 blur-[180px] bg-gradient-to-r from-blue-500 to-blue-400 rounded-3xl z-[-1]">
        </div>
        <div
            class="hidden lg:flex absolute bottom-0 left-32 w-48 h-48 blur-[180px] bg-gradient-to-r from-blue-800 to-blue-500 rounded-3xl z-[-1]">
        </div>
    </div>
    <header class="flex flex-col md:flex-row  justify-center md:justify-between items-center p-4 border-b relative bg-black/10 backdrop-blur-md w-full border-gray-400/20">
        <div class="hidden items-center ml-4 md:flex ">
            <a href="{{ route('index') }}" class="text-3xl md:text-4xl brand"><i class="fa-brands fa-d-and-d"></i></a>
        </div>
        <h1 class="text-lg md:text-xl text-gray-300 font-bold md:absolute md:left-1/2 md:transform md:-translate-x-1/2 md:mb-0 px-4 md:px-0">
            Seikkailijoiden kilta
        </h1>
        <div class="flex items-center text-gray-300 gap-3">
            @auth
            <div class="flex items-center gap-3">
                <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-sm md:text-base font-medium hover:text-white transition-all duration-300">
                    Hallintapaneeli
                </a>
                <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
                <a id="logout" class="text-sm md:text-base font-medium hover:text-white hover:cursor-pointer transition-all duration-300">
                    Kirjaudu ulos
                </a>
            </div>
            @endauth

            @guest
            <div class="flex items-center">
                <a class="text-sm md:text-base font-medium hover:text-white hover:cursor-pointer transition-all duration-300" href="{{ route('login') }}">
                    Kirjaudu
                </a>
            </div>
            @endguest
        </div>
    </header>
    <section class="flex flex-col my-9 mx-2 md:mx-10" data-aos="fade-up" data-aos-duration="800">
        @if ($errors->has('get_scenarios'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <p class="flex items-center">
                    <i class='fas fa-exclamation-triangle mr-2'></i>
                    <span>Ongelma skenaarioiden haussa:</span>
                </p>
                <code class="block bg-red-200 text-red-800 p-2 rounded mt-2">
                    {{$errors->first('get_scenarios')}}
                </code>
            </div>
        @else
            <form method="POST" action="{{ route('index') }}" id="sort_form" class="mb-6">
                @csrf
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <input id="search" type="search" placeholder="Hae" name="search" value="{{ $search_by }}" class="w-full md:w-1/3 px-4 py-2 border border-gray-300 bg-transparent text-white rounded focus:outline-none focus:border-indigo-500">

                    <select class="w-full md:w-1/3 px-4 py-2 border border-gray-300 bg-transparent text-white rounded focus:outline-none focus:border-indigo-500" name="jarjestys" id="jarjestys">
                        <option class="text-black" value="az" {{ $order_by == 'az' ? 'selected' : '' }}>A-Z</option>
                        <option class="text-black" value="za" {{ $order_by == 'za' ? 'selected' : '' }}>Z-A</option>
                        <option class="text-black" value="lvl" {{ $order_by == 'lvl' ? 'selected' : '' }}>LVL</option>
                        <option class="text-black" value="plrcount" {{ $order_by == 'plrcount' ? 'selected' : '' }}>Pelaajien määrä</option>
                    </select>

                    <select class="w-full md:w-1/3 px-4 py-2 border border-gray-300 bg-transparent text-white rounded focus:outline-none focus:border-indigo-500" name="maailma" id="maailma">
                        <option class="text-black" value="">Maailma</option>
                        @foreach ($worlds as $world)
                            <option class="text-black" value="{{ $world->id }}" {{ $filter_world == $world->id ? 'selected' : '' }}>{{ $world->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            @if ($scenarios->count() == 0)
                <div class="bg-transparent border border-indigo-500 text-white px-4 py-3 rounded mb-4">
                    <p class="flex items-center">
                        <i class='fas fa-info-circle mr-2 text-indigo-500'></i>
                        <span>Skenaarioita ei löydetty</span>
                    </p>
                </div>
            @else
                @if ($search_by != "")
                    <p class="text-gray-300 mb-4">Tulokset, jotka sisältävät '{{ $search_by }}':</p>
                @endif
            @endif

            <main id="adventure-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if ($scenarios->count() != 0)
                    @foreach ($scenarios as $scenario)
                        <section class="border border-gray-300 hover:border-indigo-500 rounded-lg p-4 bg-black/10 backdrop-blur-md transition-all duration-200 ease-in">
                            <a href="{{ route('scenario', ['id' => $scenario->id]) }}">
                                <h2 class="text-xl font-bold mb-2 flex text-white items-center"><i class="fa-solid fa-scroll mr-2"></i>{{ $scenario->name }}</h2>
                                <p class="text-white mb-2">Lvl {{ $scenario->lvl_lowest ?? '??' }}-{{ $scenario->lvl_highest ?? '??' }}, {{ $scenario->plr_least ?? '??' }}-{{ $scenario->plr_most ?? '??' }} pelaajaa</p>
                                <div class="text-gray-300 mb-4">
                                    <p class="text-white mb-2">Muut vaatimukset:</p>
                                    {!! Str::words(strip_tags($scenario->other_requirements), 30, '...') !!}
                                </div>
                                <div class="text-gray-300">
                                    <p class="text-white mb-2">Kuvaus:</p>
                                    {!! Str::words(strip_tags($scenario->description), 30, '...') !!}
                                </div>
                            </a>
                        </section>
                    @endforeach
                @endif
            </main>
        @endif
    </section>
</body>
</html>
