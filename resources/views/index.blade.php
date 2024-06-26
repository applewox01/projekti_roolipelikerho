<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin='anonymous'></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">
	<script src="{{ asset('assets/js/index.js') }}"></script>
    <title>Seikkailijoiden kilta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
<body>
    <div id="container">
		<header id="page-header">
			<h1><i class="fa-brands fa-d-and-d"></i>
				<a class="guild-link">Seikkailijoiden kilta</a></h1>
            @if (Auth::check())
			<div class="list_after_login">
            <p class="login-link">
				<a href="{{ route('filament.admin.pages.dashboard') }}">
					<i class="fa-solid fa-shield-halved"></i>
				Hallintapaneeli
			</a>
			</p>
			<p class="login-link" >
				<a href="{{ route('logout') }}">
				<i class='fas'>&#xf52b;</i> Kirjaudu ulos
				</a>
			</p>
			</div>
            @else
            <a class="login-link" href="{{ route('login') }}">
				Kirjaudu <i class="fa-solid fa-dungeon"></i>
			</a>
            @endif
		</header>

			<br>
			@if ($errors->has('get_scenarios'))
			<p class="tf_px_icon"><i class='fas fa-exclamation-triangle'></i></p>
			<p>Ongelma skenaarioiden haussa:</p>
			<code>
				{{$errors->first('get_scenarios')}}
			</code>
			@else
			<form method="POST" action="{{ route('index') }}" id="sort_form">
				@csrf
				<input id="search" type="search" placeholder="Hae" name="search" value="{{$search_by}}">
				<script>
					document.addEventListener("DOMContentLoaded", function(){
						document.getElementById("jarjestys").value = '{{$order_by}}';
						document.getElementById("maailma").value = '{{$filter_world}}';
					});
				</script>
				<select class="dropdown" name="jarjestys" id="jarjestys">
				<option value="az">A-Z</option>
				<option value="lvl">LVL</option>
				<option value="plrcount">Pelaajien määrä</option>
				</select>
				<select class="dropdown" name="maailma" id="maailma">
					<option value="">Maailma</option>
					@foreach ($worlds as $world)
					<option value="{{$world->id}}">{{$world->name}}</option>
					@endforeach
					</select>
			</form>

			@if ($scenarios->count() == 0)
			<p class="tf_px_icon"><i class='fas'>&#xf49e;</i></p>
			<p>Skenaarioita ei löydetty</p>
			@else
			@if ($search_by != "")
			<p>Tulokset, jotka sisältävät '{{$search_by}}':</p>
			@endif
			@endif
		<main id="adventure-list">
			@if ($scenarios->count() != 0)
			@foreach ($scenarios as $scenario)
			<section class="adventure-box">
				<a href="{{ route('scenario', ['id' => $scenario->id]) }}">
				<h2><i class="fa-solid fa-scroll"></i>{{$scenario->name}}</h2>
				<p class="adventure-stats">Lvl {{$scenario->lvl_lowest ?? '??'}}-{{$scenario->lvl_highest ?? '??'}}, {{$scenario->plr_least ?? '??'}}-{{$scenario->plr_most ?? '??'}} pelaajaa</p>
				<p class="scenario_req">{{$scenario->other_requirements}}</p>
				<p class="adventure-desc">{{ $scenario->description ?? '...' }}</p>
				<p class="world_info">{{ $scenario->world ?? 'Määrittelemätön maailma' }}</p>
			</a>
			</section>
			@endforeach

			@endif

		</main>
		@endif
	</div>
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
