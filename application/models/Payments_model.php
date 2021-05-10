<?php
require 'vendor/autoload.php';
class Payments_model extends CI_Model
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
        // $this->load->database();
    }

    function create_payment($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('payments', $data);
        return $newId;
    }
    function get_provider_by_id($id)
    {
        $result = $this->mongo_db->where(['payment_id' => $id])->get('payments');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_min_payment_by_farm_id($id)
    {
        $tuberia = [
            ['$project' => ['payment_id' => 1, 'amount' => 1, 'date_create' => 1, 'timestamp' => 1, '_id' => 0]],
            ['$sort' => ['timestamp' => -1]],
            ['$match' => ['farm.farm_id' => $id]]
        ];

        $query      = $this->mongo_db->aggregate('payments', $tuberia);
        if (count($query) > 0) {
            return $query[0];
        } else {
            return false;
        }
    }

    function get_all_payments($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->sort('payment_id', 'desc')->get('payments');
        } else {
            $result = $this->mongo_db->sort('payment_id', 'desc')->get('payments');
        }

        if ($get_as_row) {
            if (count($result) > 0) {
                return (object) $result[0];
            } else {
                return $result;
            }
        } else {
            return $result;
        }
    }
    function update($id, $data)
    {
        $result = $this->mongo_db->where('payment_id', $id)->set($data)->update('payments');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['payment_id' => $id])->delete('payments');
        return $result;
    }
}
