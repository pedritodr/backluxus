<?php

class Provider extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Provider_model', 'provider');
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
        $this->load->model('Product_model', 'product');
        $all_providers = $this->provider->get_all();

        foreach ($all_providers as $provider) {
            $provider->products = $this->provider->get_all_products_by_provider($provider->provider_id);
            foreach ($provider->products as $item) {
                $item->measure = $this->product->get_by_measure_id($item->product_id);
            }
        }


        $data['all_providers'] = $all_providers;

        $this->load_view_admin_g("provider/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $all_products = $this->product->get_all();
        $data['all_products'] = $all_products;

        $this->load_view_admin_g('provider/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $identificacion = $this->input->post('identificacion');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $person_payment = $this->input->post('person_payment');
        $banking = $this->input->post('banking');
        $additional = $this->input->post('additional');
        $varieties = $this->input->post('varieties');
        $address = $this->input->post('address');
        $seller = $this->input->post('seller');
        $email_seller = $this->input->post('email_seller');
        $phone_seller = $this->input->post('phone_seller');
        $email_payment = $this->input->post('email_payment');
        $phone_payment = $this->input->post('phone_payment');
        $skype_seller = $this->input->post('skype_seller');
        $skype_payment = $this->input->post('skype_payment');
        $name_commercial = $this->input->post('nombre_comercial');



        $data = ['name' => $name, 'tax_id' => $identificacion, 'email' => $email, 'phone' => $phone, 'address' => $address, 'seller' => $seller, 'phone_seller' => $phone_seller, 'skype_seller' => $skype_seller, 'email_seller' => $email_seller, 'person_payment' => $person_payment, 'email_payment ' => $email_payment, 'phone_payment   ' => $phone_payment, 'skype_payment   ' => $skype_payment, 'data_banking' => $banking, 'data_additional' => $additional, 'name_commercial' => $name_commercial];
        $id = $this->provider->create($data);
        if (isset($id)) {
            $this->provider->create_provider_products_array($id, $varieties);
        }

        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("provider/index", "location", 301);
    }

    function update_index($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_object = $this->provider->get_by_id($provider_id);
        $this->load->model('Product_model', 'product');
        $all_products = $this->product->get_all();
        $data['all_products'] = $all_products;


        if ($provider_object) {
            $data['provider_object'] = $provider_object;
            $data['products'] = $this->provider->get_all_products_by_provider_simple($provider_id);


            $this->load_view_admin_g('provider/update', $data);
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
        $identificacion = $this->input->post('identificacion');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $person_payment = $this->input->post('person_payment');
        $banking = $this->input->post('banking');
        $additional = $this->input->post('additional');
        $varieties = $this->input->post('varieties');
        $address = $this->input->post('address');
        $seller = $this->input->post('seller');
        $email_seller = $this->input->post('email_seller');
        $phone_seller = $this->input->post('phone_seller');
        $email_payment = $this->input->post('email_payment');
        $phone_payment = $this->input->post('phone_payment');
        $skype_seller = $this->input->post('skype_seller');
        $skype_payment = $this->input->post('skype_payment');
        $name_commercial = $this->input->post('nombre_comercial');

        $provider_id = $this->input->post('provider_id');

        $provider_object = $this->provider->get_by_id($provider_id);

        if ($provider_object) {

            $data = ['name' => $name, 'tax_id' => $identificacion, 'email' => $email, 'phone' => $phone, 'address' => $address, 'seller' => $seller, 'phone_seller' => $phone_seller, 'skype_seller' => $skype_seller, 'email_seller' => $email_seller, 'person_payment' => $person_payment, 'email_payment ' => $email_payment, 'phone_payment   ' => $phone_payment, 'skype_payment   ' => $skype_payment, 'data_banking' => $banking, 'data_additional' => $additional, 'name_commercial' => $name_commercial];

            $this->provider->update($provider_id, $data);
            $this->provider->create_provider_products_array($provider_id, $varieties);

            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("provider/index", "location", 301);
        }
    }
    public function delete($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_object = $this->provider->get_by_id($provider_id);
        if ($provider_object) {
            $this->provider->delete($provider_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("provider/index");
        } else {
            show_404();
        }
    }
}
