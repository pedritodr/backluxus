<?php

/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 20/3/2017
 * Time: 9:22
 */
class SafetyPay
{

    private $enviroment;
    private $safetyPayUrl;
    private $safetypayHost;
    private $safetyPayKey;
    private $safetypaySignature;
    private $requestTime;
    private $salesCurrencyCode;
    private $action;

    public function __construct()
    {
       $entorno = 1;
       if($entorno == 0){ //entorno de pruebas
        $this->safetyPayUrl = "https://sandbox-mws2.safetypay.com/express/ws/v.3.0";
		$this->safetypayHost = "sandbox-mws2.safetypay.com";
		$this->safetyPayKey = "c635b3c152343d191d32dbdc6d6d102d";
		$this->safetypaySignature = "4c1a041a76743c9a3258fe289eb60da3";
       }else{ //entorno de produccion
        $this->safetyPayUrl = "https://mws2.safetypay.com/express/ws/v.3.0";
		$this->safetypayHost = "mws2.safetypay.com";
		$this->safetyPayKey = "8ea60a3155a4fce93aceb587da41083e";
		$this->safetypaySignature = "60a0e4b7a3449a1a7303a40cca76dab8";
       }
       $this->requestTime = $this->getDateIso8601(time());
       $this->salesCurrencyCode = 'USD';
       $this->action = "";

    }

    public function getRequestDateTime(){
        return $this->requestTime;
    }

    public function getCurrencyCode(){
        return $this->salesCurrencyCode;
    }

