<?php

class Company_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }
    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('company', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        // $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['company_id' => (string) $id])->get('company');
        return (count($result) > 0) ? (object) $result[0] : false;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        $result = $this->mongo_db->where($conditions)->get('company');

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
        $result = $this->mongo_db->where('company_id', (string) $id)->set($data)->update('company');
        return $result;
    }
    function delete($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->delete('company');
        return $result;
    }

    function get_by_email($email)
    {
        $result = $this->mongo_db->where(['email' => (string) $email])->get('company');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    public function prueba()
    {
        $result = $this->mongo_db->where_text('gua')->get('products');
        var_dump($result);
        die();
    }
}
