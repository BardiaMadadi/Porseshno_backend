<?php
header('Content-Type: application/json');

require '../class/User_cofirm_sms.php';

include '../functions/user_API_functions.php';

if (isset($_POST['phoneNumber'])) {
    $phoneNumber = safe($_POST['phoneNumber'], 12);
    $phoneNumber = trim($phoneNumber);
    $code = new confirm_sms($phoneNumber);
    $confirm_code = $code->gen_code();
    response(200, "Confirm code generated successful", $confirm_code);
} else {

    response(453, "You did not send anything", null);
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
