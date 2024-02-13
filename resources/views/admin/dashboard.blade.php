<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index/app.css') }}">
    <title>Seikkailijoiden kilta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js" defer></script>
</head>
<body>



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
