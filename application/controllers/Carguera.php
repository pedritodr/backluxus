<?php

class Carguera extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Carguera_model', 'carguera');
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

        $cargueras = $this->carguera->get_all(['is_active' => 1]);
        $data['cargueras'] = $cargueras;
        $this->load_view_admin_g("carguera/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('carguera/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $person = $this->input->post('person');
        $email = $this->input->post('email');

        $this->form_validation->set_rules('name', translate('name_carguera_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("carguera/add_index");
        } else {
            $carguera_id = 'carguera_' . uniqid();
            $data = ['carguera_id' => $carguera_id, 'name' => $name, 'is_active' => 1, 'address' => $address, 'phone' => $phone, 'person' => $person, 'email' => $email];
            $this->carguera->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("carguera/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $object = $this->carguera->get_by_id($id);

        if ($object) {
            $data['object'] = $object;
            $this->load_view_admin_g('carguera/update', $data);
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

        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $person = $this->input->post('person');
        $email = $this->input->post('email');
        $carguera_id = $this->input->post('carguera_id');
        $this->form_validation->set_rules('name', translate('name_carguera_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("carguera/update_index/" . $carguera_id);
        } else {
            $data = ['name' => $name, 'address' => $address, 'phone' => $phone, 'person' => $person, 'email' => $email];
            $row =  $this->carguera->update($carguera_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("carguera/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $object = $this->carguera->get_by_id($id);

        if ($object) {
            $this->carguera->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("carguera/index");
        } else {
            show_404();
        }
    }
}
