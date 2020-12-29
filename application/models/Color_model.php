<?php

class Color_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('color', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['color_id' => $id])->get('color');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('color');
        } else {
            $result = $this->mongo_db->get('color');
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
        $result = $this->mongo_db->where('color_id', $id)->set($data)->update('color');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['color_id' => $id])->delete('color');
        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
