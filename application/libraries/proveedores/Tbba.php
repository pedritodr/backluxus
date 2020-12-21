<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tbba
{

    private $numero_transaccion;
    private $empresa;
    private $ifi_adquiriente;
    private $tipo_transaccion;
    private $fecha_transaccion;
    private $fecha_contable;
    private $hora_transaccion;
    private $canal_proceso;
    private $user_conexion;
    private $password_conexion;
    private $usurio_cajero;
    private $oficina;
    private $agente;

    private $contrapartida;
    private $tipo_cobro;
    private $codigo_moneda;
    private $referencia_adicional;
    private $nombre_contrapartida;
    private $referencia;
    private $valor;
    private $comision;
    private $codigo_tercero;
    private $ordenante;
    private $valor1;
    private $valor2;
    private $valor3;
    private $numero_id_cliente;
    private $tipo_id_cliente;
    private $tipo_identificacion_beneficiario;
    private $numero_transaccion_dato_usuario;
    private $ciudad_cliente;
    private $referencia_adicional_dato_usuario;
    private $numero_documento;
    private $telefono_cliente;

    private $tipo_pago;
    private $descripcion;
    private $fecha_envio_cobro;
    private $fecha_documento;
    private $valor_documento;



    function __construct($numero_transaccion,$empresa,$tipo_transaccion,$contrapartida,$tipo_cobro,$referencia_adicional,$nombre_contrapartida,$referencia,
    $valor,$comision,$codigo_tercero,$ordenante,$valor1,$valor2,$valor3,$numero_id_cliente,$tipo_id_cliente,$tipo_identificador_beneficiario,
    $numero_transaccion_dato_usuario,$ciudad_cliente,$referencia_adicional_dato_usuario,$numero_documento,$telefono_cliente,
    $tipo_pago,$descripcion,$fecha_envio_cobro,$fecha_documento,$valor_documento)
    {
        $this->numero_transaccion = $numero_transaccion;
        $this->empresa = $empresa;
        $this->ifi_adquiriente = '0030';
        $this->tipo_transaccion = $tipo_transaccion;
        $this->fecha_transaccion = date("Ymd");
        $this->fecha_contable = date("Ymd");
        $this->hora_transaccion = date("His");
        $this->canal_proceso = 'CPT';
        $this->user_conexion = 'ssaltos';
        $this->password_conexion = 'E@sysoft123';
        $this->usurio_cajero = 'Web';
        $this->oficina = '17000000';
        $this->agente = 'EASYSOFT';

        $this->contrapartida = $contrapartida;
        $this->tipo_cobro = $tipo_cobro;
        $this->codigo_moneda = 'USD';
        $this->referencia_adicional = $referencia_adicional;
        $this->nombre_contrapartida = $nombre_contrapartida;
        $this->referencia = $referencia;
        $this->valor = $valor;
        $this->comision = $comision;
        $this->codigo_tercero = $codigo_tercero;
        $this->ordenante = $ordenante;
        $this->valor1 = $valor1;
        $this->valor2 = $valor2;
        $this->valor3 = $valor3;
        $this->numero_id_cliente = $numero_id_cliente;
        $this->tipo_id_cliente = $tipo_id_cliente;
        $this->tipo_identificacion_beneficiario = $tipo_identificador_beneficiario;
        $this->numero_transaccion_dato_usuario = $numero_transaccion_dato_usuario;
        $this->ciudad_cliente = $ciudad_cliente;
        $this->referencia_adicional_dato_usuario = $referencia_adicional_dato_usuario;
        $this->numero_documento = $numero_documento;
        $this->telefono_cliente = $telefono_cliente;

        $this->tipo_pago = $tipo_pago;
        $this->descripcion = $descripcion;
        $this->fecha_envio_cobro = $fecha_envio_cobro;
        $this->fecha_documento = $fecha_documento;
        $this->valor_documento = $valor_documento;


    }

    public function consultar_servicio($code_servicio, $parametros_adicionales = [])
    {

    }

    public function consulta(){

        $xml_array = '<?xml version="1.0" encoding="UTF-8"?>
        <XMLTransaccion>
            <DatosUsuario>
                <NumeroTransaccion>'.$this->numero_transaccion.'</NumeroTransaccion>
                <Empresa>'.$this->empresa.'</Empresa>
                <IFIAdquiriente>'.$this->ifi_adquiriente.'</IFIAdquiriente> 
                <TipoTransaccion>'.$this->tipo_transaccion.'</TipoTransaccion>
                <FechaTransaccion>'.$this->fecha_transaccion.'</FechaTransaccion>
                <FechaContable>'.$this->fecha_contable.'</FechaContable>
                <HoraTransaccion>'.$this->hora_transaccion.'</HoraTransaccion>
                <CanalProceso>'.$this->canal_proceso.'</CanalProceso>
                <UserConexion>'.$this->user_conexion.'</UserConexion>
                <PasswordConexion>'.$this->password_conexion.'</PasswordConexion>
                <UsuarioCajero>'.$this->usurio_cajero.'</UsuarioCajero>
                <Oficina>'.$this->oficina.'</Oficina>
                <Agente>'.$this->agente.'</Agente>
            </DatosUsuario>
            <DatosTransaccion>
                <Contrapartida>'.$this->contrapartida.'</Contrapartida>
                <TipoCobro>'.$this->tipo_cobro.'</TipoCobro>
                <CodigoMoneda>'.$this->codigo_moneda.'</CodigoMoneda>
                <Referencia_Adicional>'.$this->referencia_adicional.'</Referencia_Adicional>
                <NombreContrapartida>'.$this->nombre_contrapartida.'</NombreContrapartida>
                <Referencia>'.$this->referencia.'</Referencia>
                <Valor>'.$this->valor.'</Valor>
                <Comision>'.$this->comision.'</Comision>
                <CodigoTercero>'.$this->codigo_tercero.'</CodigoTercero>
                <Ordenante>'.$this->ordenante.'</Ordenante>
                <Valor1>'.$this->valor1.'</Valor1>
                <Valor2>'.$this->valor2.'</Valor2>
                <Valor3>'.$this->valor3.'</Valor3>
                <NumeroIdCliente>'.$this->numero_id_cliente.'</NumeroIdCliente>
                <TipoIdCliente>'.$this->tipo_id_cliente.'</TipoIdCliente>
                <TipoIdentificacionBeneficiario>'.$this->tipo_identificacion_beneficiario.'</TipoIdentificacionBeneficiario>
                <NumeroTransaccion>'.$this->numero_transaccion.'</NumeroTransaccion>
                <Ciudad_Cliente>'.$this->ciudad_cliente.'</Ciudad_Cliente>
                <ReferenciaAdicional>'.$this->referencia_adicional_dato_usuario.'</ReferenciaAdicional>
                <Numero_Documento>'.$this->numero_documento.'</Numero_Documento>
                <Telefono_Cliente>'.$this->telefono_cliente.'</Telefono_Cliente>
            </DatosTransaccion>
            <FormasPago>
                <TipoPago>'.$this->tipo_pago.'</TipoPago>
                <Descripcion>'.$this->descripcion.'</Descripcion>
                <FechaEnvioCobro>'.$this->fecha_envio_cobro.'</FechaEnvioCobro>
                <FechaDocumento>'.$this->fecha_documento.'</FechaDocumento>
                <ValorDocumento>'.$this->valor_documento.'</ValorDocumento>
            </FormasPago>
        </XMLTransaccion>
';
        $wsdl   = "http://190.95.172.126:5080/MobilePaymentService/MobilePaymentService.svc?wsdl";
        $client = new SoapClient($wsdl);

        $params = array(
            "xmlImput" => $xml_array
        );
        $response = $client->__soapCall("GetServiceTransaction", array($params));

        $result = $response->GetServiceTransactionResult;
       
        $separated = explode('|',$result);

        $temp_result = [];
        for($i = 2; $i < count($separated);$i++){
            $temp_result[] = $separated[$i];
        }

        if(count($separated) >= 3){

            if((int)$separated[0] == 1){
                $cadena_xml = implode("",$temp_result);
                $resultado = new SimpleXMLElement($cadena_xml);
                $result_service = (object)$resultado;
                return [true,$result_service];
            }else{
                return [false,$this->get_code_servicio((int)$separated[0])];
            }

        }else{
            return [false,'Error de conexión'];
        }





    }

    public function registro_pago(){


        $xml_array = '<?xml version="1.0" encoding="UTF-8"?>
        <XMLTransaccion>
            <DatosUsuario>
                <NumeroTransaccion>'.$this->numero_transaccion.'</NumeroTransaccion>
                <Empresa>'.$this->empresa.'</Empresa>
                <IFIAdquiriente>'.$this->ifi_adquiriente.'</IFIAdquiriente> 
                <TipoTransaccion>'.$this->tipo_transaccion.'</TipoTransaccion>
                <FechaTransaccion>'.$this->fecha_transaccion.'</FechaTransaccion>
                <FechaContable>'.$this->fecha_contable.'</FechaContable>
                <HoraTransaccion>'.$this->hora_transaccion.'</HoraTransaccion>
                <CanalProceso>'.$this->canal_proceso.'</CanalProceso>
                <UserConexion>'.$this->user_conexion.'</UserConexion>
                <PasswordConexion>'.$this->password_conexion.'</PasswordConexion>
                <UsuarioCajero>'.$this->usurio_cajero.'</UsuarioCajero>
                <Oficina>'.$this->oficina.'</Oficina>
                <Agente>'.$this->agente.'</Agente>
            </DatosUsuario>
            <DatosTransaccion>
                <Contrapartida>'.$this->contrapartida.'</Contrapartida>
                <TipoCobro>'.$this->tipo_cobro.'</TipoCobro>                
                <CodigoMoneda>'.$this->codigo_moneda.'</CodigoMoneda>
                <Referencia_Adicional>'.$this->referencia_adicional.'</Referencia_Adicional>
                <NombreContrapartida>'.$this->nombre_contrapartida.'</NombreContrapartida>
                <Referencia>'.$this->referencia.'</Referencia>
                <Valor>'.$this->valor.'</Valor>
                <Comision>'.$this->comision.'</Comision>
                <CodigoTercero>'.$this->codigo_tercero.'</CodigoTercero>
                <Ordenante>'.$this->ordenante.'</Ordenante>
                <Valor1>'.$this->valor1.'</Valor1>
                <Valor2>'.$this->valor2.'</Valor2>
                <Valor3>'.$this->valor3.'</Valor3>
                <NumeroIdCliente>'.$this->numero_id_cliente.'</NumeroIdCliente>
                <TipoIdCliente>'.$this->tipo_id_cliente.'</TipoIdCliente>
                <TipoIdentificacionBeneficiario>'.$this->tipo_identificacion_beneficiario.'</TipoIdentificacionBeneficiario>
                <NumeroTransaccion>'.$this->numero_transaccion.'</NumeroTransaccion>
                <Ciudad_Cliente>'.$this->ciudad_cliente.'</Ciudad_Cliente>
                <ReferenciaAdicional>'.$this->referencia_adicional_dato_usuario.'</ReferenciaAdicional>
                <Numero_Documento>'.$this->numero_documento.'</Numero_Documento>
                <Telefono_Cliente>'.$this->telefono_cliente.'</Telefono_Cliente>
            </DatosTransaccion>
            <FormasPago>
                <TipoPago>'.$this->tipo_pago.'</TipoPago>
                <Descripcion>'.$this->descripcion.'</Descripcion>
                <FechaEnvioCobro>'.$this->fecha_envio_cobro.'</FechaEnvioCobro>
                <FechaDocumento>'.$this->fecha_documento.'</FechaDocumento>
                <ValorDocumento>'.$this->valor_documento.'</ValorDocumento>
            </FormasPago>
        </XMLTransaccion>
';


        $wsdl   = "http://190.95.172.126:5080/MobilePaymentService/MobilePaymentService.svc?wsdl";
        $client = new SoapClient($wsdl);

        $params = array(
            "xmlImput" => $xml_array
        );
        $response = $client->__soapCall("GetServiceTransaction", array($params));

        $result = $response->GetServiceTransactionResult;


        $separated = explode('|',$result);

        $temp_result = [];
        for($i = 2; $i < count($separated);$i++){
            $temp_result[] = $separated[$i];
        }

        if(count($separated) >= 3){

            if((int)$separated[0] == 1){
                $cadena_xml = implode("",$temp_result);
                $resultado = new SimpleXMLElement($cadena_xml);
                $result_service = (object)$resultado;
                return [true,$result_service];
            }else{
                return [false,$this->get_code_servicio((int)$separated[0])];
            }

        }else{
            return [false,'Error de conexión',$xml_array];
        }
    }



    /*Recaudaciones municipio de ambato*/
    public function valores_consulta_por_mun_ambato()
    {
        return [0 => ['codigo' => 'P', 'Valor' => 'Clave Catastral-Predio'], 1 => ['codigo' => 'S', 'Valor' => 'CIU-CEDULA-RUC']];
    }

    public function valores_impuesto_mun_ambato()
    {
        return [0 => ['codigo' => '095', 'Valor' => 'PREDIOS RUSTICOS '], 1 => ['codigo' => '130', 'Valor' => 'PATENTES'], 2 => ['codigo' => '135', 'Valor' => 'RODAJE'], 3 => ['codigo' => '140', 'Valor' => 'PREDIOS URBANOS'], 4 => ['codigo' => '200', 'Valor' => 'CONTRIBUCIONES']];
    }
    /*Fin de recaudaciones municipio de ambato*/

    /*CTG*/
    public function valores_consulta_por_ctg()
    {
        return [0 => ['codigo' => '001', 'Valor' => 'CONSULTA DE CEP'], 1 => ['codigo' => '002', 'Valor' => 'CONSULTA DE CITACIONES']];
    }

    /* Municipio de quito*/
    public function valores_tipos_impuestos_municipio_quito()
    {
        return [0 => ['codigo' => '001', 'Valor' => 'Urbano'], 1 => ['codigo' => '002', 'Valor' => 'Rustico'], 2 => ['codigo' => '003', 'Valor' => 'Patentes'], 3 => ['codigo' => '004', 'Valor' => 'Varios']];
    }

    /*SRI - RISE*/
    public function tipo_pago_sri_rise()
    {
        return [0 => ['codigo' => 'F', 'Valor' => 'PAGO A LA FECHA'], 1 => ['codigo' => 'G', 'Valor' => 'PAGO GLOBAL']];
    }

    /*Municipio de gye*/
    public function tipo_pago_municipio_gye()
    {
        return [0 => ['codigo' => '1', 'Valor' => 'Por Año'], 1 => ['codigo' => '2', 'Valor' => 'Deuda Total']];
    }

    public function tipos_impuestos_municipio_gye()
    {
        return [0 => ['codigo' => '001', 'Valor' => 'Predio']];
    }

    /*AMT*/
    public function codigos_servicios_amt()
    {
        return [0 => ['codigo' => '1', 'Valor' => 'Número Placa'], 1 => ['codigo' => '2', 'Valor' => 'Número de chasis'], 2 => ['codigo' => '3', 'Valor' => 'Código DUI o CPN']];
    }

    /*UTPL*/
    public function tipo_consulta_utpl()
    {
        return [0 => ['codigo' => '1', 'Valor' => 'Identificación Estudiante'], 1 => ['codigo' => '2', 'Valor' => 'Código Estudiante']];
    }

    /*UNIVISA*/

    public function ciudad_cliente_univisa()
    {
        return [
            0 => ['codigo' => '1111', 'Valor' => 'GUAYAQUIL'],
            1 => ['codigo' => '1113', 'Valor' => 'MILAGRO'],
            2 => ['codigo' => '1121', 'Valor' => 'MANTA'],
            3 => ['codigo' => '1122', 'Valor' => 'PORTOVIEJO'],
            4 => ['codigo' => '1211', 'Valor' => 'QUITO'],
            5 => ['codigo' => '1221 ', 'Valor' => 'CUENCA']
        ];
    }

    public function tipo_consulta_univisa()
    {
        return [0 => ['codigo' => '001', 'Valor' => 'Consulta de Contrato Univisa'], 1 => ['codigo' => '002', 'Valor' => 'Consulta de smart Card']];
    }


    /* Agencia nacional de transito (ANT) */
    public function get_provincias_ant()
    {
        return [
            0 => ['codigo' => 'AZU', 'Valor' => 'AZUAY'],
            1 => ['codigo' => 'BOL', 'Valor' => 'BOLIVAR'],
            2 => ['codigo' => 'CAN', 'Valor' => 'CANAR'],
            3 => ['codigo' => 'CAR', 'Valor' => 'EL CARCHI'],
            4 => ['codigo' => 'CHI', 'Valor' => 'CHIMBORAZO'],
            5 => ['codigo' => 'COT ', 'Valor' => 'COTOPAXI'],
            6 => ['codigo' => 'EOR', 'Valor' => 'EL ORO'],
            7 => ['codigo' => 'ESM', 'Valor' => 'ESMERALDAS'],
            8 => ['codigo' => 'GAL', 'Valor' => 'GALAPAGOS'],
            9 => ['codigo' => 'GUA', 'Valor' => 'GUAYAS'],
            10 => ['codigo' => 'IMB', 'Valor' => 'IMBABURA'],
            11 => ['codigo' => 'LOJ ', 'Valor' => 'LOJA'],
            12 => ['codigo' => 'LRS', 'Valor' => 'LOS RIOS'],
            13 => ['codigo' => 'MOR', 'Valor' => 'MORONA SANTIAGO'],
            14 => ['codigo' => 'NAP', 'Valor' => 'NAPO'],
            15 => ['codigo' => 'ORE', 'Valor' => 'ORELLANA'],
            16 => ['codigo' => 'PAS', 'Valor' => 'PASTAZA'],
            17 => ['codigo' => 'PIC ', 'Valor' => 'PICHINCHA'],
            18 => ['codigo' => 'STD', 'Valor' => 'SANTO DOMINGO'],
            19 => ['codigo' => 'STE', 'Valor' => 'SANTA ELENA'],
            20 => ['codigo' => 'SUC', 'Valor' => 'SUCUMBIOS'],
            21 => ['codigo' => 'TUN', 'Valor' => 'TUNGURAHUA'],
            22 => ['codigo' => 'ZAM', 'Valor' => 'ZAMORA CHINCHIPE']
        ];
    }

    public function get_tipo_servicios_ant()
    {
        return [
            0 => ['codigo' => 'CIT', 'Valor' => 'CITACIONES'],
            1 => ['codigo' => 'SOL', 'Valor' => 'SOLICITUD'],
            2 => ['codigo' => 'BRE', 'Valor' => 'BREVETACION']
        ];
    }

    public function tipos_brevetaciones_ant()
    {
        return [
            0 => ['codigo' => 'DA1', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO A1'],
            1 => ['codigo' => 'DC1', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO C1'],
            2 => ['codigo' => 'DD1', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO D1'],
            3 => ['codigo' => 'DE1', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO E1'],
            4 => ['codigo' => 'DIA', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO A'],
            5 => ['codigo' => 'DIB ', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO B'],
            6 => ['codigo' => 'DIC', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO C'],
            7 => ['codigo' => 'DID', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO D'],
            8 => ['codigo' => 'DIE', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO E'],
            9 => ['codigo' => 'DIF', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO F'],
            10 => ['codigo' => 'DIG', 'Valor' => 'DUPLICADO LICENCIA DE CONDUCIR TIPO G'],
            11 => ['codigo' => 'HA1 ', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO A1'],
            12 => ['codigo' => 'HC1', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO C1'],
            13 => ['codigo' => 'HD1', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO D1'],
            14 => ['codigo' => 'HE1', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO E1'],
            15 => ['codigo' => 'HIA', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO A'],
            16 => ['codigo' => 'HIB', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO B'],
            17 => ['codigo' => 'HIC ', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO C'],
            18 => ['codigo' => 'HID', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO D'],
            19 => ['codigo' => 'HIE', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO E'],
            20 => ['codigo' => 'HIF', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO F'],
            21 => ['codigo' => 'HIG', 'Valor' => 'HOMOLOGACION O CANJE LICENCIA DE CONDUCIR TIPO G'],
            22 => ['codigo' => 'PA1', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO A1'],
            23 => ['codigo' => 'PC1', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO C1'],
            24 => ['codigo' => 'PD1', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO D1'],
            25 => ['codigo' => 'PE1', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO E1'],
            26 => ['codigo' => 'PIA', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO A'],
            27 => ['codigo' => 'PIB', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO B'],
            28 => ['codigo' => 'PIC ', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO C'],
            29 => ['codigo' => 'PID', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO D'],
            30 => ['codigo' => 'PIE', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO E'],
            31 => ['codigo' => 'PIF', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO F'],
            32 => ['codigo' => 'PIG', 'Valor' => 'PRIMERA VEZ LICENCIA DE CONDUCIR TIPO G'],
            33 => ['codigo' => 'RA1', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO A1'],
            34 => ['codigo' => 'RC1', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO C1'],
            35 => ['codigo' => 'RD1', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO D1'],
            36 => ['codigo' => 'RE1', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO E1'],
            37 => ['codigo' => 'RIA', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO A'],
            38 => ['codigo' => 'RIB', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO B'],
            39 => ['codigo' => 'RIC ', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO C'],
            40 => ['codigo' => 'RID', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO D'],
            41 => ['codigo' => 'RIE', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO E'],
            42 => ['codigo' => 'RIF', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO F'],
            43 => ['codigo' => 'RIG', 'Valor' => 'RENOVACION LICENCIA DE CONDUCIR TIPO G']
        ];
    }


    private function get_code_servicio($code)
    {
        switch ($code) {
            case 0: {
                return "Transacción no permitida";
            }
            case 1: {
                return "Proceso OK";
            }
            case 2: {
                return "Código de transacción no numérico";
            }
            case 3: {
                return "Número de cuenta no númérico";
            }
            case 5: {
                return "Valor de efectivo no numérico";
            }
            case 6: {
                return "Valor transferido no numérico";
            }
            case 7: {
                return "Valor locales no numérico";
            }
            case 8: {
                return "Valor otras plazas no numérico";
            }
            case 9: {
                return "Valor total no numérico";
            }
            case 10: {
                return "Número del cheque no numérico";
            }
            case 11: {
                return "Número del motivo no numérico ";
            }
            case 12: {
                return "Numero relativo no numérico";
            }
            case 13: {
                return "Código de transacción no existe ";
            }
            case 14: {
                return "Terminal no existe";
            }
            case 16: {
                return "Numero de secuencia del server no numérico";
            }
            case 17: {
                return "Fecha no numérica";
            }
            case 18: {
                return "Hora no numérica";
            }
            case 19: {
                return "Numero único de transacción no numérico";
            }
            case 20: {
                return "Tipo de cuenta no existe";
            }
            case 21: {
                return "Cambio de turno errado";
            }
            case 22: {
                return "Error de sistema o ambiente. ( No está activa aplicación)";
            }
            case 23: {
                return "Error de proceso.  (Problemas entre programas)";
            }
            case 24: {
                return "Error de archivos.  (Problema con algún archivo)";
            }
            case 25: {
                return "Caja está cerrada";
            }
            case 26: {
                return "Movimiento en consulta automática. (WAIT)";
            }
            case 27: {
                return "Numero de motivo no existe";
            }
            case 28: {
                return "Relativo del movimiento no existe ";
            }
            case 29: {
                return "Número de cuenta no existe";
            }
            case 30: {
                return "Cuenta cerrada";
            }
            case 31: {
                return "Código de motivo no autorizado o permitido";
            }
            case 32: {
                return "Cheque fuera de rango";
            }
            case 33: {
                return "Cheque con ONP o revocatoria";
            }
            case 34: {
                return "Tiene firma emergente";
            }
            case 35: {
                return "No hay fondos disponibles, pero si bloqueados";
            }
            case 36: {
                return "Movimiento ya fue anulado";
            }
            case 37: {
                return "Negado por insuficiencia de fondos";
            }
            case 38: {
                return "No hay fondos disponibles, ni bloqueados ";
            }
            case 39: {
                return "Valores en cero";
            }
            case 40: {
                return "Valor total del movimiento no cuadra contra los parciales";
            }
            case 41: {
                return "Digito verificador incorrecto";
            }
            case 42: {
                return "Valor no puede ser negativo";
            }
            case 43: {
                return "No se puede hacer movimiento porque la cuenta esta como disponible";
            }
            case 44: {
                return "El funcionario de la consulta pide se le envié el cheque para su verificación";
            }
            case 45: {
                return "Para poder abrir una cuenta debe estar disponible.";
            }
            case 46: {
                return "Este cheque ya fue certificado";
            }
            case 47: {
                return "NO EXISTE INFORMACION";
            }
            case 48: {
                return "El valor del cheque de regalo, gerencia o PAGO no existe";
            }
            case 49: {
                return "El cheque de regalo, gerencia o PAGO ya fue pagado";
            }
            case 50: {
                return "Código de funcionario no autorizado para el pago de cheque";
            }
            case 51: {
                return "No se puede anular un movimiento de una localidad diferente";
            }
            case 52: {
                return "No se puede anular cheque certificado ya pagado";
            }
            case 58: {
                return "Valor a pagar mayor a la deuda pendiente";
            }
            case 59: {
                return "Recaudación duplicada";
            }
            case 60: {
                return "Recaudación no existe";
            }
            case 61: {
                return "Código de conversación para SAF no existe";
            }
            case 62: {
                return "Clave de usuario no numérica";
            }
            case 63: {
                return "Identificación de usuario no existe";
            }
            case 64: {
                return "Clave Incorrecta";
            }
            case 65: {
                return "Usuario no es administrador ";
            }
            case 70: {
                return "Usuario con clave suspendida";
            }
            case 71: {
                return "Usuario ya está activo";
            }
            case 72: {
                return "Usuario está inactivo";
            }
            case 73: {
                return "Usuario no está autorizado a SIGN ON";
            }
            case 74: {
                return "Clave nueva no numérica";
            }
            case 75: {
                return "Falta identificación del usuario principal";
            }
            case 76: {
                return "Falta identificación del usuario a eliminar";
            }
            case 77: {
                return "Usuario a crear o eliminar no existe";
            }
            case 78: {
                return "Usuario no ha dado SIGN ON";
            }
            case 79: {
                return "Error en actualización - Reintente";
            }
            case 81: {
                return "Clave expirada";
            }
            case 82: {
                return "Clave nueva debe ser diferente";
            }
            case 83: {
                return "Cantidad de chq. Transferido no numérico";
            }
            case 84: {
                return "Cantidad de chq. Locales no numérico";
            }
            case 85: {
                return "Cantidad de chq. Ot. Plazas no numérico";
            }
            case 86: {
                return "Cantidad de chq. Totales no numérico";
            }
            case 87: {
                return "Sena de anulación invalida";
            }
            case 88: {
                return "Cantidad total de cheques no cuadra contra los parciales";
            }
            case 89: {
                return "Tipo de certificación de cheque errada";
            }
            case 90: {
                return "Procese el movimiento OFF-LINE";
            }
            case 91: {
                return "Procese desde este momento todo OFF-LINE";
            }
            case 92: {
                return "Error tipo de Clase de pago (jubilados)";
            }
            case 93: {
                return "Error sección (jubilados)";
            }
            case 94: {
                return "No puede ser procesado OFF-LINE";
            }
            case 95: {
                return "Código de Alumno no existe";
            }
            case 96: {
                return "Valor Otros documentos no numérico";
            }
            case 97: {
                return "Cantidad otros documentos no numérico";
            }
            case 98: {
                return "Pedir autorización dentro del proceso OFF-LINE. (*)";
            }
            case 99: {
                return "Valor del movimiento fuera del límite máximo de una transacción.";
            }
            case 100: {
                return "No se puede anular en línea porque el movimiento fuera de línea no ha sido transmitido.";
            }

        }
    }
}