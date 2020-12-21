<?php
/**
 * File: SafetyPayProxy.php
 * Author: SafetyPay Inc.
 * Description: Configuration Code
 * @version 2.0
 * @package class
 * @license Open Software License (OSL 3.0)
 * Copyright 2012-2016 SafetyPay Inc. All rights reserved.
*******************************************************************************/

//if (function_exists('ini_set'))	ini_set('error_reporting','E_ALL & ~(E_NOTICE)');

if(!@include(APPPATH.'libraries/sdk_safetypay/lib/nanolink-sha256.inc.php'))
    require_once APPPATH.'libraries/sdk_safetypay/lib/nanolink-sha256.inc.php';
if(!@include(APPPATH."libraries/sdk_safetypay/lib/simplexml.class.php"))
	require_once APPPATH."libraries/sdk_safetypay/lib/simplexml.class.php";

require_once APPPATH.'libraries/sdk_safetypay/class/SafetyPayWSDL.inc.php';

define('STP_SDK_NAME', 'WS PHP');
define('STP_SDK_VERSION', '3.1.1.0');

/*
 * SafetyPay Proxy Class
 *
 * @author   	SafetyPay IT Team
 * @version   	1.0
 * @package   	class
 */
class SafetyPayProxy
{
    var $wsdl;
    var $conf = array();

    /*
     * Set default values.
     */
    function __construct($api_key,$signature_key)
    {
       
        /*
         * API and Signature Key
         * Set your Sandbox/Prod Credential.
         * Generate your own keys in the MMS, option: Profile > Credentials
         */
        $this->conf['ApiKey'] = $api_key;
        $this->conf['SignatureKey'] = $signature_key;


        /*
         * 1: For Sandbox (Test);
         * 0: For Production
         */
        $this->conf['Environment'] = 1;
        
        /*
         * Sales Currency Code
         * Samples: USD, PEN, MXN, EUR.
         * Reverse Amount
         */        
        $this->conf['SalesCurrencyCode'] = 'USD';

        /*
         * Currency Code
         * Samples: USD, PEN, MXN, EUR.
         * Register your Default Currency market products, this must match your
         * Bank Account Affiliate. MMS, option: Profile > Bank Accounts.
         */
        $this->conf['CurrencyCode'] = 'USD';


        /*
         * ISO Code Language
         * Samples: EN, ES, DE, PT.
         */
        $this->conf['Language'] = 'ES';
        

        /*
         * Communication Protocol
         * 'http' or 'https'
         * Check also related parameter: 'port_ssl'.
         */
        $this->conf['Protocol'] = 'https';

      

        /*
         * Port number to connections SSL. Related at "Environment" parameter.
         */
        $this->conf['port_ssl'] = 443;
		
       
        /*
         * Request Date Time
         */
        $this->conf['RequestDateTime'] = $this->getDateIso8601(time());

        $this->setAccessPoint();
        $this->wsdl = $this->GetProxy();
    }

    function setConf( $conf )
    {
        foreach( $conf as $k => $v )
            $this->conf[$k] = $v;
    }

   
    function getConf(){
        return $this->conf;
    }

    /*
     * Setting correctly the Service URL
     */
    function setAccessPoint()
    {
        $_env = '';
        
        $domain_srv = 'mws2.safetypay.com';

        if ( $this->conf['Environment'] ){
            $_env = 'sandbox-';
        }

		$this->conf['WsdlURL'] = strtolower( $this->conf['Protocol'] )
			. '://' .$_env.$domain_srv.'/express/ws/v.3.0/';
    }

    /*
     * Get current ISO date from UNIX Timestamp
     */
    function getDateIso8601( $int_date )
    {
        $date_mod = date('Y-m-d\TH:i:s', $int_date);
        $pre_timezone = date('O', $int_date);
        $time_zone = substr($pre_timezone, 0, 3) . ':'
                            . substr($pre_timezone, 3, 2);
        $pos = strpos($time_zone, "-");
        if (PHP_VERSION >= '4.0')
            if ($pos === false) {
            	// nothing
            }
            else
                if ($pos != 0)
                    $date_mod = $time_zone;
                else
                    if (is_string($pos) && !$pos) {
                    // nothing
                    }
                    else
                        if ($pos != 0)
                            $date_mod = $time_zone;

        return $date_mod;
    }

