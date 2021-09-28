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

function response_Answer($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    
    echo json_encode($response, true);
}
function response_Answer_count($code, $message,$data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    if($code == 200){
        $response['count'] = $data;

    }
    echo json_encode($response, true);
}