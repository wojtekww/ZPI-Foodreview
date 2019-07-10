<?php 

require_once 'config/database.php';
require_once 'objects/restaurant/restaurant.php';
$database = new Database();
$db = $database -> getConnection();

$restaurant = new Restaurant($db);
?>

<section class="res-list-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-7" id="restauracje">
                
				<?php 				
				$rests = json_decode($restaurant->getRecentlyAdded(6));	
				if($rests)
					foreach($rests as &$rest)
						require 'templates/content/restaurant-element.php';				
				else
					echo "Brak restauracji do wyświetlenia.";
				?>
								
            </div>
            <div class="col-lg-4">
			
				<?php
				require_once 'templates/sidebars/categories_sidebar.php';
				?>
				
                
                <div class="wid-box  b-shad b-top mx-auto my-4">
                    <div class="wid-cont card">
                        <img class="card-img-top" src="/images/food.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="text-danger">Restauracja miesiąca</h5>
                            <h6 class="text-danger">Kita czikita</h6>
                            <p>
                                Lorem ipsum dolor sit
                            </p>
                            <a class="btn btn-rest-color">Sprawdź!</a>
                        </div>
                        
                    </div>
                </div>
                <div class="wid-box  b-shad b-top mx-auto my-4">
                    <div class="wid-cont card">
                        <img class="card-img-top" src="/images/food.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="text-danger">Najlepsze burgery</h5>
                            <h6 class="text-danger">Kita czikita</h6>
                            <p>
                                Lorem ipsum dolor sit
                            </p>
                            <a class="btn btn-rest-color">Sprawdź!</a>
                        </div>
                        
                    </div>
                </div>
                <div class="wid-box  b-shad b-top mx-auto my-4">
                    <div class="wid-cont card">
                        <img class="card-img-top" src="/images/food.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="text-danger">Wspaniała włoska kuchnia</h5>
                            <h6 class="text-danger">Kita czikita</h6>
                            <p>
                                Lorem ipsum dolor sit
                            </p>
                            <a class="btn btn-rest-color">Sprawdź!</a>
                        </div>
                        
                    </div>
                </div>
                <div class="wid-box  b-shad b-top mx-auto my-4">
                    <div class="wid-cont px-4 py-4">
                        <h2>Ranking restauracji</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">1. Italiania czikita</li>
                            <li class="list-group-item">2. Maniana parmezana</li>
                            <li class="list-group-item">3. Sushi wybrzuszi</li>
                        </ul>
                    </div>
                </div>
                <div class="wid-box  b-shad b-top mx-auto my-4">
                    <div class="wid-cont px-4 py-4">
                        <h2>Konkurs</h2>
                        <p>Zamieniaj oceny na nagrody! Weź udział w naszym konkursie i odbierz 50 zł na obiad w dowolnej restauracji!</p>
                        <a class="btn btn-rest-color">Sprawdź!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>