    /*
     * Get Signature
     */
    function GetSignature( $aparams, $slist = '' )
    {
         
        $allparams = '';
        $alist = explode( ',', $slist );
        if ( !isset($aparams[0]) )
            foreach( $alist as $k => $v )
                $allparams .= $aparams[rtrim(ltrim($v))];
        else
            foreach( $aparams as $k => $v )
                foreach( $alist as $x => $z )
                    $allparams .= $v[rtrim(ltrim($z))];
		
		if ( preg_match('/RequestDateTime/', $slist) )
            $this->conf['Signature'] = sha256( $allparams
                                                . $this->conf['SignatureKey'] );
        else
            $this->conf['Signature'] = sha256( $this->conf['RequestDateTime']
                                                . $allparams
                                                . $this->conf['SignatureKey']);

        return $this->conf['Signature'];
    }

    /*
     * Create new instance
     */
    function GetProxy()
    {
        $this->wsdl = new SafetyPayWSDL();
        $this->wsdl->url = $this->conf['WsdlURL'];
        $this->wsdl->port_ssl = $this->conf['port_ssl'];

        return $this->wsdl;
    }

    /*
     * To test communication at WS
     */
    function CommunicationTest( $outtext = false )
    {
       
        $p = array( 'ApiKey' => $this->conf['ApiKey'],
                    'RequestDateTime' => $this->conf['RequestDateTime']
                    );
                 
        $p['Signature'] = $this->GetSignature($this->conf,'RequestDateTime');
        

        $Result = $this->wsdl->call( 'CommunicationTest',
                                        array( 'TestRequest' => $p )
                                    );
                                  
                                
        if ($outtext )
            $resp = $Result;
        elseif ( $Result['ErrorManager']['ErrorNumber']['@content'] == '0' )
            $resp = 'Communication Successful!';
        else
            $resp = 'Error: '.$Result['ErrorManager']['ErrorNumber']['@content']
                . ' - ' . $Result['ErrorManager']['Description']['@content'];

        return $resp;
    }

    /*
     * New Operation Activity retrieved by Merchants in previous process
     * GetNewOperationActivity, must be confirmed by using this process. By
     * this, those activities will not be sent again in the next
     * GetNewOperationActivity call.
     */
    function ConfirmNewOperationActivity( $params )
    {
        $p = array( 'ApiKey' => $this->conf['ApiKey'],
                    'RequestDateTime' => $this->conf['RequestDateTime'],
                    'ListOfOperationsActivityNotified' => $params
            );

        $p['Signature'] = $this->GetSignature($params['ConfirmOperation'][0],
                                                'OperationID, MerchantSalesID, '
                                                . 'MerchantOrderID, '
                                                . 'OperationStatus'
                                            );                                                     
                                                
        $Result = $this->wsdl->call('ConfirmNewOperationActivity',
                                    array( 'OperationActivityNotifiedRequest' => $p));

        return $Result;
    }

    /*
     * Merchants can notify SAFETYPAY about shipping to have a consolidate
     * report of their transactions.
     */
    function ConfirmShippedOrders( $params )
    {
        $p = array(	'ApiKey' => $this->conf['ApiKey'],
                    'RequestDateTime' => $this->conf['RequestDateTime'],
                    'ShippingDetail' => $params
                    );

        $p['Signature'] = $this->GetSignature( $params,
                                        'SalesOperationID, InvoiceDate, '
                                        .'InvoiceNo, ShipDate, ShipMethod, '
                                        .'DeliveryCompanyName, TrackingNumber, '
                                        .'RecipientName'
                                                );

        $Result = $this->wsdl->call( 'ConfirmShippedOrders',
                                    array( 'ShippedOrderRequest' => $p )
                                    );

        return $Result;
    }

