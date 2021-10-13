<?php
require_once "../class/History.php";
if(isset($_POST['userId'],$_POST['questionId'],$_POST["comment"])){
    # if userId and questionId is set
    $History = new history;
    $History->make_answer_history($_POST['userId'],$_POST['questionId'],$_POST["comment"]);

}else{
    # when nothing is set
    response_answer_history_send(400,"PLEAS SEND INP");

}
