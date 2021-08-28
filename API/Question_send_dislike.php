<?php
require_once '../class/Question.php';

if(isset($_POST["questionId"])){



    $QUESTION = new Question;
    $QUESTION->send_dislike($_POST["questionId"]);


}else{

    response_send_dislike(404,"SEND INP !!!");

}

