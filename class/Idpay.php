<?php
class idpay{



    function make_payment($buyedAccount,$userId,$amount,$name,$phone)
    {
        
        $OrderId = ' ';
        include_once '../config/db.php';
        $Sample = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $Generated = substr(str_shuffle($Sample), 0, 40);
    
        if (mysqli_query($conn, "SELECT * FROM users WHERE `order_id`='$Generated';")) {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE `order_id`='$Generated';")) == 0) {
                $OrderId = $Generated;
            }
        }else{
            $OrderId = $Generated;
        }
    if($OrderId !== ' '){
    
        $params = array(
            'order_id' => $OrderId,
            'amount' => intval($amount),
            'name' => $name,
            'phone' => $phone,
            'callback' => 'http://www.porsno.ir/Porseshno_backend/Peyment.php',
        );
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: ee117f13-558b-4834-8634-7acfd21c35fc'
            ));
    
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
        mysqli_query($conn,"INSERT INTO `orders`(`buyedAccount`,`status`,`userId`,`order_id`, `amount`, `name`, `phone`) VALUES ('$buyedAccount','200','$userId','$OrderId','$amount','$name','$phone')");
    
    
    }
        
    
        //   echo($result);
    }
    
    
    function verify_peyment($id,$order_id){
    
    
    
        $params = array(
            'id' => $id,
            'order_id' => $order_id,
          );
          
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: ee117f13-558b-4834-8634-7acfd21c35fc'
          ));
          
          $result = curl_exec($ch);
          return $result;
    
          curl_close($ch);      
    
    
    }
    


}



function response_idpay($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
