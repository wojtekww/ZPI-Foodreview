<?php
    session_start();
    
    require_once 'templates/htmlheads/main.php';
    if ((isset($_SESSION['zalogowany'])))
	{
		require_once 'templates/headers/header-loggedin.php';
	}else{
        require_once 'templates/headers/header-login.php';
    }
    require_once 'templates/carousel/carousel.php';
    require_once 'templates/content/offer_bar.php';
    require_once 'templates/content/rest-list-section.php';
    require_once 'templates/content/partners-section.php';
    require_once 'templates/content/rest-profits.php';
    require_once 'templates/footers/footer.php';
    
?>