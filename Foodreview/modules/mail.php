<?php
if(isset( $_POST['name']))
$name = $_POST['name'];
if(isset( $_POST['email']))
$email = $_POST['email'];
if(isset( $_POST['message']))
$message = $_POST['message'];
if(isset( $_POST['subject']))
$subject = $_POST['subject'];

$content="Od: $name \n Do: $email \n Wiadomośc: $message";
$recipient = "chomileusz@gmail.com";
$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: Your name <info@address.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
header('Location: ../index.php');
//mail($recipient, $subject, $content, $headers) or die("Error!");
echo "Email wysłano!";

?>