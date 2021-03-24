<?php

class Invoice_farm_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('invoice_farm', $data);
        return $newId;
    }
    function create_invoice_client($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('invoice_cliente', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['invoice_farm_id' => $id])->get('invoice_farm');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_by_number_invoice($id)
    {
        $result = $this->mongo_db->where(['invoice_number' => $id])->get('invoice_farm');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('invoice_farm');
        } else {
            $result = $this->mongo_db->get('invoice_farm');
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
        $result = $this->mongo_db->where('invoice_farm_id', $id)->set($data)->update('invoice_farm');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['invoice_farm_id' => $id])->delete('invoice_farm');
        return $result;
    }
    function update_invoice_farm_details($id, $data)
    {
        foreach ($data as $key => $value) {
            $this->mongo_db->set('details.$.' . $key, $value);
        }
        $result = $this->mongo_db->where('details.id', $id)->update('invoice_farm');
        return $result;
    }
    function update_invoice_farm($id, $data)
    {
        foreach ($data as $key => $value) {
            $this->mongo_db->set($key, $value);
        }
        $result = $this->mongo_db->where('details.id', $id)->update('invoice_farm');
        return $result;
    }
    function get_all_details_status($id = 0, $status = '0')
    {
        $fields = [
            'details' => ['$filter'  => ['input' => '$details', 'as' => 'detail', 'cond' => ['$eq' => ['$$detail.status', $status]]]],
            '_id' => 1,
        ];
        $conditions = ['details.id' => $id];
        $query      = $this->mongo_db->get_customize_fields('invoice_farm', $fields, $conditions, false, []);
        $details = [];
        foreach ($query as $item) {
            if (count($item->details) > 0) {
                foreach ($item->details as $det) {
                    $details[] = $det;
                }
            }
        }

        return (count($details) > 0) ? $details : false;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
