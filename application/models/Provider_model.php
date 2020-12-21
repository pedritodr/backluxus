<?php

class Provider_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('provider', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('provider_id', $id);
        $query = $this->db->get('provider');

        return $query->row();
    }

    function delete($id)
    {
        $this->db->where('provider_id', $id);
        $this->db->delete('provider');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('provider');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('provider_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('provider');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
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
