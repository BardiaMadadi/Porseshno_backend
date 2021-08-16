<?php
require_once "../class/History.php";
if(isset($_POST['userId'],$_POST['questionId'])){
    # if userId and questionId is set
    $History = new history;
    $History->make_answer_history($_POST['userId'],$_POST['questionId']);

}else{
    # when nothing is set
    response_answer_history_send(400,"PLEAS SEND INP");

}
