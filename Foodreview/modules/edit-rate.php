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
$rate->rate = $_POST['rate'];
print_r($_POST);
$rate->restaurantId = $restId;
$rate->userId = $user->id;

if(isset($_POST['edit'])){
    $rate_edit = $rate->edit();
    if(!$rate_edit)
        echo "Nie edytowało rate...";
}
if(isset($_POST['delete'])){
    $rate_del = $rate->delete();
    if(!$rate_del)
        echo "Nie usunęło rate...";
}
    
header("Location: ../pages/opinie/index.php");

?>