    /*
     * To create a Token URL in order to request money, it can be send by email
     * by an automatic system, or any other method.
     * With this method you can implement "SafetyPay Express" Mode.
     */
    function CreateExpressToken($data)
    {
        /*
         * Total Amount
         */
        $this->conf['Amount'] = $data->Amount;

        /*
         * Tracking Code.
         * Leave blank
         */
        $this->conf['MerchantSalesID'] = $data->MerchantSalesID;
        $this->conf['TrackingCode'] = $data->TrackingCode;

          /*
         * URL Token Expiration Time
         * In minutes. Default value: 120 minutes.
         */
        $this->conf['ExpirationTime'] = $data->ExpirationTime;

        /*
         * Filter By
         * Filter options in screen Express service as Countries, Banks
         * or Currencies. Leave blank. Optional.
         * Samples:
         * COUNTRY(PER)CURRENCY(USD): Show only to Peru and pay with US Dollar
         * BANK(1011,1019)COUNTRY(ESP): Shown only to Spain and banks selected.
         *
         */
        $this->conf['FilterBy'] = $data->FilterBy;

        /*
         * Choose a URL for Return at message of sucess or fail paid process.
         */
        $this->conf['TransactionOkURL'] = $data->TransactionOkURL;
        $this->conf['TransactionErrorURL'] = $data->TransactionErrorURL;

        /*
         * Transaction Lifetime
         * In minutes.
         */
        $this->conf['TransactionExpirationTime'] = $data->TransactionExpirationTime;

        /*
         * Merchant's Customized Name shown shoppers on screen Express service.
         */
        $this->conf['CustomMerchantName'] = $data->CustomMerchantName;

        /*
         * ShopperEmail.
         */
        $this->conf['ShopperEmail'] = $data->ShopperEmail;

         /*
         * Localized Currency ISO Code
         * Samples: USD, PEN, MXN, EUR.
         */
        $this->conf['LocalizedCurrencyID'] = $data->LocalizedCurrencyID;
        $this->conf['ProductID'] = $data->ProductID;
        $this->conf['ShopperInformation'] = $data->ShopperInformation;
		


        $p = array(
        		'ApiKey' => $this->conf['ApiKey'],
                'RequestDateTime' => $this->conf['RequestDateTime'],
                'CurrencyID' => $this->conf['CurrencyCode'],
                'Amount' => round((float)strip_tags($this->conf['Amount']), 2),
                'MerchantSalesID' => $this->conf['MerchantSalesID'],
                'Language' => $this->conf['Language'],
                'TrackingCode' => $this->conf['TrackingCode'],
                'ExpirationTime' => $this->conf['ExpirationTime'],
                'FilterBy' => $this->conf['FilterBy'],
                'TransactionOkURL' => $this->conf['TransactionOkURL'],
                'TransactionErrorURL' => $this->conf['TransactionErrorURL'],
                'TransactionExpirationTime' => $this->conf['TransactionExpirationTime'],
                'CustomMerchantName' => $this->conf['CustomMerchantName'],
                'ShopperEmail' => $this->conf['ShopperEmail'],
				'LocalizedCurrencyID' => $this->conf['LocalizedCurrencyID'],
				'ProductID' => $this->conf['ProductID']
                );
           
				
		$items = array();
		foreach( $this->conf['ShopperInformation'] as $k => $v )
		{
			if ($k !== NULL && $v !== NULL && $v!=='')	 {  $items[] = array($k => $v);	}
		}
		$p['ShopperInformation']['KeyValue_ShopperFieldType'] = $items;
		
        $p['Signature'] = $this->GetSignature(
                                    $this->conf,
                                    'CurrencyCode, Amount, MerchantSalesID,'
                                    . 'Language, TrackingCode, ExpirationTime,'
                                    . 'TransactionOkURL, TransactionErrorURL'
                                    );
                                    
        $Result = $this->wsdl->call( 'CreateExpressToken',
                                        array( 'ExpressTokenRequest' =>
                                                $p )
                                    );

        return $Result;
    }

