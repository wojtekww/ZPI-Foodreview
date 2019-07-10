<form id="rate-form" action="../../modules/create-rate.php" method="post" enctype="multipart/form-data">
	<input name="userLogin" type="hidden" value="<?php echo $_SESSION['login']; ?>">
	<input name="restaurantId" type="hidden" value="<?php echo $id; ?>">
	<div class="row">
		<div class="col-sm-3">
			<p class="text-body mb-2">Twoja ocena</p>								
			<div class="rating-stars">
				<span id="star-1" class="pointer fa fa-star"></span><span id="star-2" class="pointer fa fa-star"></span><span id="star-3" class="pointer fa fa-star"></span><span id="star-4" class="pointer fa fa-star"></span><span id="star-5" class="pointer fa fa-star"></span>
			</div>								
		</div>
		<div class="col-sm-7 comment-textarea">
			
			<textarea id="inputDescription" name="description" class="form-control" rows="3" maxlength="255" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$"></textarea>
			<div id="the-count" class="float-right mt-n4 mr-2">
				<small>
					<small>
						<span id="current">0</span>
						<span id="maximum">/ 255</span>
					</small>
				</small>
			</div>
		</div>
		<div class="col-sm-2 comment-button">
			<button class="mt-1 btn btn-danger btn-block" id="submitBtn" type="submit">Oceń</button>
		</div>
		<p class="text-danger">

			<?php 
				if(isset($_SESSION['dubelRate'])){
					echo "Ta restauracja została przez Ciebie oceniona już wcześniej!";
					unset($_SESSION['dubelRate']);
				}
				if(isset($_SESSION['rateEmpty'])){
					echo "Musisz wybrać ocenę.";
					unset($_SESSION['rateEmpty']);
				}										
			?>

		</p>							
	</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type=text/javascript>
	var test=0
	function showStars(stars_count) {	
		var i;
		for (i = 1; i <= stars_count; i++)  	 
			$('#star-' + i).addClass('checked');		
	}
	function removeStars(stars_count) {			
		for (i = stars_count + 1; i < 6; i++)  	 
			$('#star-' + i).removeClass('checked');		
	}
	function setStars(stars_count) {
		test = stars_count;
		var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "rate").val(stars_count);
		$('#rate-form').append(input);
	}
	function refreshCharacterCount() {		
		var characterCount = $('#inputDescription').val().length;
		var current = $('#current');	  
		current.text(characterCount);
	}
	
	$("#star-1").mouseenter(function(){
        showStars(1);
    }); 
	$("#star-2").mouseenter(function(){
        showStars(2);
    }); 
	$("#star-3").mouseenter(function(){
        showStars(3);
    }); 
	$("#star-4").mouseenter(function(){
        showStars(4);
    }); 
	$("#star-5").mouseenter(function(){
        showStars(5);
    }); 
	
	$("#star-1, #star-2, #star-3, #star-4, #star-5").mouseleave(function(){
        removeStars(test);
    }); 
	
	$("#star-1").click(function(){
        setStars(1);		
    }); 
	$("#star-2").click(function(){
        setStars(2);
    }); 
	$("#star-3").click(function(){
        setStars(3);
    }); 
	$("#star-4").click(function(){
        setStars(4);
    }); 
	$("#star-5").click(function(){
        setStars(5);
    }); 
	$('#inputDescription').keyup(function() {    
		refreshCharacterCount();
	});
</script>
