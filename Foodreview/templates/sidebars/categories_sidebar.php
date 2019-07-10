<?php
require_once 'config/database.php';
require_once 'objects/category/category.php';

$database = new Database();
$db = $database -> getConnection();

$category = new Category($db);

?>
<script type=text/javascript>
var result = null;
function reloadInfo(zmienna){
  $.ajax({
    type: "POST",
    data: {"zmienna":zmienna},
    url: "/objects/restaurant/restaurantHandler.php",
    success: function(data) {
      result=data;
			console.log("Inside ajax: "+ result);
			$('#restauracje').animate({opacity: 0}, 300);
			setTimeout (function(){
				$('#restauracje').html(result);
    	},300);
			$('#restauracje').animate({opacity: 1}, 300);
    },
		error: function() {
			result = null;
		}
  }); 
	console.log("Outside ajax: "+result);  // fires only after the ajax request is completed 
}   

</script>

<div class="wid-box  b-shad b-top mx-auto">
	<div class="wid-cont px-4 py-4">
		<h2 class="mb-3">Kategorie</h2>
			<div class="form-group mt-0">
					<button class="mt-2 btn btn-sm btn-outline-danger btn-block catBtn" id="submitBtn" type="submit" onClick="reloadInfo(0)">Wszystkie</button>
			</div>
				
				<?php			
				$categories = json_decode($category->getAllCategories());
				if($categories){
					foreach ($categories as &$cat) 
						echo '<div class="form-group mt-0">
									<button class="mt-2 btn btn-sm btn-outline-danger btn-block catBtn" id="submitBtn" type="submit" onClick="reloadInfo('. $cat ->typeID .')">' . $cat ->typeName . '</button>
									</div>';
				}						
				else
					echo "Brak kategorii do wyświetlenia.";
				?> 
				
	</div>
</div>
