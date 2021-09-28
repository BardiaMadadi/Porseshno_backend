<?php
require_once "../class/user.php";


if(isset($_POST['Level'],$_POST["uId"])){
    if($_POST['Level'] == "bronze" || $_POST['Level'] == "steel" || $_POST['Level'] == "gold" || $_POST['Level'] == "diamond"){

        $user = new User;
        $user->upgrade_user($_POST['Level'],$_POST["uId"]);
        
    }else{
        response_post_question(454,"SET VALID LEVEL",null);

    }
    
}else{
    response_post_question(454,"PLS SET SOME VARS",null);
}



