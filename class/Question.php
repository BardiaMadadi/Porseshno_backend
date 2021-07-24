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

        $this->icon = $inp;
    } //End______________________________________


    function set_questionName($inp)
    {

        $this->questionName = $inp;
    } //End______________________________________

    function set_start($inp)
    {

        $this->start = $inp;
    } //End______________________________________

    function set_end($inp)
    {

        $this->end = $inp;
    } //End______________________________________


    function set_userId($inp)
    {

        $this->userId = $inp;
    } //End______________________________________


    function set_question_Description($inp)
    {

        $this->questionDecription = $inp;
    } //End______________________________________



    function set_questionCat($inp)
    {

        $this->questionCat = $inp;
    } //End______________________________________



    function set_question($inp)
    {

        $this->question = $inp;
    } //End______________________________________


    //END OF SETTER______________________________



















    //select user________________________________
    function SELECT_USER($id, $phoneNumber)
    {
        include '../config/db.php';
        $query = "SELECT * FROM `users` WHERE `userId`='$id' AND `phoneNumber` = '$phoneNumber' ";
        return mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_ASSOC);
    }















    //POST QUESTION______________________________
    function POST_QUESTION()
    {

        include '../config/db.php';
        include '../functions/user_API_functions.php';


        if ($conn) {

            // VARIBALE________________________________________
            $icon = $this->icon;
            $start = $this->start;
            $questionName = $this->questionName;;
            $end = $this->end;
            $userId = $this->userId;
            $questionDecription = $this->questionDecription;
            $questionCat = $this->questionCat;
            $questionView = 0;
            $answerNumber = 0;
            $question = $this->question;


            if (isset($icon) && isset($start) && isset($questionName) && isset($end) && isset($userId)  && isset($questionDecription)  && isset($questionCat)  && isset($questionView)  && isset($answerNumber)  && isset($question)) {


                $check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `questions` WHERE `icon` = '$icon' AND `questionName` = '$questionName' AND `start` = '$start' AND `end` = '$end' AND `userId` = '$userId' AND `description` = '$questionDecription' AND  `cat` = '$questionCat' AND `views` = '$questionView' AND `answers` = '$answerNumber' AND `question` = '$question'"));

                if ($check == 0) {


                    //INSERT DATA_______________________________________
                    $INSERT_query = "INSERT INTO questions VALUES (null,'$icon', '$questionName', '$start', '$end', '$userId', '$questionDecription', '$questionCat', '$questionView', '$answerNumber', '$question');";
                    mysqli_query($conn, $INSERT_query);


                    //GET ID___________________________________________
                    $ID_QUERY = "SELECT * FROM `questions` WHERE `icon` = '$icon' AND `questionName` = '$questionName' AND `start` = '$start' AND `end` = '$end' AND `userId` = '$userId' AND `description` = '$questionDecription' AND  `cat` = '$questionCat' AND `views` = '$questionView' AND `answers` = '$answerNumber' AND `question` = '$question'";
                    $SELECT_ID = mysqli_query($conn, $ID_QUERY);
                    $postId = mysqli_fetch_array($SELECT_ID, MYSQLI_ASSOC)['questionId'];


                    //MAKE ANSWER TABLE_______________________________
                    $anser_table_name = 'Answer' . "_" . $postId;
                    $TABLE_query = "CREATE TABLE `$anser_table_name` (userId varchar(10), username varchar(20) ,date varchar(50) , Answer longtext);";
                    mysqli_query($conn, $TABLE_query);
                    response_post_question(200, "Question Created", null);
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
