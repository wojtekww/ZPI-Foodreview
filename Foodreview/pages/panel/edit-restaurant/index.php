<?php
	session_start();
    if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: ../../../index.php');
		exit();
	}
	require_once '../../../config/database.php';
	require_once '../../../templates/htmlheads/main.php';
    require_once '../../../objects/restaurant/restaurant.php';
    require_once '../../../objects/category/category.php';
	require_once '../../../templates/headers/header-loggedin.php';
	$database = new Database();
    $db = $database -> getConnection();    
    $rest = new Restaurant($db);
	$category = new Category($db);	
	if(isset($_POST['restaurantId']))
		$rest->getRestaurantById($_POST['restaurantId']);
	else
		$rest->getRestaurantById($_SESSION['restaurantId']);
	$photos = json_decode($rest->getRestaurantPhotosById($rest->restaurantId));
?>

<div class= "mt-5 mb-3 container">
	<div class="card bg-light p-2">	
		<h4 class="card-title mt-3 mb-4 text-center">Edytuj dane <?php echo $rest->name;?></h4>
		<form action="../../../modules/edit-restaurant.php" method="post" class="md-form" enctype="multipart/form-data">
			<input name="restaurantId" type="hidden" value="<?php echo $rest->restaurantId ?>">
			<input name="ownerId" type="hidden" value="<?php echo $rest->ownerId ?>">
			<div class="row">
				<div class="col-6">
				
					<article class="card-body mx-auto p-0" style="max-width: 400px;">
					
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text form-icon"> <i class="fa fa-utensils w-100"></i> </span>
							</div>
							<input type="text" id="inputName" name="name" class="form-control" placeholder="Nazwa restauracji" value="<?php echo $rest->name ?>" required autofocus maxlength="32">
						</div> <!-- form-group// -->					
						
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text form-icon"> <i class="fa fa-city w-100"></i> </span>
							</div>
							<input type="text" id="inputCity" name="city" class="form-control" placeholder="Miasto" value ="<?php echo $rest->city ?>"required maxlength="32" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$"> 
						</div> <!-- form-group// -->
						
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text form-icon"> <i class="fa fa-road w-100"></i> </span>
							</div>
							<input type="text" name="street" id="inputStreet" class="form-control" placeholder="Ulica" value ="<?php echo $rest->street ?>"required maxlength="32" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$">
						</div> <!-- form-group// -->
						
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text form-icon"> <i class="fa fa-building w-100"></i> </span>
							</div>
							<input type="number" name="buildingNumber" id="inputBuildingNumber" class="form-control" placeholder="Numer budynku" value ="<?php echo $rest->buildingNumber ?>"required maxlength="4" min="1" max="9999">
						</div> <!-- form-group// -->		
						
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text form-icon"> <i class="fa fa-door-closed w-100"></i> </span>
							</div>
							<input type="number" name="localNumber" id="inputLocalNumber" class="form-control" placeholder="Numer mieszkania" value ="<?php echo $rest->localNumber ?>" maxlength="3" min="1" max="999">
						</div> <!-- form-group// -->	
						
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text form-icon"> <i class="fa fa-address-card w-100"></i> </span>
							</div>
							<input type="postCode" name="postCode" id="inputPostCode" class="form-control" placeholder="Kod pocztowy" value ="<?php echo $rest->postCode ?>" required maxlength="6" pattern="^[0-9]{2}-[0-9]{3}$" oninvalid="this.setCustomValidity('Podaj kod pocztowy w formacie xx-xxx.')" oninput="this.setCustomValidity('')">
						</div> <!-- form-group// -->
						
						<div class="form-group input-group ">
							<div class="input-group-prepend">
								<span class="input-group-text form-icon"> <i class="fa fa-mail-bulk w-100"></i> </span>
							</div>
							<input type="text" name="postCity" id="inputPostCity" class="form-control" placeholder="Poczta" value ="<?php echo $rest->postCity ?>" required maxlength="32" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$">
						</div> <!-- form-group// -->
					

					</article>
					
				</div>
				<div class="col-6">
				
					<article class="card-body mx-auto p-0" style="max-width: 400px;">						
						<div class="form-group mt-n2">						
							<fieldset class="border p-2 form-fieldset">
								<legend class="w-auto mb-0">
									<h5 class="mb-0 font-weight-normal">Opis restauracji</h5>
								</legend>	
								<div id="the-count" class="float-right mt-n3 mr-1">
									<small>
										<span id="current">0</span>
										<span id="maximum">/ 255</span>
									</small>
								</div>						
								<textarea  class="form-control border-0" id="inputDescription" name="description" rows="7" maxlength="255" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$"><?php echo $rest->description ?></textarea>
								
							</fieldset>
							
						</div> <!-- form-group// -->
						
						<div class="form-group input-group">
							<fieldset class="border p-2 form-fieldset">
								<legend class="w-auto">
									<h5 class="mb-0 font-weight-normal">Wybierz kategorie</h5>
								</legend>
								
								<?php			
									$allCategories = json_decode($category->getAllCategories());
									$restCategories = json_decode($rest->getRestaurantCategories($rest->restaurantId));
									if($allCategories)
										foreach ($allCategories as &$acat) {
											echo '<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input" name="categories[]" id="cb_' . $acat->typeName . '" value="' . $acat->typeID . '"';
														if($restCategories)
															foreach ($restCategories as &$rcat) {
																if($acat->typeID == $rcat->typeID)
																	echo "checked";}
														echo '>
														' . $acat->typeName . '
													</label>
												</div>';
										}
									else
										echo "Brak kategorii do wyświetlenia.";
								?> 
								
							</fieldset>
						</div> <!-- form-group// -->
						
					</article>
					
				</div>
			</div>
			<article class="card-body mx-auto" style="max-width: 400px;">
				<div class="form-group">
					<button name="data" value="1" type="submit" class="btn btn-danger btn-block"> Zapisz zmiany </button>
				</div>   
							
				<p class="text-danger">
				
							<?php 
								if(isset($_SESSION['dubelName'])){
									echo "Restauracja o podanej nazwie już istnieje!";
									unset($_SESSION['dubelName']);
								}
								if(isset($_SESSION['dubelAddress'])){
									echo "Restauracja znajdująca się pod wskazanym adresem została już dodana!";
									unset($_SESSION['dubelAddress']);
								}
							?>
					
				</p>
				<p class="text-success">
				
					<?php
						if(isset($_SESSION['zmienionaPomyslnie'])){
							echo "Nowe dane zostały zapisane!";
							unset($_SESSION['zmienionaPomyslnie']);
						}
					?>
					
				</p>
			</article>
		</form>
	</div> 

	<div class="card bg-light p-2 mt-3 d-flex">
		<div class="col-6 mx-auto">
			<h4 class="card-title mt-3 mb-4 text-center">Edytuj zdjęcie główne</h4>		
			<form action="../../../modules/edit-restaurant.php" method="post" class="md-form" enctype="multipart/form-data">
				<input name="name" type="hidden" value="<?php echo $rest->name ?>">
				<input name="restaurantId" type="hidden" value="<?php echo $rest->restaurantId ?>">

				<img id="preview-image" src=<?php echo "../../../".$rest->photo; ?> class="rounded img-fluid img-rest-form">

				<div class="form-group mt-3 d-flex justify-content-center">
					<div class="mr-5 w-25 btn btn-warning" onclick="document.getElementById('mainPhoto').click();">
						<span>Zmień</span>
						<input id="mainPhoto" name="image" type="file" class="d-none">
					</div>
					<button name="mainPhoto" value="1" type="submit" class="ml-5 w-25 btn btn-danger"> Zapisz </button>
				</div>   
				<p class="text-danger text-center">
				
					<?php 
						if(isset($_SESSION['uploadError'])){
							echo "Wystąpił błąd! Dopuszuszczalne są tylko pliki w formacje jpg, png o rozmiarze nie większym niż 1MB.";
							unset($_SESSION['uploadError']);
						}								
					?>
					
				</p>
				<p class="text-success text-center">
				
					<?php
						if(isset($_SESSION['uploadSuccesfull'])){
							echo "Zdjęcie zostało zapisane!";
							unset($_SESSION['uploadSuccesfull']);
						}
					?>
					
				</p>
			</form>
		</div>
	</div>

	<div class="card bg-light p-2 mt-3 d-flex">
		<div class="col-10	mx-auto">
			<h4 class="card-title mt-3 mb-4 text-center">Dodatkowe zdjęcia</h4>		
			<form action="../../../modules/edit-restaurant.php" method="post" class="md-form" enctype="multipart/form-data">
				<input name="name" type="hidden" value="<?php echo $rest->name ?>">
				<input name="restaurantId" type="hidden" value="<?php echo $rest->restaurantId ?>">	
				<div class="row">
					<div class="col-4">
						<img id="addImage1" src="../../../<?php if(isset($photos[0])) echo $photos[0]->additionalPhotoPath; else echo "images/default.png"; ?>" class="rounded img-fluid img-add-form">
						<div class="form-group mt-3 d-flex justify-content-center">					
							<div class="mt-2 w-50 btn btn-warning" onclick="document.getElementById('addPhoto1').click();">
								<span>Zmień</span>
								<input id="addPhoto1" name="addImage[]" type="file" class="d-none">
							</div>
						</div>   
						
					</div>			
					<div class="col-4">
						<img id="addImage2" src="../../../<?php if(isset($photos[1])) echo $photos[1]->additionalPhotoPath; else echo "images/default.png"; ?>" class="rounded img-fluid img-add-form">
						<div class="form-group mt-3 d-flex justify-content-center">		
							<div class="mt-2 w-50 btn btn-warning  mx-auto" onclick="document.getElementById('addPhoto2').click();">
								<span>Zmień</span>
								<input id="addPhoto2" name="addImage[]" type="file" class="d-none">
							</div>
						</div>
					</div>	
					<div class="col-4">
						<img id="addImage3" src="../../../<?php if(isset($photos[2])) echo $photos[2]->additionalPhotoPath; else echo "images/default.png"; ?>" class="rounded img-fluid img-add-form">	
						<div class="form-group mt-3 d-flex justify-content-center">		
							<div class="mt-2 w-50 btn btn-warning" onclick="document.getElementById('addPhoto3').click();">
								<span>Zmień</span>
								<input id="addPhoto3" name="addImage[]" type="file" class="d-none">
							</div>
						</div>
					</div>	
				</div>
				<div class="form-group mt-3 d-flex justify-content-center">					
					<button name="additionalPhotos" value="1" type="submit" class="w-25 btn btn-danger"> Zapisz </button>
				</div>   
				<p class="text-danger text-center">
				
					<?php 
						if(isset($_SESSION['addUploadError'])){
							echo "Wystąpił błąd! Dopuszuszczalne są tylko pliki w formacje jpg, png o rozmiarze nie większym niż 1MB.";
							unset($_SESSION['addUploadError']);
						}								
					?>
					
				</p>
				<p class="text-success text-center">
				
					<?php
						if(isset($_SESSION['addUploadSuccesfull'])){
							echo "Zdjęcia zostały zapisane!";
							unset($_SESSION['addUploadSuccesfull']);
						}
					?>
					
				</p>
			</form>
		</div>
	</div>
</div>

<?php
    require_once '../../../templates/footers/footer.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type=text/javascript>    
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#preview-image').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }
	function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#addImage1').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }
	function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#addImage2').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }
	function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#addImage3').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }
	$("#mainPhoto").change(function(){
        readURL(this);
    }); 
	$("#addPhoto1").change(function(){
        readURL1(this);
    }); 
	$("#addPhoto2").change(function(){
        readURL2(this);
    }); 
	$("#addPhoto3").change(function(){
        readURL3(this);
    }); 
    function refreshCharacterCount() {		
		var characterCount = $('#inputDescription').val().length;
		var current = $('#current');	  
		current.text(characterCount);
	}
	$('#inputDescription').keyup(function() {    
		refreshCharacterCount();
	});
    $(refreshCharacterCount);
</script>