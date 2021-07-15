<?php
header('Content-Type: application/json');
include_once '../functions/user_API_functions.php';


if (isset($_POST['phoneNumber'])  && isset($_POST['pwd'])) {
    require '../class/user.php';
    $phoneNumber = $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];

    $user = new user(null, $phoneNumber, $pwd, null, null, null, null);
    $user->login();
}else{
    response_login(400,"You Have to send phoneNumber & pwd",null);
}
