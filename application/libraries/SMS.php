<?php

require(APPPATH . "libraries/sms/src/autoload.php");
class SMS
{

    private $ci;
    private $phone_number;
    private $sms_text;
    private $account_reference;
    private $account_username;
    private $account_password;
    function __construct($_phone_number,$_sms_text)
    {
        //elementos del mensaje SMS
        $this->ci = &get_instance();
        $this->phone_number = $_phone_number;
        $this->sms_text = $_sms_text;

        //elementos de autenticacion de cuenta
        $this->account_reference = "EX0255567";
        $this->account_username = "desarrollo@pagahoy.com";
        $this->account_password = "Q12we34rt5";
    }

    public function send_sms(){
        /* Requires PHP SDK  */
        $message = new \Esendex\Model\DispatchMessage(
            "PagaHoy", /* Send from */
            $this->phone_number, /* Send to any valid number */
            $this->sms_text,
            \Esendex\Model\Message::SmsType
        );
        $authentication = new \Esendex\Authentication\LoginAuthentication(
            $this->account_reference, /* Your Esendex Account Reference */
            $this->account_username, /* Your login email address */
            $this->account_password /* Your password */
        );
        $service = new \Esendex\DispatchService($authentication);

        try {

            $result = $service->send($message);
        }catch (Exception $ex){
            return $ex;
        }
        return $result;
    }






}
