<?php

class Farm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Farm_model', 'farm');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index_provider()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $all_providers = $this->farm->get_all_providers(['is_active' => 1]);

        $data['all_providers'] = $all_providers;

        $this->load_view_admin_g("farm/index", $data);
    }

    public function add_index_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('farm/add');
    }

    public function add_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $owner = $this->input->post('owner');
        $days = $this->input->post('days');
        $this->form_validation->set_rules('owner', translate('owner_lang'), 'required');
        $this->form_validation->set_rules('days', translate('owner_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/add_provider");
        } else {
            $provider_d = 'provider_' . uniqid();
            $data = ['provider_id' => $provider_d, 'owner' => $owner, 'days_credit' => $days, 'farms' => [], 'is_active' => 1];
            $this->farm->create_provider($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("farm/index_provider", "location", 301);
        }
    }
    function update_index_provider($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_obj = $this->farm->get_provider_by_id($provider_id);
        if ($provider_obj) {
            $data['provider_obj'] = $provider_obj;
            $this->load_view_admin_g('farm/update', $data);
        } else {
            show_404();
        }
    }
    public function update_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $owner = $this->input->post('owner');
        $days = $this->input->post('days');
        $provider_id = $this->input->post('provider_id');
        $this->form_validation->set_rules('owner', translate('owner_lang'), 'required');
        $this->form_validation->set_rules('days', translate('owner_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/add_index");
        } else {
            $data = ['owner' => $owner, 'days_credit' => $days];
            $this->farm->update_provider($provider_id, $data);
            $this->response->set_message(translate("data_update_ok"), ResponseMessage::SUCCESS);
            redirect("farm/index_provider", "location", 301);
        }
    }
    public function delete_provider($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $provider_object = $this->farm->get_provider_by_id($provider_id);
        if ($provider_object) {
            $this->farm->update_provider($provider_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("farm/index_provider");
        } else {
            show_404();
        }
    }
    public function index($provider_id = 0)
    {
        //  var_dump($provider_id);
        //  die();
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $provider_object = $this->farm->get_provider_by_id($provider_id);

        $data['provider_object'] = $provider_object;

        $this->load_view_admin_g("farm/index_farm", $data);
    }

    public function add_farm_index($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('farm/add_farm', ['provider_id' => $provider_id]);
    }

    public function add_farm()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name_legal = $this->input->post('name_legal');
        $name_commercial = $this->input->post('name_commercial');
        $address_farm = $this->input->post('address_farm');
        $address_office = $this->input->post('address_office');
        $hectare = $this->input->post('hectare');
        $provider_id = $this->input->post('provider_id');
        $this->form_validation->set_rules('name_legal', translate('name_legal_lang'), 'required');
        $this->form_validation->set_rules('name_commercial', translate('name_commercial_lang'), 'required');
        $this->form_validation->set_rules('address_farm', translate('address_farm_lang'), 'required');
        $this->form_validation->set_rules('address_office', translate('address_oficce_lang'), 'required');
        $this->form_validation->set_rules('hectare', translate('hectare_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/add_farm_index/") . $provider_id;
        } else {
            $farm_id = 'farm_' . uniqid();
            $data = ['farm_id' => $farm_id, 'name_legal' => $name_legal, 'name_commercial' => $name_commercial, 'address_farm' => $address_farm, 'address_office' => $address_office, 'hectare' => $hectare, 'is_active' => 1];
            $this->farm->create_farm($provider_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("farm/index/" . $provider_id, "location", 301);
        }
    }
    function update_index($farm_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $farm_object = $this->farm->get_farm_by_id($farm_id);

        if ($farm_object) {
            $data['farm_object'] = $farm_object;
            $this->load_view_admin_g('farm/update_farm', $data);
        } else {
            show_404();
        }
    }
    public function update_farm()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $name_legal = $this->input->post('name_legal');
        $name_commercial = $this->input->post('name_commercial');
        $address_farm = $this->input->post('address_farm');
        $address_office = $this->input->post('address_office');
        $hectare = $this->input->post('hectare');
        $provider_id = $this->input->post('provider_id');
        $farm_id = $this->input->post('farm_id');
        $farm_object = $this->farm->get_farm_by_id($farm_id);
        $this->form_validation->set_rules('name_legal', translate('name_legal_lang'), 'required');
        $this->form_validation->set_rules('name_commercial', translate('name_commercial_lang'), 'required');
        $this->form_validation->set_rules('address_farm', translate('address_farm_lang'), 'required');
        $this->form_validation->set_rules('address_office', translate('address_oficce_lang'), 'required');
        $this->form_validation->set_rules('hectare', translate('hectare_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/add_farm_index/") . $provider_id;
        } else {
            $data = ['name_legal' => $name_legal, 'name_commercial' => $name_commercial, 'address_farm' => $address_farm, 'address_office' => $address_office, 'hectare' => $hectare, 'is_active' => $farm_object->is_active, 'farm_id' => $farm_id, '_id' => $farm_object->_id];
            $this->farm->update_farm($farm_id, $data);
            $this->response->set_message(translate("data_update_ok"), ResponseMessage::SUCCESS);
            redirect("farm/index/" . $provider_id, "location", 301);
        }
    }
    public function delete_farm($farm_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $farm_object = $this->farm->get_farm_by_id($farm_id);
        if ($farm_object) {
            //  $data = ['name_legal' => $farm_object->name_legal, 'name_commercial' => $farm_object->name_commercial, 'address_farm' => $farm_object->address_farm, 'address_office' => $farm_object->address_office, 'hectare' => $farm_object->hectare, 'is_active' => 0, 'farm_id' => $farm_id, '_id' => $farm_object->_id];
            $this->farm->update_farm2($farm_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("farm/index/" . $farm_object->provider_id, "location", 301);
        } else {
            show_404();
        }
    }
}
