<?php
require_once '../class/Question.php';
$q = new Question;
if (
    // isset($_POST['state'], $_POST['inp'])
    1 == 1
) {
    $q->GET_QUESTION('search', "Name");
} else {
    $q->GET_QUESTION("asdasd", "aasdassdasd");
}
//