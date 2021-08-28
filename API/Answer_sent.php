<?php
require_once '../class/Answer.php';
if(isset($_POST['userId'],$_POST['userName'],$_POST['date'],$_POST['answer'],$_POST['questionId'],$_POST['comment'])){
    $a = new Answer($_POST['userId'], $_POST['userName'], $_POST['date'], $_POST['answer'], $_POST['questionId'],$_POST['comment']);
    $a->add_answer();
}else{
    include_once '../functions/Answer_functions.php';
    response_Answer(402,"You have to send DATA");
}

