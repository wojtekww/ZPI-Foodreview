<?php
	session_start();
    if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: ../../index.php');
		exit();
	}
	require_once '../../config/database.php';
	require_once '../../templates/htmlheads/main.php';
	require_once '../../objects/user/user.php';
	require_once '../../templates/headers/header-loggedin.php';
	$database = new Database();
	$db = $database -> getConnection();
	$user = new User($db);
	$user->getDane($_SESSION['login']);
?>
	
<div class= "mb-3 container main-cont-pan">
	<div class="row">
		<div class="col-md-12">
			<div>
				<h4>Witaj <?php echo $user->firstname; ?></h4>
				<div class="row mt-4">
					<div class="col-lg-8">
						<div class="card">
							<div class="card-header bg-danger text-light">
								<h5>Twoje dane</h5>
                                <?php
                                    if(isset($_SESSION['editer'])){
                                        echo $_SESSION['editer'];
                                        unset($_SESSION['editer']);
                                    }
                                ?>
							</div>
							<div class="card-body">
								<form action="../../modules/edit-user.php" method="post" class="md-form edit-user-form" enctype="multipart/form-data">
                                    <div class="row">
                                        <span class="col-md-2">Imię:</span>
                                        <input type="text" name="imie" id="inputName" class="col-md-10 form-control" value="<?php echo $user->firstname; ?>">
                                    </div>
                                    <div class="row mt-4">
                                        <span class="col-md-2">Nazwisko:</span>
                                        <input type="text" name="nazwisko" id="inputLastName" class="col-md-10 form-control" value="<?php echo $user->lastname; ?>">
                                    </div>
                                    <div class="row mt-4">
                                        <span class="col-md-2">Mail:</span>
                                        <input type="text" name="mail" id="inputMail" class="col-md-10 form-control" value="<?php echo $user->mail; ?>">
                                    </div>
                                    <button class="btn-success btn mt-4 ml-auto" style="display: block!important;" type="submit">Zatwierdź</button>
                                </form>
							</div>
							
						</div>
					</div>
					<div class="col-lg-4 user-side">
						<div class="card">
							<div class="card-header bg-danger text-light">
								<h5>Zarządzanie</h5>
							</div>
							<div class="card-body">
								<ul class="list-group">
									<li class="list-group-item"><a href="/pages/panel/index.php">Moje dane</a></li>
									<li class="list-group-item"><a href="/pages/edycja_usera/index.php">Edycja</a></li>
								</ul>
							</div>
						</div>
						<div class="card mt-4">
							<div class="card-header bg-danger text-light">
								<h5>Restauracje</h5>
							</div>
							<div class="card-body">
								<ul class="list-group">
									<li class="list-group-item"><a href="/pages/opinie/index.php">Ocenione</a></li>
									<li class="list-group-item"><a href="/pages/panel/uprawnienia/index.php">Uprawnienia użytkowników</a></li>
								</ul>
							</div>
						</div>
						<div class="card mt-4">
							<div class="card-header bg-danger text-light">
								<h5>Premium</h5>
							</div>
							<div class="card-body">
								<ul class="list-group">
									<li class="list-group-item">Zostań restauratorem</li>
									<li class="list-group-item">Korzyści</li>
									<li class="list-group-item"><a href="../regulamin/index.php">Regulamin</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<?php
    require_once '../../templates/footers/footer.php';
?>

