<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index/app.css') }}">
	<script src="{{ asset('assets/js/index.js') }}"></script>
    <title>Seikkailijoiden kilta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
<body>
    <div id="container">
		<header id="page-header">
			<a class="guild-link">Seikkailijoiden kilta</a>
            @if (Auth::check())
            <a class="login-link" href="{{ route('dashboard') }}">
				Hallintapaneeli <i class="fa-solid fa-shield-halved"></i>
			</a>
            @else
            <a class="login-link" href="{{ route('login') }}">
				Kirjaudu <i class="fa-solid fa-dungeon"></i>
			</a>
            @endif
		</header>

			<br>
			@auth
			@if ($errors->has('get_scenarios'))
			<p>Ongelma skenaarioiden haussa: {{$errors->first('get_scenarios')}}</p>
			@else
			<form method="POST" action="{{ route('index') }}" id="sort_form">
				@csrf
				<input id="search" type="search" placeholder="Hae" name="search" value="{{$search_by}}">
				<script>
					document.addEventListener("DOMContentLoaded", function(){
						document.getElementById("dropdown").value = "{{$order_by}}";
					});
				</script>
				<select id="dropdown" name="jarjestys">
				<option value="">Järjestä</option>
				<option value="name">A-Z</option>
				<option value="lvl_lowest">Vaikeustaso</option>
				<option value="plr_least">Pelaajien määrä</option>
				</select>
			</form>

		    <br>
		<main id="adventure-list">

			@if ($scenarios->count() == 0)
			<p>Skenaarioita ei löydetty</p>
			@else
			@foreach ($scenarios as $scenario)
			<section class="adventure-box">
				{{--<a href="{{ route('scenario?id='.$scenario->id.'') }}">--}}
				<h2><a><i class="fa-solid fa-scroll"></i>{{$scenario->name}}</a></h2>
				<p class="adventure-stats">Lvl {{$scenario->lvl_lowest}}-{{$scenario->lvl_highest}}, {{$scenario->plr_least}}-{{$scenario->plr_most}} hahmoa</p>
				<p class="adventure-desc">{{$scenario->description}}</p>
				{{--</a>--}}
			</section>	
			@endforeach

			@endif

		</main>
		@endif
		@endauth
		@guest
		<p>Kirjaudu sisään nähdäksesi skenaariosi</p>
		@endguest
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