    /*
     * Create Express Token Reverse
     */
    function CreateExpressTokenReverse($data)
    {

        /*
         * Total Amount
         */
        $this->conf['Amount'] = $data->Amount;

        /*
         * Tracking Code.
         * Leave blank
         */
        $this->conf['MerchantSalesID'] = $data->MerchantSalesID;
        $this->conf['TrackingCode'] = $data->TrackingCode;

          /*
         * URL Token Expiration Time
         * In minutes. Default value: 120 minutes.
         */
        $this->conf['ExpirationTime'] = $data->ExpirationTime;

        /*
         * Filter By
         * Filter options in screen Express service as Countries, Banks
         * or Currencies. Leave blank. Optional.
         * Samples:
         * COUNTRY(PER)CURRENCY(USD): Show only to Peru and pay with US Dollar
         * BANK(1011,1019)COUNTRY(ESP): Shown only to Spain and banks selected.
         *
         */
        $this->conf['FilterBy'] = $data->FilterBy;

        /*
         * Choose a URL for Return at message of sucess or fail paid process.
         */
        $this->conf['TransactionOkURL'] = $data->TransactionOkURL;
        $this->conf['TransactionErrorURL'] = $data->TransactionErrorURL;

        /*
         * Transaction Lifetime
         * In minutes.
         */
        $this->conf['TransactionExpirationTime'] = $data->TransactionExpirationTime;

        /*
         * Merchant's Customized Name shown shoppers on screen Express service.
         */
        $this->conf['CustomMerchantName'] = $data->CustomMerchantName;

        /*
         * ShopperEmail.
         */
        $this->conf['ShopperEmail'] = $data->ShopperEmail;

         /*
         * Localized Currency ISO Code
         * Samples: USD, PEN, MXN, EUR.
         */
        $this->conf['LocalizedCurrencyID'] = $data->LocalizedCurrencyID;
        $this->conf['ProductID'] = $data->ProductID;
        $this->conf['ShopperInformation'] = $data->ShopperInformation;

        $p = array(
                'ApiKey' => $this->conf['ApiKey'],
                'RequestDateTime' => $this->conf['RequestDateTime'],
                'CurrencyID' => $this->conf['CurrencyCode'],
                'Amount' => round((float)strip_tags($this->conf['Amount']), 2),
                'MerchantSalesID' => $this->conf['MerchantSalesID'],
                'SalesCurrencyID' => $this->conf['SalesCurrencyCode'],
                'Language' => $this->conf['Language'],
                'TrackingCode' => $this->conf['TrackingCode'],
                'ExpirationTime' => $this->conf['ExpirationTime'],
                'FilterBy' => $this->conf['FilterBy'],
                'TransactionOkURL' => $this->conf['TransactionOkURL'],
                'TransactionErrorURL' => $this->conf['TransactionErrorURL'],
                'TransactionExpirationTime' => $this->conf['TransactionExpirationTime'],
                'CustomMerchantName' => $this->conf['CustomMerchantName'],
                'ShopperEmail' => $this->conf['ShopperEmail'],
				'LocalizedCurrencyID' => $this->conf['LocalizedCurrencyID'],
				'ProductID' => $this->conf['ProductID']
                );

		$items = array();
		foreach( $this->conf['ShopperInformation'] as $k => $v )
		{
			if ($k !== NULL && $v !== NULL && $v!=='')	 {  $items[] = array($k => $v);	}
		}
		$p['ShopperInformation']['KeyValue_ShopperFieldType'] = $items;
		
        $p['Signature'] = $this->GetSignature(
                                    $this->conf,
                                    'CurrencyCode, Amount, MerchantSalesID,SalesCurrencyCode,'
                                    . 'Language, TrackingCode, ExpirationTime,'
                                    . 'TransactionOkURL, TransactionErrorURL'
                                    );
        
        $Result = $this->wsdl->call( 'CreateExpressTokenReverse',
                                        array( 'ExpressTokenReverseRequest' =>
                                                $p )
                                    );

        return $Result;
    }
	
