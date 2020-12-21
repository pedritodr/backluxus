<?php

/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 07/08/2018
 * Time: 9:22
 */

class PaymentPointList {
  
  public $Pais;
  public $Ciudad;
  public $Direccion;
  public $MasDatos;
  public $Poblado;
  public $Telefono1;
  public $Telefono2;
  public $Retorno;
  public $HorarioLV;
  public $HorarioS;
  public $HorarioD;
  public $Delegacion;
  public $CorrID;  

  function __construct($ppais,$pciudad,$pdireccion,$pmasdatos,$ppoblado,$ptelefono1,$ptelefono2,$pretorno, $phorariolv, $phorarios,$phorariod,$pdelegacion,$pcorrid){
    $this->Pais = $ppais;
    $this->Ciudad = $pciudad;
    $this->Direccion = $pdireccion;
    $this->MasDatos = $pmasdatos;
    $this->Poblado = $ppoblado;
    $this->Telefono1 = $ptelefono1;
    $this->Telefono2 = $ptelefono2;
    $this->Retorno = $pretorno;
    $this->HorarioLV = $phorariolv;
    $this->HorarioS = $phorarios;
    $this->HorarioD = $phorariod;
    $this->Delegacion = $pdelegacion;
    $this->CorrID = $pcorrid;
  }
  
  
}

class OperationConcept{
    public $ConceptID;
    public $ConceptName;

    function __construct($pconceptId,$pconceptName){
        $this->ConceptID = $pconceptId;
        $this->ConceptName = $pconceptName;
    }
}

class AvailableBank{
    public $BankCode;
    public $BankName;

    function __construct($pbankCode,$pbankName){
        $this->BankCode = $pbankCode;
        $this->BankName = $pbankName;
    }

}

class SenderEconomicactivity{
    public $actv_ID;
    public $actv_Actividad;

    function __construct($pid,$pname){
        $this->actv_ID = $pid;
        $this->actv_Actividad = $pname;
    }
}

class SenderReceiverRelationship{
    public $sttFlag;
    public $stt_Word;

    function __construct($pid,$pname){
        $this->sttFlag = $pid;
        $this->stt_Word = $pname;
    }
}

class Receiver{
    public $ReceiverCode;
    public $ReceiverName;
    public $ReceiverLastName;
    public $ReceiverAdressLine1;
    public $ReceiverAdressLine2;
    public $ReceiverTelephone1;
    public $ReceiverTelephone2;
    public $ReceiverCity;
    public $ReceiverCountry;

    function __construct($pcode,$pname,$plastname,$paddress1,$paddress2,$pphone1,$pphone2,$pcity,$pcountry){
        $this->ReceiverCode = $pcode;
        $this->ReceiverName = $pname;
        $this->ReceiverLastName = $plastname;
        $this->ReceiverAdressLine1 = $paddress1;
        $this->ReceiverAdressLine2 = $paddress2;
        $this->ReceiverTelephone1 = $pphone1;
        $this->ReceiverTelephone2 = $pphone2;
        $this->ReceiverCity = $pcity;
        $this->ReceiverCountry = $pcountry;
    }
}

class Bank{
    public $Id;
    public $bankName;
    public $branch;
    public $branchCity;
    public $accountType;
    public $accountNumber;

    function __construct($pid,$pbankname,$pbranch,$pbranchcity,$paccounttype,$paccountnumber){
        $this->Id = $pid;
        $this->bankName = $pbankname;
        $this->branch = $pbranch;
        $this->branchCity = $pbranchcity;
        $this->accountType = $paccounttype;
        $this->accountNumber = $paccountnumber;        
    }


}

class Cambio{
    public $CountryCode;
    public $Correspondent;
    public $CollectCurrency;
    public $DeliverCurrency;
    public $ExchangeRate;
    public $Fee;

    function __construct($pcountryCode,$pCorrespondent,$pcollectCurrency,$pdeliveryCurrency,$exchangeRate,$pFee){
        $this->CountryCode = $pcountryCode;
        $this->Correspondent = $pCorrespondent;
        $this->CollectCurrency = $pcollectCurrency;
        $this->DeliverCurrency = $pdeliveryCurrency;
        $this->ExchangeRate = $exchangeRate;
        $this->Fee = $pFee;        
    }

}

class Corresponsal{
    public $AmmountToSend;
    public $Total;
    public $Fee;
    public $ExchangeRate;
    public $AmmountToDeliver;
    public $CurrencyName;
    public $CorrespondentCode;
    public $CorrespondentName;

