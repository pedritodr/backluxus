<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description
 *
 * @author Rafael Bomate
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Face_recognition
{

    private $url_photo;
    private $key_azure;

    function __construct($purl_photo = "")
    {
        $this->ci_instance = &get_instance();
        $this->url_photo = $purl_photo;
        $this->key_azure = "2423a236eebc434e89d87dbb4bdab6f7";

    }

    public function listar_grupo_personas($url){
        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Ocp-Apim-Subscription-Key: ".$this->key_azure
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

    public function create_large_group($url,$name_group,$description_group){
        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Ocp-Apim-Subscription-Key: ".$this->key_azure
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_CUSTOMREQUEST] = 'PUT';
        $payload = '{ "name":"'.$name_group.'","userData":"'.$description_group.'"}';

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }

    public function delete_group($url){
        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Ocp-Apim-Subscription-Key: ".$this->key_azure
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_CUSTOMREQUEST] = 'DELETE';


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }

    public function detectar_rostro($url){

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Ocp-Apim-Subscription-Key: ".$this->key_azure
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );

        // Set additional options needed for post requests

        $curlOptions[CURLOPT_POST] = true;
        $payload = '{ "url":"'.$this->url_photo.'"}';

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }





}

