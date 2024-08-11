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
                <h1 class="text-white text-2xl text-center font-semibold">Tervetuloa takaisin!</h1>
                @csrf
                <div class="flex flex-col text-gray-300 text-base px-3">
                    <label class="text-sm font-medium mb-2" for="username">Käyttäjänimi</label>
                    <input class="bg-zinc-800 p-2 rounded-md border border-gray-500/60" type="text" id="username" name="username" minlength="3" maxlength="45" value="{{ old('username') }}" required>
                    @if ($errors->has('username')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="flex flex-col text-gray-300 text-base px-3">
                    <label class="text-sm font-medium mb-2" for="password">Salasana</label>
                    <input class="bg-zinc-800 p-2 rounded-md border border-gray-500/60" type="password" id="password" name="password" minlength="8" maxlength="255" required>
                    @if ($errors->has('password')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="flex flex-col text-white text-base px-3 mb-2">
                    <div class="inline-flex items-center">
                        <label class="relative flex items-center rounded-full cursor-pointer" htmlFor="remember">
                            <input
                                type="checkbox"
                                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-500/60 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-500 before:opacity-0 before:transition-opacity checked:border-blue-900 checked:bg-blue-900 checked:before:bg-blue-900"
                                id="remember"
                                name="remember"
                                />
                            <span
                              class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                              <x-heroicon-o-check class="h-3.5 w-3.5" stroke="currentColor" />
                            </span>
                          </label>

                        <label class="ms-2 text-sm font-medium text-gray-300" for="remember">Muista minut</label>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded-md mt-3 ring-2 ring-blue-400">Login</button>
                    <div class="flex items-center justify-between gap-2 mt-3">
                        <div class="h-[1px] w-full bg-gradient-to-r from-gray-700 to-gray-500"></div>
                        <div class="flex-shrink-0">
                            <p class="text-xs text-gray-300">TAI</p>
                        </div>
                        <div class="h-[1px] w-full bg-gradient-to-r from-gray-500 to-gray-700"></div>
                    </div>
                    <div class="flex justify-center items-center gap-2 mt-2 flex-wrap">
                        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 text-center">Luo käyttäjä</a>
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
        @if(session('success'))
            notyf.success({
                message: '{{ session('success') }}',
                dismissible: true
            })
        @endif
    </script>
</body>
</html>
