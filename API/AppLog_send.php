<?php

require_once '../class/log.php';
if (isset($_POST["phoneNumber"], $_POST["log"], $_POST["Location"])) {

    $log = new AppLog;
    $log->sendLog($_POST["phoneNumber"], $_POST["log"], $_POST["Location"]);
} else {
    response_log_send(400, "PLS send inp");
}
