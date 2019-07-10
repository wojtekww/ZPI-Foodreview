<?php

session_start();

require_once '../config/database.php';
require_once '../objects/user/user.php';

$database = new Database();
$db = $database -> getConnection();

$user = new User($db);

$user->imie = $_POST['firstName'];
$user->nazwisko = $_POST['lastName'];
$user->login = $_POST['login'];
$user->mail = $_POST['email'];
$user->haslo = $_POST['password'];
$checkPass = $_POST['repeatPassword'];

$login_exists = $user->loginExists();
$email_exists = $user->emailExists();

if(empty($user->login)){
    $_SESSION['emptyfields'] = true;
    header('Location: ../index.php');
    die("Login i haslo nie moga byc puste!");
}

if($login_exists){
    $_SESSION['dubelLogin'] = true;
    header('Location: ../pages/zarejestruj/index.php');
}else if($email_exists){
    $_SESSION['dubelMail'] = true;
    header('Location: ../pages/zarejestruj/index.php');
}else if($checkPass != $user->haslo){
    $_SESSION['passErr'] = true;
    header('Location: ../pages/zarejestruj/index.php');
}else { 
    $user_create = $user->create();
    //$user_verify = $user->verify();
    if($user_create){
        //if($user_verify){
            $_SESSION['poprawnieDodany'] = true;
            header('Location: ../pages/zarejestruj/index.php');
        //}
    }
}


?>