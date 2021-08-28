<?php
include_once "./config/db.php";
require_once './class/Idpay.php';
$idpay = new idpay;
$verify = $idpay->verify_peyment($_POST['id'],$_POST["order_id"]);
$order_id = $_POST["order_id"];
$amount = $_POST['amount'];


if(isset($verify["status"]) && $verify["status"] == 100){
    mysqli_query($conn,"UPDATE `orders` SET `amount`='$amount',`name`='$name',`phone`='$phone' WHERE `order_id`= '$order_id'; ");
}else{
    echo($verify);
}