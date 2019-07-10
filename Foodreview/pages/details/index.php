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
	
<div class= "mb-3 container">
	<div class="row">

        <?php  
            require_once '../../templates/content/rest-details.php';
            require_once '../../templates/sidebars/rest-sidebar.php';
        ?>

    </div>
</div>

<?php
    require_once '../../templates/footers/footer.php';
?>
