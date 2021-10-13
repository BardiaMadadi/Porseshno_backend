<?php


class history
{

    # MAKE ANSWER HISTORY________________________________________________________________________________________________________________________________
    function make_answer_history($UserId, $QuestionId, $Comment)
    {
        # Incloud db file
        include_once "../config/db.php";
        if ($conn) {
            # if we are connected to server :
            if (mysqli_query($conn, "SELECT * FROM `questions` WHERE `questionId`='$QuestionId';")) {
                # if can select user :
                if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `questions` WHERE `questionId`='$QuestionId';")) == 1) {
                    # if just there is just 1 user :

                    if (mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$UserId';")) {
                        # if can select user :

                        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$UserId';")) == 1) {

                            $nameOfTable = "Answer_" . $QuestionId . "_data";

                            $createTableQuery = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `$nameOfTable`(
                                userId int NOT NULL,
                                questionId int NOT NULL,
                                comment varchar(200) NOT NULL);");
                            if ($createTableQuery) {

                                $insertQuery = mysqli_query($conn, "INSERT INTO `$nameOfTable` VALUES ('$UserId','$QuestionId','$Comment');");
                                if ($insertQuery) {

                                    response_answer_history_send(200,"Done !");

                                } else {
                                    response_answer_history_send(404,"Cant Insert Sadge!");
                                }
                            } else {

                                response_answer_history_send(304,"Cant Make Table");

                            }
                        } else {
                            # if there is not 1 user :
                            response_answer_history_send(1445, "There is more User with that info");
                        }
                    } else {
                        # if cant select user
                        response_answer_history_send(1445, "Cant Handle User (May be  there is not any user)");
                    }
                } else {
                    # if cant there is more question
                    response_answer_history_send(1445, "There is more Question with that info");
                }
            } else {
                # if cant select question
                response_answer_history_send(1445, "Cant handle Question");
            }
        } else {
            # if connection lost
            response_answer_history_send(1445, "Connection Lost =(");
        }
    }


    # GET ANSWER HISTORY________________________________________________________________________________________________________________________________


    function get_answer_history($UserId)
    {
        # Incloud db connection
        include_once "../config/db.php";

        if (mysqli_query($conn, "SELECT * FROM `users` WHERE `userId` = '$UserId';")) {
            # If can select user :

            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId` = '$UserId';")) == 1) {
                # If there is just 1 User with that Id :

                static $counter = 0;

                $fileName = "userHistory_" . $UserId . ".json";
                if (file_exists("../historys/" . $fileName)) {
                    echo "[";
                    $file = file_get_contents("../historys/" . $fileName);
                    $Historys = json_decode($file, true);

                    foreach ($Historys as $History) {
                        global $counter;
                        if ($counter != 0) {
                            echo ",";
                        }


                        # SELECT Query
                        $QuestionId = $History["QuestionId"];
                        $Query = "SELECT `views`,`answers`,`description`,`questionName` FROM `questions` WHERE `questionId` = '$QuestionId';";
                        if (mysqli_query($conn, $Query)) {
                            echo json_encode(mysqli_fetch_array(mysqli_query($conn, $Query), MYSQLI_ASSOC));
                        } else {
                            # If Cant handle Query :
                            response_answer_history_get(400, "Cant handle Query");
                        }
                        $counter++;
                    }
                    echo "]";
                } else {
                    echo "[]";
                }
            } else {
                # If there is not user with that info :
                response_answer_history_get(400, "there is not user with that info");
            }
        } else {
            # if cant select user
            response_answer_history_get(400, "cant select user");
        }
    }




    function get_history_order_history($UserId)
    {


        include_once '../config/db.php';

        $orders = mysqli_fetch_all(mysqli_query($conn, "SELECT `buyedAccount`,`porsnoTrackId`,`amount`,`date` FROM `orders` WHERE `userId` = '$UserId'; "), MYSQLI_ASSOC);
        echo json_encode($orders, true);
    }
}












function response_answer_history_send($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
function response_order_history_get($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}


function response_answer_history_get($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
