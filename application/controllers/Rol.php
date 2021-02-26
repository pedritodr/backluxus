<?php

class rol extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('role_model', 'rol');
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

        $roles = $this->rol->get_all(['is_active' => 1]);
        $data['roles'] = $roles;
        $this->load_view_admin_g("role/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('role/add');
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
            redirect("rol/add_index");
        } else {
            $rol_id = 'rol_' . uniqid();
            $data = ['role_id' => $rol_id, 'name' => $name, 'is_active' => 1];
            $this->rol->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("rol/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $rol_object = $this->rol->get_by_id($id);

        if ($rol_object) {
            $data['rol_object'] = $rol_object;
            $this->load_view_admin_g('role/update', $data);
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
        $rol_id = $this->input->post('role_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("rol/update_index/" . $rol_id);
        } else {
            $data = ['name' => $name];
            $row =  $this->rol->update($rol_id, $data);
            $rol_object = $this->rol->get_by_id($rol_id);
            $this->rol->update_rol_farm_personal($rol_id, $rol_object);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("rol/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $rol_object = $this->rol->get_by_id($id);

        if ($rol_object) {
            $this->rol->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("rol/index");
        } else {
            show_404();
        }
    }
}
