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

        $str = '01232456789';
        $keylength = 4;
        $code = substr(str_shuffle($str), 0, $keylength);
        return $code;
    }
    function send_sms($message)
    {
        $to = $this->phoneNumber;
		
        $username = "09388209270";
        $password = 'faraz1743421583';
        $from = "+983000505";
        $pattern_code = "8fg0k4ale6";
        $input_data = array("verification-code"=> $message);
        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
    }
}
