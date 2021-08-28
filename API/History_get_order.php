<?php
require_once "../class/History.php";
if(isset($_POST['userId'])){
    # if userId and questionId is set
    $History = new history;
    $History->get_history_order_history($_GET['userId']);

}else{
    # when nothing is set
    response_order_history_get(400,"PLEAS SEND INP");

}
