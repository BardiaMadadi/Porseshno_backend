<?php
require "../class/Idpay.php";
//isset($_POST["userId"],$_POST["OrderId"],$_POST["name"],$_POST["phone"],$_POST["buyedAccount"] , $_POST['status'] , $_POST['paymentTrackId'])
if(isset($_POST["userId"],$_POST["OrderId"],$_POST["name"],$_POST["phone"],$_POST["buyedAccount"] , $_POST['status'] , $_POST['paymentTrackId'])){

$idpay = new idpay();
$idpay->sendOrder(
$_POST["userId"],
$_POST["OrderId"],
"50000",
$_POST["name"],
$_POST["phone"],
$_POST["buyedAccount"],
$_POST["status"],
$_POST["paymentTrackId"]
);

}else{
    response_idpay(404,"send inp !!");
}