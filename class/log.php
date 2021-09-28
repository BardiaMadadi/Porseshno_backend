<?php

class AppLog
{




    function sendLog($phoneNumber, $Log, $Location)
    {
        $phoneNumber = safe($phoneNumber,13);
        #incloud db
        include_once "../config/db.php";
        #if conn to server :
        if ($conn) {
            # Select user query :
                    #if can Insert log :
                    if (mysqli_query($conn, "INSERT INTO `appLog` VALUES ('$phoneNumber','$Log','$Location');")) {
                        response_log_send(200, "Sent");
                    } else {
                        #if vant insert log :
                        response_log_send(400, "Cant Handle");
                    }
                
        }
    }


    


# End Of Class _____________________________________________________

}
#functions :
function response_log_send($status_code, $message)
{
    header('Content-Type: application/json');
    $response['status_code'] = $status_code;
    $response['message'] = $message;

    echo json_encode($response, true);
}

function safe($data, $cutval)
{

    header('Content-Type: application/json');

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