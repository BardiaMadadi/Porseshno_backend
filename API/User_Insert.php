<?php

header('Content-Type: application/json');


if (
    isset($_POST['userName']) &&
    isset($_POST['phoneNumber']) &&
    isset($_POST['pwd']) &&
    isset($_POST['created'])

) {
    $userName = $_POST['userName'];
    $phoneNumber = $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];
    $birthday = '-';
    $accountLevel = 'bronze';
    $created = $_POST['created'];
    $end = intval($created) + 2592000;

    require_once '../class/user.php';

    $user = new User;
    $user->set_username($userName);
    $user->set_phoneNumber($phoneNumber);
    $user->set_pwd($pwd);
    $user->set_end($end);
    $user->set_accountLevel($accountLevel);
    $user->set_created($created);
    $user->insertUser();

} else {
    response_insert_User(400, "You Should send all things", null);
}



