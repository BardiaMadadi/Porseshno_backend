<?php
require_once '../class/Answer.php';
if (isset($_POST['answer'], $_POST['questionId'],$_POST["userId"])) {
    $a = new Answer($_POST['answer'], $_POST['questionId'],$_POST["userId"]);
    $a->add_answer();
} else {
    include_once '../functions/Answer_functions.php';
    response_Answer(402, "You have to send DATA");
}
