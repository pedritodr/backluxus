<?php
require 'vendor/autoload.php';
class Fixed_orders_model extends CI_Model
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
        $newId = $this->mongo_db->insert('fixed_orders', $data);
        return $newId;
    }

    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['fixed_orders' => $id])->get('fixed_orders');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_by_number_invoice($id)
    {
        $result = $this->mongo_db->where(['invoice_number' => $id])->get('fixed_orders');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('fixed_orders');
        } else {
            $result = $this->mongo_db->get('fixed_orders');
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
        $result = $this->mongo_db->where('fixed_orders', $id)->set($data)->update('fixed_orders');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['fixed_orders_id' => $id])->delete('fixed_orders');
        return $result;
    }
    function update_fixed_orders_details($id, $data)
    {
        foreach ($data as $key => $value) {
            $this->mongo_db->set('details.$.' . $key, $value);
        }
        $result = $this->mongo_db->where('details.id', $id)->update('fixed_orders');
        return $result;
    }
    function update_fixed_orders($id, $data)
    {
        foreach ($data as $key => $value) {
            $this->mongo_db->set($key, $value);
        }
        $result = $this->mongo_db->where('details.id', $id)->update('fixed_orders');
        return $result;
    }
    function get_all_details_status($id = 0, $status = '0')
    {
        $fields = [
            'details' => ['$filter'  => ['input' => '$details', 'as' => 'detail', 'cond' => ['$eq' => ['$$detail.status', $status]]]],
            '_id' => 1,
        ];
        $conditions = ['details.id' => $id];
        $query      = $this->mongo_db->get_customize_fields('fixed_orders', $fields, $conditions, false, []);
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
    function create_change_fixed_orders($invoice_id = 0, $data = [])
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->where('fixed_orders', $invoice_id)->push('change', $data)->update('fixed_orders');
        return $newId;
    }
    function create_payment($farm_id = 0, $data = [])
    {
        $newId = $this->mongo_db->where('fixed_orders', $farm_id)->push('payments', $data)->update('fixed_orders');
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

        $query      = $this->mongo_db->aggregate('fixed_orders', $tuberia);
        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }
    function create_credit_farm($farm_id = 0, $data = [])
    {
        $newId = $this->mongo_db->where('fixed_orders', $farm_id)->push('credits', $data)->update('fixed_orders');
        return $newId;
    }
    function delete_credit_farm($farm_id = 0, $data = [])
    {
        $newId = $this->mongo_db->where('fixed_orders', $farm_id)->set('credits', $data)->update('fixed_orders');
        return $newId;
    }
    function update_box_variety($invoice_id, $box_id, $variety_id, $data)
    {
        $query = $this->mongodb->luxus->fixed_orders->updateOne(
            ['fixed_orders' => ['$eq' => $invoice_id]],
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
    //-----------------------------------------------------------------------------------------------------------

}
