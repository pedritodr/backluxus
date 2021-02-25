<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlignetWallet
{

    private $urlApi;
    private $appKey;
    private $usuario;
    private $password;
    function __construct()
    {
        $this->urlApi = 'http://34.221.178.8:2007/';
        $this->appKey = '22222';
        $this->usuario = 'rafaelpagahoy';
        $this->password = 'Abc123456.';
    }

    function getToken($usuario,$password){
        $urlService = $this->urlApi.'oauth/token';
        $codeBase = base64_encode($usuario.":".$password);
        
        // Prepare curl options
        $curlOptions = array(
           CURLOPT_URL => $urlService,
           CURLOPT_HTTPHEADER => array(
               "Content-Type: application/x-www-form-urlencoded",
               "Authorization: Basic ".$codeBase
           ),
           CURLOPT_RETURNTRANSFER => true,
           // Enable for debugging purposes
           CURLOPT_VERBOSE => false
       );

       

       // Set additional options needed for post requests
     
       $curlOptions[CURLOPT_POST] = true;
       $payload = 'grant_type=client_credentials&client_id='.$usuario.'&client_secret='.$password;
             
                   
       $curlOptions[CURLOPT_POSTFIELDS] = $payload;
     

       $curlHandle = curl_init();
       // Set the options in the curl handler
       curl_setopt_array($curlHandle, $curlOptions);

       // Execute the http request
       $response = curl_exec($curlHandle);


       return $response;
    }

    
    function registerClient($data){
        $urlService = $this->urlApi.'APPInsertCliente';
        
         // Prepare curl options
         $curlOptions = array(
            CURLOPT_URL => $urlService,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $telefono = $data['telefono'];
        $email = $data['email'];
        $phone_id = $data['phone_id'];
        $fecha_registro = $data['fecha_registro'];
        $estado = "1";


        

        // Set additional options needed for post requests
      
        $curlOptions[CURLOPT_POST] = true;
        $payload = '{
                        "appkey":"'.$this->appKey.'",
                        "data":{
                            "cedula":"' . $cedula . '",
                            "nombre":"' . $nombre . '",
                            "telefono":"' . $telefono . '",
                            "email":"' . $email . '",
                            "phone_id":"' . $phone_id . '",
                            "fecha_registro":"' . $fecha_registro . '",
                            "estado":"' . $estado . '"
                        }
                    }';
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
      

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;


    }

    function getDataComercio($token,$codigo_comercio){
        $urlService = $this->urlApi.'APPGetQR';
       
        

        $headers = array(           
            'Authorization: Bearer '. $token,
            'Content-Type: application/json'
        );
       
        // Prepare curl options
        $curlOptions = array(
           CURLOPT_URL => $urlService,
           CURLOPT_HTTPHEADER => $headers,
           CURLOPT_RETURNTRANSFER => true,
           // Enable for debugging purposes
           CURLOPT_VERBOSE => false
           
       );

      

      

       
       // Set additional options needed for post requests
     
       $curlOptions[CURLOPT_POST] = true;
       $payload = '{
                       "appkey":"'.$this->appKey.'",
                       "info":"'.$codigo_comercio.'"
                   }';
       $curlOptions[CURLOPT_POSTFIELDS] = $payload;
                  

       $curlHandle = curl_init();
       // Set the options in the curl handler
       curl_setopt_array($curlHandle, $curlOptions);

       // Execute the http request
       $response = curl_exec($curlHandle);

     
      return $response;
    }
    
    function saveCard($token,$data){
        $urlService = $this->urlApi.'APPEnrrolar_Tarjeta';      
        

        $headers = array(           
            'Authorization: Bearer '. $token,
            'Content-Type: application/json'
        );
       
        // Prepare curl options
        $curlOptions = array(
           CURLOPT_URL => $urlService,
           CURLOPT_HTTPHEADER => $headers,
           CURLOPT_RETURNTRANSFER => true,
           // Enable for debugging purposes
           CURLOPT_VERBOSE => false
           
       );

      

       $id_cliente = $data['id_cliente'];
       $cedula = $data['cedula'];
       $segm1_card = $data['segm1_card'];
       $segm2_card = $data['segm2_card'];
       $segm1_fech = $data['segm1_fech'];
       $segm2_fech = $data['segm2_fech'];
       $codigo = $data['codigo'];
       $tipo = $data['tipo'];

       
       // Set additional options needed for post requests
     
       $curlOptions[CURLOPT_POST] = true;
       $payload = '{
                       "appkey":"'.$this->appKey.'",
                       "data":{
                           "id_cliente":"' . $id_cliente . '",
                           "cedula":"' . $cedula . '",
                           "segm1_card":"' . $segm1_card . '",
                           "segm2_card":"' . $segm2_card . '",
                           "segm1_fech":"' . $segm1_fech . '",
                           "segm2_fech":"' . $segm2_fech . '",
                           "codigo":"' . $codigo . '",
                           "tipo":"' . $tipo . '"
                       }
                   }';
       $curlOptions[CURLOPT_POSTFIELDS] = $payload;
                  

       $curlHandle = curl_init();
       // Set the options in the curl handler
       curl_setopt_array($curlHandle, $curlOptions);

       // Execute the http request
       $response = curl_exec($curlHandle);

      return $response;
       


      


    }

    public function confirmTransaction($token,$data){
        $urlService = $this->urlApi.'APPProcesar_Transaccion';      
        

        $headers = array(           
            'Authorization: Bearer '. $token,
            'Content-Type: application/json'
        );
       
        // Prepare curl options
        $curlOptions = array(
           CURLOPT_URL => $urlService,
           CURLOPT_HTTPHEADER => $headers,
           CURLOPT_RETURNTRANSFER => true,
           // Enable for debugging purposes
           CURLOPT_VERBOSE => false
           
       );

      

       $nombre = $data['nombre'];
       $cedula = $data['cedula'];
       $id_caja = $data['id_caja'];
       $valor = $data['valor'];
       $id_cliente = $data['id_cliente'];
       $id_tarjeta = $data['id_tarjeta'];
       $segm_tarjeta = $data['segm_tarjeta'];
       $segm1_fecha = $data['segm1_fecha'];
       $segm2_fecha = $data['segm2_fecha'];
       $segm1_codigo = $data['segm1_codigo'];
       $segm2_codigo = $data['segm2_codigo'];
       $tipo = $data['tipo'];
       // Set additional options needed for post requests
     
       $curlOptions[CURLOPT_POST] = true;
       $payload = '{
                       "appkey":"'.$this->appKey.'",                      
                        "nombre":"' . $nombre . '",
                        "cedula":"' . $cedula . '",
                        "id_caja":"' . $id_caja . '",
                        "valor":"' . $valor . '",
                        "id_cliente":"' . $id_cliente . '",
                        "id_tarjeta":"' . $id_tarjeta . '",
                        "segm_tarjeta":"' . $segm_tarjeta . '",
                        "segm1_fecha":"' . $segm1_fecha . '",
                        "segm2_fecha":"' . $segm2_fecha . '",
                        "segm1_codigo":"' . $segm1_codigo . '",
                        "segm2_codigo":"' . $segm2_codigo . '",
                        "tipo":"' . $tipo . '"                             
                   }';
       $curlOptions[CURLOPT_POSTFIELDS] = $payload;
                  

       $curlHandle = curl_init();
       // Set the options in the curl handler
       curl_setopt_array($curlHandle, $curlOptions);

       // Execute the http request
       $response = curl_exec($curlHandle);

      return $response;
    }

    


}