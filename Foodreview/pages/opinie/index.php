<?php
	session_start();	
    if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: ../../index.php');
		exit();
	}
	require_once '../../templates/htmlheads/main.php';	
	require_once '../../templates/headers/header-loggedin.php';

	require_once '../../config/database.php';
	require_once '../../objects/user/user.php';	
	require_once '../../objects/rate/rate.php';
	$database = new Database();
	$db = $database -> getConnection();
	
	$rate = new Rate($db);
	$user = new User($db);
	$user->getDane($_SESSION['login']);	

?>
	
<div class= "mb-3 container main-cont-pan">
	<div class="row">
		<div class="col-md-12">
			<div>
				<h4>Twoje opinie</h4>
				<div class="row mt-4">
					<div class="col-lg-12">

					<?php
							$rates = json_decode($rate->getRatesByUserId($user->id));
							if($rates)
								foreach($rates as &$rat)
									require '../../templates/content/rate-edit-element.php';	
								else
									echo "<h5>Nie oceniłeś jeszcze żadnej restauracji.</h5>";
					?>

					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<?php
    require_once '../../templates/footers/footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type=text/javascript>
	var test=0
	function showStars(el, stars_count) {  
        var i;        
		for (i = 1; i <= stars_count; i++)  	 
            $(el).parent().find('.star-' + i).addClass('checked');	
        for (i; i < 6; i++)  	 
            $(el).parent().find('.star-' + i).removeClass('checked');			
	}
	function setStars(el, stars_count) {        
		test = stars_count;        
		/*var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "rate").val(stars_count);*/
        $(el).closest('form').find('#rate').val(stars_count);
	}

    function getRate(el) {		
		test = $(el).closest('form').find('#rate').val();
	}
	$(".star-1").hover(function() {
		showStars($(this),1);
	}, function() {
		getRate(this)
		showStars($(this), test);
	});
	$(".star-2").hover(function() {
		showStars($(this),2);
	}, function() {
		getRate(this)
		showStars($(this), test);
	});
	$(".star-3").hover(function() {
		showStars($(this),3);
	}, function() {
		getRate(this)
		showStars($(this), test);
	});
	$(".star-4").hover(function() {
		showStars($(this), 4);
	}, function() {
		getRate(this)
		showStars($(this), test);
	});
	$(".star-5").hover(function() {
		showStars($(this), 5);
	}, function() {
		getRate(this)
		showStars($(this), test);
	});
	
	$(".star-1").click(function(){
        setStars($(this),1);		
    }); 
	$(".star-2").click(function(){
        setStars($(this),2);
    }); 
	$(".star-3").click(function(){
        setStars($(this),3);
    }); 
	$(".star-4").click(function(){
        setStars($(this),4);
    }); 
	$(".star-5").click(function(){
        setStars($(this),5);
    }); 

</script>