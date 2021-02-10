<?php
require 'vendor/autoload.php';
class Country_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('country', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['country_id' => $id])->get('country');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('country');
        } else {
            $result = $this->mongo_db->get('country');
        }
        if ($get_as_row) {
            if (count($result) > 0) {
                return (object) $result[0];
            } else {
                return false;
            }
        } else {
            return $result;
        }
    }
    function update($id, $data)
    {
        $result = $this->mongo_db->where('country_id', $id)->set($data)->update('country');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['country_id' => $id])->delete('country');
        return $result;
    }

    function create_city($country_id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->where('country_id', $country_id)->push('citys', $data)->update('country');
        return $newId;
    }
    function update_city($id, $data)
    {
        $result = $this->mongo_db->where('citys.city_id', $id)->set(['citys.$.name' => $data])->update('country');
        return $result;
    }
    function update_status_city($id)
    {
        $result = $this->mongo_db->where('citys.city_id', $id)->set(['citys.$.is_active' => 0])->update('country');
        return $result;
    }
    function get_citys_by_id($id)
    {
        $fields = [
            'citys' => ['$filter'  => ['input' => '$citys', 'as' => 'city', 'cond' => ['$eq' => ['$$city.city_id', $id]]]],
            '_id' => 1,
        ];
        $conditions = [];
        $query      = $this->mongo_db->get_customize_fields('country', $fields, $conditions, false, []);
        return (count($query) > 0) ? (object) $query[0]->citys[0] : false;
    }
    function get_all_citys($country_id)
    {
        $fields = [
            'citys' => ['$filter'  => ['input' => '$citys', 'as' => 'city', 'cond' => ['$eq' => ['$$city.is_active', 1]]]],
            '_id' => 1,
        ];
        $conditions = ['is_active'=>1,'country_id'=>$country_id];
        $query      = $this->mongo_db->get_customize_fields('country', $fields, $conditions, false, []);
        $citys = [];
        foreach ($query as $item) {
            if (count($item->citys) > 0) {
                foreach ($item->citys as $city) {
                    $citys[] = $city;
                }
            }
        }

        return (count($citys) > 0) ? $citys : false;
    }
    function get_all_countrys()
    {
        $fields = [
            'citys' => ['$filter'  => ['input' => '$citys', 'as' => 'city', 'cond' => ['$eq' => ['$$city.is_active', 1]]]],
            '_id' => 1,
            'country_id' => 1,
            'name' => 1,
            'is_active' => 1
        ];
        $conditions = ['is_active' => 1];
        $query      = $this->mongo_db->get_customize_fields('country', $fields, $conditions, false, []);
        return $query;
    }
    function get_all_countrys_farms()
    {
        $fields = [
            'country_id' => 1,
            'name' => 1,
            'is_active' => 1
        ];
        $conditions = ['is_active' => 1];
        $query      = $this->mongo_db->get_customize_fields('country', $fields, $conditions, false, []);
        return $query;
    }
    function get_country_by_cliente($country_id)
    {
        $tuberia = [
            ['$project' => ['user_id'=>1,'address'=>1]],
            ['$unwind' => '$address'],
            ['$match' => ['address.country_id' => $country_id]]
        ];

        $query      = $this->mongo_db->aggregate('users', $tuberia);
        return (count($query) > 0) ? $query : false;
    }
    function update_country_user($country_id, $data)
    {
        $query = $this->mongo_db->where('address.country_id', $country_id)->set(['address.name' => $data->name])->updateAll('users');
        return $query;
    }
    function update_country_user_marking($country_id, $data)
    {
        $query = $this->mongo_db->where('markings.country.country_id', $country_id)->set(['markings.$.country.name' => $data->name])->updateAll('users');
        return $query;
    }
    function update_city_user($city_id, $name)
    {
        $query = $this->mongo_db->where('address.city.city_id', $city_id)->set(['address.city.name' => $name])->updateAll('users');
        return $query;
    }
    function update_city_user_marking($city_id, $name)
    {
        $query = $this->mongo_db->where('markings.country.city.city_id', $city_id)->set(['markings.$.country.city.name' => $name])->updateAll('users');
        return $query;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
