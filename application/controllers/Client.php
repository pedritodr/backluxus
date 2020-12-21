<?php

class Client extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('client_model', 'client');
        $this->load->model('Dialing_model', 'dialing');
        $this->load->model('Variety_model', 'variety');

        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_clients = $this->client->get_all_clientes();

        $data['all_clients'] = $all_clients;


        $this->load_view_admin_g("client/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Country_model', 'country');
        $all_countrys = $this->country->get_all();
        $data['all_countrys'] = $all_countrys;
        $this->load_view_admin_g('client/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('User_model', 'user');

        $name = $this->input->post('name');
        $identificador = $this->input->post('identificador');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $email_pago = $this->input->post('email_pago');
        $person_pago = $this->input->post('person_pago');
        $person_contact = $this->input->post('person_contact');
        $email_contact = $this->input->post('email_contact');
        $phone = $this->input->post('phone');
        $skype_contact = $this->input->post('skype_contact');
        $skype_person = $this->input->post('skype_person');
        $phone_contact = $this->input->post('phone_contact');
        $phone_person = $this->input->post('phone_person');
        $additional = $this->input->post('additional');
        $pais = $this->input->post('pais');




        $repeat_password = $this->input->post('repeat_password');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('fullname_lang'), 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required|is_unique[user.email]');
        $this->form_validation->set_rules('password', translate('password_lang'), 'required|matches[repeat_password]');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("client/add_index");
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $w = 253;
            $h = 300;

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/cliente', time(), $w, $h);

                if ($result[0]) {
                    $data_user = [
                        'name' => $name,
                        'email' => $email,
                        'password' => md5($password),
                        'role_id' => 3
                    ];
                    $user_id = $this->user->create($data_user);
                    $data_cliente = [
                        'cliente_name' => $name,
                        'tax_id' => $identificador,
                        'user_id' => $user_id,
                        'address' => $address,
                        'phone' => $phone,
                        'paid_person' => $person_pago,
                        'paid_email' => $email_pago,
                        'contact_person' => $person_contact,
                        'contact_email' => $email_contact,
                        'logo' => $result[1],
                        'user_vendedor_id' => $this->session->userdata('user_id'),
                        'country_id' => $pais,
                        'additional' => $additional,
                        'skype_person' => $skype_person,
                        'skype_contact' => $skype_contact,
                        'phone_person' => $phone_person,
                        'phone_contact' => $phone_contact

                    ];
                    $this->client->create($data_cliente);


                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("client/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("client/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("client/add_index", "location", 301);
            }
        }
    }

    function update_index($client_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $client_object = $this->client->get_by_id($client_id);
        $this->load->model('Country_model', 'country');
        $all_countrys = $this->country->get_all();
        $data['all_countrys'] = $all_countrys;
        if ($client_object) {
            $data['client_object'] = $client_object;
            $this->load_view_admin_g('client/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('User_model', 'user');


        $name = $this->input->post('name');
        $identificador = $this->input->post('identificador');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $email_pago = $this->input->post('email_pago');
        $person_pago = $this->input->post('person_pago');
        $person_contact = $this->input->post('person_contact');
        $email_contact = $this->input->post('email_contact');
        $phone = $this->input->post('phone');
        $skype_contact = $this->input->post('skype_contact');
        $skype_person = $this->input->post('skype_person');
        $phone_contact = $this->input->post('phone_contact');
        $phone_person = $this->input->post('phone_person');
        $additional = $this->input->post('additional');
        $pais = $this->input->post('pais');
        $client_id = $this->input->post('cliente_id');
        $client_object = $this->client->get_by_id($client_id);

        $this->form_validation->set_rules('name', translate('fullname_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("client/update_index/" . $client_id);
        } else {
            if ($client_object) {

                //en caso de que todo este bien
                $name_file = $_FILES['archivo']['name'];

                $separado = explode('.', $name_file);
                $ext = end($separado); // me quedo con la extension
                $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                $allow_extension = in_array($ext, $allow_extension_array);
                if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                    if ($_FILES['archivo']['error'] == 4) {
                        $data_cliente = [
                            'cliente_name' => $name,
                            'tax_id' => $identificador,
                            'address' => $address,
                            'phone' => $phone,
                            'paid_person' => $person_pago,
                            'paid_email' => $email_pago,
                            'contact_person' => $person_contact,
                            'contact_email' => $email_contact,
                            'country_id' => $pais,
                            'additional' => $additional,
                            'skype_person' => $skype_person,
                            'skype_contact' => $skype_contact,
                            'phone_person' => $phone_person,
                            'phone_contact' => $phone_contact



                        ];
                        $this->client->update($client_id, $data_cliente);


                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("client/index", "location", 301);
                    } else {

                        $result = save_image_from_post('archivo', './uploads/cliente', time(), 253, 300);
                        if ($result[0]) {
                            if (file_exists($client_object->logo))
                                unlink($client_object->logo);
                            $data_cliente = [
                                'cliente_name' => $name,
                                'tax_id' => $identificador,
                                'address' => $address,
                                'phone' => $phone,
                                'paid_person' => $person_pago,
                                'paid_email' => $email_pago,
                                'contact_person' => $person_contact,
                                'contact_email' => $email_contact,
                                'logo' => $result[1],
                                'country_id' => $pais,
                                'additional' => $additional,
                                'skype_person' => $skype_person,
                                'skype_contact' => $skype_contact,
                                'phone_person' => $phone_person,
                                'phone_contact' => $phone_contact


                            ];
                            $this->client->update($client_id, $data_cliente);

                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("client/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("client/add_index", "location", 301);
                        }
                    }
                } else {
                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("client/update_index/" . $client_id, "location", 301);
                }
            } else {
                show_404();
            }
        } //cierra la validacion
    }
    public  function listar_destination($client_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $destinations = $this->client->get_all_clientes_by_destinations($client_id);

        $data['destinations'] = $destinations;
        $data['client_id'] = $client_id;

        $this->load_view_admin_g("client/destination_index", $data);
    }

    public function add_destination_index($client_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Country_model', 'country');
        $client_object = $this->client->get_by_id($client_id);
        $all_destinations = $this->country->gell_citys_by_country($client_object->country_id);

        $data['all_destinations'] = $all_destinations;

        $data['client_id'] = $client_id;


        $this->load_view_admin_g('client/add_destination', $data);
    }

    public function get_destinations()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }


        $country_id = $this->input->post('id');

        $this->load->model('Country_model', 'country');
        $destination_object = $this->country->gell_citys_by_country($country_id);
        echo json_encode($destination_object);
        exit();
    }

    public function add_marcacion()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $nombre = $this->input->post('nombre');
        $destination_id = $this->input->post('destination');
        $cliente_id = $this->input->post('client_id');



        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('destination', "Seleccione un destino", 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("client/add_destination/", "location", 301);
        } else {
            $data = ['name' => $nombre, 'destination_id' => $destination_id, 'cliente_id' => $cliente_id];
            $this->dialing->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("client/listar_destination/" . $cliente_id, "location", 301);
        }
    }

    function update_marcacion_index($dailing_id = 0, $cliente_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Destination_model', 'destination');
        $this->load->model('Country_model', 'country');

        $dialing_object = $this->dialing->get_by_id($dailing_id);

        $client_object = $this->client->get_by_id($cliente_id);
        $all_destinations = $this->country->gell_citys_by_country($client_object->country_id);

        if ($dialing_object) {
            $data['cliente_id'] = $cliente_id;
            $data['dialing_object'] = $dialing_object;
            $data['all_destinations'] = $all_destinations;


            $this->load_view_admin_g('client/update_marcacion', $data);
        } else {
            show_404();
        }
    }
    public function update_marcacion()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }


        $nombre = $this->input->post('nombre');
        $destination_id = $this->input->post('destination');
        $dialing_id = $this->input->post('dialing_id');
        $cliente_id = $this->input->post('cliente_id');


        $dialing_object = $this->dialing->get_by_id($dialing_id);
        if ($dialing_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
            $this->form_validation->set_rules('destination', "Seleccione un destino", 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("client/update_marcacion_index/", "location", 301);
            } else {
                $data = ['name' => $nombre, 'destination_id' => $destination_id];
                $this->dialing->update($dialing_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("client/listar_destination/" . $cliente_id, "location", 301);
            }
        }
    }

    public function delete_marcacion($dailing_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $dialing_object = $this->dialing->get_by_id($dailing_id);
        if ($dialing_object) {
            $this->dialing->delete($dailing_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("client/listar_destination/", "location", 301);
        } else {
            show_404();
        }
    }

    public function delete($client_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('User_model', 'user');

        $client_object = $this->client->get_by_id($client_id);
        if ($client_object) {
            $this->user->delete($client_object->user_id);
            $this->client->delete($client_id);
            $this->dialing->delete_cliente($client_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("client/index");
        } else {
            show_404();
        }
    }
    public function pedido_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Destination_model', 'destination');
        $this->load->model('Type_box_model', 'type_box');
        $this->load->model('Product_category_model', 'product_category');
        $this->load->model('Carguera_model', 'carguera');
        $id = $this->input->post('category');

        $all_cargueras = $this->carguera->get_all();
        $all_type_box = $this->type_box->get_all();
        $all_clientes = $this->cliente->get_all();
        $all_destinations = $this->destination->get_all();

        $all_product_category = $this->product_category->get_all();

        $data['all_cargueras'] = $all_cargueras;
        $data['all_product_category'] = $all_product_category;
        $data['all_type_box'] = $all_type_box;
        $data['all_destinations'] = $all_destinations;
        $data['all_clientes'] = $all_clientes;

        if ($id == NULL) {

            $all_products = $this->product->get_all_products();
            /* foreach ($all_products as $product) {
                $product->measure = $this->variety->get_by_variety_id($product->product_id);
            }*/
            $data['all_products'] = $all_products;
        } else {
            $all_products = $this->product->get_all_products_by_id($id);
            foreach ($all_products as $product) {
                $product->varieties = $this->variety->get_by_variety_id($product->product_id);
            }

            if ($all_products) {
                $data['all_products'] = $all_products;
            } else {

                $this->response->set_message("No se encontraron productos", ResponseMessage::ERROR);
                redirect("client/pedido_index");
            }
        }



        $this->load_view_admin_g("client/resquest", $data);
    }
    public function get_marcacion()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');

        $all_dialing = $this->dialing->get_marcacion_by_user($id);

        echo json_encode($all_dialing);
        exit();
    }

    public function get_variety_by_product()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');
        $this->load->model('Product_model', 'product');

        $all_varieties = $this->product->get_by_measure_id($id);


        echo json_encode($all_varieties);
        exit();
    }
    public function get_variety_by_id()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');
        $this->load->model('Variety_model', 'variety');

        $all_varieties = $this->variety->get_by_id($id);

        echo json_encode($all_varieties);
        exit();
    }

    public function get_destination_by_id()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');
        $this->load->model('Dialing_model', 'dialing');

        $all_dialing = $this->dialing->get_marcacion_by_id($id);

        echo json_encode($all_dialing);
        exit();
    }

    public function add_request()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_model', 'request');
        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');



        $purchase = $this->input->post('purchase');
        $date_purchase = $this->input->post('date_purchase');
        $date_reception = $this->input->post('date_reception');
        $data = [];
        $data = json_decode($_POST['array']);
        $cliente_id = $data[0]->cliente_id;
        //var_dump($data, $purchase, $date_delivery, $date_reception, $cliente_id);

        $data_request = [
            'date_time_reception' => $date_reception,
            'date_purchase' => $date_purchase,
            'purchase_order' => $purchase,
            'cliente_id' => $cliente_id


        ];
        $request_id = $this->request->create($data_request);
        //  $request_id = $this->request->create($data_request);



        for ($i = 0; $i < sizeof($data); $i++) {
            $product_measure_id =  $data[$i]->variety_measure_id;
            $dialing_id = $data[$i]->dialing_id;
            $qty_bunches = $data[$i]->qty_bunches;
            $unit_price = $data[$i]->precio;
            $tolal_price = $data[$i]->subtotal;
            $box_type_id = $data[$i]->tipo_id;
            $total_steams = $data[$i]->total_bunches;

            $qty = $data[$i]->cantidad;
            if ($request_id) {
                $data_request_product = [
                    'request_id' => $request_id,
                    'product_measure_id' => $product_measure_id,
                    'dialing_id' => $dialing_id,
                    'qty_bunches' => $qty_bunches,
                    'unit_price' => $unit_price,
                    'total_price' => $tolal_price,
                    'total_steams' => $total_steams
                ];
                $request_product_id = $this->request_product->create($data_request_product);
                if ($request_product_id) {
                    $data_request_product_box = [
                        'request_product_id' => $request_product_id,
                        'qty' => $qty,
                        'box_type_id' => $box_type_id
                    ];
                    $this->request_product_box->create($data_request_product_box);
                }
            }
        }
        $this->response->set_message("pedido creado correctamente", ResponseMessage::SUCCESS);

        echo json_encode($request_product_id);
        exit();
    }
}
