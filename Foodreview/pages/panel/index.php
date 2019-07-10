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
	require_once '../../objects/restaurant/restaurant.php';
	require_once '../../templates/headers/header-loggedin.php';
	$database = new Database();
	$db = $database -> getConnection();
	$user = new User($db);	
	$user->getDane($_SESSION['login']);
	
	$restaurant = new Restaurant($db);
	$rests = json_decode($restaurant->getRestaurantsByOwnerId($user->id));
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
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										Imię:
									</div>
									<div class="col-sm-6">
										<?php echo $user->firstname ?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										Nazwisko:
									</div>
									<div class="col-sm-6">
										<?php echo $user->lastname ?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										Email:
									</div>
									<div class="col-sm-6">
										<?php echo $user->mail ?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										Aktywny:
									</div>
									<div class="col-sm-6">
										<?php echo $user->userverified ?>
									</div>
								</div>
								<div class="d-flex justify-content-end">
									<a href="../../pages/edycja_usera/index.php" class="btn btn-danger text-light">Edytuj</a>
								</div>
							</div>
							
						</div>
						<h4 class="mt-4">Twoje restauracje</h4>
						<div class="card mt-4">
								<div class="card-header bg-danger text-light mb-n3">
									<h5>Twoje restauracje</h5>
								</div>
								<div class="card-body">
									<?php
										if($rests)
											foreach($rests as &$rest)
												echo '
													<div class="d-flex bd-highlight p-2">
  														<div class="mr-auto p-2 bd-highlight">
															<h5 class="d-inline-block">'.$rest->restaurantName.'</h5>
														</div>
														<form action="../../pages/panel/edit-restaurant/index.php" method="post">
															<div class="p-2 bd-highlight">
																<button name="restaurantId" value="'.$rest->restaurantId.'" class="btn btn-warning float-right d-inline-block mr-2" type="submit">Edytuj</button>
															</div>
														</form>	
														<form action="../../modules/delete-restaurant.php" method="post">
															<div class="p-2 bd-highlight">
																
																<button name="restaurantId" value="'.$rest->restaurantId.'" class="btn btn-danger float-right d-inline-block" type="submit">Usuń</button>
															</div>
														</form>	
													</div>';
										else
											echo "<p>Brak restauracji do wyświetlenia.</p>";
										?>


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

