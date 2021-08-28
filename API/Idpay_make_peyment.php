<?php
require_once "../class/Idpay.php";
if(isset($_POST["userId"],$_POST['amount'],$_POST['name'],$_POST['phone'])){

    $idpay = new idpay;
    $idpay->make_payment($_POST["buyedAccount"],$_POST["userId"],$_POST['amount'],$_POST['name'],$_POST['phone']);


}else{
    response_idpay(400,"Send Input");

}
