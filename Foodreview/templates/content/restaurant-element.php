<div class="rest-box  b-shad b-top mb-4">
	<div class="rest-cover px-4 py-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.6)), 
			url('<?php if(!is_null($rest->mainPhotoPath))	echo $rest->mainPhotoPath; else echo "images/default-food.jpg";	?>');  
			background-size: cover;  background-repeat: no-repeat;">
		<h2>
			<?php echo $rest->restaurantName; ?>
		</h2>
		<p>ul. <?php echo $rest->street. " " . $rest->buildingNumber; ?>  </p>
	</div>
	<div class="rest-content px-4 py-4">
		<p class="lead">
            <?php echo $rest->restaurantDescription; ?>
		</p>
		<div class="d-flex justify-content-between align-items-center">
			<div class="rating-stars">
			
			<?php
				for($i = 0 ; $i < round($rest->rating) ; $i++ )
					echo '<span class="fa fa-star checked"></span>';
				for($i = round($rest->rating); $i < 5 ; $i++ )
					echo '<span class="fa fa-star"></span>';
			?>
				
			</div>
			<a class="btn btn-rest-color" href="pages/details/index.php?id=<?php echo $rest->restaurantId; ?>">Zobacz restuarację</a>
		</div>
	</div>
</div>