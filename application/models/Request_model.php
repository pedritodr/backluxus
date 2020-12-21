<?php

class Request_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('request', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('request_id', $id);
        $query = $this->db->get('request');

        return $query->row();
    }

    function delete($id)
    {
        $this->db->where('request_id', $id);
        $this->db->delete('request');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('request');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('request_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('request');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }

    function get_all_request()
    {
        $this->db->select('*');
        $this->db->from('request');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');


        $query = $this->db->get();
        return $query->result();
    }
    function get_all_request_by_id($id)
    {

        $this->db->select('request.request_id,request.purchase_order,request.date_time_reception,request.date_purchase,cliente.cliente_name,cliente.logo,cliente.address,country.name as country,product_measure.measure,request_product.request_product_id,request_product.total_steams,request_product.unit_price,request_product.total_price,product.product_id,product.name,product.photo,dialing.name as dialing,destination.name as destination');
        $this->db->from('request');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->join('country', 'country.country_id = cliente.country_id');
        $this->db->join('request_product', 'request_product.request_id = request.request_id');
        $this->db->join('product_measure', 'product_measure.product_measure_id = request_product.product_measure_id');
        $this->db->join('product', 'product.product_id = product_measure.product_id');
        $this->db->join('dialing', 'dialing.dialing_id = request_product.dialing_id');
        $this->db->join('destination', 'destination.destination_id = dialing.destination_id');

        $this->db->where('request.request_id', $id);


        $query = $this->db->get();
        return $query->result();
    }
    function get_all_request_variety_by_id($id)
    {
        $this->db->select('request_product.request_product_id,request_product.total_steams,request_product.product_measure_id,request_product.unit_price,request_product.total_price,request_product.status,product.product_id,product.name,product.photo,product_measure.measure');
        $this->db->from('request_product');
        $this->db->join('product_measure', 'product_measure.product_measure_id = request_product.product_measure_id');
        $this->db->join('product', 'product.product_id=product_measure.product_id');
        $this->db->where('request_product.request_id', $id);


        $query = $this->db->get();
        return $query->result();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