    function __construct($AmmountToSend,$Total,$Fee,$ExchangeRate,$AmmountToDeliver,$CurrencyName,$CorrespondentCode,$CorrespondentName){
        $this->AmmountToSend = $AmmountToSend;
        $this->Total = $Total;
        $this->Fee = $Fee;
        $this->ExchangeRate = $ExchangeRate;
        $this->AmmountToDeliver = $AmmountToDeliver;
        $this->CurrencyName = $CurrencyName;  
        $this->CorrespondentCode = $CorrespondentCode;
        $this->CorrespondentName = $CorrespondentName;      
    }

}

class Token{
    public $MtToken;
    public $AmmountToSend;
    public $Charges;
    public $AmmountToDeliver;
    public $CurrencyPayName;
    public $ExchangeRateLD;
    public $CodCorresponsal;
    public $NomCorresponsal;

    function __construct($MtToken,$AmmountToSend,$Charges,$AmmountToDeliver,$CurrencyPayName,$ExchangeRateLD,$CodCorresponsal,$NomCorresponsal){
        $this->MtToken = $MtToken;
        $this->AmmountToSend = $AmmountToSend;
        $this->Charges = $Charges;
        $this->AmmountToDeliver = $AmmountToDeliver;
        $this->CurrencyPayName = $CurrencyPayName;
        $this->ExchangeRateLD = $ExchangeRateLD;  
        $this->CodCorresponsal = $CodCorresponsal;
        $this->NomCorresponsal = $NomCorresponsal;      
    }

}

class LatinTravelRemesas
{  
    private $agentCode;
    private $agentPassword;
    private $urlService;
    
    public function __construct()
    {
        $this->agentCode = '102';
        $this->agentPassword = 'TQ66672';
        $this->urlService = 'http://sandbox.legionelite.com:11500/LTEC/LE_TFWEB_IN.asmx?WSDL';
    }

