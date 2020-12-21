<?php

class Fcm
{

    private $ci;
    private $server_key;
    

    function __construct()
    {
        //elementos del mensaje SMS
        $this->ci = &get_instance();
        $this->server_key = 'AAAAOiIu9DA:APA91bEjkQpOqJUQNcpct7wcjTEGPZuIWE2TKQowlmJ_zu5TV0RMpg1pKHA3eWhOmU5hfQMsicXkz6iayeTGAcx-xT_IxFKW2gjuKnFNZf-HgWqpb1cpnXgPGtDs4W_oGlHZwGYpgafa';
        
    }

    public function send_push($user_token = "",$message = "",$title = "",$badge = 0){


         $registrationIds = array($user_token);


        //data para android notification 
        $msg = array
        (
            'body' 	=> $message,
            'title'		=> $title,
            'vibrate'	=> 1,
            'sound'		=> 'default',
            'badge'=> $badge
            
        );

        $fields = array
        (
            'registration_ids' 	=> $registrationIds,
            'data'			=> $msg
        );

        $headers = array
        (
            'Authorization: key=' . $this->server_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        return $result;
    }






}
