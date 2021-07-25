<?php

require '../class/user.php';


header('Content-Type: application/json');



if (

    isset($_POST['phoneNumber'])  && isset($_POST['pwd'])

) {

    $phoneNumber =  $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];
    $user = new user();
    $user->set_phoneNumber($phoneNumber);
    $user->set_pwd($pwd);
    $user->login();
} else {
    response_login(400, "You Have to send phoneNumber & pwd", null);
}
