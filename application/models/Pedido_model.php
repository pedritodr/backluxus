<?php

class Pedido_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('pedido', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->get('pedido');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('pedido');
        } else {
            $result = $this->mongo_db->get('pedido');
        }
        if ($get_as_row) {
            if (count($result) > 0) {
                return (object) $result[0];
            } else {
                return false;
            }
        } else {
            return ($result);
        }
    }
    function update($id, $data)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where('_id', $objecId)->set($data)->update('pedido');
        return $result;
    }
    function delete($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->delete('pedido');
        return $result;
    }

    function get_by_pedido_user($user_id)
    {

        $result = $this->mongo_db->where(['user' => (object) $user_id])->get('pedido');
        return $result;
    }


    function get_by_pedido($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' =>  $objecId])->get('pedido');
        return $result;
    }
}
