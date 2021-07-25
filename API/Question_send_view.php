<?php
require '../class/Question.php';
if(isset($_GET['id'])){

    $q = new Question;
    $q->send_view($_GET['id']);

}
