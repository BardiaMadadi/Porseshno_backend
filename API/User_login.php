<?php

require '../class/user.php';


header('Content-Type: application/json');



if (

    isset($_POST['phoneNumber'])  && isset($_POST['pwd'])

) {

    $phoneNumber =  '09168070558';
    $pwd = 1234;
    $user = new user();
    $user->set_phoneNumber($phoneNumber);
    $user->set_pwd($pwd);

    $user->login();
} else {
    include '../functions/user_API_functions.php';
    response_login(400, "You Have to send phoneNumber & pwd", null);
}
