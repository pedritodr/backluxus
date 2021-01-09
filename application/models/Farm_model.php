<?php

class Farm_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('fams', $data);
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['farm_id' => $id])->get('fams');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('fams');
        } else {
            $result = $this->mongo_db->get('fams');
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
        $result = $this->mongo_db->where('farm_id', $id)->set($data)->update('fams');
        return $result;
    }
    function delete($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->delete('fams');
        return $result;
    }


    function create_provider_products_array($id, $array)
    {

        $this->db->where('provider_id', $id);
        $this->db->delete('provider_product');

        foreach ($array as $item) {
            $data = ['provider_id' => $id, 'product_id' => $item];
            $this->db->insert('provider_product', $data);
        }
    }

    function get_all_products_by_provider_simple($id)
    {
        $this->db->select('product_id');
        $this->db->where('provider_id', $id);
        $query = $this->db->get('provider_product');


        $all_products_provider = $query->result();

        if ($all_products_provider) {
            $all_products_ids = [];
            foreach ($all_products_provider as $item) {
                $product = $this->product->get_by_id($item->product_id);
                if ($product)
                    array_push($all_products_ids, $product->product_id);
            }
            return $all_products_ids;
        } else return null;
    }
    function get_all_products_by_provider($id)
    {
        $this->db->select('product.product_id,product.name');
        $this->db->from('provider_product');
        $this->db->join('product', 'product.product_id = provider_product.product_id');
        $this->db->join('provider', 'provider.provider_id = provider_product.provider_id');


        $this->db->where('provider_product.provider_id', $id);


        $query = $this->db->get();
        return $query->result();
    }

    function get_all_providers_by_variety($id)
    {
        $this->db->select('*');
        $this->db->from('provider_product');
        $this->db->join('product', 'product.product_id = provider_product.product_id');
        $this->db->join('provider', 'provider.provider_id = provider_product.provider_id');

        $this->db->where('product.product_id', $id);


        $query = $this->db->get();
        return $query->result();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
