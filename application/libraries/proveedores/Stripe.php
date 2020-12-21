<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe
{

    //development
    private $public_key;
    private $secret_key;

    //production
    private $public_key_production;
    private $private_key_production;

    private $mode;

    function __construct()
    {

        $this->mode = 'test'; //test o production
        $this->public_key = 'pk_test_LYo6eCJ6nhio9fCPymh0Sz51'; 
        $this->secret_key = 'sk_test_YYyAuNyyk3Czduir3No2gd2Z';

        $this->public_key_production = 'pk_live_acRZkfZ3saNrTOoMWO8GQsiS';
        $this->private_key_production = 'sk_live_DiVwyojSlj7e52aHlQYxjsQz';
    }

    //Modulo de Balance
    //obtener el objeto balance, obtengo todos los datos del balance de la cuenta de usuario
    function get_object_balance(){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/charges';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    function get_balance(){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/balance';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    function get_transaction_by_id($id){ // el id que se espera se obtiene del metodo get_object_balance en el atributo balance_transaction
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/balance/history/'.$id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    function get_list_balance($limit = 0){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $limit_str = '';
         if($limit > 0 ){
             $limit_str = '?limit='.$limit;
         }
         $url = 'https://api.stripe.com/v1/balance/history'.$limit_str;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    //fin del modulo de balance


    //Modulo Gestion de clientes 

    public function list_clientes($limit = 0){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $limit_str = '';
         if($limit > 0 ){
             $limit_str = '?limit='.$limit;
         }
         $url = 'https://api.stripe.com/v1/customers'.$limit_str;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    public function get_client_by_id($id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/customers/'.$id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    public function create_cliente($description,$email){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/customers';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",               
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        $curlOptions[CURLOPT_POST] = true;
        
       
        $payload = 'description='.$description.'&email='.$email;
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    public function update_cliente($client_id,$description,$email){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/customers/'.$client_id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",               
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        $curlOptions[CURLOPT_POST] = true;
        
       
        $payload = 'description='.$description.'&email='.$email;
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    public function delete_cliente($client_id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

       
         $url = 'https://api.stripe.com/v1/customers/'.$client_id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica,
                "-X DELETE"
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

      


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "DELETE"); 

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    //Fin modulo Gestion de clientes

    
    //Modulo Payout (cuando se reciben fondos de Stripe)

    public function list_payout($limit = 0){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $limit_str = '';
         if($limit > 0 ){
             $limit_str = '?limit='.$limit;
         }
         $url = 'https://api.stripe.com/v1/payouts'.$limit_str;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    public function payout_detail($payout_id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/payouts/'.$payout_id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    //Fin del modulo de Payout

    //Modulo para Tokenizar
    function create_card_token($card_number, $exp_month,$exp_year,$cvc){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/tokens';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",               
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        $curlOptions[CURLOPT_POST] = true;
        
       
        $payload = 'card[number]='.$card_number.'&card[exp_month]='.$exp_month.'&card[exp_year]='.$exp_year.'&card[cvc]='.$cvc;
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    function getToken($token_id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/tokens/'.$token_id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }
    //fin del modulo de Tokenizacion


    //modulo de gestion de tarjetas

    function create_card($token,$user_id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/customers/'.$user_id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",               
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        $curlOptions[CURLOPT_POST] = true;
        
       
        $payload = 'source='.$token;
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    function list_cards($client_id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

      
         $url = 'https://api.stripe.com/v1/customers/'.$client_id.'/sources?object=card';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    function update_card_data($owner_name = "",$card_id,$customer_id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/customers/'.$customer_id.'/sources/'.$card_id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",               
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        $curlOptions[CURLOPT_POST] = true;
        
       
        $payload = 'name='.$owner_name;
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    function delete_card($card_id,$customer_id){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

       
         $url = 'https://api.stripe.com/v1/customers/'.$customer_id.'/sources/'.$card_id;
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica,
                "-X DELETE"
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

      


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "DELETE"); 

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    //fin del modulo de gestion de tarjetas

    //amount int que representa los centavos en la moneda
    function create_charge($customer_id,$amount, $currency, $source, $description){
        $llave_publica = $this->public_key;
        $password_private = $this->secret_key;

        if($this->mode == 'production'){
            
            $llave_publica = $this->public_key_production;
            $password_private = $this->private_key_production;
        }

         // Prepare curl options
         $url = 'https://api.stripe.com/v1/charges';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",               
                "Authorization: Bearer ".$password_private,
                "-u : ".$llave_publica
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        $curlOptions[CURLOPT_POST] = true;
        
       
        $payload = 'amount='.$amount.'&currency='.$currency.'&source='.$source.'&description='.$description.'&customer='.$customer_id;
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        return $response;
    }

    //modulo de cargos



    //fin del modulo de cargos

}