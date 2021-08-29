<?php
require_once "../class/Answer.php";

if (isset($_POST['questionId'])) {
    $A = new Answer(null, null, null, null, null, null);
    $A->comment_get($_POST['questionId']);
} else {
    include_once '../functions/Answer_functions.php';
    response_Answer(400, "PLS SEND questionId");
}
