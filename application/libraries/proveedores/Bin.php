<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author Rafael Bomate
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Bin
{

    private $ci_instance;




    function __construct()
    {
        $this->ci_instance = &get_instance();


    }

    //metodo para realizar las recargas
    public function get_bank_data($bin = "")
    {
        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => 'https://lookup.binlist.net/'.$bin,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Accept-Version: 3"
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );



       $curlOptions[CURLOPT_HTTPGET] = true;


        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }




    //metodos de acceso



}

