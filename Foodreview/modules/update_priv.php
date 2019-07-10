<?php

session_start();

require_once '../config/database.php';
require_once '../objects/user/user.php';
				
$database = new Database();
$db = $database -> getConnection();

$user = new User($db);

$user->getDane($_POST['userlogin']);

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
	
$userId = $_POST['userid'];
$user->usertype = $_POST['uprawnienia'];
print_r($_POST);
$user->userid = $userId;


if(isset($_POST['edit'])){
    $user_edit = $user->editPriv();
    if(!$user_edit)
        echo "Nie edytowało uprawnień...";
}
  
header("Location: ../pages/panel/uprawnienia/index.php");

?>
