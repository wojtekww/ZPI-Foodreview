<?php

session_start();

$_SESSION['firstName'] = $_POST['firstName'];
$_SESSION['lastName'] = $_POST['lastName'];
$_SESSION['email'] = $_POST['email'];
header('Location: ../pages/zarejestruj/index.php');

?>