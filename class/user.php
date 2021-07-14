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

    function __construct($userName, $phoneNumber, $pwd, $birthday, $accountLevel, $created, $end)
    {
        include '../functions/user_API_functions.php';
        $this->userName = safe($userName, 50);
        $this->phoneNumber = safe($phoneNumber, 12);
        $this->pwd = hash_pwd($pwd);
        $this->birthday = safe($birthday, 50);
        $this->accountLevel = safe($accountLevel, 25);
        $this->created = safe($created, 50);
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
            $SELECTQUERY = "SELECT `userid` WHERE `phoneNumber`='$phoneNumber' ";
            return mysqli_num_rows(mysqli_query($conn, $insertUserQuery));
        }
    }
    function __destruct()
    {
        include '../config/db.php';
        mysqli_close($conn);

    }
}
