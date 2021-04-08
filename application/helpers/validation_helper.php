<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validation
 * Helper para incluir expresiones regulares a utilizar en las
 * vistas en el atributo pattern de los input
 * @author Randy
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//NUMERO EJEMPLO: 53445
if (!function_exists('val_only_number')) {
    function val_only_number()
    {
        return "[1-9]{0,1}[0-9]{1,10}";
    }
}

//NUMERO DECIMAL EJEMPLO: 534.00
if (!function_exists('val_decimal')) {
    function val_decimal()
    {
        return "[1-9]{0,1}[0-9]{1,10}[,]{1}[0-9]{2}";
    }
}

//PASSWORD SEGURO EJEMPLO: Pasword123
if (!function_exists('val_secure_password')) {
    function val_secure_password()
    {
        return "(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)";
    }
}

//TEXTO SIN ESPACIOS
if (!function_exists('val_only_text')) {
    function val_only_text()
    {
        return "^[a-zA-Z ñ.áéíóúäëïöü\'-]{2,100}";
    }
}

//TEXTO - ESPACIO - TEXTO
if (!function_exists('val_text_space_text')) {
    function val_text_space_text()
    {
        return "^[a-zA-Z ñ.áéíóúäëïöü\'-]{2,100}[\s]{1}[a-zA-Z ñ.áéíóúäëïöü\'-]{2,100}{1,100}$";
    }
}

//TEXTO CON ESPACIOS
if (!function_exists('val_text_space')) {
    function val_text_space()
    {
        return "^[a-zA-Z\s ñ.áéíóúäëïöü\'-]{2,100}$";
    }
}

//TEXTO CON NUMEROS
if (!function_exists('val_text_number')) {
    function val_text_number()
    {
        return "^[a-zA-Z0-9 ñ.áéíóúäëïöü\'-]{2,100}$";
    }
}

//TEXTO CON NUMEROS Y ESPACIOS
if (!function_exists('val_text_number_space')) {
    function val_text_number_space()
    {
        return "^[a-zA-Z0-9\s ñ.áéíóúäëïöü\'-]{2,100}$";
    }
}