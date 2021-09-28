<?php
#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'YOUR-SERVER-API-ACCESS-KEY-GOES-HERE' );
    $registrationIds = $_GET['id'];

#prep the bundle
     $msg = array
          (
		'body' 	=> 'Body  Of Notification',
		'title'	=> 'Title Of Notification',
             	'icon'	=> 'myicon',/*Default Icon*/
              	'sound' => 'mySound'/*Default sound*/
          );

	$fields = array
			(
				'to'		=> $registrationIds,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);

#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

#Echo Result Of FireBase Server
echo $result;