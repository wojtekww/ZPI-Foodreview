<?php
    session_start();
    if ((isset($_SESSION['zalogowany'])))
	{
		header('Location: ../../pages/panel/index.php');
		exit();
	}
    require_once '../../templates/htmlheads/main.php';
    require_once '../../templates/headers/header-login.php';
?>
	
<div class= "mt-5 mb-3 container">
	<div class="row">
        <div class="col">
        <?php require_once '../../templates/forms/register-form.php'; ?>
        </div>
    </div>
</div>

<?php
    require_once '../../templates/footers/footer.php';
?>
