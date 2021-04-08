<?php

class Bouquet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Bouquet_model', 'bouquet');
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

        $all_bouquets = $this->bouquet->get_all(['is_active' => 1]);
        $data['all_bouquets'] = $all_bouquets;
        $this->load_view_admin_g("bouquet/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('bouquet/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = (int)$this->input->post('name');

        $this->form_validation->set_rules('name', "Nombre", 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("bouquet/add_index");
        } else {
            $bouquet_id = 'bouquet_' . uniqid();
            $data = ['bouquet_id' => $bouquet_id, 'number' => $name, 'is_active' => 1];
            $this->bouquet->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("bouquet/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $bouquet_object = $this->bouquet->get_by_id($id);

        if ($bouquet_object) {
            $data['bouquet_object'] = $bouquet_object;
            $this->load_view_admin_g('bouquet/update', $data);
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
        $name = (int) $this->input->post('name');
        $bouquet_id = $this->input->post('bouquet_id');
        $this->form_validation->set_rules('name', "Número", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("bouquet/update_index/" . $bouquet_id);
        } else {
            $data = ['number' => $name];
            $row =  $this->bouquet->update($bouquet_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("bouquet/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $bouquet_object = $this->bouquet->get_by_id($id);

        if ($bouquet_object) {
            $this->bouquet->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("bouquet/index");
        } else {
            show_404();
        }
    }
}
