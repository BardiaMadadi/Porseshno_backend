<?php

require '../class/user.php';

if(isset($_POST['phoneNumber'])){
    $user = new user(null,$_POST['phoneNumber'],null,null,null,null,null);
    if($user->selectUser() == 0){
        response(200,"User dose not exist ",null);
    }else{
        response(413,"User already created",null);
    }
}



function response($code, $message, $data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;

    echo json_encode($response, true);
}



?>