<?php

use phpDocumentor\Reflection\PseudoTypes\True_;

class history
{

    # MAKE ANSWER HISTORY________________________________________________________________________________________________________________________________
    function make_answer_history($UserId, $QuestionId)
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

                            # if just there is 1 user with that information :

                            #make name of history table
                            $name = "answers_history_{$UserId}";
                            # Query of making table
                            $CreateQuery = "CREATE TABLE IF NOT EXISTS {$name} (
                                        `questionId` VARCHAR(30) NOT NULL
                                        )";

                            if (mysqli_query($conn, $CreateQuery)) {

                                # if can run that query :
                                if (mysqli_query($conn, "INSERT INTO {$name} VALUE('$QuestionId');")) {
                                    # if can Insert :
                                    response_answer_history_send(200, "Done");
                                } else {
                                    # else :
                                    response_answer_history_send(1445, "Cant Insert (make)");
                                }
                            } else {
                                # if cant run query : (database already created) : 
                                if (mysqli_query($conn, "INSERT INTO {$name} VALUE('$QuestionId');")) {
                                    # if can insert :
                                    response_answer_history_send(200, "Done");
                                } else {
                                    # if cant insert :
                                    response_answer_history_send(1445, "Cant Insert");
                                }
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
                $name = "answers_history_{$UserId}";

                # SELECT Query
                $Query = "SELECT questions.views,questions.answers,questions.description,questions.questionName
                FROM questions
                INNER JOIN {$name}
                ON {$name}.questionId = questions.questionId";
                if (mysqli_query($conn, $Query)) {

                    # If Can Handle Question

                    if (mysqli_num_rows(mysqli_query($conn, $Query)) !== 0) {

                        # If there is more Question


                        echo json_encode(mysqli_fetch_all(mysqli_query($conn, $Query), MYSQLI_ASSOC), true);
                    } else {

                        # If There is not Answer Question
                        echo "[]";
                    }
                } else {
                    # If Cant handle Query :
                    response_answer_history_get(400, "Cant handle Query");
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




    function get_history_order_history($UserId){


        include_once '../config/db.php';
        
        $orders = mysqli_fetch_all(mysqli_query($conn,"SELECT `buyedAccount`,`porsnoTrackId`,`amount`,`date` FROM `orders` WHERE `userId` = '$UserId'; "),MYSQLI_ASSOC);
        echo json_encode($orders,true);
    
    
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
