<?php

class Recargas_internacionales
{

    
    function __construct()
    {
        $this->ci = &get_instance();    
         
    }

    function enviarRecarga($skuCode, $monto,$phone,$sendCurrencyISO,$id_transferencia_interna,$settings,$validationOnly = true){
      
        $url = "https://api.dingconnect.com/api/V1/SendTransfer";
        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "api_key: BncZHIATKsB6FG46rBnuz6"
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
     
        $curlOptions[CURLOPT_POST] = true;
        $payload = '{
            "SkuCode": "'.$skuCode.'",
            "SendValue": '.$monto.',
            "SendCurrencyIso":"'.$sendCurrencyISO.'",
            "AccountNumber": "'.$phone.'",
            "DistributorRef": "'.$id_transferencia_interna.'",
            "Settings": ['.$settings.'],
            "ValidateOnly":'.$validationOnly.'
          }';
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }

    //regiones soportadas
    function getRegions($country_iso = ""){
         // Prepare curl options
         $url = "";
         if(strlen($country_iso) == 0){
            $url = 'https://api.dingconnect.com/api/V1/GetRegions';
         }else{            
            $url = 'https://api.dingconnect.com/api/V1/GetRegions?countryIsos='.$country_iso;
         }
         
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //monedas soportadas
    function getCurrencies(){
         
         // Prepare curl options
         $url = 'https://api.dingconnect.com/api/V1/GetCurrencies';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //paises soportados
    function getCountries(){
         // Prepare curl options
         $url = 'https://api.dingconnect.com/api/V1/GetCountries';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //lista de proveedores de recargas
    function getProviders(){
         // Prepare curl options
         $url = 'https://api.dingconnect.com/api/V1/GetProviders';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //estado de los proveedores de recargas
    function getProvidersStatus(){
        // Prepare curl options
        $url = 'https://api.dingconnect.com/api/V1/GetProviderStatus';
        $curlOptions = array(
           CURLOPT_URL => $url,
           CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               "api_key: BncZHIATKsB6FG46rBnuz6"
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

   //lista de productos disponibles para poder realizar recargas
   function getProducts(){
        // Prepare curl options
        $url = 'https://api.dingconnect.com/api/V1/GetProducts';
        $curlOptions = array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //descripciones del producto
    function getProductsDescriptions(){
         // Prepare curl options
         $url = 'https://api.dingconnect.com/api/V1/GetProductDescriptions';
         $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //balance actual en la cuenta
    function getBalance(){
        // Prepare curl options
        $url = 'https://api.dingconnect.com/api/V1/GetBalance';
        $curlOptions = array(
           CURLOPT_URL => $url,
           CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //obtener promociones vigentes
    function getPromotions(){
        // Prepare curl options
        $url = 'https://api.dingconnect.com/api/V1/GetPromotions';
        $curlOptions = array(
           CURLOPT_URL => $url,
           CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               "api_key: BncZHIATKsB6FG46rBnuz6"
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

    //obtener la descripcion de las promociones
    function getPromotionsDescription(){
        // Prepare curl options
        $url = 'https://api.dingconnect.com/api/V1/GetPromotionDescriptions';
        $curlOptions = array(
           CURLOPT_URL => $url,
           CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               "api_key: BncZHIATKsB6FG46rBnuz6"
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

    function getAccountLookup($number){
        // Prepare curl options
        $url = 'https://api.dingconnect.com/api/V1/GetAccountLookup?accountNumber='.$number;
        $curlOptions = array(
           CURLOPT_URL => $url,
           CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               "api_key: BncZHIATKsB6FG46rBnuz6"
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



    

}
