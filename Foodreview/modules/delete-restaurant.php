<?php

session_start();

require_once '../config/database.php';
require_once '../objects/restaurant/restaurant.php';
				
$database = new Database();
$db = $database -> getConnection();

$restaurant = new Restaurant($db);
$restaurant->restaurantId = $_POST['restaurantId'];

$restaurant->delete();

header("Location: ../pages/panel/index.php");

?>
