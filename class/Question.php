<?php

class Question
{


    // Variable
    public $icon = '';
    public $questionName = '';
    public $start = '';
    public $end = '';
    public $userId = '';
    public $questionDecription = '';
    public $questionCat = '';
    public $questionView = '';
    public $answerNumber = '';
    public $question = '';



    //   SETTER_________________________________
    function set_icon($inp)
    {

        $this->icon = str_replace(' ', '', $inp);
    } //End______________________________________


    function set_questionName($inp)
    {

        $this->questionName = $inp;
    } //End______________________________________

    function set_start($inp)
    {

        $this->start = str_replace(' ', '', $inp);
    } //End______________________________________

    function set_end($inp)
    {

        $this->end = str_replace(' ', '', $inp);
    } //End______________________________________


    function set_userId($inp)
    {

        $this->userId = str_replace(' ', '', $inp);
    } //End______________________________________


    function set_question_Description($inp)
    {

        $this->questionDecription = $inp;
    } //End______________________________________



    function set_questionCat($inp)
    {

        $this->questionCat = str_replace(' ', '', $inp);
    } //End______________________________________



    function set_question($inp)
    {

        $this->question = stripcslashes($inp);
    } //End______________________________________


    //END OF SETTER______________________________



    //select user________________________________
    function SELECT_USER($id, $phoneNumber)
    {
        include_once '../config/db.php';
        $query = "SELECT * FROM `users` WHERE `userId`='$id' AND `phoneNumber` = '$phoneNumber' ";
        return mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_ASSOC);
    }


    //SEND VIEW________________________________
    function send_view($id)
    {
        include_once '../config/db.php';
        $select_q = "SELECT * FROM `questions` WHERE `questionId`='$id' LIMIT 1";
        if (mysqli_num_rows(mysqli_query($conn, $select_q)) == 1) {
            $view =  mysqli_fetch_array(mysqli_query($conn, $select_q), MYSQLI_ASSOC)['views'];
            $finalView = intval($view);
            $finalView += 1;
            $query = "UPDATE `questions` SET `views`= '$finalView' WHERE `questionId`='$id' LIMIT 1";
            mysqli_query($conn, $query);
            response_post_question(200, "Done!", null);
        } else {
            response_post_question(400, "Fail!", null);
        }
    }



    //GET_QUESTION_______________________________

    function GET_QUESTION($stt, $inp)
    {

        include '../config/db.php';

        switch ($stt) {
            case "search":
                $Query = "SELECT * FROM `questions` WHERE `questionName` LIKE '%$inp%';";
                $Question = mysqli_fetch_all(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                echo json_encode($Question, true);
                break;
            case "qId":
                $Query = "SELECT * FROM `questions` WHERE `questionId` = '$inp' ";
                $Question = mysqli_fetch_array(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                echo json_encode($Question, true);
                break;
            case "uId":
                $Query = "SELECT * FROM `questions` WHERE `userId` = '$inp' ";
                $Question = mysqli_fetch_all(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                echo json_encode($Question, true);
                break;
            default:
                $Query = "SELECT * FROM `questions`";
                $Question = mysqli_fetch_all(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                echo json_encode($Question,true);




        }
    }








    //POST QUESTION______________________________
    function POST_QUESTION()
    {

        include_once '../config/db.php';


        if ($conn) {

            // VARIBALE________________________________________
            $icon = $this->icon;
            $start = $this->start;
            $start = trim($start);
            $questionName = $this->questionName;;
            $end = $this->end;
            $end = trim($end);
            $userId = $this->userId;
            $end = trim($end);
            $questionDecription = $this->questionDecription;
            $questionCat = $this->questionCat;
            $questionView = 0;
            $answerNumber = 0;
            $question = $this->question;


            if (isset($icon) && isset($start) && isset($questionName) && isset($end) && isset($userId)  && isset($questionDecription)  && isset($questionCat)  && isset($questionView)  && isset($answerNumber)  && isset($question)) {
                //if values are set::

                $check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `questions` WHERE `icon` = '$icon' AND `questionName` = '$questionName' AND `start` = '$start' AND `end` = '$end' AND `description` = '$questionDecription' AND  `cat` = '$questionCat' AND `views` = '$questionView' AND `answers` = '$answerNumber' AND `question` = '$question'"));


                if ($check == 0) {

                    //if Question dose not exist ::

                    if (intval(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId' LIMIT 1"), MYSQLI_ASSOC)['questionRemaining']) > 0) {


                        if (time() < intval(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId' LIMIT 1"), MYSQLI_ASSOC)['end'])) {


                            if (intval($end) < intval(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId' LIMIT 1"), MYSQLI_ASSOC)['end'])) {



                                //INSERT DATA_______________________________________
                                $INSERT_query = "INSERT INTO questions VALUES (null,'$icon', '$questionName', '$start', '$end', '$userId', '$questionDecription', '$questionCat', '$questionView', '$answerNumber', '$question');";
                                mysqli_query($conn, $INSERT_query);


                                //GET ID___________________________________________
                                $ID_QUERY = "SELECT * FROM `questions` WHERE `icon` = '$icon' AND `questionName` = '$questionName' AND `start` = '$start' AND `end` = '$end' AND `userId` = '$userId' AND `description` = '$questionDecription' 
                            AND  `cat` = '$questionCat' AND `views` = '$questionView' AND `answers` = '$answerNumber' AND `question` = '$question'";
                                $SELECT_ID = mysqli_query($conn, $ID_QUERY);
                                $postId = mysqli_fetch_array($SELECT_ID, MYSQLI_ASSOC)['questionId'];


                                //MAKE ANSWER TABLE_______________________________
                                $anser_table_name = 'Answer' . "_" . $postId;
                                $TABLE_query = "CREATE TABLE `$anser_table_name` (userId varchar(10), username varchar(20) ,date varchar(50) , Answer longtext);";
                                mysqli_query($conn, $TABLE_query);

                                // question reamaning


                                $select_u = "SELECT * FROM `users` WHERE `userId`='$userId' LIMIT 1";
                                $questionRemaining =  mysqli_fetch_array(mysqli_query($conn, $select_u), MYSQLI_ASSOC)['questionRemaining'];
                                $finalquestionRemaining = intval($questionRemaining);
                                $finalquestionRemaining -= 1;
                                $query = "UPDATE `users` SET `questionRemaining`= '$finalquestionRemaining' WHERE `userId`='$userId' LIMIT 1";
                                mysqli_query($conn, $query);
                                response_post_question(200, "Question Created", null);
                            } else {
                                response_post_question(500, "Your question end is higher than end of subscription", null);
                            }
                        } else {
                            response_post_question(404, "Your subscription time ended !", null);
                        }
                    } else {

                        response_post_question(403, "Your subscription question number is done!", null);
                    }
                } else {

                    response_post_question(400, "there is question with that information by this user", null);
                }
            } else {


                response_post_question(400, "You have to put all inputs", null);
            }
        } else {


            response_post_question(400, "Can not connect to server", null);
        }
    }
}


function safe($data, $cutval)
{

    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = substr($data, 0, $cutval);
    $data = str_replace('/', '', $data);
    $data = str_replace('<', '', $data);
    $data = str_replace('>', '', $data);
    $data = str_replace('#', '', $data);
    $data = str_replace('--', '', $data);
    $data = str_replace('SELECT', '', $data);
    $data = str_replace('OR', '', $data);
    return $data;
}

function hash_pwd($data)
{
    $pwd = strlen($data) . 'dogs_are_fun' . $data . "AND_I_HATE_CATS";
    $data = md5($pwd);
    return $data;
}

function response_login($code, $message, $data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    if ($code == 200) {
        $response['Id'] = $data['userId'];
        $response['userName'] = $data['userName'];
        $response['phoneNumber'] = $data['phoneNumber'];
        $response['birthday'] = $data['birthday'];
        $response['accountLevel'] = $data['accountLevel'];
        $response['created'] = $data['created'];
        $response['end'] = $data['end'];
    }
    echo json_encode($response, true);
}
function response_post_question($code, $message, $data)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
