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

        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('role_model', 'rol');
        $this->load->model('User_model', 'user');
        $this->load->model('Country_model', 'country');
        $roles = $this->rol->get_all(['is_active' => 1]);
        $all_providers = $this->farm->get_all_providers(['is_active' => 1]);
        foreach ($all_providers as $item) {
            if (!$item->farm_father) {
                $item->farms_sons = $this->farm->get_all_farm_sons($item->farm_id);
            }
        }
        $users_luxus = $this->user->get_all_users();
        $data['countrys'] = $this->country->get_all_countrys_farms();
        $data['users_luxus'] = $users_luxus;
        $data['all_providers'] = $all_providers;
        $data['roles'] = $roles;
        $this->load_view_admin_g("farm/index", $data);
    }

    public function add_index_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Country_model', 'country');
        $country_id = 'country_5fe0e59bdfb97';
        $citys = $this->country->get_all_citys($country_id);
        $all_providers = $this->farm->get_all_farm_father();
        $data['farms'] = $all_providers;
        $data['citys'] = $citys;
        $this->load_view_admin_g('farm/add', $data);
    }

    public function add_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Country_model', 'country');
        //  $owner = $this->input->post('owner');
        $days = $this->input->post('days');
        $name_legal = $this->input->post('name_legal');
        $name_commercial = $this->input->post('name_commercial');
        $address_farm = $this->input->post('address_farm');
        $address_office = $this->input->post('address_office');
        $hectare = $this->input->post('hectare');
        $farm = $this->input->post('farms');
        $city = $this->input->post('citys');
        $observations = $this->input->post('desc');
        $farms = false;
        if ($farm != '0') {
            $farms = $this->farm->get_min_farm_by_id($farm);
        }
        if ($city != '0') {
            $city = $this->country->get_citys_by_id($city);
        }
        $this->form_validation->set_rules('name_commercial', translate('name_commercial_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/add_provider");
        } else {
            $farm_id = 'farm_' . uniqid();
            $data = [
                'farm_id' => $farm_id,
                'days_credit' => $days,
                'farm_father' => $farms,
                'name_legal' => $name_legal,
                'date_create' => date('Y-m-d'),
                'name_commercial' => $name_commercial,
                'address_farm' => $address_farm,
                'address_office' => $address_office,
                'hectare' => $hectare,
                'observations' => $observations,
                'city' => $city,
                'is_active' => 1
            ];
            $this->farm->create_provider($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("farm/index_provider", "location", 301);
        }
    }
    function update_index_provider($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $provider_obj = $this->farm->get_provider_by_id($provider_id);
        if ($provider_obj) {
            $this->load->model('Country_model', 'country');
            $country_id = 'country_5fe0e59bdfb97';
            $citys = $this->country->get_all_citys($country_id);
            $all_providers = $this->farm->get_all_farm_father_edit($provider_id);
            $data['farms'] = $all_providers;
            $data['provider_obj'] = $provider_obj;
            $data['citys'] = $citys;
            $this->load_view_admin_g('farm/update', $data);
        } else {
            show_404();
        }
    }
    public function update_provider()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Country_model', 'country');
        $farm_id = $this->input->post('farm_id');
        $days = $this->input->post('days');
        $name_legal = $this->input->post('name_legal');
        $name_commercial = $this->input->post('name_commercial');
        $address_farm = $this->input->post('address_farm');
        $address_office = $this->input->post('address_office');
        $hectare = $this->input->post('hectare');
        $farm = $this->input->post('farms');
        $city = $this->input->post('citys');
        $observations = $this->input->post('desc');
        $farms = false;
        if ($farm != '0') {
            $farms = $this->farm->get_min_farm_by_id($farm);
        }
        if ($city != '0') {
            $city = $this->country->get_citys_by_id($city);
        }
        $this->form_validation->set_rules('name_commercial', translate('name_commercial_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("farm/update_index_provider/" . $farm_id);
        } else {
            $data = [
                'days_credit' => $days,
                'farm_father' => $farms,
                'name_legal' => $name_legal,
                'name_commercial' => $name_commercial,
                'address_farm' => $address_farm,
                'address_office' => $address_office,
                'hectare' => $hectare,
                'observations' => $observations,
                'city' => $city,
            ];
            $this->farm->update_provider($farm_id, $data);
            if (!$farms) {
                $data_min = [
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('User_model', 'user');
        $provider_object = $this->farm->get_provider_by_id($provider_id);
        $users_luxus = $this->user->get_all_users();
        $data['users_luxus'] = $users_luxus;
        $data['provider_object'] = $provider_object;

        $this->load_view_admin_g("farm/index_farm", $data);
    }

    public function add_farm_index($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('farm/add_farm', ['provider_id' => $provider_id]);
    }

    public function add_farm()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Role_model', 'rol');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $skype = $this->input->post('skype');
        $farm_id = $this->input->post('farmId');
        $function = $this->input->post('functions');
        $objFuction = $this->rol->get_by_id($function);
        $person_id = 'person_' . uniqid();
        $data = [
            'person_id' => $person_id,
            'name' => $name,
            'email' => $email,
            'skype' => $skype,
            'phone' => $phone,
            'is_active' => 1,
            'farm_id' => $farm_id,
            'function' => $objFuction
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Role_model', 'rol');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $skype = $this->input->post('skype');
        $email = $this->input->post('email');
        $person_id = $this->input->post('personId');
        $farm_id = $this->input->post('farmId');
        $function = $this->input->post('functions');
        $objFuction = $this->rol->get_by_id($function);
        $data = [
            'name' => $name,
            'skype' => $skype,
            'phone' => $phone,
            'email' => $email,
            'function' => $objFuction
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $personLuxus = json_decode($this->input->post('personLuxus'));
        $farm_id = $this->input->post('farmId');
        foreach ($personLuxus as $item) {
            $person_id = 'pl_' . uniqid();
            $item->person_luxus_id = $person_id;
            $item->person_is_active = 1;
        }
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
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
    public function index_balance()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3, 8])) {
            $this->log_out();
            redirect('login/index');
        }

        $data['farms'] = $this->farm->get_all_providers(['is_active' => 1]);
        $this->load_view_admin_g("farm/index_balance", $data);
    }

    public function loadInvoiceRangeDate()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3, 8])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Payments_model', 'payment');
        $since = strtotime($this->input->post('since'));
        $until = strtotime($this->input->post('until'));
        $farmId = $this->input->post('farmId');
        $latestPayment = $this->payment->get_min_payment_by_farm_id($farmId);
        $response = $this->farm->get_invoice_load_range_date($since, $until, $farmId);
        $balance = $this->farm->balance_farm($farmId);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $response, 'latestPayment' => $latestPayment, 'balance' => $balance]);
        exit();
    }
    public function index_payments()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Payments_model', 'payments');

        $data['payments'] = $this->payments->get_all_payments();

        $this->load_view_admin_g("farm/index_payments", $data);
    }
    public function add_payments()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $data['farms'] = $this->farm->get_min_providers();
        $this->load_view_admin_g("farm/add_payments", $data);
    }
    public function loadInvoicePayment()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Invoice_farm_model', 'invoice_farm');
        $farmId = $this->input->post('farmId');
        $farm_object = $this->farm->get_min_farm_by_id($farmId);
        $farm_object->days_credit === '' ? $days_credit = '30' : $days_credit = $farm_object->days_credit;
        $dateActual = date('Y-m-' . $days_credit);
        $response = $this->invoice_farm->balance_farm_payment($farmId, $days_credit);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $response, 'date' => $dateActual]);
        exit();
    }
    public function add_payment_invoice_farm()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Invoice_farm_model', 'invoice_farm');
        $this->load->model('Payments_model', 'payment');
        $arrayRequest = json_decode($this->input->post('arrayRequest'));
        $amount = (float) $this->input->post('amount');
        $balance = (float) $this->input->post('balance');
        $selectTypeTransaction = $this->input->post('selectTypeTransaction');
        $costeTransfer = (float)$this->input->post('costeTransfer');
        $numberTransaction = $this->input->post('numberTransaction');
        $farm = json_decode($this->input->post('farm'));
        $date_create = date("Y-m-d H:i:s");
        $bank = $this->input->post('bank');
        $payment_id = 'payment_' . uniqid();
        $arrTemp = [];
        $data = [
            'paymentId' => $payment_id,
            'farm' => $farm,
            'costeTransfer' => $costeTransfer,
            'is_active' => 1,
            'selectTypeTransaction' => $selectTypeTransaction,
            'bank' => $bank,
            'balance' => $balance,
            'numberTransaction' => $numberTransaction,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create)
        ];
        $dataMin = [
            'paymentId' => $payment_id,
            'costeTransfer' => $costeTransfer,
            'is_active' => 1,
            'selectTypeTransaction' => $selectTypeTransaction,
            'bank' => $bank,
            'balance' => $balance,
            'numberTransaction' => $numberTransaction,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create)
        ];
        for ($i = 0; $i < count($arrayRequest); $i++) {
            if ($arrayRequest[$i]->selected) {
                unset($arrayRequest[$i]->_id);
                if ((float)$arrayRequest[$i]->amountInvoice <= $amount) {
                    $amount = (float) number_format($amount, 2) - (float) number_format((float)$arrayRequest[$i]->amountInvoice, 2);
                    $dataMin['amount'] = (float)number_format((float)$arrayRequest[$i]->amountInvoice);
                    $dataMin['csm'] = 1;
                    $dataPayment = [
                        'payment' => (object)$dataMin,
                    ];
                    $this->invoice_farm->update($arrayRequest[$i]->invoice_farm, ['paid' => true]);
                    $this->invoice_farm->create_payment($arrayRequest[$i]->invoice_farm, $dataPayment);
                } else {
                    $dataMin['amount'] = $amount;
                    $amount = 0;
                    $dataPayment = [
                        'payment' => (object)$dataMin,
                    ];
                    $this->invoice_farm->create_payment($arrayRequest[$i]->invoice_farm, $dataPayment);
                }
                $arrTemp[] = $arrayRequest[$i];
            }
            if ($amount <= 0) {
                break;
            }
        }
        $data['invoices'] = $arrTemp;
        $this->payment->create_payment($data);
        $payment = $this->payment->get_by_id($payment_id);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $payment]);
        exit();
    }
}
