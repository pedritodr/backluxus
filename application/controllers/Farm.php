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
        $this->load->model('User_model', 'user');
        $this->load->model('Country_model', 'country');
        $all_providers = $this->farm->get_all_providers(['is_active' => 1]);
        foreach ($all_providers as $item) {
            if (!$item->farm_father) {
                $item->farms_sons = $this->farm->get_all_farm_sons($item->farm_id);
            }
        }
        $users_luxus = $this->user->get_all(['role_id' => 1, 'is_delete' => 0]);
        $data['countrys'] = $this->country->get_all_countrys_farms();
        $data['users_luxus'] = $users_luxus;
        $data['all_providers'] = $all_providers;
        $this->load_view_admin_g("farm/index", $data);
    }

    public function add_index_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $all_providers = $this->farm->get_all_farm_father();
        $data['farms'] = $all_providers;
        $this->load_view_admin_g('farm/add', $data);
    }

    public function add_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $owner = $this->input->post('owner');
        $days = $this->input->post('days');
        $name_legal = $this->input->post('name_legal');
        $name_commercial = $this->input->post('name_commercial');
        $address_farm = $this->input->post('address_farm');
        $address_office = $this->input->post('address_office');
        $hectare = $this->input->post('hectare');
        $farm = $this->input->post('farms');

        $observations = $this->input->post('desc');
        $farms = false;
        if ($farm != '0') {
            $farms = $this->farm->get_min_farm_by_id($farm);
        }

        $this->form_validation->set_rules('owner', translate('owner_lang'), 'required');
        $this->form_validation->set_rules('days', translate('owner_lang'), 'required');
        $this->form_validation->set_rules('name_legal', translate('name_legal_lang'), 'required');
        $this->form_validation->set_rules('name_commercial', translate('name_commercial_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/add_provider");
        } else {
            $farm_id = 'farm_' . uniqid();
            $data = [
                'farm_id' => $farm_id,
                'owner' => $owner,
                'days_credit' => $days,
                'farm_father' => $farms,
                'name_legal' => $name_legal,
                'date_create' => date('Y-m-d'),
                'name_commercial' => $name_commercial,
                'address_farm' => $address_farm,
                'address_office' => $address_office,
                'hectare' => $hectare,
                'observations' => $observations,
                'is_active' => 1
            ];
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
            $all_providers = $this->farm->get_all_farm_father_edit($provider_id);
            $data['farms'] = $all_providers;
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
        $farm_id = $this->input->post('farm_id');
        $owner = $this->input->post('owner');
        $days = $this->input->post('days');
        $name_legal = $this->input->post('name_legal');
        $name_commercial = $this->input->post('name_commercial');
        $address_farm = $this->input->post('address_farm');
        $address_office = $this->input->post('address_office');
        $hectare = $this->input->post('hectare');
        $farm = $this->input->post('farms');

        $observations = $this->input->post('desc');
        $farms = false;
        if ($farm != '0') {
            $farms = $this->farm->get_min_farm_by_id($farm);
        }

        $this->form_validation->set_rules('owner', translate('owner_lang'), 'required');
        $this->form_validation->set_rules('days', translate('owner_lang'), 'required');
        $this->form_validation->set_rules('name_legal', translate('name_legal_lang'), 'required');
        $this->form_validation->set_rules('name_commercial', translate('name_commercial_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/update_index_provider/" . $farm_id);
        } else {
            $data = [
                'owner' => $owner,
                'days_credit' => $days,
                'farm_father' => $farms,
                'name_legal' => $name_legal,
                'name_commercial' => $name_commercial,
                'address_farm' => $address_farm,
                'address_office' => $address_office,
                'hectare' => $hectare,
                'observations' => $observations
            ];
            $this->farm->update_provider($farm_id, $data);
            if (!$farms) {

                $data_min = [
                    'owner' => $owner,
                    'name_legal' => $name_legal,
                    'name_commercial' => $name_commercial
                ];

                $this->farm->update_farm_sons($farm_id, $data_min);
            }
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
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('User_model', 'user');
        $provider_object = $this->farm->get_provider_by_id($provider_id);
        $users_luxus = $this->user->get_all(['role_id' => 1, 'is_delete' => 0]);
        $data['users_luxus'] = $users_luxus;
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
            $data = ['name_legal' => $name_legal, 'name_commercial' => $name_commercial, 'address_farm' => $address_farm, 'address_office' => $address_office, 'hectare' => $hectare];
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
            $data = ['is_active' => 0];
            $this->farm->update_farm($farm_id, $data);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("farm/index/" . $farm_object->provider_id, "location", 301);
        } else {
            show_404();
        }
    }

    public function add_persona()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $skype = $this->input->post('skype');
        $farm_id = $this->input->post('farmId');
        $function = $this->input->post('functions');
        $person_id = 'person_' . uniqid();
        $data = [
            'person_id' => $person_id,
            'name' => $name,
            'email' => $email,
            'skype' => $skype,
            'phone' => $phone,
            'is_active' => 1,
            'farm_id' => $farm_id,
            'function' => (int)$function
        ];
        $this->farm->create_person($farm_id, $data);
        $farm = $this->farm->get_provider_by_id($farm_id);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $farm->personal]);
        exit();
    }

    public function update_person()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $skype = $this->input->post('skype');
        $email = $this->input->post('email');
        $person_id = $this->input->post('personId');
        $farm_id = $this->input->post('farmId');
        $function = $this->input->post('functions');

        $data = [
            'name' => $name,
            'skype' => $skype,
            'phone' => $phone,
            'email' => $email,
            'function' => (int)$function
        ];
        $this->farm->update_person($person_id, $data);
        $farm = $this->farm->get_provider_by_id($farm_id);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $farm->personal]);
        exit();
    }
    public function delete_person()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $person_id = $this->input->post('personId');
        $farm_id = $this->input->post('farmId');
        $this->farm->delete_person($farm_id, $person_id);
        $farm = $this->farm->get_provider_by_id($farm_id);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $farm->personal]);
        exit();
    }
    public function add_person_luxus()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $personLuxus = (object)$this->input->post('personLuxus');
        $farm_id = $this->input->post('farmId');
        $person_id = 'pl_' . uniqid();
        $personLuxus->person_luxus_id = $person_id;
        $personLuxus->person_is_active = 1;
        $response = $this->farm->update_provider($farm_id, ['person_luxus' => $personLuxus]);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function markets()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }

        $countrys = $this->input->post('countrys');
        $farm_id = $this->input->post('farmId');
        $data = [
            'markets' => $countrys,
        ];
        $this->farm->update_provider($farm_id, $data);
        echo json_encode(['status' => 200, 'msj' => 'correcto']);
        exit();
    }
    public function add_varieties()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }

        $varieties = json_decode($this->input->post('varietiesLoad'));
        $farm_id = $this->input->post('farmId');
        $data = [
            'varieties' => $varieties,
        ];
        $this->farm->update_provider($farm_id, $data);
        $farm = $this->farm->get_provider_by_id($farm_id);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $farm->varieties]);
        exit();
    }
    public function delete_variety()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $product_id = $this->input->post('productId');
        $farm_id = $this->input->post('farmId');
        $this->farm->delete_variety($farm_id, $product_id);
        $farm = $this->farm->get_provider_by_id($farm_id);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $farm->varieties]);
        exit();
    }
}
