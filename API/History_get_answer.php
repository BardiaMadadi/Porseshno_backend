<?php
require_once "../class/History.php";
if(isset($_POST['userId'])){
    # if userId and questionId is set
    $History = new history;
    $History->get_answer_history($_POST['userId']);

}else{
    # when nothing is set
    response_answer_history_send(400,"PLEAS SEND INP");

}
