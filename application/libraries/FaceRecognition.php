<?php

class FaceRecognition
{

    private $ci;
    
    

    function __construct()
    {
        //elementos del mensaje SMS
        $this->ci = &get_instance();
       
        
    }

    //devuelve la aceptación del comentario 0 - 1. 1. Se siente bien con lo escrito 0. No se siente bien con lo que utiliza

    function analyzeImage($url_image){
      $key = '5c93150f41814e709b68aa687694d64e';
        $endpoint = 'https://analisis-imagen-pagahoy.cognitiveservices.azure.com/';
        $url = $endpoint.'vision/v2.0/analyze?visualFeatures=Adult&details=Celebrities&language=es';
             // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Ocp-Apim-Subscription-Key: ".$key
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_POST] = true;
        $payload = '{"url":"'.$url_image.'"}';        
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);
        
        // Execute the http request
        $response = curl_exec($curlHandle);
        return json_decode($response);
    }

    function getTextFromImageOCR($url_image){
        
        

        $key = '5c93150f41814e709b68aa687694d64e';
        $endpoint = 'https://analisis-imagen-pagahoy.cognitiveservices.azure.com/';
        $url = $endpoint.'vision/v2.0/ocr?language=es';
             // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Ocp-Apim-Subscription-Key: ".$key
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_POST] = true;
        $payload = '{"url":"'.$url_image.'"}';        
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);
        
        // Execute the http request
        $response = curl_exec($curlHandle);
        
        /* response
        {
  "documents": [
    {
      "id": "1",
      "score": 0.92
    },
    {
      "id": "2",
      "score": 0.85,
    },
    {
      "id": "3",
      "score": 0.34
    }
  ],
  "errors": []
}
        */

        return json_decode($response);
    }

    function get_fases_claves($documentos){
        //ejemplo de contenido del body
        /*'{
            "documents": [
                {
                  "language": "en",
                  "id": "1",
                  "text": "Hello world. This is some input text that I love."
                },
                {
                  "language": "fr",
                  "id": "2",
                  "text": "Bonjour tout le monde"
                },
                {
                  "language": "es",
                  "id": "3",
                  "text": "La carretera estaba atascada. Había mucho tráfico el día de ayer."
                }
              ]
            }'*/
        $documentos = json_encode($documentos);

        $key = '8ee77e45c95b4ef3bebe00916afddb9a';
        $endpoint = 'https://analisis-textos-pagahoy.cognitiveservices.azure.com/';
        $url = $endpoint.'text/analytics/v2.0/keyPhrases';
             // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Ocp-Apim-Subscription-Key: ".$key
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_POST] = true;
        $payload = $documentos;        
        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);
        
        // Execute the http request
        $response = curl_exec($curlHandle);
        

        return json_decode($response);
    }


  





}
