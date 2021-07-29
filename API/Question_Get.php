<?php
require_once '../class/Question.php';
$q = new Question;
if (isset($_POST['state'], $_POST['inp'])) {
    $q->GET_QUESTION($_POST['state'], $_POST['inp']);
}
//