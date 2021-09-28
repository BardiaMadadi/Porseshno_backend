<?php
require_once '../class/Question.php';

if (isset($_POST["userId"], $_POST["questionId"], $_POST["title"], $_POST["desc"], $_POST["start"], $_POST["end"])) {
    $question = new Question();
    $question->EditQuestion($_POST["userId"], $_POST["questionId"], $_POST["title"], $_POST["desc"], $_POST["start"], $_POST["end"]);
} else {
    response_edit_question(400, "Send inputs");
}
