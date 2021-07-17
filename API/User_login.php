<?php

require '../class/user.php';


header('Content-Type: application/json');



if (

    isset($_POST['phoneNumber'])  && isset($_POST['pwd'])

) {
    $phoneNumber =  $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];

    $user = new user(null, $phoneNumber, $pwd, null, null, null, null);
    $user->login();
} else {
    include '../functions/user_API_functions.php';
    response_login(400, "You Have to send phoneNumber & pwd", null);
}
