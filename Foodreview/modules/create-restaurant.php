<?php

session_start();

require_once '../config/database.php';
require_once '../objects/restaurant/restaurant.php';
				
$database = new Database();
$db = $database -> getConnection();

$restaurant = new Restaurant($db);

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }

$restaurant->name = test_input($_POST['name']);
$restaurant->description = test_input($_POST['description']);
$restaurant->ownerId = test_input($_POST['ownerId']);
$restaurant->city = test_input($_POST['city']);
$restaurant->street = test_input($_POST['street']);
$restaurant->buildingNumber = test_input($_POST['buildingNumber']);
$restaurant->localNumber = test_input($_POST['localNumber']);
$restaurant->postCode = test_input($_POST['postCode']);
$restaurant->postCity = test_input($_POST['postCity']);

if(isset($_POST['categories']))
		$restaurant->categories = $_POST['categories'];

$name_exists = $restaurant->nameExists();
$address_exists = $restaurant->addressExists();

if($name_exists){
    $_SESSION['dubelName'] = true;
    header('Location: ../pages/dodaj-restauracje/index.php');
}else if($address_exists){
    $_SESSION['dubelAddress'] = true;
    header('Location: ../pages/dodaj-restauracje/index.php');
}else { 	
    $restaurant_create = $restaurant->create();
	
    if($restaurant_create){
		
		//////////UPLOAD PLIKU //////////////
		$target_dir = "../images/";		
		
		$uploadOk = 1;
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));		
		$photo = str_replace(' ', '-', $restaurant->name);
		$restaurant->photo = "images/" . $photo.".".$imageFileType;
		$target_file = $target_dir . $photo.".".$imageFileType;

		
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["image"]["size"] > 1000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {			
			$_SESSION['uploadError'] = true;	
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
				$restaurant->updatePhoto();
			} else {
				echo "Sorry, there was an error uploading your file.";
				$_SESSION['uploadError'] = true;	
			}
		}
		$_SESSION['poprawnieDodana'] = true;
		header('Location: ../pages/dodaj-restauracje/index.php', false);
    }
	else 
		echo "Nie dodało restauracji...";
}

?>
