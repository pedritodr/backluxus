<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlaceToPay
{

    private $usuarioPlaceToPay;
    private $trankeyPlaceToPay;
    private $url_base;
    private $nonce;
    private $seed;
    function __construct($usuario,$trankey)
    {
        $this->usuarioPlaceToPay = $usuario;
        $this->trankeyPlaceToPay = $trankey;
        $this->url_base = 'https://sandbox.placetopay.com';
        $this->nonce = rand(0,1000000);
        $this->seed = date(DateTime::ISO8601);
    }

    private function generateTranKey(){
        $nonce = $this->nonce;
        $seed = $this->seed;
        $str = $nonce+$seed+$this->trankeyPlaceToPay;
        $tranKey = base64_encode(hash ( "sha256", $str ));
        return $tranKey;
    }

    public function informationRequest($token,$referencia,$totalPay,$tipoInfo,$estructura_tarjeta){

        $responseMockup = '{     
            "status": {
                "status": "OK",
                "reason": 0,
                "message": "La petición se ha procesado correctamente",
                "date": "2018-02-05T21:16:00-05:00"
            },
            "provider": "INTERDIN",
            "cardTypes": [
                "C"
            ],
            "displayInterest": true,
            "requireOtp": true,
            "requireCvv2": true,
            "threeDS": "unsupported",
            "credits": [
                {
                    "code": 1,
                    "type": "00",
                    "groupCode": "C",
                    "installments": [
                        1             
                    ],
                    "installment": 1,
                    "description": "CORRIENTE"         
                },
                {
                    "code": 1,
                    "type": "01",
                    "groupCode": "D",
                    "installments": 
                    [
                        3
                    ],
                    "installment": 3,
                    "description": "DIFERIDO CORRIENTE"         
                },
                {
                    "code": 1,
                    "type": "22", 
                    "groupCode": "M",
                    "installments": 
                        [
                            12,9,6,3
                        ],
                        "installment": 12,
                        "description": "DIF PLUS PAGO TOTAL"
                },
                {
                    "code": 1,
                    "type": "02",
                    "groupCode": "P",
                    "installments": [
                        24,21,18,15,12,9,6,3
                    ],
                    "installment": 24,
                    "description": "DIFERIDO PROPIO" 
                },
                {
                    "code": 1,
                    "type": "03",
                    "groupCode": "X",
                    "installments": 
                        [
                            3
                        ],
                    "installment": 3,
                    "description": "PLAN PAGOS ESPECIAL"
                }
            ]
        } ';
        return $responseMockup;
        
        $url = $this->url_base + '/gateway/information'; 
        $resultTranKey = $this->generateTranKey();

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"                
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        
        $curlOptions[CURLOPT_POST] = true;
        $payload = "";
        if($tipoInfo == 2){ //si la solicitud es a través de Token
            $payload = '{   
                "auth": {
                    "login": "'.$this->usuarioPlaceToPay.'",
                    "tranKey": "'.$resultTranKey.'",
                    "nonce": "'.base64_encode($this->nonce).'",
                    "seed": "'.$this->seed.'"
                },
                "instrument": {
                    "token": {
                        "token": "'.$token.'"
                    }
                },
                "payment": {
                    "reference": "'.$referencia.'",
                    "amount": {
                        "total": '.$totalPay.',
                        "currency": "USD" 
                    }
                }
            }';
        }else{ //se consulta la informacion a través de una tarjeta
            $separated_fecha_caducidad = explode("/",$estructura_tarjeta->caducidad);
            $payload = '{   
                "auth": {
                    "login": "'.$this->usuarioPlaceToPay.'",
                    "tranKey": "'.$resultTranKey.'",
                    "nonce": "'.base64_encode($this->nonce).'",
                    "seed": "'.$this->seed.'"
                },
                "instrument": {
                    "card": {
                        "number ": "'.$estructura_tarjeta->numberCard.'",
                        "expirationMonth":"'.$separated_fecha_caducidad[1].'",
                        "expirationYear":"'.$separated_fecha_caducidad[0].'",
                        "cvv":"'.$estructura_tarjeta->cvv.'"
                    }
                },
                "payment": {
                    "reference": "'.$referencia.'",
                    "amount": {
                        "total": '.$totalPay.',
                        "currency": "USD" 
                    }
                }
            }';
        }

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
     

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        //response mockup

        

        return $response;
    }

    public function calculoInteres($cardToken,$code,$type,$groupCode,$installment,$referencia,$totalPay){
        $url = $this->url_base + '/gateway/interests'; 
        $resultTranKey = $this->generateTranKey();

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"                
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        
        $curlOptions[CURLOPT_POST] = true;
        $payload = '{   
            "auth": {
                "login": "'.$this->usuarioPlaceToPay.'",
                "tranKey": "'.$resultTranKey.'",
                "nonce": "'.base64_encode($this->nonce).'",
                "seed": "'.$this->seed.'"
            },
            "instrument": {     
                "token": {
                    "token": "'.$cardToken.'"     
                },
                "credit": {
                    "code": '.$code.',
                    "type": "'.$type.'",
                    "groupCode": "'.$groupCode.'",
                    "installment": '.$installment.'
                }
            },
            "payment": {
                "reference": "'.$referencia.'",
                "amount": {
                    "total": '.$totalPay.',
                    "currency": "USD"     
                }
            } 
        }';

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
     

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        //response mockup

        $responseMockup = '{     
            "status": {
                "status": "OK",
                "reason": 0,
                "message": "La petición se ha procesado correctamente",
                "date": "2018-02-05T21:18:11-05:00"
            },
            "provider": "INTERDIN",
            "values": {
                "original": 120.1,
                "installment": 0,
                "interest": 2.7622999999999998,
                "total": 122.86229999999999
            },
            "conversion": null 
        }';

        return $response;
    }

    public function generacionOTP($cardToken,$referencia,$totalPay,$estructuraTarjeta,$tipo_info){

        $responseMockup = '{     
            "status": {
                "status": "OK",
                "reason": 0,
                "message": "La petición se ha procesado correctamente",
                "date": "2018-02-05T21:20:37-05:00"
            },
            "provider": "INTERDIN" 
        }';
        return $responseMockup;
        $url = $this->url_base + '/gateway/otp/generate'; 
        $resultTranKey = $this->generateTranKey();

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"                
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        
        $curlOptions[CURLOPT_POST] = true;
        if($tipoInfo == 2){
            $payload = '{   
                "auth": {
                    "login": "'.$this->usuarioPlaceToPay.'",
                    "tranKey": "'.$resultTranKey.'",
                    "nonce": "'.base64_encode($this->nonce).'",
                    "seed": "'.$this->seed.'"
                },
                "instrument": {     
                    "token": {
                        "token": "'.$cardToken.'"     
                    }
                },
                "payment": {
                    "reference": "'.$referencia.'",
                    "amount": {
                        "total": '.$totalPay.',
                        "currency": "USD"     
                    }
                } 
            }';
        }else{
            $separated_fecha_caducidad = explode("/",$estructuraTarjeta->caducidad);
            $payload = '{   
                "auth": {
                    "login": "'.$this->usuarioPlaceToPay.'",
                    "tranKey": "'.$resultTranKey.'",
                    "nonce": "'.base64_encode($this->nonce).'",
                    "seed": "'.$this->seed.'"
                },
                "instrument": {
                    "card": {
                        "number ": "'.$estructuraTarjeta->numberCard.'",
                        "expirationMonth":"'.$separated_fecha_caducidad[1].'",
                        "expirationYear":"'.$separated_fecha_caducidad[0].'",
                        "cvv":"'.$estructuraTarjeta->cvv.'"
                    }
                },
                "payment": {
                    "reference": "'.$referencia.'",
                    "amount": {
                        "total": '.$totalPay.',
                        "currency": "USD" 
                    }
                }
            }';
        }

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
     

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        //response mockup

        

        return $response;
    }

    public function validarOTP($cardToken,$referencia,$totalPay,$otp){
        $url = $this->url_base + '/gateway/otp/validate'; 
        $resultTranKey = $this->generateTranKey();

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"                
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        
        $curlOptions[CURLOPT_POST] = true;
        $payload = '{   
            "auth": {
                "login": "'.$this->usuarioPlaceToPay.'",
                "tranKey": "'.$resultTranKey.'",
                "nonce": "'.base64_encode($this->nonce).'",
                "seed": "'.$this->seed.'"
            },
            "instrument": {     
                "token": {
                    "token": "'.$cardToken.'"     
                },
                "otp": "'.$otp.'"
            },
            "payment": {
                "reference": "'.$referencia.'",
                "amount": {
                    "total": '.$totalPay.',
                    "currency": "USD"     
                }
            } 
        }';

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
     

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        //response mockup

        $responseMockup = '{     
            "status": {
                "status": "OK",
                "reason": 0,
                "message": "OTP Validation successful",
                "date": "2018-07-19T08:59:57-05:00"
            },
            "provider": "INTERDIN",
            "signature": "a8ecc59c2510a8ae27e1724ebf4647b5",
            "validated": true 
        }';

        return $response;
    }

    public function procesarTransaction(){
        $url = $this->url_base + '/gateway/process '; 
        $resultTranKey = $this->generateTranKey();

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"                
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        
        $curlOptions[CURLOPT_POST] = true;
        $payload = '{
            "auth": {
                "login": "45974e82a3867355d3471bc4a1f18a1c",
                "tranKey": "/K9f7yJpyptkPrADFWoWYsO5yZU=",
                "nonce": "WW1aa01XWXlOVEEzT1RoalptSmpOalEzT1dNd05UTXlZMkUwWlRRME1UVT0=",
                "seed": "2018-01-29T17:09:38-05:00"
            },
            "locale": "es_EC",
            "payment": {
                "reference": "TEST_20171108_144400",
                "description": "Ipsam quia sunt dolore minus atque blanditiis corrupti.",
                "amount": {
                    "taxes": [
                        {
                            "kind": "ice",
                            "amount": 4.8,
                            "base": 40
                        },
                        {
                            "kind": "valueAddedTax",
                            "amount": 7.6,
                            "base": 40
                        }
                    ],
                    "details": [
                        {
                            "kind": "shipping",
                            "amount": 2
                        },
                        {
                            "kind": "tip",
                            "amount": 2
                        },
                        {
                            "kind": "subtotal",
                            "amount": 40
                        }
                    ],
                    "currency": "USD",
                    "total": 56.4
                }
            },
            "ipAddress": "127.0.0.1",
            "userAgent": "Mozilla/5.0 USER_AGENT HERE",
            "additional": {
                "SOME_ADDITIONAL": "http://example.com/yourcheckout"
            },
            "instrument": {
                "card": {
                    "number": "36545400000008",
                    "expirationMonth": "12",
                    "expirationYear": "21",
                    "cvv": "123"
                },
                "credit": {
                    "code": "1",
                    "type": "02",
                    "groupCode": "P",
                    "installment": "24"
                },
                "otp": "a8ecc59c2510a8ae27e1724ebf4647b5"   
            },
            "payer": {
                "document": "8467451900",
                "documentType": "CC", 
                "name": "Miss Delia Schamberger Sr.",
                "surname": "Wisozk",
                "email": "tesst@gmail.com",
                "mobile": "3006108300"
            },
            "buyer": {
                "document": "8467451900",
                "documentType": "CC",
                "name": "Miss Delia Schamberger Sr.",
                "surname": "Wisozk",
                "email": "tesst@gmail.com",
                "mobile": "3006108300"
            }
        }';

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
     

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        //response mockup

        $responseMockup = '{   
            "auth": {
                "login": "45974e82a3867355d3471bc4a1f18a1c",
                "tranKey": "/K9f7yJpyptkPrADFWoWYsO5yZU=",
                "nonce": "WW1aa01XWXlOVEEzT1RoalptSmpOalEzT1dNd05UTXlZMkUwWlRRME1UVT0=",
                "seed": "2018-01-29T17:09:38-05:00"
            },
            "locale": "es_EC",
            "payment": {
                "reference": "TEST_20171108_144400",
                "description": "Ipsam quia sunt dolore minus atque blanditiis corrupti.",
                "amount": {
                    "taxes": [
                        {
                            "kind": "ice",
                            "amount": 4.8,
                            "base": 40
                        },
                        {
                            "kind": "valueAddedTax",
                            "amount": 7.6,
                            "base": 40
                        }
                    ],
                    "details": [
                        {
                            "kind": "shipping",
                            "amount": 2
                        },
                        {
                            "kind": "tip",
                            "amount": 2
                        },
                        {
                            "kind": "subtotal",
                            "amount": 40
                        }
                    ],
                    "currency": "USD",
                    "total": 56.4
                }
            },
            "ipAddress": "127.0.0.1",
            "userAgent": "Mozilla/5.0 USER_AGENT HERE",
            "additional": {
                "SOME_ADDITIONAL": "http://example.com/yourcheckout"
            },
            "instrument": {
                "card": {
                    "number": "36545400000008",
                    "expirationMonth": "12",
                    "expirationYear": "21",
                    "cvv": "123"
                },
                "credit": {
                    "code": "1",
                    "type": "02",
                    "groupCode": "P",
                    "installment": "24"
                },
                "otp": "a8ecc59c2510a8ae27e1724ebf4647b5"
            },
            "payer": {
                "document": "8467451900",
                "documentType": "CC",
                "name": "Miss Delia Schamberger Sr.",
                "surname": "Wisozk",
                "email": "tesst@gmail.com",
                "mobile": "3006108300"
            },
            "buyer": {
                "document": "8467451900",
                "documentType": "CC",
                "name": "Miss Delia Schamberger Sr.",
                "surname": "Wisozk",
                "email": "tesst@gmail.com",
                "mobile": "3006108300"
            }
        }';

        return $response;
    }

    public function tokenizarTarjeta($name,$surname,$email,$cardNumber,$expirationMonth,$expirationYear,$cvv,$otp,$ip,$agent){

        $responseMockup = '{ 
            "status": {
                "status": "OK",
                "message": "Token generado exitosamente",
                "reason": "00",
                "date": "2018-03-06T20:47:01-05:00"
            },
            "provider": "INTERDIN",
            "instrument": {
                "token": {
                    "token": "81135c6e8115b27e6a8afa4bce7d619503e87603d1fc4d139abea11b7c5e17ae",
                    "subtoken": "1493989062790008",
                    "franchise": "diners",
                    "franchiseName": "Diners",
                    "issuerName": "Diners Club",
                    "lastDigits": "0008",
                    "validUntil": "12/21"
                }
            }
        } ';
        return $responseMockup;


        $url = $this->url_base + '/gateway/tokenize'; 
        $resultTranKey = $this->generateTranKey();

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"                
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        
        $curlOptions[CURLOPT_POST] = true;
        $payload = "";
        if($otp==0){
            $payload = '{   
                "auth": {
                    "login": "'.$this->usuarioPlaceToPay.'",
                    "tranKey": "'.$resultTranKey.'",
                    "nonce": "'.base64_encode($this->nonce).'",
                    "seed": "'.$this->seed.'"
                },   
                "payer": {
                    "name": "'.$name.'",
                    "surname": "'.$surname.'",
                    "email": "'.$email.'"
                },
                "instrument": {
                    "card": {
                        "number": "'.$cardNumber.'",
                        "expirationMonth": "'.$expirationMonth.'",
                        "expirationYear": "'.$expirationYear.'",
                        "cvv": "'.$cvv.'"
                    }
                },
                "ipAddress": "'.$ip.'",
                "userAgent": "'.$agent.'"
            }';
        }else{
            $payload = '{   
                "auth": {
                    "login": "'.$this->usuarioPlaceToPay.'",
                    "tranKey": "'.$resultTranKey.'",
                    "nonce": "'.base64_encode($this->nonce).'",
                    "seed": "'.$this->seed.'"
                },   
                "payer": {
                    "name": "'.$name.'",
                    "surname": "'.$surname.'",
                    "email": "'.$email.'"
                },
                "instrument": {
                    "card": {
                        "number": "'.$cardNumber.'",
                        "expirationMonth": "'.$expirationMonth.'",
                        "expirationYear": "'.$expirationYear.'",
                        "cvv": "'.$cvv.'"
                    }​,
                    "otp": "'.$otp.'"
                },
                "ipAddress": "'.$ip.'",
                "userAgent": "'.$agent.'"
            }';
        }

        $curlOptions[CURLOPT_POSTFIELDS] = $payload;
     

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);

        //response mockup

       
        return $response;
    } 

 


    public function get_all_cards($method, $url)
    {

        $paymentez_server_application_code = "BNEG-EC-SERVER";
        $paymentez_server_application_key = "FrJ7s3xmeyov2EYunfI908f28lj8QV";

        $date = new DateTime();
        $unix_time_stamp = $date->getTimestamp();


        $unik_token_string = $paymentez_server_application_key . $unix_time_stamp;

        //$unik_token_hash = $this->strToHex(hash('sha256',$unik_token_string));
        $unik_token_hash = hash('sha256', $unik_token_string);

        $auth_token = base64_encode($paymentez_server_application_code . ";" . $unix_time_stamp . ";" . $unik_token_hash);

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Auth-Token:" . $auth_token
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        if ($method === 'POST') {
            $curlOptions[CURLOPT_POST] = true;
            // $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } elseif ($method == 'PUT' || $method == 'DELETE') {
            $curlOptions[CURLOPT_CUSTOMREQUEST] = $method;
            // $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } else {
            $curlOptions[CURLOPT_HTTPGET] = true;
        }

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }

    function delete_card($method, $url, $user_id, $token)
    {
        $paymentez_server_application_code = "BNEG-EC-SERVER";
        $paymentez_server_application_key = "FrJ7s3xmeyov2EYunfI908f28lj8QV";

        $date = new DateTime();
        $unix_time_stamp = $date->getTimestamp();


        $unik_token_string = $paymentez_server_application_key . $unix_time_stamp;

        //$unik_token_hash = $this->strToHex(hash('sha256',$unik_token_string));
        $unik_token_hash = hash('sha256', $unik_token_string);

        $auth_token = base64_encode($paymentez_server_application_code . ";" . $unix_time_stamp . ";" . $unik_token_hash);

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Auth-Token:" . $auth_token
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        if ($method === 'POST') {
            $curlOptions[CURLOPT_POST] = true;
            $payload = '{
                           "card":
                                {
                                    "token":"' . $token . '"
                                },
                            "user":{
                                  "id":"' . $user_id . '"
                            }
                        }';
            $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } elseif ($method == 'PUT' || $method == 'DELETE') {
            $curlOptions[CURLOPT_CUSTOMREQUEST] = $method;
            // $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } else {
            $curlOptions[CURLOPT_HTTPGET] = true;
        }

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }

    function execute_debit_card_transaction($method, $url, $user_id, $email, $amount, $tax, $description, $referencia_compra, $token)
    {
        $paymentez_server_application_code = "BNEG-EC-SERVER";
        $paymentez_server_application_key = "FrJ7s3xmeyov2EYunfI908f28lj8QV";

        $date = new DateTime();
        $unix_time_stamp = $date->getTimestamp();


        $unik_token_string = $paymentez_server_application_key . $unix_time_stamp;

        //$unik_token_hash = $this->strToHex(hash('sha256',$unik_token_string));
        $unik_token_hash = hash('sha256', $unik_token_string);

        $auth_token = base64_encode($paymentez_server_application_code . ";" . $unix_time_stamp . ";" . $unik_token_hash);

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Auth-Token:" . $auth_token
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        if ($method === 'POST') {
            $curlOptions[CURLOPT_POST] = true;
            $payload = '{
                            "user":{
                                "id":"' . $user_id . '",
                                "email":"' . $email . '"
                            },
                           "order":
                                {
                                    "amount":' . $amount . ',
                                    "description":"' . $description . '",
                                    "dev_reference":"' . $referencia_compra . '",
                                    "vat":' . $tax . '
                                },
                            "card":{
                                  "token":"' . $token . '"
                            }
                        }';
            $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } elseif ($method == 'PUT' || $method == 'DELETE') {
            $curlOptions[CURLOPT_CUSTOMREQUEST] = $method;
            // $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } else {
            $curlOptions[CURLOPT_HTTPGET] = true;
        }

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }

    function execute_credit_card_transaction($method, $url, $user_id, $email, $amount, $tax, $description, $referencia_compra, $token, $installments)
    {
        $paymentez_server_application_code = "BNEG-EC-SERVER";
        $paymentez_server_application_key = "FrJ7s3xmeyov2EYunfI908f28lj8QV";

        $date = new DateTime();
        $unix_time_stamp = $date->getTimestamp();


        $unik_token_string = $paymentez_server_application_key . $unix_time_stamp;

        //$unik_token_hash = $this->strToHex(hash('sha256',$unik_token_string));
        $unik_token_hash = hash('sha256', $unik_token_string);

        $auth_token = base64_encode($paymentez_server_application_code . ";" . $unix_time_stamp . ";" . $unik_token_hash);

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Auth-Token:" . $auth_token
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests
        if ($method === 'POST') {
            $curlOptions[CURLOPT_POST] = true;
            $payload = '{
                            "user":{
                                "id":"' . $user_id . '",
                                "email":"' . $email . '"
                            },
                           "order":
                                {
                                    "amount":' . $amount . ',
                                    "description":"' . $description . '",
                                    "dev_reference":"' . $referencia_compra . '",
                                    "vat":' . $tax . ',
                                    "installments":' . $installments . ',
                                    "installments_type":3
                                },
                            "card":{
                                  "token":"' . $token . '"
                            }
                        }';
            $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } elseif ($method == 'PUT' || $method == 'DELETE') {
            $curlOptions[CURLOPT_CUSTOMREQUEST] = $method;
            // $curlOptions[CURLOPT_POSTFIELDS] = $payload;
        } else {
            $curlOptions[CURLOPT_HTTPGET] = true;
        }

        $curlHandle = curl_init();
        // Set the options in the curl handler
        curl_setopt_array($curlHandle, $curlOptions);

        // Execute the http request
        $response = curl_exec($curlHandle);


        return $response;
    }

    function execute_refund($url, $transaction_id)
    {
        $paymentez_server_application_code = "BNEG-EC-SERVER";
        $paymentez_server_application_key = "FrJ7s3xmeyov2EYunfI908f28lj8QV";

        $date = new DateTime();
        $unix_time_stamp = $date->getTimestamp();


        $unik_token_string = $paymentez_server_application_key . $unix_time_stamp;

        //$unik_token_hash = $this->strToHex(hash('sha256',$unik_token_string));
        $unik_token_hash = hash('sha256', $unik_token_string);

        $auth_token = base64_encode($paymentez_server_application_code . ";" . $unix_time_stamp . ";" . $unik_token_hash);

        // Prepare curl options
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Auth-Token:" . $auth_token
            ),
            CURLOPT_RETURNTRANSFER => true,
            // Enable for debugging purposes
            CURLOPT_VERBOSE => false
        );


        // Set additional options needed for post requests

        $curlOptions[CURLOPT_POST] = true;
        $payload = '{
                        "transaction":{
                            "id":"' . $transaction_id . '"
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

    public function get_error($code)
    {
        switch ($code) {
            case 0: {
                return "Esperando por el cobro";
                break;
            }
            case 1: {
                return "Se requiere verificación de la tarjeta, la operación puede tardar unos minutos en concretarse";
                break;
            }

            case 3: {
                return "Proceso pagado correctamente";
                break;
            }

            case 6: {
                return "No se pudo realizar la operación porque la tarjeta es fraudulenta";
                break;
            }

            case 7: {
                return "Reembolso realizado con éxito";
                break;
            }

            case 8: {
                return "Contracargo realizado con éxito";
                break;
            }

            case 9: {
                return "Transacción rechazada por el transportista";
                break;
            }

            case 10: {
                return "No se pudo realizar la operación debido a un error de la pasarela";
                break;
            }

            case 11: {
                return "No se pudo realizar la operación debido a un intento de fraude en el pago";
                break;
            }

            case 12: {
                return "No se pudo realizar la operación debido a que la tarjeta se encuentra en la lista negra de la pasarela de pago";
                break;
            }

            case 13: {
                return "No se pudo realizar la operación debido a que la transacción a exedido el tiempo máximo permitido para una petición";
                break;
            }

            case 19: {
                return "No se pudo realizar la operación debido a que es inválido el código de autorización";
                break;
            }

            case 20: {
                return "No se pudo realizar la operación debido a que el código de autorización ha expirado";
                break;
            }

            case 21: {
                return "No se pudo realizar la operación debido a que se detectó un fraude por parte de la pasarela. La transacción está pendiente a reembolso";
                break;
            }

            case 22: {
                return "No se pudo realizar la operación debido a que el código de autorización es inválido. La transacción está pendiente a reembolso";
                break;
            }

            case 23: {
                return "No se pudo realizar la operación debido a que el código de autorización ha expirado. La transacción está pendiente a reembolso";
                break;
            }

            case 24: {
                return "No se pudo realizar la operación debido a que se detectó un fraude por parte de la pasarela. La transacción está pendiente a reembolso";
                break;
            }

            case 25: {
                return "No se pudo realizar la operación debido a que el código de autorización es inválido. La transacción está pendiente a reembolso";
                break;
            }

            case 26: {
                return "No se pudo realizar la operación debido a que el código de autorización ha expirado. La transacción está pendiente a reembolso";
                break;
            }

            case 27: {
                return "Merchant. La transacción está pendiente a reembolso";
                break;
            }

            case 28: {
                return "Merchant. Se debe realizar la petición de reembolso";
                break;
            }

            case 30: {
                return "Transaction seated";
                break;
            }


        }
    }


}