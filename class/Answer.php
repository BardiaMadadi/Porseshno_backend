<?php
class Answer
{

    public $userId;
    public $questionId;
    public $userName;
    public $date;
    public $answer;
    public $comment;

    function __construct($userId, $userName, $date, $answer, $questionId,$comment)
    {
        $this->userId = trim($userId);
        $this->userName = $userName;
        $this->date = trim($date);
        $this->answer = $answer;
        $this->questionId = trim($questionId);
        $this->comment = $comment;
    }

    function add_answer()
    {
        include_once '../config/db.php';
        include_once '../functions/Answer_functions.php';
        $uId = $this->userId;
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$uId'")) == 1) {
            $qId = $this->questionId;
            $qId = trim($qId);
            $uName = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$uId'"))['userName'];
            $answers_num = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `questions` WHERE `questionId`='$qId';"))['answers'];
            $answers_f_num  = intval($answers_num) + 1;
            $answer_table_name = 'Answer_' . $qId;
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `$answer_table_name` WHERE `userId`='$uId'")) == 0 ) {

                $date = $this->date;
                $answer = $this->answer;

                
                

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'http://185.190.39.159/Porseshno_backend/API/History_add_answer.php');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, [
                        'userId' => $uId,
                        'questionId' => $qId
                    ]);
                    $response = curl_exec($ch);
                    $response_arr = json_decode($response, true);
                    if($response_arr["status_code"] == 200)
                    {
                     
                        $comment = $this->comment;

                        if (
                            mysqli_query($conn, "INSERT INTO `$answer_table_name` VALUES ('$uId', '$uName', '$date', '$answer', '$comment');") == true &&
                            mysqli_query($conn, "UPDATE `questions` SET `answers`='$answers_f_num' WHERE `questionId`='$qId'") == true
                        ) {

                            response_Answer(200,"Answer sent");



                        } else {
                            response_Answer(400,mysqli_query($conn, "Ohhh shit this problem as usuall"));
                            
                        }



                    }else{
                        response_Answer(400,"There is problem with Add History");

                    }


                
            } else {

                response_Answer(400,"User is spaming");


            }
        } else {
            response_Answer(400,"user dose not exist");

        }


    }



    function AgoAnswers($qId){

        








    }








    function answer_get($qId){
        include_once '../config/db.php';
        include_once '../functions/Answer_functions.php';
        $table_name = 'Answer_'.$qId;
        if(mysqli_query($conn,"SELECT * FROM `$table_name`")){
            echo json_encode(mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM `$table_name`"),MYSQLI_ASSOC),true);

        }else{
            response_Answer(400,"Answer TABLE dose not exist");
        }
    }

    function comment_get($qId){
        require_once "../config/db.php";
        require_once "../functions/Answer_functions.php";
        $table_name = 'Answer_'.$qId;
        if(mysqli_query($conn,"SELECT `Comment` FROM `$table_name`")){
            echo json_encode(mysqli_fetch_all(mysqli_query($conn,"SELECT `Comment` FROM `$table_name`"),MYSQLI_ASSOC),true);

        }else{
            response_Answer(400,"Answer TABLE dose not exist");
        }
    }




   
}

