<?php
class idpay{


    function getOrder(){
        include_once '../config/db.php';
        $Sample = "1234567890";
        $Generated = substr(str_shuffle($Sample), 0, 4);
    
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE `order_id`='$Generated';")) == 0) {
                return $Generated;
            }else{
                $this->getOrder();
            }
        
    }



    function make_payment($buyedAccount,$userId,$amount,$name,$phone)
    {
        include_once '../config/db.php';
        $OrderId = $this->getOrder();
        
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
        $time = time();
        mysqli_query($conn,"INSERT INTO `orders` VALUES ('maked','$userId','$OrderId','1','$amount','$name','$phone','$time','1','1','1','1','$buyedAccount');");
    
    
    }

    
    }




    function sendOrder($userId,$OrderId,$amount,$name,$phone,$buyedAccount , $status , $paymentTrackId){


        include_once '../config/db.php';
        $time = time();
                     
        #paymentTrackId => when pay from the bazar => equal with `TOKEN`
        if(mysqli_query($conn,"INSERT INTO `orders` VALUES ('$status','$userId','$OrderId','1','$amount','$name','$phone','$time','1','$paymentTrackId','1','1','$buyedAccount');")){
            
            response_idpay(200,"Done!");

        }else{

            response_idpay(404,"Cant Handle !");

        }

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
          return json_decode($result,true);
    
          curl_close($ch);      
    
    
    }
    


}



function response_idpay($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
