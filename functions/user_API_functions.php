<?php


function safe($data, $cutval)
{

    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = substr($data, 0, $cutval);
    $data = str_replace('/', '', $data);
    $data = str_replace('<', '', $data);
    $data = str_replace('>', '', $data);
    $data = str_replace('#', '', $data);
    $data = str_replace('--', '', $data);
    $data = str_replace('SELECT', '', $data);
    $data = str_replace('OR', '', $data);
    return $data;
}
function hash_pwd($data)
{
    $pwd = strlen($data) . 'dogs_are_fun' . $data . "AND_I_HATE_CATS";
    $data = md5($pwd);
    return $data;
}

function response_login($code, $message, $data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    if ($code == 200) {
        $response['Id'] = $data['userId'];
        $response['userName'] = $data['userName'];
        $response['phoneNumber'] = $data['phoneNumber'];
        $response['birthday'] = $data['birthday'];
        $response['accountLevel'] = $data['accountLevel'];
        $response['created'] = $data['created'];
        $response['end'] = $data['end'];
    }
    echo json_encode($response, true);
}
function response_post_question($code, $message, $data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    if ($code == 200) {
        $response['Id'] = 2;
    }
    echo json_encode($response, true);
}