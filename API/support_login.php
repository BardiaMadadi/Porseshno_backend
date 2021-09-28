<?php

    require_once '../class/Support.php';

    if(isset($_POST['username'] , $_POST['pwd'])){//isset($_POST['username'] , $_POST['pwd'])

        $login = new Support();
        $login->set_username($_POST['username']);
        //$login->set_username('mohkhz');
        $login->set_pwd($_POST['pwd']);
        //$login->set_pwd('test');
        $login->login();


    }else{
        responseSupportLogin(405,"Send Inputs",null);
    }
