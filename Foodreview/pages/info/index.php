<?php
	session_start();
    if ((isset($_SESSION['zalogowany'])))
	{
		require_once '../../templates/headers/header-loggedin.php';
	}else{
        require_once '../../templates/headers/header-login.php';
    }
    require_once '../../templates/htmlheads/main.php';
?>
<div class="container">
    <div class="p-2 col-lg-12 mt-5">
       <h3 style="text-align:center;">O Foodreview</h3>
       <div class="mt-3">
            <span>Strona powstała na wskutek projektu realizowanego na przedmiot "Zespołowe Przedsięwzięcie Inżynierskie". Strona służyć ma ludziom, którzy chcą ocenić restauracje w której mieli przyjemność przebywać. Zalogowani użytkownicy w stanie są dodawać komentarze oraz oceniać restauracje w skali 1-5. Dodatkowo użytkownicy posiadający status restauratora, są w stanie dodawać swoje restauracje,  dodawać ich opis oraz zdjęcia z nimi związane.</span>
        </div>
    </div>
</div>

<?php
    require_once '../../templates/footers/footer.php';
?>