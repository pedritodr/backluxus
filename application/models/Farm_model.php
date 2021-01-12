<?php

class Farm_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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
        return $query;
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
    function update_farm($id, $data)
    {
        $result = $this->mongo_db->where('farms.farm_id', $id)->set(['farms.$' => $data])->update('providers');
        return $result;
    }
    function update_farm2($id)
    {
        $result = $this->mongo_db->where('farms.farm_id', $id)->set(['farms.$.is_active' => 0])->update('providers');
        return $result;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
