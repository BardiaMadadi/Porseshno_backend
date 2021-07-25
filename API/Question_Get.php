<?php
require '../class/Question.php';
$q = new Question;
if (isset($_GET['state'], $_GET['inp'])) {
    $q->GET_QUESTION($_GET['state'], $_GET['inp']);
}
