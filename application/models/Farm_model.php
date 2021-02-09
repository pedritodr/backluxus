<?php
require 'vendor/autoload.php';
class Farm_model extends CI_Model
{

    private $mongodb;
    function __construct()
    {
        parent::__construct();
        $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
        // $this->load->database();
    }

    function create_provider($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('providers', $data);
        return $newId;
    }
    function get_provider_by_id($id)
    {
        $result = $this->mongo_db->where(['provider_id' => $id])->get('providers');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_farms($id)
    {
        $result = $this->mongo_db->where(['provider_id' => $id, 'farms.is_active' => 1])->get('providers');
        return $result;
    }
    function get_farm_by_id($id)
    {
        $fields = [
            'farms' => ['$filter'  => ['input' => '$farms', 'as' => 'farm', 'cond' => ['$eq' => ['$$farm.farm_id', $id]]]],
            '_id' => 1,
            'provider_id' => 1
        ];
        $conditions = [];
        $query      = $this->mongo_db->get_customize_fields('providers', $fields, $conditions, false, []);
        $query[0]->farms[0]->provider_id = $query[0]->provider_id;
        return (count($query) > 0) ? (object) $query[0]->farms[0] : false;
    }

    function get_all_providers($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('providers');
        } else {
            $result = $this->mongo_db->get('providers');
        }

        if ($get_as_row) {
            if (count($result) > 0) {
                return (object) $result[0];
            } else {
                return false;
            }
        } else {
            return ($result) ? array_to_object($result) : FALSE;
        }
    }
    function update_provider($id, $data)
    {
        $result = $this->mongo_db->where('provider_id', $id)->set($data)->update('providers');
        return $result;
    }
    function delete_provider($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['provider_id' => $id])->delete('providers');
        return $result;
    }

    function create_farm($provider_id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->where('provider_id', $provider_id)->push('farms', $data)->update('providers');
        return $newId;
    }
    function create_person($id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $result = $this->get_all_personal($id);
        $datos =[];
        if($result){
            foreach ($result as $item) {
                $datos[] =$item->farms->personal;
            }
            $datos[] = (object)$data;
        }else{
            $datos[] = (object)$data;
        }
        $result = $this->mongo_db->where('farms.farm_id', $id)->set(['farms.$.personal' => $datos])->update('providers');
        return $result;
    }
    function update_farm($id, $data)
    {
        foreach ($data as $key => $value) {
            $this->mongo_db->set('farms.$.'.$key, $value);
        }
        $result = $this->mongo_db->where('farms.farm_id', $id)->update('providers');
        return $result;
    }
    function update_farm2($id)
    {
        $result = $this->mongo_db->where('farms.farm_id', $id)->set(['farms.$.is_active' => 0])->update('providers');
        return $result;
    }
    function get_all_personal($id)
    {
        $tuberia = [
            ['$project' => ['farms.personal' => 1, 'farms.farm_id' => 1]],
            ['$unwind' => '$farms'],
            ['$unwind' => '$farms.personal'],
            ['$match' => ['farms.personal.is_active' => 1, 'farms.farm_id' => $id]]
        ];

        $query      = $this->mongo_db->aggregate('providers', $tuberia);
        return (count($query) > 0) ? $query : false;
    }

    function get_persona_by_id($provider_id, $farm_id, $person_id)
    {
        $tuberia = [
            ['$project' => ['farms.personal' => 1, 'farms.farm_id' => 1, 'provider_id' => 1]],
            ['$unwind' => '$farms'],
            ['$unwind' => '$farms.personal'],
            ['$match' => ['farms.personal.is_active' => 1, 'farms.personal.person_id' => $person_id, 'farms.farm_id' => $farm_id, 'provider_id' => $provider_id]]
        ];

        $query      = $this->mongo_db->aggregate('providers', $tuberia);
        if (isset($query[0]->farms->personal)) {
            if (is_object($query[0]->farms->personal)) {
                return $query[0]->farms->personal;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function update_person($params, $data)
    {
        $query = $this->mongodb->luxus->providers->updateOne(
            ['provider_id' => ['$eq' => $params->provider_id]],
            ['$set' => [
                'farms.$[far].personal.$[per].name' => $data->name,
                'farms.$[far].personal.$[per].skype' => $data->skype,
                'farms.$[far].personal.$[per].phone' => $data->phone,
                'farms.$[far].personal.$[per].whatsapp' => $data->whatsapp,
                'farms.$[far].personal.$[per].function' => $data->function,
            ]],
            ['arrayFilters' => [
                ['far.farm_id' => ['$eq' => $params->farm_id]],
                ['per.person_id' => ['$eq' => $params->person_id]]
            ]]
        );
        return $query;
    }
    function delete_person($params)
    {
        $query = $this->mongodb->luxus->providers->updateOne(
            ['provider_id' => ['$eq' => $params->provider_id]],
            ['$set' => [
                'farms.$[far].personal.$[per].is_active' => 0
            ]],
            ['arrayFilters' => [
                ['far.farm_id' => ['$eq' => $params->farm_id]],
                ['per.person_id' => ['$eq' => $params->person_id]]
            ]]
        );
        return $query;
    }
    function get_all_farms()
    {
        $fields = [
            'farms' => ['$filter'  => ['input' => '$farms', 'as' => 'farm', 'cond' => ['$eq' => ['$$farm.is_active', 1]]]],
            '_id' => 1,
        ];
        $conditions = [];
        $query      = $this->mongo_db->get_customize_fields('providers', $fields, $conditions, false, []);
        $farms =[];
        foreach ($query as $item) {
            if(count($item->farms)>0){
                foreach ($item->farms as $farm) {
                        $farms[]=$farm;
                }
            }
        }

        return (count($farms) > 0) ? $farms : false;
    }
    function update_user_person($user_id, $data)
    {
        foreach ($data as $key => $value) {
           $this->mongo_db->set('farms.$.person_luxus.'.$key,$value);
        }
        $query = $this->mongo_db->where('farms.person_luxus.user_id', $user_id)->updateAll('providers');
        return $query;
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
