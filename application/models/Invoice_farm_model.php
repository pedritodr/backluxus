<?php
require 'vendor/autoload.php';
class Invoice_farm_model extends CI_Model
{
    private $mongodb;
    function __construct()
    {
        parent::__construct();
        if (ENVIRONMENT == 'development') {
            $this->mongodb = new MongoDB\Client("mongodb://localhost:27017/");
        } else {
            $this->mongodb = new MongoDB\Client("mongodb://adminDemo:5Tgbvfr43edcxsw21qaz@localhost:27017/");
        }
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
            $result = $this->mongo_db->where($conditions)->sort('timestamp', 'asc')->get('invoice_farm');
        } else {
            $result = $this->mongo_db->sort('timestamp', 'asc')->get('invoice_farm');
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
    function create_payment($farm_id = 0, $data = [])
    {
        $newId = $this->mongo_db->where('invoice_farm', $farm_id)->push('payments', $data)->update('invoice_farm');
        return $newId;
    }
    function balance_farm_payment($id, $days_credit)
    {
        $mesEndActual = strtotime(date('Y-m-' . $days_credit));
        $tuberia = [
            [
                '$project' => ['_id' => 0]
            ],
            ['$sort' => ['timestamp' => -1]],
            ['$match' => ['farms.farm_id' => $id, 'timestamp' => ['$lte' => $mesEndActual], 'paid' => ['$ne' => true]]]
        ];

        $query      = $this->mongo_db->aggregate('invoice_farm', $tuberia);
        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }
    function create_credit_farm($farm_id = 0, $data = [])
    {
        $newId = $this->mongo_db->where('invoice_farm', $farm_id)->push('credits', $data)->update('invoice_farm');
        return $newId;
    }
    function delete_credit_farm($farm_id = 0, $data = [])
    {
        $newId = $this->mongo_db->where('invoice_farm', $farm_id)->set('credits', $data)->update('invoice_farm');
        return $newId;
    }
    function update_box_variety($invoice_id, $box_id, $variety_id, $data)
    {
        $query = $this->mongodb->luxus->invoice_farm->updateOne(
            ['invoice_farm' => ['$eq' => $invoice_id]],
            ['$set' => [
                'details.$[d].varieties.$[v].credit' => $data,
            ]],
            ['arrayFilters' => [
                ['d.id' => ['$eq' => $box_id]],
                ['v.id' => ['$eq' => $variety_id]]
            ]]
        );
        return $query;
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
            $result = $this->mongo_db->where($conditions)->sort('number_invoice', 'asc')->get('invoice_cliente');
        } else {
            $result = $this->mongo_db->sort('number_invoice', 'asc')->get('invoice_cliente');
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
    function get_all_invoice_client_desc($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->sort('number_invoice', 'desc')->get('invoice_cliente');
        } else {
            $result = $this->mongo_db->sort('number_invoice', 'desc')->get('invoice_cliente');
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
    function create_change_invoice_client($invoice_id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->where('invoice', $invoice_id)->push('change', $data)->update('invoice_cliente');
        return $newId;
    }
    function update_detail_box($invoice_id, $detail_id, $box_id, $data)
    {
        $query = $this->mongodb->luxus->invoice_cliente->updateOne(
            ['invoice' => ['$eq' => $invoice_id]],
            ['$set' => [
                'details.$[d].boxs.$[b]' => $data,
            ]],
            ['arrayFilters' => [
                ['d.id' => ['$eq' => $detail_id]],
                ['b.id' => ['$eq' => $box_id]]
            ]]
        );
        return $query;
    }
    function get_min_invoices_by_marking($id = 0)
    {
        $tuberia = [
            ['$project' => ['invoice' => 1, 'awb' => 1, 'number_invoice' => 1, 'marking' => 1, 'status' => 1, 'details' => 1, '_id' => 0]],
            ['$sort' => ['number_invoice' => 1]],
            ['$match' => ['marking.marking_id' => $id, 'status' => ['$ne' => -1]]]
        ];

        $query      = $this->mongo_db->aggregate('invoice_cliente', $tuberia);
        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }
    function create_credit_invoice_client($invoice = 0, $data = [])
    {
        $newId = $this->mongo_db->where('invoice', $invoice)->push('credits', $data)->update('invoice_cliente');
        return $newId;
    }
    function update_box_variety_invoice_cliente($invoice_id, $detail, $box_id, $variety_id, $data)
    {
        $query = $this->mongodb->luxus->invoice_cliente->updateOne(
            ['invoice' => ['$eq' => $invoice_id]],
            ['$set' => [
                'details.$[detail].boxs.$[box].varieties.$[variety].credit' => $data,
            ]],
            ['arrayFilters' => [
                ['detail.id' => ['$eq' => $detail]],
                ['box.id' => ['$eq' => $box_id]],
                ['variety.id' => ['$eq' => $variety_id]]
            ]]
        );
        return $query;
    }
    function update_credit_invoice_client($invoice_id, $credit_id, $items, $description)
    {
        $query = $this->mongodb->luxus->invoice_cliente->updateOne(
            ['invoice' => ['$eq' => $invoice_id]],
            ['$set' => [
                'credits.$[credit].items' => $items,
                'credits.$[credit].description' => $description,
            ]],
            ['arrayFilters' => [
                ['credit.credit_id' => ['$eq' => $credit_id]]
            ]]
        );
        return $query;
    }
    function get_invoices_by_marking($id = 0)
    {
        $tuberia = [
            ['$project' => ['invoice' => 1, 'awb' => 1, 'number_invoice' => 1, 'marking' => 1, 'status' => 1, 'details' => 1, 'date_create' => 1, '_id' => 0]],
            ['$sort' => ['number_invoice' => 1]],
            ['$match' => ['marking.marking_id' => $id, 'status' => ['$ne' => -1]]]
        ];

        $query      = $this->mongo_db->aggregate('invoice_cliente', $tuberia);
        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }
    function update_box_variety_invoice_cliente_price($invoice_id, $detail, $box_id, $variety_id, $data)
    {
        $query = $this->mongodb->luxus->invoice_cliente->updateOne(
            ['invoice' => ['$eq' => $invoice_id]],
            ['$set' => [
                'details.$[detail].boxs.$[box].varieties.$[variety].priceClient' => $data,
            ]],
            ['arrayFilters' => [
                ['detail.id' => ['$eq' => $detail]],
                ['box.id' => ['$eq' => $box_id]],
                ['variety.id' => ['$eq' => $variety_id]]
            ]]
        );
        return $query;
    }
}
