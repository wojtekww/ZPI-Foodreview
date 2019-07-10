<?php

session_start();

require_once '../config/database.php';
require_once '../objects/user/user.php';
				
$database = new Database();
$db = $database -> getConnection();


$user = new User($db);

$user->getDane($_SESSION['login']);


$user->imie = $_POST['imie'];
$user->nazwisko = $_POST['nazwisko'];
$user->mail = $_POST['mail'];
$user->login = $_SESSION['login'];
echo "kupsko";
$userEd = $user->edit();
    if(!$userEd)
    {
        $_SESSION['editer'] = "nie udalo sie wyedytowac...";
    }
    
header("Location: ../pages/edycja_usera/index.php");

?>
