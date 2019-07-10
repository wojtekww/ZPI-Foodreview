<?php

session_start();

require_once '../config/database.php';
require_once '../objects/rate/rate.php';
require_once '../objects/user/user.php';
				
$database = new Database();
$db = $database -> getConnection();



$user = new User($db);

$user->getDane($_POST['userLogin']);

$rate = new Rate($db);

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
	
$restId = $_POST['restaurantId'];
$rate->description = test_input($_POST['description']);
if(isset($_POST['rate']))
	$rate->rate = $_POST['rate'];
else
	$rate_empty = True;
$rate->restaurantId = $restId;
$rate->userId = $user->id;


$userId_exists = $rate->userRateExists();
if($userId_exists){
    $_SESSION['dubelRate'] = true;	
	header("Location: ../pages/details/index.php?id=$restId");
}else if($rate_empty){
	$_SESSION['rateEmpty'] = true;	
	header("Location: ../pages/details/index.php?id=$restId");
}else { 	
    $rate_create = $rate->create();
	
    if($rate_create){			
		header("Location: ../pages/details/index.php?id=$restId");
    }
	else 
		echo "Nie dodało rate...";
}

?>
