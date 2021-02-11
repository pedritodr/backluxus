<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {

     parent::__construct();

       $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {
        //var_dump($this->session->userdata());die();
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('dashboard/index_admin');
    }
}
