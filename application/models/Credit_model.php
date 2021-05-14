<?php
require 'vendor/autoload.php';
class Credit_model extends CI_Model
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
        $newId = $this->mongo_db->insert('credits', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['credit_id' => $id])->get('credits');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('credits');
        } else {
            $result = $this->mongo_db->get('credits');
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
        $result = $this->mongo_db->where('credit_id', $id)->set($data)->update('credits');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['credit_id' => $id])->delete('credits');
        return $result;
    }
    function create_images($id = 0, $data = [])
    {
        $newId = $this->mongo_db->where('credit_id', $id)->push('images', $data)->update('credits');
        return $newId;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
