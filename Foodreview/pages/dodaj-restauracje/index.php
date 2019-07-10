<?php
    session_start();
    if (isset($_SESSION['zalogowany'])){
		require_once '../../templates/headers/header-loggedin.php';		
	} else{
		require_once '../../templates/headers/header-login.php';
	}
    require_once '../../templates/htmlheads/main.php';
	
?>
<div class= "mt-5 mb-3 container">
	<div class="row">
        <div class="col">
		
			<?php 
				if (isset($_SESSION['zalogowany'])){
					require_once '../../templates/forms/add-restaurant-form.php'; 		
				} else{
					echo ("
					<h4 class='text-center'>
						Żeby dodać restaurację musisz się <a href='../../pages/zaloguj/index.php'>zalogować</a>.
					</h4>");
				}				
			?>
			
        </div>
    </div>
</div>

<?php
    require_once '../../templates/footers/footer.php';
?>
