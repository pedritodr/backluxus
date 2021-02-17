<?php

class Color extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Color_model', 'color');
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

        $all_colors = $this->color->get_all(['is_active' => 1]);
        $data['all_colors'] = $all_colors;
        $this->load_view_admin_g("color/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load_view_admin_g('color/add');
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
            redirect("color/add_index");
        } else {
            $color_id = 'color_' . uniqid();
            $data = ['color_id' => $color_id, 'name' => $name, 'is_active' => 1];
            $this->color->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("color/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $color_object = $this->color->get_by_id($id);

        if ($color_object) {
            $data['color_object'] = $color_object;
            $this->load_view_admin_g('color/update', $data);
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
        $color_id = $this->input->post('color_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("color/update_index/" . $color_id);
        } else {
            $data = ['name' => $name];
            $row =  $this->color->update($color_id, $data);
            if ($row) {
                $this->load->model('Product_model', 'product');
                $this->product->update_product_color($color_id, $name);
                $this->product->update_color_farm($color_id,$name);
            }
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("color/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $color_object = $this->color->get_by_id($id);

        if ($color_object) {
            $this->color->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("color/index");
        } else {
            show_404();
        }
    }
}
