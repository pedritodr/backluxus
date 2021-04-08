<?php

class measure_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('measure', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['measure_id' => $id])->get('measure');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('measure');
        } else {
            $result = $this->mongo_db->get('measure');
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
        $result = $this->mongo_db->where('measure_id', $id)->set($data)->update('measure');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['measure_id' => $id])->delete('measure');
        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
