<?php
require_once 'restaurant.php';
require_once '../../config/database.php';
$database = new Database();
$db = $database -> getConnection();
if(isset($_POST['zmienna'])) {
    $myREST = new Restaurant($db);
    $result = $myREST->getRestaurantByType($_POST['zmienna']);
    $rests = json_decode($result);
    $html = '';
    ob_start();
    
    if($rests)
        foreach($rests as &$rest)
            include('../../templates/content/restaurant-element.php');
    else
        echo "Brak restauracji do wyswietlenia";    
        
    $html = ob_get_clean(); 
    echo $html;
}