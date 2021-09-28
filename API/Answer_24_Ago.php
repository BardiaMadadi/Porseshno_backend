<?php

require_once '../class/Answer.php';
if (isset($_POST['questionId'])) {

    $answer = new Answer(0,0,0,0,$_POST['questionId'],0);

    $answer->AgoAnswers();
} else {
    include_once '../functions/Answer_functions.php';
    response_Answer(401,"SEND INP PKS");


}
