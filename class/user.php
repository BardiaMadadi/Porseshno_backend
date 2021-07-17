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
        include '../functions/user_API_functions.php';
        $this->userName = safe($userName, 50);
    }

    //set phone
    function set_phoneNumber($phoneNumber)
    {
        include '../functions/user_API_functions.php';
        $this->phoneNumber = safe($phoneNumber, 12);
    }


    //set pwd
    function set_pwd($pwd)
    {
        include '../functions/user_API_functions.php';
        $this->pwd = hash_pwd($pwd);
    }
    
    
    //set birthday
    function set_birthday($birthday)
    {
        include '../functions/user_API_functions.php';
        $this->birthday = safe($birthday, 50);
    }
    
    //set level
    function set_accountLevel($accountLevel)
    {
        include '../functions/user_API_functions.php';
        $this->accountLevel = safe($accountLevel, 25);
    }


    //set created
    function set_created($created)
    {
        include '../functions/user_API_functions.php';
        $this->created = safe($created, 50);
    }
    

    //set end
    function set_end($end)
    {
        include '../functions/user_API_functions.php';
        $this->end = safe($end, 50);
    }

    function insertUser()
    {
        include '../config/db.php';
        if ($conn) {
            $insertUserQuery = "INSERT INTO users VALUES (NULL,'$this->userName','$this->phoneNumber','$this->pwd','$this->birthday',' $this->accountLevel','$this->created','$this->end' )";
            mysqli_query($conn, $insertUserQuery);
        }
    }
    function selectUser()
    {
        include '../config/db.php';

        if ($conn) {
            $phoneNumber = $this->phoneNumber;
            $SELECTQUERY = "SELECT * FROM `users` WHERE `phoneNumber`='$phoneNumber' ";
            $rows = mysqli_num_rows(mysqli_query($conn, $SELECTQUERY));
            return $rows;
        }
    }


    function login()
    {


        include '../config/db.php';

        if ($conn) {

            $phoneNumber = $this->phoneNumber;

            $pwd = $this->pwd;


            $SELECTQUERY = "SELECT * FROM `users` WHERE `phoneNumber`='$phoneNumber' AND `pwd`='$pwd' LIMIT 1";


            if (mysqli_num_rows(mysqli_query($conn, $SELECTQUERY)) == 1) {

                include_once '../functions/user_API_functions.php';

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
