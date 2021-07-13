<?php
require '../class/user.php';



if (isset($_POST['userName']) && isset($_POST['phoneNumber']) && isset($_POST['pwd']) && isset($_POST['birthday']) && isset($_POST['accountLevel']) && isset($_POST['created']) && isset($_POST['end'])) {

    $userName = $_POST['userName'];
    $phoneNumber = $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];
    $birthday = $_POST['birthday'];
    $accountLevel = $_POST['accountLevel'];
    $created = $_POST['created'];
    $end = $_POST['end'];


    if (empty(trim($userName)) || empty(trim($phoneNumber)) || empty(trim($pwd)) || !empty( trim($birthday)) || empty(trim($accountLevel)) || empty(trim($created)) || empty(trim($end))) {
        
    } else {
        $user = new user($userName, $phoneNumber, $pwd, $birthday, $accountLevel, $created, $end);
        $user->insertUser();
    }
} else {
    //is not set
}
