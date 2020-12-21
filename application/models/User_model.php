<?php

class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }
    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('users', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['user_id' => $id])->get('users');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('users');
        } else {
            $result = $this->mongo_db->get('users');
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
        $result = $this->mongo_db->where('user_id', $id)->set($data)->update('users');
        return $result;
    }

    function update_user($email, $data)
    {
        //$objecId = $this->mongo_db->create_document_id($email);
        $result = $this->mongo_db->where('email', $email)->set($data)->update('users');
        return $result;
    }
    function delete($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->delete('users');
        return $result;
    }

    function get_by_email($email)
    {
        $result = $this->mongo_db->where(['email' => (string) $email])->get('users');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
}
