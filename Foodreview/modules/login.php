<?php

session_start();

require_once '../config/database.php';
require_once '../objects/user/user.php';

$database = new Database();
$db = $database -> getConnection();

$user = new User($db);

$user->login = $_POST['login'];
$login_exists = $user->loginExists();

if(empty($user->login)){
    $_SESSION['emptyfields'] = true;
    header('Location: ../index.php');
    die("Login i haslo nie moga byc puste!");
}
if($login_exists && password_verify($_POST['password'], $user->password)){
    $_SESSION['zalogowany'] = true;
    $_SESSION['login'] = $user->login;
    unset($_SESSION['loginer']);
    header('Location: ../pages/panel/index.php');
}else{
    $_SESSION['loginer'] = true;
    header('Location: ../pages/zaloguj/index.php');
}

?>