<?php

if(isset($_POST['phoneNumber'])  && isset($_POST['pwd'])){
    require '../class/user.php';
    $phoneNumber = $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];

    $user = new user(null,$phoneNumber,$pwd,null,null,null,null);
    $user->login();

}
