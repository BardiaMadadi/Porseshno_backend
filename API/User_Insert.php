<?php
require '../class/user.php';

header('Content-Type: application/json');


if (
    isset($_POST['userName']) &&
    isset($_POST['phoneNumber']) &&
    isset($_POST['pwd']) &&
    // isset($_POST['birthday']) &&
    // isset($_POST['accountLevel']) &&
    isset($_POST['created'])

) {

    $userName = $_POST['userName'];
    $phoneNumber = $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];
    $birthday = $_POST['birthday'] = '-';
    $accountLevel = $_POST['accountLevel'] = 'bronze';
    $created = $_POST['created'];
    $end = intval($created) + 2592000;


    $user = new user();
    $user->set_username($userName);
    $user->set_phoneNumber($phoneNumber);
    $user->set_pwd($pwd);
    $user->set_created($created);
    $user->insertUser();


    response(200, "User Created", array(
        "userName" => $userName,
        "phoneNumber" => $phoneNumber,
        "birthday" => $birthday,
        "accountLevel" => $accountLevel,
        "created" => $created,
        "end" => $end,
    ));
} else {
    response(400, "You Should send all things", null);
}


function response($code, $message, $data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    if ($code == 200) {
        $response['userName'] = $data['userName'];
        $response['phoneNumber'] = $data['phoneNumber'];
        $response['birthday'] = $data['birthday'];
        $response['accountLevel'] = $data['accountLevel'];
        $response['created'] = $data['created'];
        $response['end'] = $data['end'];
    }
    echo json_encode($response, true);
}

