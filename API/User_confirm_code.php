<?php
header('Content-Type: application/json');

require_once '../class/User_cofirm_sms.php';

if (isset($_POST['phoneNumber'])) {
    $phoneNumber = safe($_POST['phoneNumber'], 12);
    $phoneNumber = trim($phoneNumber);
    $code = new confirm_sms($phoneNumber);
    $confirm_code = $code->gen_code();
    $code->send_sms($confirm_code);
    response(200, "Confirm code generated successful", $confirm_code);
} else {

    response(453, "You did not send anything", null);
}



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
function response($code, $message, $data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    if ($code == 200) {
        $response['code'] = $data;
    }
    echo json_encode($response, true);
}
