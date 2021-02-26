<?php
require 'vendor/autoload.php';
class Role_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('role', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['role_id' => $id])->get('role');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('role');
        } else {
            $result = $this->mongo_db->get('role');
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
        $result = $this->mongo_db->where('role_id', $id)->set($data)->update('role');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['role_id' => $id])->delete('role');
        return $result;
    }
    function update_rol_farm_personal($rol_id, $data)
    {
        $query = $this->mongo_db->where('personal.function.role_id', $rol_id)->get('providers');
        $update = false;
        foreach ($query as $item) {
            if (isset($item->personal)) {
                foreach ($item->personal as $person) {
                    $result = $this->mongodb->luxus->providers->updateOne(
                        ['farm_id' => ['$eq' => $item->farm_id]],
                        ['$set' => [
                            'personal.$[per].function' => $data,
                        ]],
                        ['arrayFilters' => [
                            ['per.function.role_id' => ['$eq' => $rol_id]],
                        ]]
                    );
                    if ($result) {
                        $update = true;
                    }
                }
            }
        }
        return $update;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
