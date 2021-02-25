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
        $all_countrys = $this->country->get_all_countrys();
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
            $data = ['country_id' => $country_id, 'name' => $name, 'is_active' => 1, 'citys' => []];
            $this->country->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("country/index", "location", 301);
        }
    }
    public function add_city()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $name = $this->input->post('nameCityAdd');
        $country_id = $this->input->post('countryId');
        $city_id = 'city_' . uniqid();
        $data = ['city_id' => $city_id, 'name' => $name, 'is_active' => 1, 'country_id' => $country_id];
        $response =  $this->country->create_city($country_id, $data);
        $citys = $this->country->get_all_citys($country_id);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'citys' => $citys]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }

    public function update_city()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $name = $this->input->post('nameCityEdit');
        $city_id = $this->input->post('cityId');
        $country_id = $this->input->post('countryId');
        $response =  $this->country->update_city($city_id, $name);
        $this->country->update_city_user($city_id,$name);
        $this->country->update_city_user_marking($city_id,$name);
        $citys = $this->country->get_all_citys($country_id);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'citys' => $citys]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }

    public function delete_city()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $city_id = $this->input->post('cityId');
        $country_id = $this->input->post('countryId');
        $response =  $this->country->update_status_city($city_id);

        $citys = $this->country->get_all_citys($country_id);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'citys' => $citys]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
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
            $this->country->update_country_user($country_id, (object)$data);
            $this->country->update_country_user_marking($country_id, (object)$data);
            $this->country->update_city_user_markets($country_id,$name);
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
