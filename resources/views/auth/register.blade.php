<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/auth/app.css') }}">
    <title>Seikkailijoiden kilta</title>
</head>
<body>
    <div class="container">
        <form method="post">
            @csrf
            <h1>Rekisteröidy</h1>
            <div class="form-group">
                <label for="username">Käyttäjänimi</label>
                <input type="text" name="username" id="username" class="form-control" minlength="3" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="email">Sähköposti</label>
                <input type="email" name="email" id="email" class="form-control" maxlength="100" required>
            </div>
            <div class="form-group">
                <label for="password">Salasana</label>
                <input type="password" name="password" id="password" class="form-control" minlength="8" maxlength="255" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Vahvista salasana</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" minlength="8" maxlength="255" required>
            </div>
            <div class="form-group">
                <label for="invite">Kutsu koodi</label>
                <input type="password" name="invite" id="invite" class="form-control" maxlength="35" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Rekisteröidy</button>
            </div>
        </form>
    </div>
</body>
</html>
