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

                        <div class="form-box">
                            <div>
                                <div class="form-group">
                                    <label for="npcName">NPC Nimi</label>
                                    <input type="text" id="npcName" name="npcName">
                                </div>
                                <div class="form-group">
                                    <label for="npcDescription">Kuvaus</label>
                                    <textarea id="npcDescription" name="npcDescription" rows="5"></textarea>
                                </div>
                                <button class="btn" type="button">Poista <i class="fa-solid fa-trash"></i></button>
                                <button class="btn" type="button">Uusi Hirviö</button>
                            </div>
                        </div>

                        <div class="form-box">
                            <div>
                                <div class="form-group">
                                    <label for="mnstrName">Hirviö Nimi</label>
                                    <input type="text" id="mnstrName" name="mnstrName">
                                </div>
                                <div class="form-group">
                                    <label for="mnstrCombat">Taistelutiedot</label>
                                    <textarea id="mnstrCombat" name="mnstrCombat" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="mnstrExtraDetails">Lisätiedot</label>
                                    <textarea id="mnstrExtraDetails" name="mnstrExtraDetails" rows="5"></textarea>
                                </div>
                                <button class="btn" type="button">Poista <i class="fa-solid fa-trash"></i></button>
                                <button class="btn" type="button">Uusi NPC</button>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="mnstrDefense">Puolustus</label>
                                    <input type="text" id="mnstrDefense" name="mnstrDefense">
                                </div>
                                <div class="form-group">
                                    <label for="mnstrHitPoints">Osumapisteet</label>
                                    <input type="text" id="mnstrHitPoints" name="mnstrHitPoints">
                                </div>
                                <div class="form-group">
                                    <label for="mnstrXP">XP</label>
                                    <input type="text" id="mnstrXP" name="mnstrXP">
                                </div>
                                <div class="form-group">
                                    <label for="mnstrLink">Linkki</label>
                                    <input type="text" id="mnstrLink" name="mnstrLink">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-box">
                            <div>
                                <div class="form-group">
                                    <label for="locationName">Paikan Nimi</label>
                                    <input type="text" id="locationName" name="locationName">
                                </div>
                                <div class="form-group">
                                    <label for="locationDescription">Kuvaus</label>
                                    <textarea id="locationDescription" name="locationDescription" rows="5"></textarea>
                                </div>
                                <button class="btn" type="button">Poista <i class="fa-solid fa-trash"></i></button>
                                <button class="btn" type="button">Uusi Paikka</button>
                            </div>
                        </div>

                        <div class="form-box">
                            <div>
                                <div class="form-group">
                                    <label for="eventName">Tapahtuman Nimi</label>
                                    <input type="text" id="eventName" name="eventName">
                                </div>
                                <div class="form-group">
                                    <label for="eventDescription">Kuvaus</label>
                                    <textarea id="eventDescription" name="eventDescription" rows="5"></textarea>
                                </div>
                                <button class="btn" type="button">Poista <i class="fa-solid fa-trash"></i></button>
                                <button class="btn" type="button">Uusi Tapahtuma</button>
                            </div>
                        </div>
                        
                        <div class="form-box">
                            <div>
                                <div class="form-group">
                                    <label for="fileName">Liitteen Nimi</label>
                                    <input type="text" id="fileName" name="fileName">
                                </div>
                                <div class="file-input">
                                    <input type="file" name="file-input" id="file-input" class="file-input__input" />
                                    <label class="file-input__label" for="file-input">
                                        <div class="input-icon">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                    </label>
                                </div>
                                    <button class="btn" type="button">Poista <i class="fa-solid fa-trash"></i></button>
                                    <button class="btn" type="button">Uusi Liite</button>
                                </div>
                                </div>
                        </div>

                    </div>

                    <div>
                        <button class="btn" type="submit">Luo Skenaario</button>
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
