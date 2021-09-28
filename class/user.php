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
        $this->phoneNumber = $phoneNumber;
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
        $this->end = $end;
    }


    function EditUser($userId)
    {

        include_once '../config/db.php';

        $userName = $this->userName;
        $pwd = $this->pwd;
        $birthday = $this->birthday;
        //if pass word was - 
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


    function GetUsers()
    {

        include_once "../config/db.php";

        $query = "SELECT * FROM `users`";
        $req = mysqli_query($conn, $query);
        if ($req) {
            $row = mysqli_fetch_all($req, MYSQLI_ASSOC);
            if ($row !== null) {

                echo json_encode($row);
            } else {
                response_get_user(404,"Null user");
            }
        } else {
            response_get_user(405,"Cant Handle");
        }
    }



    function upgrade_user($Level, $userId)
    {

        include_once '../config/db.php';
        if (mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId'")) {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId'")) == 1) {
                #there is user with that Id
                $User = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `userId`='$userId'"), MYSQLI_ASSOC);

                switch ($Level) {

                    case "bronze":

                        $Qreamainig = intval($User["questionRemaining"]);
                        $Qreamainig = $Qreamainig + 2;
                        $UEnd = 0;
                        if (time() > intval($User["end"])) {
                            $UEnd = intval(time());
                            $UEnd = $UEnd + 1728000;
                        } else {
                            $UEnd = intval($User["end"]);
                            $UEnd = $UEnd + 1728000;
                        }

                        $Query = "UPDATE `users` SET `accountLevel`='bronze',`questionRemaining`='$Qreamainig',`end`='$UEnd' WHERE `userId`='$userId'";
                        if (mysqli_query($conn, $Query)) {

                            response_post_question(200, "Done", $User["end"]);
                        }
                        break;
                    case "steel":
                        $Qreamainig = intval($User["questionRemaining"]);
                        $Qreamainig = $Qreamainig + 10;
                        $UEnd = 0;
                        if (time() > intval($User["end"])) {
                            $UEnd = intval(time());
                            $UEnd = $UEnd + 5184000;
                        } else {
                            $UEnd = intval($User["end"]);
                            $UEnd = $UEnd + 5184000;
                        }
                        $Query = "UPDATE `users` SET `accountLevel`='steel',`questionRemaining`='$Qreamainig',`end`='$UEnd' WHERE `userId`='$userId'";
                        if (mysqli_query($conn, $Query)) {

                            response_post_question(200, "Done", $User["end"]);
                        }
                        break;
                    case "gold":
                        $Qreamainig = intval($User["questionRemaining"]);
                        $Qreamainig = $Qreamainig + 20;
                        $UEnd = 0;
                        if (time() > intval($User["end"])) {
                            $UEnd = intval(time());
                            $UEnd = $UEnd + 6912000;
                        } else {
                            $UEnd = intval($User["end"]);
                            $UEnd = $UEnd + 6912000;
                        }
                        $Query = "UPDATE `users` SET `accountLevel`='gold',`questionRemaining`='$Qreamainig',`end`='$UEnd' WHERE `userId`='$userId'";
                        if (mysqli_query($conn, $Query)) {

                            response_post_question(200, "Done", $User["end"]);
                        }
                        break;
                    case "diamond":
                        $Qreamainig = intval($User["questionRemaining"]);
                        $Qreamainig = $Qreamainig + 50;
                        $UEnd = 0;
                        if (time() > intval($User["end"])) {
                            $UEnd = intval(time());
                            $UEnd = $UEnd + 9504000;
                        } else {
                            $UEnd = intval($User["end"]);
                            $UEnd = $UEnd + 9504000;
                        }
                        $Query = "UPDATE `users` SET `accountLevel`='diamond',`questionRemaining`='$Qreamainig',`end`='$UEnd' WHERE `userId`='$userId'";
                        if (mysqli_query($conn, $Query)) {

                            response_post_question(200, "Done", $User["end"]);
                        }
                        break;
                }
            }
        }
    }


    function insertUser()
    {
        include_once '../config/db.php';
        //Insert User
        if ($conn) {
            $insertUserQuery = "INSERT INTO `users` VALUES (NULL,'$this->userName','$this->phoneNumber','$this->pwd','$this->birthday','$this->accountLevel','2','$this->created','$this->end' )";
            $phoneNumber = $this->phoneNumber;
            $SELECT = "SELECT * FROM `users` WHERE phoneNumber='$phoneNumber'";

            if (mysqli_query($conn, $insertUserQuery)) {
                if (mysqli_query($conn, $SELECT)) {

                    $user = mysqli_fetch_array(mysqli_query($conn, $SELECT));
                    $userId = $user["userId"];
                    $userName = $user["userName"];
                    $phoneNumber = $user["phoneNumber"];
                    $birthday = $user["birthday"];
                    $accountLevel = $user["accountLevel"];
                    $created = $user["created"];
                    $end = $user["end"];
                    $questionRemaining = $user["questionRemaining"];

                    response_insert_User(200, "Done", array(
                        "userId" => $userId,
                        "userName" => $userName,
                        "phoneNumber" => $phoneNumber,
                        "birthday" => $birthday,
                        "accountLevel" => $accountLevel,
                        "created" => $created,
                        "end" => $end,
                        "questionRemaining" => $questionRemaining,

                    ));
                }
            } else {

                response_insert_User(400, "Cand Handle", null);
            }
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
                    'end' => $userInfo['end'],
                    'questionRemaining' => $userInfo["questionRemaining"]

                );

                response_login(200, "User Found", $responseInfo);
            } else {

                response_login(201, "User Not Found", null);
            }
        }
    }



    # Forgot PWD

    function pwd_forget()
    {

        #inc db
        include_once "../config/db.php";

        $phoneNumber = $this->phoneNumber;
        if ($conn) {

            $select_query = mysqli_query($conn, "SELECT * FROM `users` WHERE `phoneNumber`='$phoneNumber';");
            if ($select_query) {
                # If can handle user

                if (mysqli_num_rows($select_query) == 1) {

                    # If just there is 1 user with that phone Number
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'http://185.190.39.159/Porseshno_backend/API/User_confirm_code.php');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, [
                        'phoneNumber' => $phoneNumber
                    ]);
                    $response = curl_exec($ch);
                    $response_arr = json_decode($response, true);
                    if ($response_arr["status_code"] == 200) {

                        # if status code = 200

                        echo $response;
                    } else {

                        # If code API Failed

                        response_pwd_forget(400, "Failed", null);
                    }
                } else {

                    # If there is not 1 user


                    response_pwd_forget(400, "There is no user with that info", null);
                }
            } else {

                response_pwd_forget(400, "Cant Handle User", null);
            }
        }
    }



    function Edit_pwd()
    {

        $phoneNumber = $this->phoneNumber;
        $pwd = $this->pwd;
        include_once '../config/db.php';

        if ($conn) {


            if (mysqli_query($conn, "SELECT * FROM `users` WHERE `phoneNumber`='$phoneNumber';")) {
                # If can handle user

                if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `phoneNumber`='$phoneNumber';")) == 1) {



                    if (mysqli_query($conn, "UPDATE `users` SET `pwd` = '$pwd' WHERE `phoneNumber`='$phoneNumber';")) {

                        response_pwd_edit(200, "Done");
                    } else {

                        response_pwd_edit(400, "Cant handle Update");
                    }
                } else {

                    response_pwd_edit(400, "There is no user with that info");
                }
            } else {

                response_pwd_edit(400, "Cant Handle User");
            }
        }
    }
}












