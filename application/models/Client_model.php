<?php

class Client_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('cliente', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('cliente_id', $id);
        $query = $this->db->get('cliente');

        return $query->row();
    }
    function get_by_user_id($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('cliente');
        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE, $order = false, $by = false, $cant = false, $active = false)
    {
        if ($order)
            $this->db->order_by($order, $by);
        if ($cant)
            $this->db->limit($cant);
        if ($active)
            $this->db->where('is_active', 1);
        if ($conditions)
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        $query = $this->db->get('cliente');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('cliente_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('cliente');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('cliente_id', $id);
        $this->db->delete('cliente');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function get_all_clientes()
    {
        $this->db->select('*');
        $this->db->from('cliente');
        $this->db->join('user', 'user.user_id = cliente.user_id');
        $this->db->join('country', 'country.country_id = cliente.country_id');


        $query = $this->db->get();
        return $query->result();
    }
    function get_all_clientes_by_destinations($id)
    {
        $this->db->select('dialing.dialing_id,cliente.cliente_id,dialing.name,destination.name as name_destination,country.name as name_country');
        $this->db->from('cliente');
        $this->db->join('user', 'user.user_id = cliente.user_id');
        $this->db->join('dialing', 'dialing.cliente_id = cliente.cliente_id');
        $this->db->join('destination', 'destination.destination_id = dialing.destination_id');
        $this->db->join('country', 'country.country_id = cliente.country_id');
        $this->db->where('dialing.cliente_id', $id);


        $query = $this->db->get();
        return $query->result();
    }


    //------------------------------------------------------------------------------------------------------------------------------------------
}
