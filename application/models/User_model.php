<?php
require 'vendor/autoload.php';
class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
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
    function create_marking($user_id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->where('user_id', $user_id)->push('markings', $data)->update('users');
        return $newId;
    }
    function update_marking($id,$data)
    {
        foreach ($data as $key => $value) {
            $this->mongo_db->set($key, $value);
        }
        $result = $this->mongo_db->where('markings.marking_id', $id)->update('users');
        return $result;
    }
    function delete_marking($user_id, $marking_id)
    {
        $query = $this->mongodb->luxus->users->updateOne(
            ['user_id' => $user_id],
            ['$pull' => ['markings' => ['marking_id' => $marking_id]]]
        );
        return $query;
    }

}
