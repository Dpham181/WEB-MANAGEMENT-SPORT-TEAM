<?php

$email = $_POST['email'];
$cname= $_POST['cname'];
$subject= $_POST['subject'];
$message= $_POST['message'];

$feedback = array(
    "email" => "$email",
    "cname" => "$cname",
    "subject" => "$subject",
    "message" => "$message",

);
require_once 'notify_password.php';
$email = "servicebasketballmanagement@gmail.com";
notify_password($email, $feedback);







?>
