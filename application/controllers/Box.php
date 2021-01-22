<?php

class Box extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Box_model', 'box');
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

        $all_boxs = $this->box->get_all(['is_active' => 1]);
        $data['all_boxs'] = $all_boxs;
        $this->load_view_admin_g("box/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('box/add');
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
            redirect("box/add_index");
        } else {
            $box_id = 'box_' . uniqid();
            $data = ['box_id' => $box_id, 'name' => $name, 'is_active' => 1];
            $this->box->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("box/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $box_object = $this->box->get_by_id($id);

        if ($box_object) {
            $data['box_object'] = $box_object;
            $this->load_view_admin_g('box/update', $data);
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
        $box_id = $this->input->post('box_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("box/update_index/" . $box_id);
        } else {
            $data = ['name' => $name];
            $row =  $this->box->update($box_id, $data);
            $objBox = $this->box->get_by_id($box_id);
            $this->load->model('Categoria_model', 'categoria');
            $this->load->model('Product_model', 'product');
            $this->categoria->update_type($box_id,$objBox);
            $this->product->update_categories_type($box_id,$objBox);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("box/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $box_object = $this->box->get_by_id($id);

        if ($box_object) {
            $this->box->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("box/index");
        } else {
            show_404();
        }
    }
}
