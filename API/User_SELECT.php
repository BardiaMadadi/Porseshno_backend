<?php

require '../class/user.php';
header('Content-Type: application/json');

if (isset($_POST['phoneNumber'])) {
    $phoneNumber = $_POST['phoneNumber'];
    $user = new user();

    $user->set_phoneNumber($phoneNumber);




    if ($user->selectUser() == 0) {
        response(200, "User dose not exist ");
    } else {
        response(413, "User Found");
    }
} else {
    response(400, "You have to send phoneNumber");
}



function response($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;

    echo json_encode($response, true);
}
