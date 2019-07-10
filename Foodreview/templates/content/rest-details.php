<?php 

require_once '../../config/database.php';
require_once '../../objects/restaurant/restaurant.php';
require_once '../../objects/rate/rate.php';
require_once '../../objects/user/user.php';
$database = new Database();
$db = $database -> getConnection();

$restaurant = new Restaurant($db);
$rate = new Rate($db);
$user = new User($db);

$id = $_GET['id'];
$restaurant->getRestaurantById($id); // if false?	

$photos = json_decode($restaurant->getRestaurantPhotosById($id));
$comments = json_decode($rate->getRatesByRestaurantId($id));	
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<div class="p-2 col-lg-8 mt-5">
    <div class="card mb-3 card-details">
        <div class="card-header text-white card-header-color">Szczegóły restauracji: <?php echo $restaurant->name; ?></div>
        <img src="../../<?php 
		if(!is_null($restaurant->photo))
			echo "../../".$restaurant->photo; 
		else 
			echo "../../images/default-food.jpg";	 
		?>"class="card-img-top mainimage-details" alt="zdjęcie restauracji">
        <div class="card-body text-danger">
		<div class="row">
			<div class="col-7">	
            <h5 class="card-title"><?php echo $restaurant->name; ?></h5>
            <p class="card-text card-rest-grey card-rest-desc">
               <?php echo $restaurant->description; ?>
			</p>
			</div>
			<?php if($photos){
					echo'<div class="col-5">
                    <h5 class="card-title">Galeria</h5>
                    <p class="card-rest-grey card-rest-desc">
					<div id="myGallery" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators" style="display:none;">';

					$i = 0;

					foreach($photos as &$photo){
						if($i ==0)
							echo '<li data-target="#myGallery" data-slide-to="'.$i.'" class="active"></li>';
						else{
							echo '<li data-target="#myGallery" data-slide-to="'.$i.'"></li>';
						
						}
						$i++;
					}	

					echo '</ol>
						<div class="carousel-inner">';
					
					$j =0;

					foreach($photos as &$photo){
						if($j == 0)
							echo '<div class="carousel-item items active">
									<img class="first-slide" src="../../'. $photo->additionalPhotoPath .'" alt="First slide">
								</div>';
						else{
							echo '<div class="carousel-item items">
									<img class="second-slide" src="../../'. $photo->additionalPhotoPath .'" alt="Second slide">
								</div>';
						}
						$j++;
					}

					echo '</div><a class="carousel-control-prev" href="#myGallery" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#myGallery" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div></p>
				</div>';
				}?>
                    
		</div>
            <p>
                <div class="rating-stars">					
                    <?php
					for($i = 0 ; $i < round($restaurant->rating) ; $i++ )
						echo '<span class="fa fa-star checked"></span>';
					for($i = round($restaurant->rating); $i < 5 ; $i++ )
						echo '<span class="fa fa-star"></span>';
					?>
                </div>		
				
            </p>
            <div class="d-flex justify-content-around ">
                <div class="p-2">
                    <h5 class="card-title">Adres</h5>
                    <p class="card-rest-grey card-rest-desc">
                            <?php echo $restaurant->city; ?> , ul. <?php echo $restaurant->street . " " . $restaurant->buildingNumber; ?>
                    </p>
                </div>
                <div class="p-2">
                    <h5 class="card-title">Data dodania</h5>
                    <p class="card-rest-grey card-rest-desc">
                        <?php echo $restaurant->createdDate; ?>
                    </p>
				</div>
			</div>
			
            <ul class="list-group list-group-flush">
			
				<li class="list-group-item">
				
				<?php
					if ((isset($_SESSION['zalogowany']))){
						$user->getDane($_SESSION['login']);
						$rate->userId = $user->id;						
						$rate->restaurantId = $id;
						$userId_exists = $rate->userRateExists();
						if($userId_exists){
							echo "<small><p class='text-body'>Ta restauracja została przez Ciebie oceniona już wcześniej. Swoje oceny możesz edytować w panelu użytkownika.</p></small>";
						}else
							require_once '../../templates/forms/rate-form.php';
					}else{								
						echo "<p class='text-body'><a href='../../pages/zaloguj/index.php'>Zaloguj się</a> żeby ocenić restaurację.</p>";
					}
				?>
					
				</li>
			
				<?php 
				if($comments){
					foreach($comments as &$comment)
					echo 
						'<li class="list-group-item">
							<div class="row">
								<div class="col-2 comment-user mt-2">
										<img class="img-responsive user-photo img-thumbnail" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
										<p>' . $comment->userName . '</p>
								</div>
								<div class="col-sm-10 border rounded comment">
									<p>' . $comment->description . '</p>
								</div>
							</div>
							<div class="row comment-date">
								<div class ="col-sm-12 mt-0">Komentarz dodano: ' . $comment->createdDate . '</div>
							</div>
						</li>';
				} else{
					echo 
					'<li class="list-group-item text-body">
						Ta restauracja nie ma jeszcze ocen, bądź pierwszy!
					</li>';
				}
                ?>
				
            </ul>
        </div>
    </div>
	<div class="card">
		<div class="card-header card-header-color text-light">Zobacz na mapie</div>
		<div id="map">
		</div>
	</div>
</div>