    //obtiene la lista de puntos de pagos asociados a un pais, este método solo es necesario cuando la recogida es en efectivo
    //ok
    public function listaPuntosPago($country_code = ""){


        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));            
      
       
        $param_array = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'CountryCode'=>$country_code,
            'CityName'=>''
        ];
                    
        $params = array(
            "CD" => $param_array
        );
           
        $result = $client->PaymentPointList($params)->PaymentPointListResult;
               
        
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{
            $lista = $result->PaymentPointList;
            $cadena_object_xml = $lista->any;
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        

            $data_xml   = simplexml_load_string($lista)->asXML();
            $xml = new SimpleXMLElement($data_xml);

            $lista_puntos  = [];
            for($i = 0;$i<count($xml->DocumentElement->LEDATA);$i++){
                $pais = $xml->DocumentElement->LEDATA[$i]->Pais;
                $ciudad = $xml->DocumentElement->LEDATA[$i]->Ciudad;
                $direccion = $xml->DocumentElement->LEDATA[$i]->Direccion;
                $masdatos = $xml->DocumentElement->LEDATA[$i]->MasDatos;
                $poblado = $xml->DocumentElement->LEDATA[$i]->Poblado;
                $telefono1 = $xml->DocumentElement->LEDATA[$i]->Telefono1;
                $telefono2 = $xml->DocumentElement->LEDATA[$i]->Telefono2;
                $retorno = $xml->DocumentElement->LEDATA[$i]->Retorno;
                $horariolv = $xml->DocumentElement->LEDATA[$i]->HorarioLV;
                $horarios = $xml->DocumentElement->LEDATA[$i]->HorarioS;
                $horariod = $xml->DocumentElement->LEDATA[$i]->HorarioD;
                $delegacion = $xml->DocumentElement->LEDATA[$i]->Delegacion;
                $corrid = $xml->DocumentElement->LEDATA[$i]->CorrID;

                $lista_puntos[] = new PaymentPointList($pais,$ciudad,$direccion,$masdatos,$poblado,$telefono1,$telefono2,$retorno,$horariolv,$horarios,$horariod,$delegacion,$corrid);
            }
            return [true,$lista_puntos];                
        }           


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }

    }
    
    //obtiene la lista de actividades economicas disponibles para un pais, estas actividades son para el que envia el dinero
    //ok
    public function listaActividadesEconomicasPorPais($country_code = ""){
        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
                
        $param_array = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'SenderCountryCode'=>$country_code
        ];            
           
        $params = array(
            "CD" => $param_array
        );
           
        $result = $client->SenderEconomicActivity($params)->SenderEconomicActivityResult;
        
               
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{

            $lista =$result->SenderEconomicactivityList;          
            $cadena_object_xml = $lista->any;           
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        
           
            $data_xml   = simplexml_load_string($lista)->asXML();           
            $xml = new SimpleXMLElement($data_xml);
            
            
            $lista_actividades_economicas  = [];
            for($i = 0;$i<count($xml->DocumentElement->LEDATA);$i++){
                $act_id = $xml->DocumentElement->LEDATA[$i]->actv_ID;
                $act_name = $xml->DocumentElement->LEDATA[$i]->actv_Actividad;
                $lista_actividades_economicas[] = new SenderEconomicactivity($act_id,$act_name);
            }
            return [true,$lista_actividades_economicas];
                           
        }           


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }    

     //obtiene la lista conceptos de operaciones por apis
     //ok
     public function listaConceptosOperacionesPorPais($country_code = ""){
        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
       $param_array = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'SenderCountryCode'=>$country_code
        ];      
           
        $params = array(
            "CD" => $param_array
        );
           
        $result = $client->OperationsConceptsList($params)->OperationsConceptsListResult;   
        
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{
            $lista = $result->OperationsConceptsList;            
            $cadena_object_xml = $lista->any;           
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        
           
            $data_xml   = simplexml_load_string($lista)->asXML();           
            $xml = new SimpleXMLElement($data_xml);
            
            
            $lista_conceptos  = [];
            for($i = 0;$i<count($xml->DocumentElement->Concepts);$i++){
                $concept_id = $xml->DocumentElement->Concepts[$i]->ConceptID;
                $concept_name = $xml->DocumentElement->Concepts[$i]->ConceptName;
                $lista_conceptos[] = new OperationConcept($concept_id,$concept_name);
            }
            return [true,$lista_conceptos];                
        }           


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

     //obtiene la lista de bancos disponibles por pais
    //ok
    public function listaBancosDisponiblesPorPais($country_code = ""){
        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
      
        $param_array = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'ReceiverCountryCode'=>$country_code
        ];     
           
        $params = array(
            "CD" => $param_array
        );
           
        $result = $client->AvaliableReceiverBanksList($params)->AvaliableReceiverBanksListResult;
        
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{
            $lista = $result->AvaliableReceiverBanks;
            $cadena_object_xml = $lista->any;           
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        
           
            $data_xml   = simplexml_load_string($lista)->asXML();           
            $xml = new SimpleXMLElement($data_xml);
            
            
            $lista_bancos_disponibles  = [];
            for($i = 0;$i<count($xml->DocumentElement->LEDATA);$i++){
                $bank_code = $xml->DocumentElement->LEDATA[$i]->BankCode;
                $bank_name = $xml->DocumentElement->LEDATA[$i]->BankName;
                $lista_bancos_disponibles[] = new AvailableBank($bank_code,$bank_name);
            }
            return [true,$lista_bancos_disponibles];                
        }           


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //registrar un nuevo cliente en la infraestructura de latintravel
    //ok
    public function crearNuevoCliente($dataCliente){
        /*
        $dataCliente['senderName']  = "Rafael Felipe";
        $dataCliente['senderLastName']  = "Bomate Gavio";
        $dataCliente['senderSex']  = "M";
        $dataCliente['senderDocumentType']  = "PAS";        
        $dataCliente['senderDocumentNumber'] = "I210972";
        $dataCliente['senderDocumentExpiration'] = "2020-03-16";
        $dataCliente['senderDocumnetIssued'] = "PER";
        $dataCliente['senderDocumentIssuedDate'] = "2014-07-07";
        $dataCliente['senderStreet'] = "República de El Salvador y Moscú";
        $dataCliente['senderHouseNumber'] = "3-3";
        $dataCliente['senderFloorAndDoor'] = "Piso 3";
        $dataCliente['senderCity']= "Quito";
        $dataCliente['senderPostalCode']="14500";
        $dataCliente['senderProvince'] = "Pichincha";
        $dataCliente['senderCountry'] = "ECU";
        $dataCliente['senderTelephone1'] = "+593987670081";
        $dataCliente['senderTelephone2'] = "+593654789687";
        $dataCliente['senderBirthDate'] = "1986-04-24";
        $dataCliente['senderBirthCountry'] = "CUB";
        $dataCliente['senderOccupation'] = "0";
        $dataCliente['senderSalary'] = "450";
        $dataCliente['senderNationality']= "CUB";
        $dataCliente['senderMail'] = "rfbomate86@gmail.com";
        $dataCliente['senderCodiceFiscale'] = ""; */

        $senderName = $dataCliente['senderName'];
        $senderLastName = $dataCliente['senderLastName'];
        $senderSex = $dataCliente['senderSex']; // M o F
        $senderDocumentType = $dataCliente['senderDocumentType']; //OTH, PAS, RES, DNI, NONE
        $senderDocumentNumber = $dataCliente['senderDocumentNumber'];
        $senderDocumentExpiration = $dataCliente['senderDocumentExpiration'];
        $senderDocumnetIssued = $dataCliente['senderDocumnetIssued'];
        $senderDocumentIssuedDate = $dataCliente['senderDocumentIssuedDate'];
        $senderStreet = $dataCliente['senderStreet'];
        $senderHouseNumber = $dataCliente['senderHouseNumber'];
        $senderFloorAndDoor = $dataCliente['senderFloorAndDoor'];
        $senderCity = $dataCliente['senderCity'];
        $senderPostalCode = $dataCliente['senderPostalCode'];
        $senderProvince = $dataCliente['senderProvince'];  
        $senderCountry = $dataCliente['senderCountry'];
        $senderTelephone1 = $dataCliente['senderTelephone1'];
        $senderTelephone2 = $dataCliente['senderTelephone2'];
        $senderBirthDate = $dataCliente['senderBirthDate'];
        $senderBirthCountry = $dataCliente['senderBirthCountry'];
        $senderOccupation = $dataCliente['senderOccupation'];
        $senderSalary = $dataCliente['senderSalary'];
        $senderNationality = $dataCliente['senderNationality'];
        $senderMail = $dataCliente['senderMail'];

        $senderCodiceFiscale = "";
        if($senderCountry == 'ITA'){
            $senderCodiceFiscale = $dataCliente['senderCodiceFiscale'];
        }

        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
       
        $data_param = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'SenderName'=>$senderName,
            'SenderLastName'=>$senderLastName,
            'SenderSex'=>$senderSex,
            'SenderDocumentType'=>$senderDocumentType,
            'SenderDocumentNumber'=>$senderDocumentNumber,
            'SenderDocumentExpiration'=>$senderDocumentExpiration,
            'SenderDocumnetIssued'=>$senderDocumnetIssued,
            'SenderDocumentIssuedDate'=>$senderDocumentIssuedDate,
            'SenderStreet'=>$senderStreet,
            'SenderHouseNumber'=>$senderHouseNumber,
            'SenderFloorAndDoor'=>$senderFloorAndDoor,
            'SenderCity'=>$senderCity,
            'SenderPostalCode'=>$senderPostalCode,
            'SenderProvince'=>$senderProvince,
            'SenderCountry'=>$senderProvince,
            'SenderCountry'=>$senderCountry,
            'SenderTelephone1'=>$senderTelephone1,
            'SenderTelephone2'=>$senderTelephone2,
            'SenderBirthDate'=>$senderBirthDate,
            'SenderBirthCountry'=>$senderBirthCountry,
            'SenderOccupation'=>$senderOccupation,
            'SenderSalary'=>$senderSalary,
            'SenderNationality'=>$senderNationality,
            'SenderMail'=>$senderMail,
            'SenderCodiceFiscale'=>$senderCodiceFiscale
        ];            
           
        $params = array(
            "CD" => $data_param
        );
           
        $result = $client->NewCustomer($params)->NewCustomerResult;          
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }else{
            return [true,$result->ReturnCode];    // devuelve el codigo del cliente            
        }           


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
        
        
    }

    //obtener las relaciones sender - Receiver
    //ok
    public function matrizSenderReceiver(){
        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
       

        $param_array = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=> $this->agentPassword
        ];            
           
        $params = array(
            "CD" => $param_array
        );
           
        $result = $client->SenderReceiverRelatioship($params)->SenderReceiverRelatioshipResult;       
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{

            $lista = $result->RelationList;
            $cadena_object_xml = $lista->any;           
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        
           
            $data_xml   = simplexml_load_string($lista)->asXML();           
            $xml = new SimpleXMLElement($data_xml);
                        
            
            $lista_relaciones  = [];
            for($i = 0;$i<count($xml->DocumentElement->LEDATA);$i++){
                $relation_id = $xml->DocumentElement->LEDATA[$i]->sttFlag;
                $relation_name = $xml->DocumentElement->LEDATA[$i]->stt_Word;
                $lista_relaciones[] = new SenderReceiverRelationship($relation_id,$relation_name);
            }

            return [true,$lista_relaciones];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //registrar un nuevo receptor de dinero
    //ok
    public function crearNuevoReceptorDinero($dataReceptor){
        $customerNumber = $dataReceptor['customerNumber'];
        $receiverName = $dataReceptor['receiverName'];
        $receiverLastName = $dataReceptor['receiverLastName']; 
        $receiverAdressLine1 = $dataReceptor['receiverAdressLine1']; 
        $receiverAdressLine2 = $dataReceptor['receiverAdressLine2'];
        $receiverCity = $dataReceptor['receiverCity'];
        $receiverCountry = $dataReceptor['receiverCountry'];
        $receiverTelephone1 = $dataReceptor['receiverTelephone1'];
        $receiverTelephone2 = $dataReceptor['receiverTelephone2'];
        $senderReceiverRelationship = $dataReceptor['senderReceiverRelationship'];
        $receiverDOB = $dataReceptor['ReceiverDOB'];
        
        /*
        $data['customerNumber']  = "55";
        $data['receiverName']  = "Darío";
        $data['receiverLastName']  = "Valdes Musibay";
        $data['receiverAdressLine1']  = "José Tamayo y Luis Cordero";        
        $data['receiverAdressLine2'] = "Edificio Tamayo Plaza";
        $data['receiverCity'] = "Lima";
        $data['receiverCountry'] = "PER";
        $data['receiverTelephone1'] = "+5936547852";
        $data['receiverTelephone2'] = "+5936541287";
        $data['senderReceiverRelationship'] = "3"; //revisar como obtengo este valor sttFlag
        */
       

        

        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));          
      

        $param_array = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'CustomerNumber'=>$customerNumber,
            'ReceiverName'=>$receiverName,
            'ReceiverLastName'=>$receiverLastName,
            'ReceiverAdressLine1'=>$receiverAdressLine1,
            'ReceiverAdressLine2'=>$receiverAdressLine2,
            'ReceiverCity'=>$receiverCity,
            'ReceiverCountry'=>$receiverCountry,
            'ReceiverTelephone1'=>$receiverTelephone1,
            'ReceiverTelephone2'=>$receiverTelephone2,
            'SenderReceiverRelationship'=>$senderReceiverRelationship,
            'ReceiverDOB'=>$receiverDOB
        ];            
           
        $params = array(
            "CD" => $param_array
        );
           
        $result = $client->ReceiverNew($params)->ReceiverNewResult;
          
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }else{
            return [true,$result->ReturnCode]; //devuelve el codigo del beneficiario   10             
        }           


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //listar beneficiarios dado un cliente
    //ok
    public function getReceptoresByCliente($customerCode = ""){
        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
      
        
        $param_array = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'CustomerCode'=>$customerCode
        ];            
        $params = array(
            "CD" => $param_array
        );
           
        $result = $client->ReceiverList($params)->ReceiverListResult;
          
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{

            $lista = $result->ReceiverList;
            $cadena_object_xml = $lista->any;           
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        
           
            $data_xml   = simplexml_load_string($lista)->asXML();           
            $xml = new SimpleXMLElement($data_xml);
            
            
            $lista_receptores  = [];
            for($i = 0;$i<count($xml->DocumentElement->LEDATA);$i++){
                $ReceiverCode = $xml->DocumentElement->LEDATA[$i]->ReceiverCode;
                $ReceiverName = $xml->DocumentElement->LEDATA[$i]->ReceiverName;
                $ReceiverLastName = $xml->DocumentElement->LEDATA[$i]->ReceiverLastName;
                $ReceiverAdressLine1 = $xml->DocumentElement->LEDATA[$i]->ReceiverAdressLine1;
                $ReceiverAdressLine2 = $xml->DocumentElement->LEDATA[$i]->ReceiverAdressLine2;
                $ReceiverTelephone1 = $xml->DocumentElement->LEDATA[$i]->ReceiverTelephone1;
                $ReceiverTelephone2 = $xml->DocumentElement->LEDATA[$i]->ReceiverTelephone2;
                $ReceiverCity = $xml->DocumentElement->LEDATA[$i]->ReceiverCity;
                $ReceiverCountry = $xml->DocumentElement->LEDATA[$i]->ReceiverCountry;


                $lista_receptores[] = new Receiver($ReceiverCode,$ReceiverName,$ReceiverLastName,$ReceiverAdressLine1,$ReceiverAdressLine2,$ReceiverTelephone1,$ReceiverTelephone2,$ReceiverCity,$ReceiverCountry);
            }
            return [true,$lista_receptores];    

                          
        }            


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //editar datos de beneficiarios
    //ok
    public function editarReceptorDinero($dataReceptor){
        $customerNumber = $dataReceptor['customerNumber'];
        $receiverName = $dataReceptor['receiverName'];
        $receiverLastName = $dataReceptor['receiverLastName']; 
        $receiverAdressLine1 = $dataReceptor['receiverAdressLine1']; 
        $receiverAdressLine2 = $dataReceptor['receiverAdressLine2'];
        $receiverCity = $dataReceptor['receiverCity'];
        $receiverCountry = $dataReceptor['receiverCountry'];
        $receiverTelephone1 = $dataReceptor['receiverTelephone1'];
        $receiverTelephone2 = $dataReceptor['receiverTelephone2'];
        $senderReceiverRelationship = $dataReceptor['senderReceiverRelationship'];
        $receiverDOB = $dataReceptor['receiverDOB'];

        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
        $param_data = [
                'AgentCode'=>$this->agentCode,
                'AgentPassword'=>$this->agentPassword,
                'CustomerCode'=>$customerNumber,
                'ReceiverCode'=>$dataReceptor['receiverCode'],
                'ReceiverName'=>$receiverName,
                'ReceiverLastName'=>$receiverLastName,
                'ReceiverAdressLine1'=>$receiverAdressLine1,
                'ReceiverAdressLine2'=>$receiverAdressLine2,
                'ReceiverCity'=>$receiverCity,
                'ReceiverCountry'=>$receiverCountry,
                'ReceiverTelephone1'=>$receiverTelephone1,
                'ReceiverTelephone2'=>$receiverTelephone2,
                'SenderReceiverRelationship'=>$senderReceiverRelationship,
                'ReceiverDOB'=>$receiverDOB
        ];
           
        $params = array(
            "CD" => $param_data
        );
           
        $result = $client->ReceiverEdit($params)->ReceiverEditResult;
          
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }else{
            return [true,$result->ReturnCode]; //devuelve el codigo del beneficiario editado                
        }           


        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //lista de bancos asociados a un beneficiario
    //ok
    public function listaBancosByReceptor($receiverCode = ""){
        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
       
        $param_data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'ReceiverCode'=> $receiverCode
        ];
           
        $params = array(
            "CD" => $param_data
        );
           
        $result = $client->ReceiverBankAccountList($params)->ReceiverBankAccountListResult;       
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{

            $lista = $result->ReceiverBankList;
            $cadena_object_xml = $lista->any;           
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        
           
            $data_xml   = simplexml_load_string($lista)->asXML();           
            $xml = new SimpleXMLElement($data_xml);
                  
            
            $lista_bancos  = [];
            for($i = 0;$i<count($xml->DocumentElement->LEDATA);$i++){
                $ID = $xml->DocumentElement->LEDATA[$i]->ID;
                $BankName = $xml->DocumentElement->LEDATA[$i]->BankName;
                $Branch = $xml->DocumentElement->LEDATA[$i]->Branch;
                $BranchCity = $xml->DocumentElement->LEDATA[$i]->BranchCity;
                $AccountType = $xml->DocumentElement->LEDATA[$i]->AccountType;
                $AccontNumber = $xml->DocumentElement->LEDATA[$i]->AccontNumber;

                $lista_bancos[] = new Bank($ID,$BankName,$Branch,$BranchCity,$AccountType,$AccontNumber);
            }


            return [true,$lista_bancos];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //agregar un banco asocidado a un beneficiario
    //ok
    public function createBancobyReceptor($dataBanco){

        $receiverCode = $dataBanco['receiverCode'];
        $bankName = $dataBanco['bankName'];
        $branch = $dataBanco['branch'];
        $branchCity = $dataBanco['branchCity'];
        $accountType = $dataBanco['accountType']; //None, Savings, Current, Others
        $account = $dataBanco['account'];

        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
        
      
        $param_data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'ReceiverCode'=>$receiverCode,
            'BankName'=>$bankName,
            'Branch'=>$branch,
            'BranchCity'=>$branchCity,
            'AccountType'=>$accountType,
            'Account'=>$account
        ];
           
        $params = array(
            "CD" => $param_data
        );
           
        $result = $client->ReceiverBankAccountNew($params)->ReceiverBankAccountNewResult;       
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];        
        }else{
            return [true,$result->ReturnCode];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

   

    //enviar foto del documento del cliente que envia el dinero
    //ok    
    public function sendFotoSender($img_url,$customer_code){        

        $client = null;
        try {

        $client = new SoapClient($this->urlService,array('trace' => 1, 'soap_version' => SOAP_1_1));     
              
        $param_data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'CustomerCode'=>$customer_code,
            'Base64Image'=>base64_encode($img_url)
        ];

                  
        $params = array(
            "CD" => $param_data
        );
        $result = $client->SenderUploadImageDocument($params)->SenderUploadImageDocumentResult;       
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];        
        }else{
            return [true,$result->ReturnCode];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    


    
    //obtener tasas de cambio referenciales
    public function tasasCambioDisponibles($destinationCountryCode = ""){
        $client = null;
        try {

        $client = new SoapClient($this->urlService);     
        
        $data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'DestinationCountryCode'=> $destinationCountryCode,
            'IncludeCatchmentInEUR'=>TRUE,
            'IncludeCatchmentInUSD'=>FALSE
        ];    

        
                    
           
        $params = array(
            "CD" => $data
        );
           
        $result = $client->GetAvaliableExchangeRates($params)->GetAvaliableExchangeRatesResult;
        
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];
        }elseif($result->ReturnResult == 'NoData'){
            return [true,[]];
        }else{

            $lista = $result->AvaliableExchangeRates;
            $cadena_object_xml = $lista->any;           
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        
           
            $data_xml   = simplexml_load_string($lista)->asXML();           
            $xml = new SimpleXMLElement($data_xml);
           
            $lista_cambios = [];

            for($i = 0;$i<count($xml->DocumentElement->ExchangeRates);$i++){
                $CountryCode  = $xml->DocumentElement->ExchangeRates[$i]->CountryCode;
                $Correspondent = $xml->DocumentElement->ExchangeRates[$i]->Correspondent;
                $CollectCurrency = $xml->DocumentElement->ExchangeRates[$i]->CollectCurrency;
                $DeliverCurrency = $xml->DocumentElement->ExchangeRates[$i]->DeliverCurrency;
                $ExchangeRate = $xml->DocumentElement->ExchangeRates[$i]->ExchangeRate;
                $Fee = $xml->DocumentElement->ExchangeRates[$i]->Fee;

                $lista_cambios[] = new Cambio($CountryCode,$Correspondent,$CollectCurrency,$DeliverCurrency,$ExchangeRate,$Fee);
            }

            return [true,$lista_cambios];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    } 


    
    //realizar un cálculo previo de la operación
    public function obtenerAllCorresponsales($dataRequest = []){

        $destinationCountryCode = $dataRequest['destinationCountryCode'];
        $destinationCity = $dataRequest['destinationCity'];
        $collectCurrency = $dataRequest['collectCurrency'];
        $paymentCurrency = $dataRequest['paymentCurrency'];
        $ammount = $dataRequest['ammount'];
        $modeCalc = $dataRequest['modeCalc']; // Charge_excluded or Charge_included or To_deliver_value
        $deliveryMethod = $dataRequest['deliveryMethod']; // None or BankDeposit or PickUp or HomeDelivery
        

        $client = null;
        try {

        $client = new SoapClient($this->urlService);     
        
              
        $data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'DestinationCountryCode'=> $destinationCountryCode,
            'DestinationCity'=>$destinationCity,
            'CollectCurrency'=>$collectCurrency,
            'PaymentCurrency'=>$paymentCurrency,
            'Ammount'=>$ammount,
            'ModeCalc'=>$modeCalc,
            'DeliveryMethod'=>$deliveryMethod
        ];    
        
        
        $params = array(
            "CD" => $data
        );
           
        $result = $client->CalcAllCorrespondents($params)->CalcAllCorrespondentsResult;
             
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];        
        }else{

            $lista = $result->AvaliableCalc;
            $cadena_object_xml = $lista->any;
            $lista = str_replace(array("diffgr:","msdata:"),'', $cadena_object_xml);
            $index = strpos($lista,"<diffgram");
            $lista = substr($lista,$index);        

            $data_xml   = simplexml_load_string($lista)->asXML();
            $xml = new SimpleXMLElement($data_xml);

            

            $lista_corresponsales  = [];
            for($i = 0;$i<count($xml->DocumentElement->CalcList);$i++){
                $AmmountToSend = $xml->DocumentElement->CalcList[$i]->AmmountToSend;
                $Total = $xml->DocumentElement->CalcList[$i]->Total;
                $Fee = $xml->DocumentElement->CalcList[$i]->Fee;
               
                $ExchangeRate = $xml->DocumentElement->CalcList[$i]->ExchangeRate;
                $AmmountToDeliver = $xml->DocumentElement->CalcList[$i]->AmmountToDeliver;
                $CurrencyName = $xml->DocumentElement->CalcList[$i]->CurrencyName;
                $CorrespondentCode = $xml->DocumentElement->CalcList[$i]->CorrespondentCode;
                $CorrespondentName = $xml->DocumentElement->CalcList[$i]->CorrespondentName;               

                $lista_corresponsales[] = new Corresponsal($AmmountToSend,$Total,$Fee,$ExchangeRate,$AmmountToDeliver,$CurrencyName,$CorrespondentCode,$CorrespondentName);
            }


            return [true,$lista_corresponsales];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    /* De aqui en adelante no existen los metodos en el web services*/
    //obtener token para envio del request
    public function getToken($dataRequest = []){
        $customerCode = $dataRequest['customerCode'];
        $receiverCode = $dataRequest['receiverCode'];
        $receiverBankAccountCode = $dataRequest['receiverBankAccountCode']; //0 si no es deposito bancario - id del banco
        $correspondentCode = $dataRequest['correspondentCode']; // código de corresponsalia 
        $ammountToSend = $dataRequest['ammountToSend'];
        $collectCurrency = $dataRequest['collectCurrency']; 
        $paymentCurrency = $dataRequest['paymentCurrency']; 
        $methodOfPayment = $dataRequest['methodOfPayment']; // 1 - BankDeposit, 2 PickUp, 3 HomeDelivery
        

        $client = null;
        try {

        $client = new SoapClient($this->urlService);     

        $data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'CustomerCode'=> $customerCode,
            'ReceiverCode'=>$receiverCode,
            'ReceiverBankAccountCode'=>$receiverBankAccountCode,
            'CorrespondentCode'=>$correspondentCode,
            'AmmountToSend'=>$ammountToSend,
            'CollectCurrency'=>$collectCurrency,
            'PaymentCurrency'=>$paymentCurrency,
            'MethodOfPayment'=>$methodOfPayment
        ];    
        
                
        $params = array(
            "CD" => $data
        );
           
        $result = $client->GetCalcEnd($params)->GetCalcEndResult;
            
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];        
        }else{
            return [true,$result->MtToken];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //---   confirmar envio ---------

    public function confirmarTransaccion($dataRequest = []){
        $mtToken = $dataRequest['mtToken'];
        $operationsConcept = $dataRequest['operationsConcept'];
        $payMentPointCode = $dataRequest['payMentPointCode']; //solo para las recogidas en efectivo
               



        $client = null;
        try {

        $client = new SoapClient($this->urlService);             
    
           
        $data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'MtToken'=>$mtToken,
            'OperationsConcept'=>$operationsConcept,
            'PayMentPointCode'=>$payMentPointCode
        ];    
        $params = array(
            "CD" => $data
        );
           
        $result = $client->NewMTCommit($params)->NewMTCommitResult;
       
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];        
        }else{
            return [true,$result->OperationCode];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //Detalle de una transaccion
    public function moneyTransferDetails($dataRequest = []){
        $agentReference = $dataRequest['agentReference']; //referencia de la transaccion       
               

        $client = null;
        try {

        $client = new SoapClient($this->urlService);     
        
              
        $data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'AgentReference'=>$agentReference
        ];            

        $params = array(
            "CD" => $data
        );
           
        $result = $client->GetMoneyTtransferDetails($params)->GetMoneyTtransferDetailsResult;              
                       
        if($result->ReturnResult == 'HasError'){            
            return [false,$result->ReturnDescription];        
        }else{
            return [true,$result];                
        }
        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    //Cancelar una transaccion
    //El proceso realiza una solicitud que debe ser procesado y confirmado por usuarios de Backoffice 

    /*
    public function cancelTransaction($dataRequest = []){
        $agentReference = $dataRequest['agentReference']; //referencia de la transaccion       
        $cancelReason = $dataRequest['cancelReason'];    
        $cancelDescription = $dataRequest['cancelDescription'];    

        $client = null;
        try {

        $client = new SoapClient($this->urlService);     
        
                
        $data = [
            'AgentCode'=>$this->agentCode,
            'AgentPassword'=>$this->agentPassword,
            'AgentReference'=>$agentReference,
            'CancelReason'=>$cancelReason,
            'CancelDescription'=>$cancelDescription
        ];            
        $params = array(
            "CD" => $data
        );
           
        $result = $client->PerformMTCancel($params);
        return $result;       
                       
        if($result->ReturnResult == 'HasError'){
            return [false,$result->ReturnDescription];        
        }else{
            return [true,$result->ReturnCode];                
        }

        } catch (SoapFault $ex) {           
            return [false,$ex->getMessage()]; 
        }
    }

    */

    

}