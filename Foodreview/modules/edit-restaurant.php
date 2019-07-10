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

if(isset($_POST['data'])){
    $restaurant->restaurantId = $_POST['restaurantId'];
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
        header('Location: ../pages/panel/edit-restaurant/index.php');
    }else if($address_exists){
        $_SESSION['dubelAddress'] = true;
        header('Location: ../pages/panel/edit-restaurant/index.php');
    }else { 	
        $restaurant_edit = $restaurant->edit();
    }

    if(!$restaurant_edit )
        echo "COS NIE TAK";
    else        
        $_SESSION['zmienionaPomyslnie'] = true;
    $_SESSION['restaurantId'] = $_POST['restaurantId'];    
    header("Location: ../pages/panel/edit-restaurant/index.php");
}
if(isset($_POST['mainPhoto'])){
    $restaurant->name = $_POST['name'];
    $restaurant->restaurantId = $_POST['restaurantId'];
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
        echo "Sorry, your file was not uploaded.";        
        $_SESSION['uploadError'] = true;	
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";            
            $_SESSION['uploadSuccesfull'] = true;            
			$restaurant->updatePhoto();       
        } else {
            echo "Sorry, there was an error uploading your file.";
            $_SESSION['uploadError'] = true;	
        }
    }    
    header("Location: ../pages/panel/edit-restaurant/index.php");
}

if(isset($_POST['additionalPhotos'])){  
    
    $restaurant->name = $_POST['name'];
    $restaurant->restaurantId = $_POST['restaurantId'];
    $uploadOkk = 1;
    for ($i = 0; $i<3; $i++)
        if($_FILES['addImage']['name'][$i]!=""){                
            print_r($_FILES['addImage']['name'][$i]);

            //////////UPLOAD PLIKU //////////////
            $target_dir = "../images/";		
            $uploadOk = 1;

            $target_file = $target_dir . basename($_FILES["addImage"]["name"][$i]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));		
            $photo = str_replace(' ', '-', $restaurant->name);
            $photos[] = "images/" . $photo.($i+1).".".$imageFileType;
            $target_file = $target_dir . $photo.($i+1).".".$imageFileType;


            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["addImage"]["tmp_name"][$i]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check file size
            if ($_FILES["addImage"]["size"][$i] > 1000000) {
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
                echo "Sorry, your file was not uploaded.";        
                $_SESSION['addUploadError'] = true;	
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["addImage"]["tmp_name"][$i], $target_file)) {
                    echo "The file ". basename( $_FILES["addImage"]["name"][$i]). " has been uploaded.";            
                    $_SESSION['addUploadSuccesfull'] = true;         
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $_SESSION['addUploadError'] = true;	
                    $uploadOkk = 0;
                }
            }
        }
    if($uploadOkk != 0 && isset($photos)){
        $restaurant->deleteAdditionalPhotos();
        $restaurant->photos = $photos;
        print_r($photos);
        $restaurant->addAdditionalPhotos();   
    }  
    header("Location: ../pages/panel/edit-restaurant/index.php");


}
?>
