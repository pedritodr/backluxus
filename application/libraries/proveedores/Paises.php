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

class Paises
{
    private $lista;
    private $ci_instance;
    function __construct()
    {
        $this->ci_instance = &get_instance();
        $json = file_get_contents('https://restcountries.eu/rest/v2/all');        
       $this->lista = $json;
    }

    //metodo para realizar las recargas
    public function get_all()
    {
       return json_decode($this->lista);
    }

    public function save_countries_and_currencies(){
        $lista_paises = json_decode($this->lista);
        $this->ci_instance->load->model("Country_model","country");

        foreach($lista_paises as $item){
            $top_level_domain ="";
            $callingCodes = "";
            $lat_lng = "";
            foreach($item->topLevelDomain as $item_domain){
                $top_level_domain.=$item_domain."-";
            }
            foreach($item->callingCodes as $item_calling){
                $callingCodes.=$item_calling."|";
            }

            $lat_lng = "";
            if($item->latlng && is_array($item->latlng) && count($item->latlng)==2){
                $lat_lng = $item->latlng[0].",".$item->latlng[1];
            }
           
            $name = ($item->translations->es)?$item->translations->es:$item->name;
            $data_country = [
                'name'=>$name,
                'topLevelDomain'=>$top_level_domain,
                'alpha2Code'=>$item->alpha2Code,
                'alpha3Code'=>$item->alpha3Code,
                'callingCodes'=>$callingCodes,
                'capital'=>$item->capital,
                'latlng'=>$lat_lng,
                'flag'=>$item->flag
            ];          
            $country_id = $this->ci_instance->country->insert_country($data_country);

            foreach($item->currencies as $item_currency){
                $data_currency = [
                    'country_id'=>$country_id,
                    'code'=>$item_currency->code,
                    'name'=>$item_currency->name,
                    'symbol'=>$item_currency->symbol
                ];

                $this->ci_instance->country->insert_currency($data_currency);
            }

        }
    }




    



}

