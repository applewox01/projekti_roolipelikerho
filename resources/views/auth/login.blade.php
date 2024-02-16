<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/auth/app.css') }}">
    <title>Seikkailijoiden kilta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js" defer></script>
</head>
<body>
    <div class="container">
        <form method="post">
            @csrf
            <h1>Kirjaudu</h1>
            <div class="form-group">
                <label for="username">Käyttäjänimi</label>
                <input type="text" name="username" id="username" class="form-control" minlength="3" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="password">Salasana</label>
                <input type="password" name="password" id="password" class="form-control" minlength="8" maxlength="255" required>
            </div>
            <label class="remember" for="remember">
                <input name="remember" id="remember" type="checkbox">
                <span>Pysy kirjautuneena</span>
            </label>
            <div class="form-group">
                <button type="submit" class="btn">Kirjaudu</button>
                <a href="{{ route('register') }}"><button type="button" class="btn">Luo käyttäjä</button></a>
            </div>
        </form>
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