    private function GetSignature( $aparams, $slist = '' )
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
                                                . $this->safetypaySignature );
        else
            $this->conf['Signature'] = sha256($this->requestTime
                                                . $allparams
                                                . $this->safetypaySignature);

        return $this->conf['Signature'];
    }

    
    function CreateExpressToken($data){
        $this->action = 'CreateExpressToken';
        $data['CurrencyCode'] = $this->salesCurrencyCode;
        $data['Language'] = 'ES';
        $signature = $this->GetSignature(
            $data,
            'CurrencyCode, Amount, MerchantSalesID,'
            . 'Language, TrackingCode, ExpirationTime,'
            . 'TransactionOkURL, TransactionErrorURL'
            );
      
        $data = (object)$data;    
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:safetypay:messages:mws:api" xmlns:urn1="urn:safetypay:schema:mws:api">
		<soapenv:Header/>
		<soapenv:Body>
		<urn:ExpressTokenRequest>
		<!--Optional:-->
		<urn:ApiKey>'.$this->safetyPayKey.'</urn:ApiKey>
		<!--Optional:-->
		<urn:RequestDateTime>'.$this->requestTime.'</urn:RequestDateTime>
		<!--Optional:-->
		<urn:CurrencyID>'.$this->salesCurrencyCode.'</urn:CurrencyID>
		<urn:Amount>'.$data->Amount.'</urn:Amount>
		<!--Optional:-->
		<urn:MerchantSalesID>'.$data->MerchantSalesID.'</urn:MerchantSalesID>
		<!--Optional:-->
		<urn1:Language>ES</urn1:Language>
		<!--Optional:-->
		<urn:TrackingCode>'.$data->TrackingCode.'</urn:TrackingCode>
		<!--Optional:-->
		<urn:ExpirationTime>'.$data->ExpirationTime.'</urn:ExpirationTime>
		<!--Optional:-->
		<urn:FilterBy>'.$data->FilterBy.'</urn:FilterBy>
		<!--Optional:-->
		<urn:TransactionOkURL>'.$data->TransactionOkURL.'</urn:TransactionOkURL>
		<!--Optional:-->
		<urn:TransactionErrorURL>'.$data->TransactionErrorURL.'</urn:TransactionErrorURL>
		<!--Optional:-->
		<urn:TransactionExpirationTime>'.$data->TransactionExpirationTime.'</urn:TransactionExpirationTime>
		<!--Optional:-->
		<urn:CustomMerchantName>'.$data->CustomMerchantName.'</urn:CustomMerchantName>
		<!--Optional:-->
		<urn:ShopperEmail>'.$data->ShopperEmail.'</urn:ShopperEmail>
		<!--Optional:-->
		<urn:Signature>'.$signature.'</urn:Signature>
		<urn:LocalizedCurrencyID>'.$data->LocalizedCurrencyID.'</urn:LocalizedCurrencyID>
		<urn:ShopperInformation>
		<!--Zero or more repetitions:-->
        <urn:ShopperFieldType Key="?" Value="?"/>
        <urn1:ShopperField Key="ShopperInformation_first_name" Value="'.$data->ShopperInformation->first_name.'"/>
        <urn1:ShopperField Key="ShopperInformation_last_name" Value="'.$data->ShopperInformation->last_name.'"/>
        <urn1:ShopperField Key="ShopperInformation_email" Value="'.$data->ShopperInformation->email.'"/>
        <urn1:ShopperField Key="ShopperInformation_document_type" Value="'.$data->ShopperInformation->document_type.'"/>
        <urn1:ShopperField Key="ShopperInformation_document_number" Value="'.$data->ShopperInformation->document_number.'"/>
        <urn1:ShopperField Key="ShopperInformation_address1" Value="'.$data->ShopperInformation->address1.'"/>
        <urn1:ShopperField Key="ShopperInformation_country_code" Value="'.$data->ShopperInformation->country_code.'"/>
        <urn1:ShopperField Key="ShopperInformation_mobile" Value="'.$data->ShopperInformation->mobile.'"/>
		<urn1:ShopperField Key="ShopperInformation_notify_expiration" Value="'.$data->ShopperInformation->notify_expiration.'"/></urn:ShopperInformation>
		</urn:ExpressTokenRequest>
		</soapenv:Body>
		</soapenv:Envelope>';
		
		try{
			$result = $this->curlSafetypay($xml);
			return $result;			
		}catch(Exception $e){
			return 'Excepción capturada: '.  $e->getMessage();
		}
	}
	
	function GetNewOperationActivity(){
        $data['RequestDateTime'] = $this->requestTime;        
        $this->action = 'GetNewOperationActivity';

        $signature = $this->GetSignature( $data,'RequestDateTime');
        
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:safetypay:messages:mws:api">
				<soapenv:Header/>
				<soapenv:Body>
				<urn:OperationActivityRequest>
				<urn:ApiKey>'.$this->safetyPayKey.'</urn:ApiKey>
				<urn:RequestDateTime>'.$this->requestTime.'</urn:RequestDateTime>
				<urn:Signature>'.$signature.'</urn:Signature>
				</urn:OperationActivityRequest>
				</soapenv:Body>
                </soapenv:Envelope>';
              
		
		try{
			$result = $this->curlSafetypay($xml);
			return $result;			
		}catch(Exception $e){
            
			return 'Excepción capturada: '.  $e->getMessage();
		}
	}
	
	function ConfirmNewOperationActivity($data){
        $this->action = 'ConfirmNewOperationActivity';
        
        $signature = $this->GetSignature($data,'OperationID, MerchantSalesID,'
        . 'MerchantOrderID, '
        . 'OperationStatus'
        );    
        
        

        $data = (object)$data;
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:safetypay:messages:mws:api">
				<soapenv:Header/>
				<soapenv:Body>
				<urn:OperationActivityNotifiedRequest>
				<urn:ApiKey>'.$this->safetyPayKey.'</urn:ApiKey>
				<urn:RequestDateTime>'.$this->requestTime.'</urn:RequestDateTime>
				<urn:ListOfOperationsActivityNotified>
				<urn1:ConfirmOperation xmlns:urn1="urn:safetypay:schema:mws:api">
				<urn1:CreationDateTime>'.$data->CreationDateTime.'</urn1:CreationDateTime>
				<urn1:OperationID>'.$data->OperationID.'</urn1:OperationID>
				<urn1:MerchantSalesID>'.$data->MerchantSalesID.'</urn1:MerchantSalesID>
				<urn1:MerchantOrderID>'.$data->MerchantOrderID.'</urn1:MerchantOrderID>
				<urn1:OperationStatus>'.$data->OperationStatus.'</urn1:OperationStatus>
				</urn1:ConfirmOperation>
				</urn:ListOfOperationsActivityNotified>
				<urn:Signature>'.$signature.'</urn:Signature>
				</urn:OperationActivityNotifiedRequest>
				</soapenv:Body>
				</soapenv:Envelope>';
		
		try{
			$result = $this->curlSafetypay($xml);
			return $result;			
		}catch(Exception $e){
			return 'Excepción capturada: '.  $e->getMessage();
		}
	}

    private function curlSafetypay($xml){
		//global $safetyPayUrl;
		global $safetypayHost;
		global $action;
		
		$len = strlen($xml);
		
		$headers = array(
			'Content-Type: text/xml; charset=utf-8',
			'Content-Length: '.$len,
			'Host: '.$this->safetypayHost.'',
			'SOAPAction: "urn:safetypay:contract:mws:api:'.$this->action.'"'
		);
				
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_URL, $this->safetyPayUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
  
		$response = curl_exec($ch);
		
		return $response;		
    }

    private function getDateIso8601( $int_date )
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
    


    
   



}

