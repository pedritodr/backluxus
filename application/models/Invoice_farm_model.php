<?php
require 'vendor/autoload.php';
class Invoice_farm_model extends CI_Model
{
    private $mongodb;
    function __construct()
    {
        parent::__construct();
        $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('invoice_farm', $data);
        return $newId;
    }

    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['invoice_farm' => $id])->get('invoice_farm');
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
        $result = $this->mongo_db->where('invoice_farm', $id)->set($data)->update('invoice_farm');
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
    function create_change_invoice_farm($invoice_id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->where('invoice_farm', $invoice_id)->push('change', $data)->update('invoice_farm');
        return $newId;
    }
    //------------------------------------------------------------------------------------------------------------invoice cliente

    function create_invoice_client($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('invoice_cliente', $data);
        return $newId;
    }
    function get_by_id_invoice_client($id)
    {
        $result = $this->mongo_db->where(['invoice' => $id])->get('invoice_cliente');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all_invoice_client($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('invoice_cliente');
        } else {
            $result = $this->mongo_db->get('invoice_cliente');
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
    function update_invoice_client($id, $data)
    {
        $result = $this->mongo_db->where('invoice', $id)->set($data)->update('invoice_cliente');
        return $result;
    }
    function get_box_by_invoice_farm($box_id, $invoice_id)
    {
        $tuberia = [
            ['$project' => ['details' => 1, 'invoice' => 1, '_id' => 0]],
            ['$unwind' => '$details'],
            ['$unwind' => '$details.boxs'],
            ['$match' => ['details.boxs.id' => $box_id, 'details.boxs.invoice_farm' => $invoice_id]]
        ];

        $query      = $this->mongo_db->aggregate('invoice_cliente', $tuberia);
        if (isset($query[0]->details)) {
            if (is_object($query[0]->details)) {
                $query[0]->details->boxs->detail_id =  $query[0]->details->id;
                return $query[0]->details->boxs;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function delete_box_id($invoice_id, $detail_id, $box_id)
    {
        $query = $this->mongodb->luxus->invoice_cliente->updateOne(
            ['invoice' => $invoice_id, 'details.id' => $detail_id],
            ['$pull' => ['details.$.boxs' => ['id' => $box_id]]]
        );
        return $query;
    }
    function get_detail_invoice_client_by_id($invoice_id, $detail_id)
    {
        $tuberia = [
            ['$project' => ['details' => 1, 'invoice' => 1, '_id' => 0]],
            ['$unwind' => '$details'],
            ['$match' => ['details.id' => $detail_id, 'invoice' => $invoice_id]]
        ];

        $query      = $this->mongo_db->aggregate('invoice_cliente', $tuberia);
        if (isset($query[0]->details)) {
            if (is_object($query[0]->details)) {
                return $query[0]->details;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function delete_detail_invoice_cliente_by_id($invoice_id, $detail_id)
    {
        $query = $this->mongodb->luxus->invoice_cliente->updateOne(
            ['invoice' => $invoice_id],
            ['$pull' => ['details' => ['id' => $detail_id]]]
        );
        return $query;
    }
}
