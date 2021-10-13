<?php
class Answer
{

    public $userId;
    public $questionId;
    public $userName;
    public $date;
    public $answer;
    public $comment;

    function __construct($answer, $questionId, $userId)
    {
        $this->questionId = str_replace(" ", "", $questionId);
        $this->answer = $answer;
        $this->userId = $userId;
    }

    function add_answer()
    {
        include_once '../config/db.php';
        include_once '../functions/Answer_functions.php';


        $qId = $this->questionId;
        $answer = $this->answer;
        $uId = $this->userId;


        $fileName = "answer_" . $qId . "_" . $uId . ".json";
        if (!file_exists("../answers/" . $fileName)) {

            $myfile = fopen("../answers/" . $fileName, "w") or die("Unable to open file!");
            $txt = "[]";
            fwrite($myfile, $txt);
            fclose($myfile);
            file_put_contents("../answers/" . $fileName, $answer);
        }





        $fileOfAnswers = file_get_contents("../answers/" . $fileName);
        $query = mysqli_query($conn, "UPDATE `questions` SET `userAnswers` = '$fileOfAnswers' WHERE questionId = '$qId';");
        if ($query) {
            echo $fileOfAnswers;
        } else {
            echo "shit SQL";
        }
        unlink("../answers/" . $fileName);
    }



    function AgoAnswers()
    {
        $qId = $this->questionId;
        $fileName = "answer_" . $qId . ".json";
        $AnswerFile = file_get_contents("../answers/" . $fileName);
        include_once '../config/db.php';
        include_once '../functions/Answer_functions.php';
        $AnswerFileArr = json_decode($AnswerFile, true);
        $Ago = time() - 86400;
        static $count = 0;
        static $Agos = 0;

        foreach ($AnswerFileArr as $Answer) {
            global $count;
            global $Agos;
            if ($count !== 0) {
                if (intval($AnswerFileArr[$count - 1]["questionNumber"]) !== intval($Answer["questionNumber"])) {
                    if (intval($Answer['date']) > $Ago) {

                        $Agos++;
                    }
                }
            }
            $count++;
        }
        echo $Agos;
    }








    function answer_get($qId)
    {
        include_once '../config/db.php';
        include_once '../functions/Answer_functions.php';

        $selectQuery = mysqli_query($conn, "SELECT `userAnswers` FROM `questions` WHERE `questionId` = '$qId'");
        if($selectQuery){

            if(mysqli_num_rows($selectQuery) !== 0){

                echo mysqli_fetch_array($selectQuery,MYSQLI_ASSOC)["userAnswers"];

            }else{
                response_Answer(400,"There is not any question");
            }



        }else{
            response_Answer(400,"Cant Handle Query may be there is not any Q");
        }
    }

    function comment_get($QuestionId)
    {
        require_once "../config/db.php";
        require_once "../functions/Answer_functions.php";
        $nameOfTable = "Answer_" . $QuestionId . "_data";
        $getCommentQuery = mysqli_query($conn,"SELECT `comment` FROM `$nameOfTable`");
        if ($getCommentQuery) {
            echo json_encode(mysqli_fetch_all($getCommentQuery, MYSQLI_ASSOC), true);
        } else {
            response_Answer(400, "Answer TABLE dose not exist");
        }
    }
}
