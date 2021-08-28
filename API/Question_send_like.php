<?php
require_once '../class/Question.php';

if(isset($_POST["questionId"])){



    $QUESTION = new Question;
    $QUESTION->send_like($_POST["questionId"]);


}else{

    response_send_like(404,"SEND INP !!!");

}

