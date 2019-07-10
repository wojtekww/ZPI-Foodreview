<?php
require_once '../../config/database.php';
require_once '../../objects/category/category.php';
require_once '../../objects/user/user.php';

$database = new Database();
$db = $database -> getConnection();
$user = new User($db);
$user->getDane($_SESSION['login']);
$category = new Category($db);
?>

<div class="card bg-light p-2">	
	<h4 class="card-title mt-3 mb-4 text-center">Dodaj nową restaurację</h4>
	<form action="../../modules/create-restaurant.php" method="post" class="md-form" enctype="multipart/form-data">
		<input id = "userId" name="ownerId" type="hidden" value="<?php echo $user->id ?>">
		<div class="row">
			<div class="col-6">
			
				<article class="card-body mx-auto p-0" style="max-width: 400px;">
				
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon"> <i class="fa fa-utensils w-100"></i> </span>
						</div>
						<input type="text" id="inputName" name="name" class="form-control" placeholder="Nazwa restauracji" value="" required autofocus maxlength="32">
					</div> <!-- form-group// -->					
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon"> <i class="fa fa-city w-100"></i> </span>
						</div>
						<input type="text" id="inputCity" name="city" class="form-control" placeholder="Miasto" value =""required maxlength="32" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$"> 
					</div> <!-- form-group// -->
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon"> <i class="fa fa-road w-100"></i> </span>
						</div>
						<input type="text" name="street" id="inputStreet" class="form-control" placeholder="Ulica" value =""required maxlength="32" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$">
					</div> <!-- form-group// -->
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon"> <i class="fa fa-building w-100"></i> </span>
						</div>
						<input type="number" name="buildingNumber" id="inputBuildingNumber" class="form-control" placeholder="Numer budynku" value =""required maxlength="4" min="1" max="9999">
					</div> <!-- form-group// -->		
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon"> <i class="fa fa-door-closed w-100"></i> </span>
						</div>
						<input type="number" name="localNumber" id="inputLocalNumber" class="form-control" placeholder="Numer mieszkania" value ="" maxlength="3" min="1" max="999">
					</div> <!-- form-group// -->	
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon"> <i class="fa fa-address-card w-100"></i> </span>
						</div>
						<input type="postCode" name="postCode" id="inputPostCode" class="form-control" placeholder="Kod pocztowy" value ="" required maxlength="6" pattern="^[0-9]{2}-[0-9]{3}$" oninvalid="this.setCustomValidity('Podaj kod pocztowy w formacie xx-xxx.')" oninput="this.setCustomValidity('')">
					</div> <!-- form-group// -->
					
					<div class="form-group input-group ">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon"> <i class="fa fa-mail-bulk w-100"></i> </span>
						</div>
						<input type="text" name="postCity" id="inputPostCity" class="form-control" placeholder="Poczta" value ="" required maxlength="32" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$">
					</div> <!-- form-group// -->
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text form-icon" > <i class="fa fa-image w-100"></i> </span>
						</div>
						<div class="custom-file" id="customFile">
							<input type="file" name="image" id="inputImage" class="custom-file-input" accept="image/*">
							<label id="file-input-label" class="custom-file-label">Wybierz zdjęcie...</label>
						</div>
					</div> <!-- form-group// -->					

				</article>
				
			</div>
			<div class="col-6">
			
				<article class="card-body mx-auto p-0" style="max-width: 400px;">
				
					<image src="../../images/default.png" class="rounded img-fluid img-rest-form" id="preview-image"/>
					
					<div class="form-group mt-3">						
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
							<textarea  class="form-control border-0" id="inputDescription" name="description" rows="3" maxlength="255" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$"></textarea>
							
						</fieldset>
						
					</div> <!-- form-group// -->
					
					<div class="form-group input-group">
						<fieldset class="border p-2 form-fieldset">
							<legend class="w-auto">
								<h5 class="mb-0 font-weight-normal">Wybierz kategorie</h5>
							</legend>
							
							<?php			
								$categories = json_decode($category->getAllCategories());
								if($categories)
									foreach ($categories as &$cat) 
										echo '<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input type="checkbox" class="form-check-input" name="categories[]" id="cb_' . $cat->typeName . '" value="' . $cat->typeID . '" >
													' . $cat->typeName . '
												</label>
											</div>';	
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
				<button type="submit" class="btn btn-danger btn-block"> Dodaj restaurację </button>
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
							if(isset($_SESSION['uploadError'])){
								echo "Nie udało się wgrać zdjęcia na serwer! Możesz to zrobić później w panelu użytkownika.";
								unset($_SESSION['uploadError']);
							}
						?>
				
			</p>
			<p class="text-success">
			
				<?php
					if(isset($_SESSION['poprawnieDodana'])){
						echo "Restauracja pomyślnie dodana!";
						unset($_SESSION['poprawnieDodana']);
					}
				?>
				
			</p>
		</article>
	</form>
</div> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type=text/javascript>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview-image').attr('src', e.target.result);
				var filename = $('input[type=file]').val().split('\\').pop();
				$('#file-input-label').text(filename);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    function refreshCharacterCount() {		
		var characterCount = $('#inputDescription').val().length;
		var current = $('#current');	  
		current.text(characterCount);
	}
    $("#inputImage").change(function(){
        readURL(this);
    }); 
	$('#inputDescription').keyup(function() {    
		refreshCharacterCount();
	});

</script>
