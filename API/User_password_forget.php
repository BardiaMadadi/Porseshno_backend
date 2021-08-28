<?php

require_once "../class/user.php";


if (isset($_POST["phoneNumber"])) {

    $User = new user;
    $User->set_phoneNumber($_POST["phoneNumber"]);
    $User->pwd_forget();

} else {
    response_pwd_forget(400,"SET INP",null);
}
