<?php

class Aeroline extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Aeroline_model', 'aeroline');
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

        $all_aerolines = $this->aeroline->get_all(['is_active' => 1]);
        $data['all_aerolines'] = $all_aerolines;
        $this->load_view_admin_g("aeroline/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('aeroline/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        $this->form_validation->set_rules('code', translate('code_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("aeroline/add_index");
        } else {
            $aeroline_id = 'aeroline_' . uniqid();
            $data = ['aeroline_id' => $aeroline_id, 'name' => $name, 'is_active' => 1, 'code' => $code];
            $this->aeroline->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("aeroline/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $aeroline_object = $this->aeroline->get_by_id($id);

        if ($aeroline_object) {
            $data['object'] = $aeroline_object;
            $this->load_view_admin_g('aeroline/update', $data);
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
        $code = $this->input->post('code');
        $aeroline_id = $this->input->post('aeroline_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("aeroline/update_index/" . $aeroline_id);
        } else {
            $data = ['name' => $name, 'code' => $code];
            $row =  $this->aeroline->update($aeroline_id, $data);

            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("aeroline/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $aeroline_object = $this->aeroline->get_by_id($id);

        if ($aeroline_object) {
            $this->aeroline->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("aeroline/index");
        } else {
            show_404();
        }
    }
}
