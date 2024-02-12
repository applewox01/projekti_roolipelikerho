<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/df37ec336e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index/app.css') }}">
    <title>Seikkailijoiden kilta</title>
</head>
<body>
    <div id="container">
		<header id="page-header">
			<a class="guild-link">Seikkailijoiden kilta</a>
			<a class="login-link" href="#">
				Kirjaudu <i class="fa-solid fa-dungeon"></i>
			</a>
		</header>

			<br>

			<h3>
				<a><input id="search" type="search" placeholder="Hae">
				<select id="dropdown">
				<option>Järjestä</option>
				<option value="alphabetically">A-Z</option>
				<option value="name">Nimi</option>
				<option value="difficulty">Vaikeustaso</option>
				<option value="players">Pelaajien määrä</option>
				</select></a>
			</h3>

		    <br>

		<main id="adventure-list">

			<section class="adventure-box">
				<h2><a><i class="fa-solid fa-scroll"></i> Hylätty kääpiötemppeli</a></h2>
				<p class="adventure-stats">Lvl 1-2, 3-6 hahmoa</p>
				<p class="adventure-desc">Tapasitte muutama päivä sitten vanhan tuttavanne yhdessä kaupungin tavernoista, ja koska hän oli mielestään palveluksen velkaa, hän antoi teille löytämänsä dokumentin, jossa on kartta ja rakennuksen pohjapiirros. Kyseessä on kuulemma kääpiöiden hylkäämä paikka, josta saattaisi löytyä jotain aarteitakin.</p>
			</section>

			<section class="adventure-box">
				<h2><a><i class="fa-solid fa-scroll"></i> Khimaira talon vartijana</a></h2>
				<p class="adventure-stats">Lvl 4-5, 3-6 hahmoa</p>
				<p class="adventure-desc">Velholla on ongelma: hänen kotinsa on vallannut khimaira, joka hyökkää kaikkien sinne menevien kimppuun. Jos seikkailijat hankkiutuvat siitä eroon ja hakevat hänen tärkeimmän taikakirjansa kellarista, hän on valmis maksamaan huomattavan palkkion.</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Kirjan vangit</a></h2>
				<p class="adventure-stats">Lvl 4-5, 3-6 hahmoa</p>
				<p class="adventure-desc"><i>Kirjan maailmaan eksymistä ei ehkä yleensä tarkoiteta näin kirjaimellisesti.</i> Jumissa maagisen kirjan vankina, seikkailijoilla on vain kaksi vaihtoehtoa päästä ulos: tappaa demoni, jonka voimaan kirjan lumous perustuu, tai murtaa sinetti, joka pitää sekä demonin että heidät vangittuina.</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Kirous syvyyksistä</a></h2>
				<p class="adventure-stats">Lvl 2-3, 3-6 hahmoa</p>
				<p class="adventure-desc">Mossleyn siirtokuntaan on iskenyt tautiepidemia, ja Miskalin temppeli lähettää papitar Cassandran auttamaan. Seikkailijoiden tehtävä on saattaa hänet turvallisesti perille ja takaisin kaupunkiin.</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Liskojen pesä</a></h2>
				<p class="adventure-stats">Lvl 1-2, 3-6 hahmoa</p>
				<p class="adventure-desc">Koboldit ovat vallanneet kyläläisten varastona käyttämän vanhan kaivoksen. Seikkailijat palkataan hankkiutumaan niistä eroon.</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Luonnoton talvi</a></h2>
				<p class="adventure-stats">Lvl 3-5, 3-6 hahmoa</p>
				<p class="adventure-desc">Hahmot saapuvat suojaisaan laaksoon, jossa vallitsee talvinen sää, vaikka laakson ulkopuolella on helle. Laaksossa asuvat kääpiöt kertovat kylmän sään jatkuneen jo yli vuoden ja koko ajan vain pahenevan. Syypääkin on selvä: maahisen ja tieflingin tuhatkunta vuotta sitten ("isoisän isän aikoina") rakentama torni. Mutta sitä tutkimaan menneet eivät ole palanneet.</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Petopentu</a></h2>
				<p class="adventure-stats">Lvl 2-3, 3-6 hahmoa</p>
				<p class="adventure-desc">Eräs velho on ostanut maagisten petojen kasvattajalta pennun kotinsa tulevaksi vartijaksi. Se pitäisi vain viedä perille.</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Taikasieniä ja keijupölyä</a></h2>
				<p class="adventure-stats">Lvl 3-5, 2-6 hahmoa</p>
				<p class="adventure-desc">Alkemisti maksaa lähimetsässä kasvavista sienistä viisi hopeapalaa sadalta grammalta. Mutta vain tietyistä, hyvin erityisistä sienistä. Ne ovat väriltään vaalean violetteja ja hohtavat pimeässä.</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Velhokuninkaan hauta</a></h2>
				<p class="adventure-stats">Yhteensä 5-8 kokemustasoa (ainakin yksi varas).</p>
				<p class="adventure-desc">Vain muutaman kilometrin päässä kaupungista on muinaisen velhokuninkaan maanalainen hauta. Koko maassa kerrotaan tarinaa, että hänen mukanaan haudattiin huomattava määrä rikkauksia – sekä rahaa että taikaesineitä. Tarina myös kertoo, että hauta on kirottu ja sinne astuva ei koskaan palaa maan pinnalle hengissä – mutta eihän tuohon kukaan usko. Eihän?</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Vineford</a></h2>
				<p class="adventure-stats">Kaikenlaiset hahmot toimivat, salapoliisimysteeri</p>
				<p class="adventure-desc">Miskalin temppeli palkkaa seikkailijat selvittämään, miksi Vinefordin kylän pappi ei ole lähettänyt kirjeitä tavalliseen tapaansa. Kylässä on isompiakin ongelmia kuin paikallisten viininviljelijöiden sukuriidat, mutta mikä tai kuka aiheuttaa ne?</p>
			</section>

			<section class="adventure-box">
				<h2><i class="fa-solid fa-scroll"></i> Yön noita</a></h2>
				<p class="adventure-stats">Lvl 3-4, 3-6 hahmoa</p>
				<p class="adventure-desc">Kylästä on kadonnut jo kaksi pientä lasta keskellä yötä. Kyläläiset pelkäävät kaappaajan olevan noita, joka vie loputkin yksi kerrallaan.</p>
			</section>

			<section class="adventure-box" style="visibility: hidden">
				<h2><i class="fa-solid fa-scroll"></i> <a href=""></a></h2>
				<p class="adventure-stats"></p>
				<p class="adventure-desc"></p>
			</section>

		</main>
	</div>
</body>
</html>
