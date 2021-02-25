<?php

class Type extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Type_model', 'type');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_types = $this->type->get_all(['is_active' => 1]);
        $data['all_types'] = $all_types;
        $this->load_view_admin_g("type/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('type/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');

        $this->form_validation->set_rules('name', "Nombre", 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("type/add_index");
        } else {
            $type_id = 'type_' . uniqid();
            $data = ['type_id' => $type_id, 'name' => $name, 'is_active' => 1];
            $this->type->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("type/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $type_object = $this->type->get_by_id($id);

        if ($type_object) {
            $data['type_object'] = $type_object;
            $this->load_view_admin_g('type/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $name = $this->input->post('name');
        $type_id = $this->input->post('type_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("type/update_index/" . $type_id);
        } else {
            $data = ['name' => $name];
            $row =  $this->type->update($type_id, $data);
            $this->load->model('Product_model', 'product');
            if ($row) {
                $this->product->update_product_type($type_id, $name);
                $this->product->update_type_farm($type_id,$name);
            }
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("type/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $type_object = $this->type->get_by_id($id);

        if ($type_object) {
            $this->type->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("type/index");
        } else {
            show_404();
        }
    }
}
