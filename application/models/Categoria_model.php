<?php

class Categoria_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('category', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['category_id' => $id])->get('category');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('category');
        } else {
            $result = $this->mongo_db->get('category');
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
        $result = $this->mongo_db->where('category_id', $id)->set($data)->update('category');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['category_id' => $id])->delete('category');
        return $result;
    }
    function update_type($id, $data)
    {
        $result = $this->mongo_db->where('type_box.box_id', $id)->set(['type_box' => $data])->updateAll('category');
        return $result;
    }


    //------------------------------------------------------------------------------------------------------------------------------------------
}
