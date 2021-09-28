<?php

class support
{
    private $name, $pwd, $username;

    function set_name($name)
    {
        $this->name = $name;
    }

    function get_name()
    {
        return $this->name;
    }

    function set_pwd($pwd)
    {
        $this->pwd = $pwd;
    }

    function get_pwd()
    {
        return $this->pwd;
    }

    function set_username($username)
    {
        $this->username = $username;
    }

    function get_username()
    {
        return $this->username;
    }


    function login()
    {
        $username = $this->username;
        $pwd = $this->pwd;
        include_once '../config/db.php';

        $query = "SELECT * FROM `support` WHERE `username` = '$username' AND `pwd` = '$pwd' LIMIT 1;";

        $result  = mysqli_query($conn, $query);



        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                responseSupportLogin(200, "ok", array(
                    "username" => $row['username'],
                    "name" => $row['name'],
                    "id" => $row['id']
                ));
            }else{
                responseSupportLogin(404, "there is more than 1 or no user !", null);
            }
        } else {
            responseSupportLogin(404, "Cant Handle", null);
        }
    }
}


function responseSupportLogin($code, $message, $data)
{
    $export['code'] = $code;
    $export['message'] = $message;
    if ($code == 200) {
        $export['username'] = $data['username'];
        $export['name'] = $data['name'];
        $export['id'] = $data['id'];
    }
    echo json_encode($export);
}
