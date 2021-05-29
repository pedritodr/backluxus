<?php
require 'vendor/autoload.php';
class Carguera_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        if (ENVIRONMENT == 'development') {
            $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
        } else {
            $this->mongodb = new MongoDB\Client("mongodb://adminDemo:5Tgbvfr43edcxsw21qaz@localhost:27017/");
        }
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('carguera', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['carguera_id' => $id])->get('carguera');
        return (count($result) > 0) ? (object) $result[0] : false;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->sort('name', 'asc')->get('carguera');
        } else {
            $result = $this->mongo_db->sort('name', 'asc')->get('carguera');
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
        $result = $this->mongo_db->where('carguera_id', $id)->set($data)->update('carguera');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['carguera_id' => $id])->delete('carguera');
        return $result;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
