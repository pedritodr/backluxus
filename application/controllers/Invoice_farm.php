<?php

class Invoice_farm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Invoice_farm_model', 'invoice_farm');
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

        $all_invoice_farm = $this->invoice_farm->get_all();
        $data['all_invoice_farm'] = $all_invoice_farm;
        $this->load_view_admin_g("invoice_farm/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Farm_model', 'farm');
        $this->load->model('Product_model', 'product');
        $this->load->model('Box_model', 'box');
        $this->load->model('measure_model', 'measure');
        $this->load->model('Country_model', 'country');
        $this->load->model('Categoria_model', 'categoria');
        $data['categories']  = $this->categoria->get_all(['is_active' => 1]);
        //  $data['products'] = $this->product->get_all(['is_active' => 1]);
        $data['farms'] = $this->farm->get_all_farms();
        $data['boxs_type'] = $this->box->get_all(['is_active' => 1]);
        $data['measures'] = $this->measure->get_all(['is_active' => 1]);
      //  $data['countrys'] = $this->country->get_all(['is_active' => 1]);
        $this->load_view_admin_g('invoice_farm/add', $data);
    }

    public function add()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $awb = trim(($this->input->post('awb')));
        $invoceNumber = trim(($this->input->post('invoceNumber')));
        $dispatchDay = trim(($this->input->post('dispatchDay')));
        $farms = ($_POST['farms']);
        $markings = ($_POST['markings']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        $invoice_farm = 'invoice_farm' . uniqid();
        $date_create = date("Y-m-d H:i:s");
        $data_invoice = [
            'invoice_farm' => $invoice_farm,
            'invoice_number' => $invoceNumber,
            'dispatch_day' => $dispatchDay,
            'awb' => $awb,
            'markings' => $markings,
            'farms' => $farms,
            'details' => $arrayRequest,
            'status' => 0,
            'date_create'=>$date_create
        ];
        $resquest =  $this->invoice_farm->create($data_invoice);
        if ($resquest) {
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }

    public function search_products()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Product_model', 'product');
        $categorie = $this->input->post('categorie');
        $products =  $this->product->get_all(['categoria.category_id' => $categorie]);
        if ($products) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'products' => $products]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'No se encuentran variedades asociadas a esta categoria']);
            exit();
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $bouquet_object = $this->invoice_farm->get_by_id($id);

        if ($bouquet_object) {
            $data['bouquet_object'] = $bouquet_object;
            $this->load_view_admin_g('invoice_farm/update', $data);
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
        $name = (int) $this->input->post('name');
        $bouquet_id = $this->input->post('bouquet_id');
        $this->form_validation->set_rules('name', "Número", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("invoice_farm/update_index/" . $bouquet_id);
        } else {
            $data = ['number' => $name];
            $row =  $this->invoice_farm->update($bouquet_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("invoice_farm/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $bouquet_object = $this->invoice_farm->get_by_id($id);

        if ($bouquet_object) {
            $this->invoice_farm->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("invoice_farm/index");
        } else {
            show_404();
        }
    }
}
