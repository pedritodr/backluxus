<?php

class Measure extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Measure_model', 'measure');
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

        $all_measures = $this->measure->get_all(['is_active' => 1]);
        $data['all_measures'] = $all_measures;
        $this->load_view_admin_g("measure/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('measure/add');
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
            redirect("measure/add_index");
        } else {
            $measure_id = 'measure_' . uniqid();
            $data = ['measure_id' => $measure_id, 'name' => $name, 'is_active' => 1];
            $this->measure->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("measure/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $measure_object = $this->measure->get_by_id($id);

        if ($measure_object) {
            $data['measure_object'] = $measure_object;
            $this->load_view_admin_g('measure/update', $data);
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
        $measure_id = $this->input->post('measure_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("measure/update_index/" . $measure_id);
        } else {
            $data = ['name' => $name];
            $row =  $this->measure->update($measure_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("measure/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $measure_object = $this->measure->get_by_id($id);

        if ($measure_object) {
            $this->measure->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("measure/index");
        } else {
            show_404();
        }
    }
}
