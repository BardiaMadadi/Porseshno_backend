<?php

function notify($to,$data){

    $api_key="AAAAJFSqBr8:APA91bHgsE6t_GesOzxmccHGAHgrMQIhpPCpfLJQx5qEO8yvrDDi-Ev3zQZqUkN7MeoyU09EMBSrXdisjmFKCQ8xs_XIvyI9XL5VHYHbRio5LUEmoJSplsZiSONy6p1oFX66szBKcNLb";
    $url="https://fcm.googleapis.com/fcm/send";
    $fields=json_encode(array('to'=>$to,'notification'=>$data));

    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($fields));

    $headers = array();
    $headers[] = 'Authorization: key ='.$api_key;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}

$to="";
$data=array(
    'title'=>'Greetings',
    'body'=>'Hi, From PHP Script'
);

notify($to,$data);
echo "Notification Sent";

?>