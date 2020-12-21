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

class Banco
{

    private $ci_instance;
    private $user;
    private $password;
    private $additional_auth;

    /*
     * Autenticación adicional
     *
     * 0=>No tiene
     * 1=>Pregunta de seguridad
     * 2=>SMS
     * */

    /*
     * Bancos
     * 1- Pacifico
     * 2- Pichincha
     * 3- Guayaquil
     * 4- Bolivariano
     * 5- Produbanco
     * */


    function __construct($user, $password, $tipo_banco)
    {
        $this->ci_instance = &get_instance();
        $this->user = $user;
        $this->password = $password;
        switch ($tipo_banco) {
            case 1:
            case 3:
            case 4:
            case 5: {
                $this->additional_auth = 1;
                break;
            }
            case 2: {
                $this->additional_auth = 2;
                break;
            }

        }

    }

    //metodo para realizar las recargas
    public function login()
    {
        return [true,$this->additional_auth]; //[login valido, tipo de autenticacion extra]
    }

    public function get_extra_login(){
        $form ="";
        if($this->additional_auth >0){
            if($this->additional_auth == 1){ //pregunta y respuesta de seguridad
                $pregunta = "¿Cuál es el nombre de tu madre?";
                $form = "<div style='font-weight: bold; margin-left: 10px;'>".$pregunta."</div>";
                $form.="<div class='form-group' style='margin-left: 10px;margin-right: 10px;margin-top: 10px;'>";
                $form.="<input type='text' class='form-control' name='respuesta' id='respuesta' placeholder='Escriba su respuesta...' />";
                $form.="<div style='text-align:center'>";
                $form.="<button class='btn btn-danger' type='button' style='margin-top: 10px;' onclick='enviar_confirmacion()'><i class='glyphicon glyphicon-send'></i> Enviar confirmación</button>";
                $form.="</div>";
                $form.="</div>";
                return [true,$form];
            }elseif ($this->additional_auth == 2){ //sms

                $form="<div class='form-group' style='margin-left: 10px; margin-right: 10px;'>";
                $form .= "<label>Escriba el código que le llegó por SMS</label>";
                $form.="<input type='text' class='form-control' name='sms' id='sms' placeholder='Escriba su código' />";
                $form.="</div>";
                $form.="<div style='text-align:center'>";
                $form.="<button class='btn btn-danger' type='button' style='margin-top: 10px;' onclick='enviar_confirmacion_sms()'><i class='glyphicon glyphicon-send'></i> Enviar confirmación</button>";
                $form.="</div>";
                return [true,$form];
            }

        }else{
            return [false,""]; //[pudo devolver formulario, formulario (html)]
        }


    }


    public function validate_extra_login(){
        return true;
    }

    public function validate_response_respuesta($respuesta = ""){
        return true;
    }

    public function validate_extra_sms($code = ""){
        return true;
    }

    public function make_transfer($monto,$user_fuente,$user_destino){

        return true;
    }


    //metodos de acceso



}

