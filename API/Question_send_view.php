<?php
require '../class/Question.php';
if(isset($_POST['id'])){

    $q = new Question;
    $q->send_view($_POST['id']);

}
