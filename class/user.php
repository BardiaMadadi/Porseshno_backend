<?php


class user
{

    public $userName;
    public $phoneNumber;
    public $pwd;
    public $birthday;
    public $accountLevel;
    public $created;
    public $end;

    // function __construct($userName, $phoneNumber, $pwd, $birthday, $accountLevel, $created, $end)
    // {
    //     include '../functions/user_API_functions.php';
    //     $this->userName = safe($userName, 50);
    //     $this->phoneNumber = safe($phoneNumber, 12);
    //     $this->pwd = hash_pwd($pwd);
    //     $this->birthday = safe($birthday, 50);
    //     $this->accountLevel = safe($accountLevel, 25);
    //     $this->created = safe($created, 50);
    //     $this->end = safe($end, 50);
    // }

    //set username
    function set_username($userName)
    {
        $this->userName = safe($userName, 50);
    }

    //set phone
    function set_phoneNumber($phoneNumber)
    {
        $this->phoneNumber = safe($phoneNumber, 12);
    }


    // set pwd
    function set_pwd($pwd)
    {
        $this->pwd = hash_pwd($pwd);
    }


    //set birthday
    function set_birthday($birthday)
    {
        $this->birthday = safe($birthday, 50);
    }

    //set level
    function set_accountLevel($accountLevel)
    {
        $this->accountLevel = safe($accountLevel, 25);
    }


    //set created
    function set_created($created)
    {
        $this->created = safe($created, 50);
    }


    //set end
    function set_end($end)
    {
        $this->end = safe($end, 50);
    }


    function EditUser($userId)
    {

        include_once '../config/db.php';

        $userName = $this->userName;
        $pwd = $this->pwd;
        $birthday = $this->birthday;
        if ($pwd == "0fe0229266a191f497761736b0f94a7c") {

            $Query = "UPDATE `users` SET `userName`='$userName',`birthday`='$birthday' WHERE `userId`='$userId';";
        } else {
            $Query = "UPDATE `users` SET `userName`='$userName',`pwd`='$pwd',`birthday`='$birthday' WHERE `userId`='$userId';";
        }

        if (mysqli_query($conn, $Query) && mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId'")) {

            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId' LIMIT 2")) == 1) {
                response_post_question(200, "Changed", null);
            } else {
                response_post_question(400, "There is not user with that info", null);
            }
        } else {
            response_post_question(400, "cant handle", null);
            var_dump(mysqli_query($conn, $Query));
            var_dump(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId'"));
        }
    }






    function insertUser()
    {
        require '../config/db.php';
        //Insert User
        if ($conn) {
            $insertUserQuery = "INSERT INTO users VALUES (NULL,'$this->userName','$this->phoneNumber','$this->pwd','$this->birthday','$this->accountLevel','2','$this->created','$this->end' )";
            mysqli_query($conn, $insertUserQuery);
        }
    }
    function selectUser()
    {
        //SELECT user to check
        require '../config/db.php';
        if ($conn) {
            $phoneNumber = $this->phoneNumber;
            $SELECTQUERY = "SELECT * FROM `users` WHERE `phoneNumber`='$phoneNumber' ";
            $rows = mysqli_num_rows(mysqli_query($conn, $SELECTQUERY));
            return $rows;
        }
    }


    //login function
    function login()
    {


        include '../config/db.php';

        if ($conn) {

            $phoneNumber = $this->phoneNumber;

            $pwd = $this->pwd;



            $SELECTQUERY = "SELECT * FROM `users` WHERE `phoneNumber`='$phoneNumber' AND `pwd`='$pwd' LIMIT 1";


            if (mysqli_num_rows(mysqli_query($conn, $SELECTQUERY)) == 1) {


                $userInfo = mysqli_fetch_array(mysqli_query($conn, $SELECTQUERY), MYSQLI_ASSOC);

                $responseInfo = array(
                    'userId' => $userInfo['userId'],
                    'userName' => $userInfo['userName'],
                    'phoneNumber' => $userInfo['phoneNumber'],
                    'birthday' => $userInfo['birthday'],
                    'accountLevel' => $userInfo['accountLevel'],
                    'created' => $userInfo['created'],
                    'end' => $userInfo['end']

                );

                response_login(200, "User Found", $responseInfo);
            } else {

                response_login(201, "User Not Found", null);
            }
        }
    }
}






//functions__________________________________________________________


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
