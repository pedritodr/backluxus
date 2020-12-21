<?php

class Country extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Country_model', 'country');
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

        $all_countrys = $this->country->get_all(['is_active' => 1]);
        $data['all_countrys'] = $all_countrys;
        $this->load_view_admin_g("country/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('country/add');
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
            redirect("country/add_index");
        } else {
            $country_id = 'country_' . uniqid();
            $data = ['country_id' => $country_id, 'name' => $name, 'is_active' => 1];
            $this->country->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("country/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $country_object = $this->country->get_by_id($id);

        if ($country_object) {
            $data['country_object'] = $country_object;
            $this->load_view_admin_g('country/update', $data);
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
        $country_id = $this->input->post('country_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("country/update_index/" . $country_id);
        } else {
            $data = ['name' => $name];
            $row =  $this->country->update($country_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("country/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $country_object = $this->country->get_by_id($id);

        if ($country_object) {
            $this->country->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("country/index");
        } else {
            show_404();
        }
    }
}
