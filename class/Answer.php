<?php
class Answer
{

    public $userId;
    public $questionId;
    public $userName;
    public $date;
    public $answer;

    function __construct($userId, $userName, $date, $answer, $questionId)
    {
        $this->userId = trim($userId);
        $this->userName = $userName;
        $this->date = trim($date);
        $this->answer = trim($answer);
        $this->questionId = trim($questionId);
    }

    function add_answer()
    {
        include_once '../config/db.php';
        include_once '../functions/Answer_functions.php';
        $uId = $this->userId;
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$uId'")) == 1) {
            $qId = $this->questionId;
            $uName = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$uId'"))['userName'];
            $answers_num = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `questions` WHERE `questionId`='$qId';"))['answers'];
            $answers_f_num  = intval($answers_num) + 1;
            $answer_table_name = 'answer_' . $qId;
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `$answer_table_name` WHERE `userId`='$uId'")) == 0 ) {

                $date = $this->date;
                $answer = $this->answer;

                
                if (
                    mysqli_query($conn, "INSERT INTO `$answer_table_name`(`userId`, `username`, `date`, `Answer`) VALUES ('$uId', '$uName', '$date', '$answer');") == true &&
                    mysqli_query($conn, "UPDATE `questions` SET `answers`='$answers_f_num' WHERE `questionId`='$qId'") == true
                ) {

                    
                    response_Answer(200,"Answer sent");

                } else {
                    response_Answer(400,"There is problem with sending");
                }
            } else {

                response_Answer(400,"User is spaming");


            }
        } else {
            response_Answer(400,"user dose not exist");

        }
    }




   
}

