<?php

class Banner_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('banners', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->get('banners');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('banners');
        } else {
            $result = $this->mongo_db->get('banners');
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
    function update($id, $data)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where('_id', $objecId)->set($data)->update('banners');
        return $result;
    }
    function delete($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->delete('banners');
        return $result;
    }

    function get_by_email($email)
    {
        $result = $this->mongo_db->where(['email' => (string) $email])->get('banners');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
