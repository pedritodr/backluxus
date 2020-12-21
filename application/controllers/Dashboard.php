<?php
require(APPPATH . "libraries/facebook/src/facebook.php");

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        /*  $this->load->model('User_model', 'user');
        $this->load->model('Pedido_model', 'pedido');
        $this->load->model('Product_model', 'producto'); */
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();

        /*    if (!in_array($this->session->userdata('role_id'), [1, 2, 3,])) {
            $this->log_out();
            redirect('login/index');
        } */
    }

    public function index()

    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('dashboard/index_admin');
    }

    public function ver_detalle($id)
    {

        $pedido_object = $this->pedido->get_by_pedido($id);

        $data['pedido_object'] = $pedido_object;
        $this->load_view_admin_g('dashboard/detalle_pedido', $data);
    }

    public function change($id)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $pedido_object = $this->pedido->get_by_id($id);

        if ($pedido_object) {
            if ($pedido_object->status == 0)
                $this->pedido->update($id, ['status' => 1]);
            if ($pedido_object->status == 1)
                $this->pedido->update($id, ['status' => 0]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("dashboard/index");
        } else {
            show_404();
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $pedido_object = $this->pedido->get_by_id($id);

        if ($pedido_object) {

            $this->pedido->delete($id);
            $this->response->set_message('El Pedido se ha eliminado Correctamente', ResponseMessage::SUCCESS);
            redirect("dashboard/index");
        } else {
            show_404();
        }
    }
}
