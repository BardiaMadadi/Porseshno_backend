<?php

class Report
{

    // public $qId;
    // public $uId;
    // public $description;

    public function new_report($qId, $uId, $description)
    {

        include_once '../config/db.php';
        $QUERY = mysqli_query($conn, "SELECT * FROM `question_report` WHERE `qId` = '$qId' AND `uId` = '$uId' LIMIT 1;");
        $info = mysqli_fetch_array($QUERY);

        $export = array();

        if ($info == null) {
            $query = "INSERT INTO `question_report` VALUES ('$uId' , '$qId' , '$description')";

            $result  = mysqli_query($conn, $query);


            if ($result) {
                $export['status_code'] = "200";
                $export['message'] = $info;
            } else {
                $export['status_code'] = "402";
                $export['message'] = "error";
            }
        } else {
            $export['status_code'] = "401";
            $export['message'] = "error";
        }

        return $export;
    }
    function GetAllReports()
    {
        include_once '../config/db.php';

        $QueryString = "SELECT * FROM `question_report`";
        $Query = mysqli_query($conn, $QueryString);
        if ($Query) {
            $row = mysqli_fetch_all($Query, MYSQLI_ASSOC);
            if ($row !== null) {
                echo json_encode($row);
            } else {
                respondeGetReports(404, "Row is NULL");
            }
        } else {
            respondeGetReports(404, "Cant Handle");
        }
    }


    # END__________________________________


}


function respondeGetReports($code, $message)
{
    $export['code'] = $code;
    $export['message'] = $message;

    echo json_encode($export);
}