    /*
     * To amount refund to specific Sales Operation ID.
     */
    function CreateRefund( $params )
    {
        $this->conf['SalesOperationID'] = $params['SalesOperationID'];
        $this->conf['AmountToRefund'] = $params['AmountToRefund'];
        $this->conf['TotalPartial'] = $params['TotalPartial'];
        $this->conf['Reason'] = $params['Reason'];

        $p = array( 'ApiKey' => $this->conf['ApiKey'],
                    'RequestDateTime' => $this->conf['RequestDateTime'],
                    'SalesOperationID' => $params['SalesOperationID'],
                    'AmountToRefund' => $params['AmountToRefund'],
                    'TotalPartial' => $params['TotalPartial'],
					'MerchantRefundId' => $params['MerchantRefundId'],
                    'Reason' => $params['Reason'],
                    'Comments' => $params['Comments']                    
                    );

               
		
		$items = array();
		foreach( $params['ShopperInformation'] as $k => $v )
		{
			if ($k !== NULL && $v !== NULL && $v!=='')	 {  $items[] = array($k => $v);	}
		}
		$p['ShopperInformation']['KeyValue_ShopperField'] = $items;

        $p['Signature'] = $this->GetSignature(
                                    $params,
                                    'SalesOperationID, AmountToRefund, '
                                    . 'TotalPartial, Reason'
                                    );

        $Result = $this->wsdl->call( 'CreateRefund',
                                        array( 'RefundProcessRequest' =>
                                            $p )
                                    );

        return $Result;
    }

	function GetNewTokenID($param)
	{
		$tokenURL = '';
		$this->conf['CurrencyCode'] = $param->CurrencyCode;
		$this->conf['Amount'] = $param->Amount;
		$this->conf['MerchantSalesID'] = $param->MerchantSalesID;
		$this->conf['ExpirationTime'] = $param->ExpirationTime;
		//$this->conf['FilterBy'] = 'COUNTR(BRA)';
        $this->conf['ProductID'] = $param->ProductID;
        
		$tokenID = $this->CreateExpressToken();
		if ($tokenID['ErrorManager']['ErrorNumber']['@content'] == '0')
			$tokenURL = $tokenID['ShopperRedirectURL'];
		else
			$tokenURL = $this->conf['TransactionErrorURL'];
		
		return $tokenURL;
	}
	
    /*
     * Retrieve all new operation activity. This includes new Paid Orders.
     * The activity will be sent again if they are not confirmed in
     * process ConfirmNewOperationActivity.
     */
    function GetNewOperationActivity()
    {
        $p = array( 'ApiKey' => $this->conf['ApiKey'],
                    'RequestDateTime' => $this->conf['RequestDateTime']
                    );
        
        $p['Signature'] = $this->GetSignature( $this->conf,'RequestDateTime');

        $Result = $this->wsdl->call( 'GetNewOperationActivity',
                                    array( 'OperationActivityRequest' =>
                                            $p )
                                    );

        return $Result;
    }

    /*
     * Retrieve all operation activity for a specific operation.
     */
    function GetOperation($saleID)
    {
        $this->conf['MerchantSalesID'] = $saleID;

        $p = array( 'ApiKey' => $this->conf['ApiKey'],
                    'RequestDateTime' => $this->conf['RequestDateTime'],
                    'MerchantSalesID' => $saleID
                    );

        $p['Signature'] = $this->GetSignature( $this->conf, 'MerchantSalesID' );

        $Result = $this->wsdl->call( 'GetOperation',
                                        array( 'OperationRequest' =>
                                                $p )
                                    );

        return $Result;
    }
}
?>