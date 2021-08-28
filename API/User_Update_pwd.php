<?php

require_once "../class/user.php";

if( isset($_POST["phoneNumber"],$_POST["pwd"])){


    $User = new user;
    $User->set_phoneNumber($_POST["phoneNumber"]);
    $User->set_pwd($_POST["pwd"]);
    $User->Edit_pwd();



}else{

    response_pwd_edit(400,"Send Input PLS");

}