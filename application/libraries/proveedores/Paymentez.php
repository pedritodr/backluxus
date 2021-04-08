<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentez
{

    function __construct()
    {

    }

    private function strToHex($string)
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0' . $hexCode, -2);
        }
        return strToUpper($hex);
    }

    private function hexToStr($hex)
    {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
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