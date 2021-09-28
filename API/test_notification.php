<?php

function sendFCM() {
    // FCM API Url
    $url = 'https://fcm.googleapis.com/fcm/send';
  
    // Put your Server Key here
    $apiKey = "AAAAJFSqBr8:APA91bHgsE6t_GesOzxmccHGAHgrMQIhpPCpfLJQx5qEO8yvrDDi-Ev3zQZqUkN7MeoyU09EMBSrXdisjmFKCQ8xs_XIvyI9XL5VHYHbRio5LUEmoJSplsZiSONy6p1oFX66szBKcNLb";
  
    // Compile headers in one variable
    $headers = array (
      'Authorization:key=' . $apiKey,
      'Content-Type:application/json'
    );
  
    // Add notification content to a variable for easy reference
    $notifData = [
      'title' => "پرسشنامه جدید",
      'body' => ".پرسشنامه ی جدید توسط مدیریت با نام'تست ۱' ساخته شده است",
      //  "image": "url-to-image",//Optional
      'click_action' => ".Notification.NotificationHandlerActivity" //Action/Activity - Optional
    ];
  
    $dataPayload = [
      'qId'=> '82'
    ];
  
    // Create the api body
    $apiBody = [
      'notification' => $notifData,
      'data' => $dataPayload, //Optional
      //'time_to_live' => 3600, // optional - In Seconds
      //'to' => '/topics/offer'
      'to' => '/topics/new-question'
      //'registration_ids' = ID ARRAY
      //'to' => 'dmFpnufdT0uJvYTKdbIBIV:APA91bFsZHWl9R2Ttg__aIKikXIEhkYESmwOhl7i-c8VDHxw7Cmy05tLi1whPiE1sizGfLUi0f1CGvMj--MhXt3O9hf71BxPcY1QAVMsq9fo20qHT-fMLLeHv4-HvL67S6Ilnlhdrlog'
    ];
    
    // Initialize curl with the prepared headers and body
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));
  
    // Execute call and save result
    $result = curl_exec($ch);
    print($result);
    // Close curl after call
    curl_close($ch);
  
    return $result;
  }

  sendFCM();

  ?>

