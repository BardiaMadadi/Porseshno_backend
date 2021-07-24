<?php
require '../class/Question.php';

if (isset($_POST['icon'], $_POST['questionName'], $_POST['start'], $_POST['end'], $_POST['userId'], $_POST['desc'], $_POST['cat'], $_POST['question'])) {

    $q = new Question;
    $q->set_icon($_POST['icon']);
    $q->set_questionName($_POST['questionName']);
    $q->set_start($_POST['start']);
    $q->set_end($_POST['end']);
    $q->set_userId($_POST['userId']);
    $q->set_question_Description($_POST['desc']);
    $q->set_questionCat($_POST['cat']);
    $q->set_question($_POST['question']);


    $q->POST_QUESTION();
}else{
    include '../functions/user_API_functions.php';
    response_post_question(400, "You have to put all inputs", null);
}
?>
<form action="" method="post">
    <input name="icon" type="text">
    <input name="questionName" type="text">
    <input name="start" type="text">
    <input name="end" type="text">
    <input name="userId" type="text">
    <input name="desc" type="text">
    <input name="cat" type="text">
    <input name="question" type="text">
    <button type="submit">SUBMIT</button>
</form>