//functions__________________________________________________________

function response_pwd_forget($status_code, $message, $code)
{
    header('Content-Type: application/json');
    $response['status_code'] = $status_code;
    $response['message'] = $message;
    if ($status_code == 200) {
        $response['code'] = $code;
    }
    echo json_encode($response, true);
}



function response_pwd_edit($status_code, $message)
{
    header('Content-Type: application/json');
    $response['status_code'] = $status_code;
    $response['message'] = $message;

    echo json_encode($response, true);
}



function response_insert_User($code, $message, $data)
{
    header('Content-Type: application/json');
    $response['status_code'] = $code;
    $response['message'] = $message;
    if ($code == 200) {
        $response['userId'] = $data['userId'];
        $response['userName'] = $data['userName'];
        $response['phoneNumber'] = $data['phoneNumber'];
        $response['birthday'] = $data['birthday'];
        $response['accountLevel'] = $data['accountLevel'];
        $response['created'] = $data['created'];
        $response['end'] = $data['end'];
        $response['questionRemaining'] = $data["questionRemaining"];
    }
    echo json_encode($response, true);
}


function safe($data, $cutval)
{

    header('Content-Type: application/json');

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
    header('Content-Type: application/json');
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
        $response['questionRemaining'] = $data["questionRemaining"];
    }
    echo json_encode($response, true);
}


function response_get_user($code, $message)
{
    header('Content-Type: application/json');
    $response['status_code'] = $code;
    $response['message'] = $message;
    echo json_encode($response, true);
}



function response_post_question($code, $message, $data)
{
    header('Content-Type: application/json');
    $response['status_code'] = $code;
    $response['message'] = $message;
    if ($code == 200) {
        $response['end'] = $data;
    }

    echo json_encode($response, true);
}
