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

class Recarga
{

    private $ci_instance;
    private $country_code; //Código del pais
    private $currency_id; //Código de la moneda
    private $sales_user_id; // Código de vendedor
    private $mobile_operator; // operadora movil
    private $amount; //monto de la recarga
    private $customer_phone_number; //numero del cliente
    private $service_mode; // si la peticion es asincrónica y sincrónica
    private $partner_tx_id;
    private $partner_instance_id;
    private $channel;
    private $aditional_parameters;
    private $payment_method;
    private $xmlPaymentMethodParameters;



    /*
     * MOV=>Movistar
     * POR=>Porta (Claro)
     * ALE=>Alegro (CNT)
     * DTV=>Direct TV
     * TVC=>TV Cable
     * TUE=>Tuenti
     * */


    function __construct($pmobile_operator, $pamount, $pcustomer_phone_number)
    {
        $this->ci_instance = &get_instance();
        $this->country_code = 'EC';
        $this->currency_id = 'US';
        $this->sales_user_id = 'may.milton.vera';
        $this->mobile_operator = $pmobile_operator;
        $this->amount = $pamount;
        $this->customer_phone_number = $pcustomer_phone_number;
        $this->service_mode = 'S';

        $this->partner_tx_id = time();
        $this->partner_instance_id = 1;
        $this->channel = 'H2H';
        $this->aditional_parameters = "";
        $this->payment_method = 'EFE';
        $this->xmlPaymentMethodParameters = "";
    }

    //metodo para realizar las recargas
    public function recharge()
    {

        $url_desarrollo = 'http://201.234.83.210:1002/WSBWiseElectronicRecharges.asmx?WSDL';
        $url_produccion ='http://201.234.83.210:1002/WSBWiseElectronicRecharges.asmx?WSDL';


        $client = new SoapClient($url_desarrollo,array('trace' => 1, 'soap_version' => SOAP_1_1));

        $param = [
            'countryId'=>$this->country_code,
            'currencyId'=>$this->currency_id,
            'salesUserId'=>$this->sales_user_id,
            'mobileOperator'=>$this->mobile_operator,
            'amount'=>$this->amount,
            'customerPhoneNumber'=>$this->customer_phone_number,
            'serviceMode'=>$this->service_mode,
            'partnerTxId'=>$this->partner_tx_id,
            'partnerInstanceId'=>$this->partner_instance_id,
            'channel'=>$this->channel,
            'xmlAdditionalParameters'=>$this->aditional_parameters,
            'paymentMethod'=>$this->payment_method,
            'xmlPaymentMethodParameters'=>$this->xmlPaymentMethodParameters
        ];

        $result = $client->Recharge($param)->RechargeResult;


        $result = new SimpleXMLElement($result);

        $result_service = (object) $result;

        $is_ok_response = $this->process_response_code($result_service->ResponseCode);

        return [$result_service,$is_ok_response[0],$is_ok_response[1]]; //[Objeto de respuesta, true or false operation, msg validation]
    }

    public function echo_service(){
        $url_desarrollo = 'http://201.234.83.210:1002/WSBWiseElectronicRecharges.asmx?WSDL';
        $client = new SoapClient($url_desarrollo);

        // $headerbody = array('UserName' => 'tester', 'Password' => '111111', 'Culture' => 'es_ES', 'Version' => '9');
        //$headers = new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'LoginHeader', $headerbody);
        // $headers = new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'soap');
        //$client->__setSoapHeaders($headers);


        $result = $client->Echo();
        return $result;


    }

