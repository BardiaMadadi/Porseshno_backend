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
        # incloud 
        include_once '../config/db.php';
        $select_q = "SELECT * FROM `questions` WHERE `questionId` = '$id';";
        if (mysqli_query($conn, $select_q)) {

            if (mysqli_num_rows(mysqli_query($conn, $select_q)) == 1) {
                $view =  mysqli_fetch_array(mysqli_query($conn, $select_q), MYSQLI_ASSOC)['views'];
                $finalView = intval($view);
                $finalView += 1;
                $query = "UPDATE `questions` SET `views`= '$finalView' WHERE `questionId`='$id'";
                mysqli_query($conn, $query);
                response_post_question(200, "Done!", null);
            } else {
                response_post_question(400, "Fail!", null);
            }
        } else {

            response_post_question(400, "Cant Handle!", null);
        }
    }





    function EditQuestion($userId, $questionId, $title, $desc, $start, $end)
    {

        include_once '../config/db.php';
        if ($conn) {

            #-select user query
            $SelectUserQuery = "SELECT `end` FROM `users` WHERE `userId` = '$userId' LIMIT 1;";
            if (mysqli_query($conn, $SelectUserQuery)) {
                #if can handle query
                if (mysqli_fetch_array(mysqli_query($conn, $SelectUserQuery), MYSQLI_ASSOC)) {
                    $User = mysqli_fetch_array(mysqli_query($conn, $SelectUserQuery), MYSQLI_ASSOC);
                    # if can handle select user data :
                    if ($User["end"] > $end) {
                        # if end is valid
                        $SelectQuestionQuery = "SELECT `questionId` FROM `questions` WHERE `questionId` = '$questionId' LIMIT 1;";
                        if (mysqli_query($conn, $SelectQuestionQuery)) {
                            #if can handle query
                            if (mysqli_num_rows(mysqli_query($conn, $SelectQuestionQuery)) == 1) {

                                $UpdateQuery = "UPDATE `questions` SET `start` = '$start', `end` = '$end', `questionName` = '$title', `description` = '$desc' WHERE `questionId` = '$questionId';";
                                if (mysqli_query($conn, $UpdateQuery)) {
                                    response_edit_question(200, "DONE !");
                                } else {
                                    response_edit_question(400, "cant handle Update");
                                }
                            } else {
                                response_edit_question(400, "there is not question with that qId");
                            }
                        } else {
                            response_edit_question(400, "cant handle select q");
                        }
                    } else {
                        response_edit_question(400, "end is not valid");
                    }
                } else {
                    response_edit_question(400, "cant fetch User");
                }
            } else {
                response_edit_question(400, "cant handle select user");
            }
        }
    }









    //GET_QUESTION_______________________________

    function GET_QUESTION($stt, $inp)
    {

        include '../config/db.php';

        switch ($stt) {
            case "search":
                $Query = "SELECT `questionId`,`icon`,`questionName`,`start`,`end`,`userId`,`description`,`cat`,`views`,`answers`,`userAnswers` FROM `questions` WHERE `questionName` LIKE '%$inp%';";
                $Question = mysqli_fetch_all(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                echo json_encode($Question, true);
                break;
            case "qId":



                $cURLConnection = curl_init();

                curl_setopt($cURLConnection, CURLOPT_URL, "http://185.190.39.159/Porseshno_backend/API/Question_send_view.php?id={$inp}");
                curl_setopt($cURLConnection, CURLOPT_POST, true);
                curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, ["id" => $inp]);
                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($cURLConnection);
                $response = json_decode($response, true);
                if ($response["status_code"] == 200) {

                    $time = time();
                    $Query = "SELECT * FROM `questions` WHERE `questionId` = '$inp';";
                    $Question = mysqli_fetch_array(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                    echo json_encode($Question, true);
                } else {
                    echo json_encode($response);
                }



                curl_close($cURLConnection);

                break;
            case "uId":
                $Query = "SELECT `questionId`,`icon`,`questionName`,`start`,`end`,`userId`,`description`,`cat`,`views`,`answers` FROM `questions` WHERE `userId` = '$inp' ";
                $Question = mysqli_fetch_all(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                echo json_encode($Question, true);
                break;
            default:
                $time = time();
                $Query = "SELECT `questionId`,`icon`,`questionName`,`start`,`end`,`userId`,`description`,`cat`,`views`,`answers` FROM `questions` WHERE $time > `start`;";
                $Question = mysqli_fetch_all(mysqli_query($conn, $Query), MYSQLI_ASSOC);
                echo json_encode($Question, true);
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
                                $INSERT_query = "INSERT INTO questions VALUES (null,'$icon', '$questionName', '$start', '$end', '$userId', '$questionDecription', '$questionCat', '$questionView', '$answerNumber', '$question', '0','0','[]');";

                                //GET ID___________________________________________


                                // $ID_QUERY = "SELECT * FROM `questions` WHERE `icon` = '$icon' AND `questionName` = '$questionName' AND `start` = '$start' AND `end` = '$end' AND `userId` = '$userId' AND `description` = '$questionDecription' 
                                // AND  `cat` = '$questionCat' AND `views` = '$questionView' AND `answers` = '$answerNumber' AND `question` = '$question'";


                                if (mysqli_query($conn, $INSERT_query)) {

                                    // question reamaning

                                    $select_u = "SELECT * FROM `users` WHERE `userId`='$userId' LIMIT 1";


                                    if (mysqli_query($conn, $select_u)) {

                                        # Get reamaining :

                                        $questionRemaining =  mysqli_fetch_array(mysqli_query($conn, $select_u), MYSQLI_ASSOC)['questionRemaining'];
                                        $finalquestionRemaining = intval($questionRemaining);
                                        $finalquestionRemaining -= 1;

                                        # new Reamining :

                                        # update user and set questionRemaining :
                                        $query = "UPDATE `users` SET `questionRemaining`= '$finalquestionRemaining' WHERE `userId`='$userId' LIMIT 1";


                                        # if can do query

                                        if (mysqli_query($conn, $query)) {


                                            # Response :
                                            response_post_question(200, "Question Created", null);
                                        } else {

                                            $questionRemaining =  mysqli_fetch_array(mysqli_query($conn, $select_u), MYSQLI_ASSOC)['questionRemaining'];
                                            $finalquestionRemaining = intval($questionRemaining);
                                            $finalquestionRemaining -= 1;
                                            response_post_question(400, "We are in LEVEL : 4", null);
                                            $plusReamainig = $finalquestionRemaining + 1;
                                            mysqli_query($conn, "UPDATE `users` SET `questionRemaining`= '$plusReamainig' WHERE `userId`='$userId' LIMIT 1");
                                        }
                                    } else {
                                        response_post_question(400, "We are in LEVEL : 3", null);
                                    }
                                } else {
                                    response_post_question(400, "We are in LEVEL : 1", null);
                                }
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





    function send_like($QuestionId)
    {

        include_once '../config/db.php';


        $QuestionId = trim($QuestionId);


        $SelectQuestionQuery = "SELECT * FROM `questions` WHERE `questionId` = '$QuestionId';";

        if (mysqli_query($conn, $SelectQuestionQuery)) {
            if (mysqli_num_rows(mysqli_query($conn, $SelectQuestionQuery)) == 1) {
                $question = mysqli_fetch_array(mysqli_query($conn, $SelectQuestionQuery), MYSQLI_ASSOC);
                $currentLike = intval($question["like"]);
                $nextLike = $currentLike + 1;
                if (mysqli_query($conn, "UPDATE `questions` SET `like`='$nextLike';")) {
                    response_send_like(200, "Done !");
                } else {
                    response_send_like(400, "Cant Handle Update");
                }
            } else {
                response_send_like(400, "There is sno question with that info");
            }
        } else {

            response_send_like(400, "cant handle query");
        }
    }





    function send_dislike($QuestionId)
    {

        include_once '../config/db.php';


        $QuestionId = trim($QuestionId);


        $SelectQuestionQuery = "SELECT * FROM `questions` WHERE `questionId` = '$QuestionId';";

        if (mysqli_query($conn, $SelectQuestionQuery)) {
            if (mysqli_num_rows(mysqli_query($conn, $SelectQuestionQuery)) == 1) {
                $question = mysqli_fetch_array(mysqli_query($conn, $SelectQuestionQuery), MYSQLI_ASSOC);
                $currentLike = intval($question["dislike"]);
                $nextLike = $currentLike + 1;
                if (mysqli_query($conn, "UPDATE `questions` SET `dislike`='$nextLike';")) {
                    response_send_dislike(200, "Done !");
                } else {
                    response_send_dislike(400, "Cant Handle Update");
                }
            } else {
                response_send_dislike(400, "There is sno question with that info");
            }
        } else {

            response_send_dislike(400, "cant handle query");
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
function response_post_question($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}

function response_send_like($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
function response_send_dislike($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
function response_edit_question($code, $message)
{
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}
