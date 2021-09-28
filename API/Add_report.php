<?php

require_once '../class/Report.php';
if(isset($_POST['qId'] , $_POST['uId'] , $_POST['description'])){
    $a = new Report();
    $response = $a->new_report($_POST['qId'] , $_POST['uId'] , $_POST['description']);

    echo json_encode($response, true);

}else{
    include_once '../functions/Answer_functions.php';
    response_Answer(400,"PLS SEND info");

}