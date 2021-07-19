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



    function set_questionView($inp)
    {

        $this->questionView = $inp;
    } //End______________________________________


    function set_Answer_number($inp)
    {

        $this->answerNumber = $inp;
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

        if ($conn) {

            // VARIBALE________________________________________
            $icon = $this->icon;
            $start = $this->start;
            $questionName = $this->questionName;;
            $end = $this->end;
            $userId = $this->userId;
            $questionDecription = $this->questionDecription;
            $questionCat = $this->questionCat;
            $questionView = $this->questionView;
            $answerNumber = $this->answerNumber;
            $question = $this->question;
            $fin_name = $userId . "_" . $questionName;

            //_________________________________________________
            if (!isset($icon) || empty($icon) || !isset($questionName) || empty($questionName) || !isset($start) || empty($start) || !isset($end) || empty($end) || !isset($userId) || empty($userId) || !isset($questionDecription) || empty($questionDecription) || !isset($questionCat) || empty($questionCat) || !isset($questionView) || empty($questionView) || !isset($answerNumber) || empty($answerNumber)) {
            } else {




                //MAKE QUESTION TABLE_______________________________
                $TABLE_query = "CREATE TABLE `$fin_name` (icon longtext ,questionName varchar(20),start varchar(30),end varchar(30),userId int(11),description varchar(200),cat varchar(20),views varchar(10),answers varchar(10),question longtext);";

                mysqli_query($conn, $TABLE_query);

                //__________________________________________________


                //INSERT DATA_______________________________________
                $INSERT_query = "INSERT INTO {$fin_name} VALUES ('$icon', '$questionName', '$start', '$end', '$userId', '$questionDecription', '$questionCat', '$questionView', '$answerNumber', '$question');";
                mysqli_query($conn, $INSERT_query);


                //return____________________________________________

                return ''
            }
        }
    }
}

$q = new Question;
$q->set_icon("icon");
$q->set_questionName("name of Q");
$q->set_start("start");
$q->set_end("end");
$q->set_userId("USER ID");
$q->set_question_Description("desc");
$q->set_questionCat("CATEGOURY");
$q->set_questionView("VIEW");
$q->set_Answer_number("4324");
$q->set_question("JSON");


$q->POST_QUESTION();
