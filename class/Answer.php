<?php
class Answer
{

    public $userId;
    public $questionId;
    public $userName;
    public $date;
    public $answer;
    public $comment;

    function __construct($answer, $questionId)
    {
        $this->answer = $answer;
        $this->questionId = str_replace(" ", "", $questionId);
    }

    function add_answer()
    {
        include_once '../config/db.php';
        include_once '../functions/Answer_functions.php';


        $qId = $this->questionId;
        $answer = $this->answer;


        $fileName = "answer_" . $qId . ".json";
        if (!file_exists("../answers/" . $fileName)) {

            $myfile = fopen("../answers/" . $fileName, "w") or die("Unable to open file!");
            $txt = "[]";
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        $AnswerFile = file_get_contents("../answers/" . $fileName);
        #append :
        $base = json_decode($AnswerFile, true);
        $Array = json_decode($answer, true);

        array_push($base, $Array);

        file_put_contents("../answers/" . $fileName, json_encode($base));


        $updateQuery = mysqli_query($conn, "UPDATE `questions` SET `userAnswers` = '$answer' WHERE `questionId` = '$qId';");
        if ($updateQuery) {
            response_Answer(200, "Cant Updatre");
            var_dump(json_decode($answer, true));
        } else {
            response_Answer(400, "Cant Updatre");
        }
    }



    function AgoAnswers()
    {
        $qId = $this->questionId;
        $fileName = "answer_103.json";
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
        $table_name = 'Answer_' . $qId;
        if (mysqli_query($conn, "SELECT * FROM `$table_name`")) {
            echo json_encode(mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `$table_name`"), MYSQLI_ASSOC), true);
        } else {
            response_Answer(400, "Answer TABLE dose not exist");
        }
    }

    function comment_get($qId)
    {
        require_once "../config/db.php";
        require_once "../functions/Answer_functions.php";
        $table_name = 'Answer_' . $qId;
        if (mysqli_query($conn, "SELECT `Comment` FROM `$table_name`")) {
            echo json_encode(mysqli_fetch_all(mysqli_query($conn, "SELECT `Comment` FROM `$table_name`"), MYSQLI_ASSOC), true);
        } else {
            response_Answer(400, "Answer TABLE dose not exist");
        }
    }
}
