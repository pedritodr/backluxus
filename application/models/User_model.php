<?php
require 'vendor/autoload.php';
class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        if (ENVIRONMENT == 'development') {
            $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
        } else {
            $this->mongodb = new MongoDB\Client("mongodb://adminDemo:5Tgbvfr43edcxsw21qaz@localhost:27017/");
        }
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
    function get_all_users()
    {
        $result = $this->mongo_db->where(['role_id' => $this->mongo_db->ne(3), 'is_active' => 1])->get('users');
        return (count($result) > 0) ? $result : false;
    }
    function get_all_clients()
    {
        $result = $this->mongo_db->where(['role_id' => 3, 'is_active' => 1, 'is_delete' => 0])->get('users');
        return (count($result) > 0) ? $result : false;
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
    function update_marking($id, $data)
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
    function create_manager($user_id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->where('user_id', $user_id)->push('managers', $data)->update('users');
        return $newId;
    }
    function update_manager($id, $data)
    {

        foreach ($data as $key => $value) {
            $this->mongo_db->set($key, $value);
        }
        $result = $this->mongo_db->where('managers.manager_id', $id)->update('users');
        return $result;
    }
    function delete_manager($user_id, $marking_id)
    {
        $query = $this->mongodb->luxus->users->updateOne(
            ['user_id' => $user_id],
            ['$pull' => ['managers' => ['manager_id' => $marking_id]]]
        );
        return $query;
    }
    function update_user_person($user_id, $data)
    {
        foreach ($data as $key => $value) {
            $this->mongo_db->set('person_luxus.' . $key, $value);
        }
        $query = $this->mongo_db->where('person_luxus.user_id', $user_id)->updateAll('users');
        return $query;
    }
    function login($email, $password)
    {
        $query = $this->mongo_db->where(['email' => $email, 'password' => $password])->get('users');
        return (count($query) > 0) ? $query[0] : false;
    }
    function get_min_client_by_marking_id($id)
    {
        $fields = [
            'user_id' => 1,
            'name_company' => 1,
            'name_commercial' => 1,
            'email' => 1,
            'secuencial' => 1,
            '_id' => 0
        ];
        $conditions = [
            'markings.marking_id' => $id
        ];
        $query = $this->mongo_db->get_customize_fields('users', $fields, $conditions);
        if (count($query) > 0) {
            return $query[0];
        } else {
            return false;
        }
    }
}
