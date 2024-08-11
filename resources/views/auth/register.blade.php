<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <title>Seikkailijoiden kilta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js" defer></script>

    @vite(['resources/css/app.css'])
</head>
<body class="antialiased bg-black w-full">
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
    <div class="flex flex-col w-screen h-screen items-center justify-center p-4">
        <div class="flex flex-col items-center justify-center h-full w-full max-w-[500px]">
            <form class="flex flex-col gap-3 w-full bg-zinc-950 border-2 border-zinc-900 rounded-lg p-4 m-3 box-border" method="POST">
                <h1 class="text-white text-2xl text-center font-semibold">Rekisteröidy</h1>
                @csrf
                <div class="flex flex-col text-gray-300 text-base px-3">
                    <label class="text-sm font-medium mb-2" for="username">Käyttäjänimi</label>
                    <input class="bg-zinc-800 p-2 rounded-md border border-gray-500/60" type="text" id="username" name="username" minlength="3" maxlength="30" value="{{ old('username') }}" required>
                    @if ($errors->has('username')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="flex flex-col text-gray-300 text-base px-3">
                    <label class="text-sm font-medium mb-2" for="email">Sähköposti</label>
                    <input class="bg-zinc-800 p-2 rounded-md border border-gray-500/60" type="email" id="email" name="email" maxlength="255" value="{{ old('email') }}">
                    @if ($errors->has('email')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="flex flex-col text-gray-300 text-base px-3">
                    <label class="text-sm font-medium mb-2" for="password">Salasana</label>
                    <input class="bg-zinc-800 p-2 rounded-md border border-gray-500/60" type="password" id="password" name="password" minlength="8" maxlength="255" required>
                    @if ($errors->has('password')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="flex flex-col text-gray-300 text-base px-3">
                    <label class="text-sm font-medium mb-2" for="password_confirmation">Vahvista salasana</label>
                    <input class="bg-zinc-800 p-2 rounded-md border border-gray-500/60" type="password" id="password_confirmation" name="password_confirmation" minlength="8" maxlength="255" required>
                    @if ($errors->has('password_confirmation')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="flex flex-col text-gray-300 text-base px-3">
                    <label class="text-sm font-medium mb-2" for="invite">Kutsu koodi</label>
                    <input class="bg-zinc-800 p-2 rounded-md border border-gray-500/60" type="text" id="invite" name="invite" maxlength="35" value="{{ old('invite') }}" required>
                    @if ($errors->has('invite')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('invite') }}</span>
                    @endif
                </div>
                <div class="flex flex-col text-white text-base px-3 mb-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded-md mt-3 ring-2 ring-blue-400">Rekisteröidy</button>
                    <div class="flex items-center justify-between gap-2 mt-3">
                        <div class="h-[1px] w-full bg-gradient-to-r from-gray-700 to-gray-500"></div>
                        <div class="flex-shrink-0">
                            <p class="text-xs text-gray-300">TAI</p>
                        </div>
                        <div class="h-[1px] w-full bg-gradient-to-r from-gray-500 to-gray-700"></div>
                    </div>
                    <div class="flex justify-center items-center gap-2 mt-2 flex-wrap">
                        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Kirjaudu</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="module">
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
    </script>
</body>
</html>
