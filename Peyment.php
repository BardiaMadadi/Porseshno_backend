<?php

# maked , porsnotrackid , card no , peyment track id , normal track id , id


# Invlouds________________________________________________________________________________________________
include_once "./config/db.php";
require_once './class/Idpay.php';

$idpay = new idpay;
# if Idpay sends orderId & amount :

if (isset($_POST["order_id"], $_POST["amount"])) {
    
    # catch orderId & amount :
    $order_id = $_POST["order_id"];
    $amount = $_POST['amount'];
    $p = '';

    # if can get order in orders table :
    if (mysqli_query($conn, "SELECT * FROM `orders` WHERE `order_id` = '$order_id'")) {
        
        # fetch order :
        $order = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `orders` WHERE `order_id` = '$order_id'"), MYSQLI_ASSOC);
        
        
        # Verify Peyment ________________________________
        $verify = $idpay->verify_peyment($_POST['id'], $_POST["order_id"]);
        
        # get  values of order that we wanted :
        intval($userId = $order["userId"]);
        $buyedAccount = $order["buyedAccount"];

        # if Verify get 200 code :
        if (isset($verify["status"]) && $verify["status"] == 100) {
            
            
            #get value of verify response :

            $status = $verify["status"];
            $porsnoTrackId = $verify["settlement"]["wallet"]["id"];
            $card_no = $verify["payment"]["card_no"];
            $paymentTrackId = $verify["payment"]["track_id"];
            $paymentTrackId = intval($paymentTrackId);
            $normalTrackId = $verify["track_id"];
            $normalTrackId = intval($normalTrackId);
            $id = $verify["id"];
            
            #update query
            
            $update = "UPDATE `orders` SET `status` = 'done', `porsnoTrackId` = '$porsnoTrackId', `card_no` = '$card_no' , `paymentTrackId` = '$paymentTrackId' , `normalTrackId` = '$normalTrackId' , `id` = '$id'  WHERE `order_id`= '$order_id';";

            # UPGRADE USER ___________________________________________________________________________________________________

            

            $data = [
                "Level" => $order["buyedAccount"],
                "uId"=> $order["userId"]
            ];
            $url = "http://185.190.39.159/Porseshno_backend/API/User_Upgrade.php";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            $responseJson = $response;
            $responseArr = json_decode($response,true);



            # if  upgrrade get 200 code :

            if ($responseArr["status_code"] == 200) {
                # if can Update :
                if (mysqli_query($conn, $update)) {
                    $p = 'پرداخت با موفقیت انجام شد';
                } else {
                    # if cant update order
                    $p = $status . "<br/>" .$porsnoTrackId . "<br/>" .$card_no . "<br/>" .$paymentTrackId . "<br/>" .$normalTrackId . "<br/>" .$id . "<br/>" .$order_id . "<br/>";
                }
            # if 
            } else {
                # ADD LOG API HERE .
                $p = $response["status_code"];
            }
        } else {
            
            $p = $verify;
        }
    } else {
        $p = "کاربر شناسایی نشد";
    }
} else {

    $order_id = "نا مشخص";
    $amount = "نا مشخص";
    $p = 'پرداخت با موفقیت انجام نشد';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت</title>
</head>

<body>

    <style>
        @font-face {
            font-family: Vazir;
            src: url(../public-html/Vazir-Bold.woff2);
        }

        * {
            margin: 0;
            padding: 0;
        }

        .box {
            width: 100vw;
            height: 100vh;
            background-color: #4ae54a;
            overflow: hidden;
        }

        p {
            color: white;
            font-family: Vazir;
            font-size: 6vw;

            text-align: center;
            margin: 0;
        }

        p {
            color: white;
            font-family: Vazir;
            width: 100%;
            font-size: 6vw;
            text-align: center;
            margin: 0;

        }


        @media screen and (min-width: 768px) {
            .box {
                width: 100vw;
                height: 100vh;
                background-color: #4ae54a;
                overflow: auto;
            }

            p {
                font-size: 50px;
            }

            p {
                font-size: 50px;
            }

        }
    </style>

    <div class="box">
        <p><?= $p ?></p>
        <p>مبلغ : <?= $amount ?></p>
        <p> کد رهگیری شما : <?= $order_id ?> </p>
        <p>در صورت بروز هر مشکل یا تیم پشتیبانی در تماس باشید !</p>
    </div>


</body>

</html>