    private function process_response_code($code){
        $result = [];
        switch ($code){
            case 0:{
                $result[0] = true;
                $result[1] = "Transacción exitosa.";
                break;
            }

            case 1:{
                $result[0] = false;
                $result[1] = "Vendedor no válido.";
                break;
            }

            case 2:{
                $result[0] = false;
                $result[1] = "Contraseña incorrecta.";
                break;
            }

            case 3:{
                $result[0] = false;
                $result[1] = "Cliente no válido.";
                break;
            }
            case 4:{
                $result[0] = false;
                $result[1] = "Monto sobre el máximo.";
                break;
            }

            case 5:{
                 $result[0] = false;
                $result[1] = "Monto bajo el mínimo";
                break;
            }

            case 6:{
                $result[0] = false;
                $result[1] = "Balance insuficiente";
                break;
            }

            case 7:{
                $result[0] = false;
                $result[1] = "Transacción duplicada";
                break;
            }

            case 8:
            case -1:{
                $result[0] = false;
                $result[1] = "Error en el servicio";
                break;
            }

            case 9:{
                $result[0] = false;
                $result[1] = "Operación no autorizada.";
                break;
            }

            case 10:{
                $result[0] = false;
                $result[1] = "El usuario no tiene permisos de canal";
                break;
            }

            case 11:{
                $result[0] = false;
                $result[1] = "Destinatario no Válido";
                break;
            }

            case 12:{
                $result[0] = false;
                $result[1] = "Comprobante utilizado. ";
                break;
            }

            case 13:{
                $result[0] = false;
                $result[1] = "Monto no válido. ";
                break;
            }

            case 14:{
                $result[0] = false;
                $result[1] = "Transacción previamente reversada";
                break;
            }

            case 15:{
                $result[0] = false;
                $result[1] = "No se encuentra transacción a reversar.";
                break;
            }

            case 16:{
                $result[0] = false;
                $result[1] = "Parámetros no válidos.";
                break;
            }

            case 17:{
                $result[0] = false;
                $result[1] = "Súpero el numero de intentos.";
                break;
            }

            case 18:{
                $result[0] = false;
                $result[1] = "Debe cambiar su clave";
                break;
            }

            case 19:{
                $result[0] = false;
                $result[1] = "Canal no existe";
                break;
            }

            case 20:{
                $result[0] = false;
                $result[1] = "Operadora no existe";
                break;
            }

            case 21:{
                $result[0] = false;
                $result[1] = "Forma de pago no existe";
                break;
            }

            case 22:{
                $result[0] = false;
                $result[1] = "Pin no disponible";
                break;
            }

            case 23:{
                $result[0] = false;
                $result[1] = "Tiempo excedido para el reverso";
                break;
            }
            case 24:{
                $result[0] = false;
                $result[1] = "Celular cliente en estado no válido para recargas";
                break;
            }
            case 25:{
                $result[0] = false;
                $result[1] = "Id de terminal no válido";
                break;
            }

            case 26:{
                $result[0] = false;
                $result[1] = "Id de distribuidor no válido";
                break;
            }

            case 27:{
                $result[0] = false;
                $result[1] = "Distribuidor inactivo";
                break;
            }

            case 28:{
                $result[0] = false;
                $result[1] = "Transacción no registrada";
                break;
            }

            case 29:{
                $result[0] = false;
                $result[1] = "Caducó petición.";
                break;
            }

            case 30:{
                $result[0] = false;
                $result[1] = "Cliente ha excedido monto máximo de activación";
                break;
            }

            case 31:{
                $result[0] = false;
                $result[1] = "Distribuidor ha excedido monto máximo de venta.";
                break;
            }

            case 32:{
                $result[0] = false;
                $result[1] = "Distribuidor ha excedido máximo de transacciones";
                break;
            }

            case 32:{
                $result[0] = false;
                $result[1] = "Comprobante no válido";
                break;
            }




        }

        return $result;
    }

    //metodos de acceso
    public function get_country_code(){
        return $this->country_code;
    }

    public function get_currency_id(){
        return $this->currency_id;
    }

    public function get_sales_user_id(){
        return $this->sales_user_id;
    }

    public function get_mobile_operator(){
        return $this->mobile_operator;
    }

    public function get_amount(){
        return $this->amount;
    }

    public function get_customer_phone_number(){
        return $this->customer_phone_number;
    }

    public function get_service_mode(){
        return $this->service_mode;
    }

    public function get_partner_tx_id(){
        return $this->partner_tx_id;
    }

    public function get_partner_instance_id(){
        return $this->partner_instance_id;
    }

    public function get_channel(){
        return $this->channel;
    }

    public function get_aditional_parameters(){
        return $this->aditional_parameters;
    }

    public function get_payment_method(){
        return $this->payment_method;
    }

    public function get_xmlPaymentMethodParameters(){
        return $this->xmlPaymentMethodParameters;
    }

    public function get_comision(){
        $comision = 0;
        switch ($this->mobile_operator){
            case "ALE":{
                $comision = $this->amount * 0.1; //10% recargas CNT
                break;
            }
            case "POR":{
                $comision = $this->amount * 0.065; // 6.5% recargas claro
                break;
            }
            case "MOV":{
                $comision = $this->amount * 0.055; // 5.5% recargas movistar
                break;
            }
            case "TUE":{
                $comision = $this->amount * 0.055; // 5.5% recargas tuenti
                break;
            }
            case "DTV":{
                $comision = $this->amount * 0.065; // 6.5% recargas direct tv
                break;
            }
            case "TVC":{
                $comision = $this->amount * 0.085; // 8.5% recargas TV Cable
                break;
            }
            case "CNTTV":{
                $comision = $this->amount * 0.09; // 9% recargas CNT TV
                break;
            }
        }

        return $comision;
    }




















}

