<?php


class confirm_sms
{

    public $phoneNumber;

    function __construct($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    function gen_code()
    {

        $str = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYT-';
        $keylength = 4;
        $code = substr(str_shuffle($str), 0, $keylength);
        return $code;
    }

   
}
