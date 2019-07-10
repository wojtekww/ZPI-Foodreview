<?php
	session_start();	
    if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: ../../../index.php');
		exit();
	}
	require_once '../../../templates/htmlheads/main.php';	
	require_once '../../../templates/headers/header-loggedin.php';

	require_once '../../../config/database.php';
	require_once '../../../objects/user/user.php';	
	require_once '../../../objects/rate/rate.php';
	$database = new Database();
	$db = $database -> getConnection();
	
	$user = new User($db);
?>
<div class="container">
    <div class="p-2 col-lg-12 mt-5">
    <h3 class ="m-4" style="text-align: center;">Uprawnienia użytkowników</h3>
        <?php $users = json_decode($user->getAllUsers());	
        if($users)
            foreach($users as &$user)
                require '../../../templates/content/privilages_edit.php';			
        else
            echo "Brak userów do wyświetlenia.";
        ?>
        
    </div>
</div>


<?php
    require_once '../../../templates/footers/footer.php';
?>
