<?php
require_once '../class/user.php';
if (
    isset($_POST['userName']) && isset($_POST['pwd']) && isset($_POST['birthday']) && isset($_POST['userId'])
) {

    $User = new user;
    $User->set_username($_POST['userName']);
    $User->set_pwd($_POST['pwd']);
    $User->set_birthday($_POST['birthday']);
    $User->EditUser($_POST['userId']);
} else {
    response_post_question(400, "Set something", null);
}
