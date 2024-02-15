<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin/app.css') }}">
    <title>Seikkailijoiden kilta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js" defer></script>
</head>
<body>
    <main>
        <div class="container">
            <aside>
                <nav>
                    <ul>
                        <div class="navigation-buttons">
                            <li><a href="#">
                                <div class="col">
                                    <div>
                                        <i class="fa-solid fa-scroll"></i>
                                    </div>
                                    <div>
                                        <p>Skenaariot</p>
                                    </div>
                                </div>
                            </a></li>
                            <li><a href="#">
                                <div class="col">
                                    <div>
                                        <i class="fa-solid fa-users-gear"></i>
                                    </div>
                                    <div>
                                        <p>Käyttäjät</p>
                                    </div>
                                </div>
                            </a></li>
                            <li><a href="#">
                                <div class="col">
                                    <div>
                                        <i class="fa-solid fa-hat-wizard"></i>
                                    </div>
                                    <div>
                                        <p>Hahmot</p>
                                    </div>
                                </div>
                            </a></li>
                        </div>
                        <li><a href="{{ route('index') }}">
                            <div class="col">
                                <div>
                                    <i class="fa-solid fa-dungeon"></i>
                                </div>
                                <div>
                                    <p>Takaisin<br>Kiltaan</p>
                                </div>
                            </div>
                        </a></li>
                    </ul>
            </aside>
            <div class="content">
                <h1>Uusi Skenaario</h1>
                <div class="content-box">
                    <h1>Perustiedot</h1>
                    <form action="">

                    <div class="form-container">
                        <div class="form-box">
                            <div>
                                <div class="form-group">
                                    <label for="name">Nimi</label>
                                    <input type="text" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="description">Kuvaus</label>
                                    <textarea id="description" name="description" rows="5"></textarea>
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="minlvl">Hahmojen kokemustaso</label>
                                    <div class="row">
                                        <input type="number" id="minlvl" name="minlvl" min="1" value="1">
                                        <span>-</span>
                                        <input type="number" id="maxlvl" name="maxlvl" min="1" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="minlvl">Hahmojen määrä</label>
                                    <div class="row">
                                        <input type="number" id="minplayers" name="minplayers" min="1" value="1">
                                        <span>-</span>
                                        <input type="number" id="maxplayers" name="maxplayers" min="1" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="requirements">Muut vaatimukset</label>
                                    <input type="text" id="requirements" name="requirements">
                                </div>
                            </div>
                        </div>

                        <div class="form-box">
                            <div>
                                <div class="form-group">
                                    <label for="description">Kuvaus pelinjohtajalle</label>
                                    <textarea id="description" name="description" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Taustatiedot</label>
                                    <textarea id="description" name="description" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    </form>
                </div>
            </div>
        </div>
    </main>



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
