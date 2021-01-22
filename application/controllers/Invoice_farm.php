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

        $all_invoice_farm = $this->invoice_farm->get_all(['is_active' => 1]);
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
        $data['products'] = $this->product->get_all(['is_active' => 1]);
        $data['farms'] = $this->farm->get_all_farms();
        $data['boxs_type'] = $this->box->get_all(['is_active' => 1]);
        $data['measures'] = $this->measure->get_all(['is_active' => 1]);
        $data['countrys'] = $this->country->get_all(['is_active' => 1]);
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

        $date = trim(($this->input->post('date')));
        $to = trim(($this->input->post('to')));
        $address = trim(($this->input->post('address')));
        $customer = trim(($this->input->post('customer')));
        $airline = trim(($this->input->post('airline')));
        $shippementDate = trim(($this->input->post('shippementDate')));
        $awb = trim(($this->input->post('awb')));
        $hawb = trim(($this->input->post('hawb')));
        $freighForward = trim(($this->input->post('freighForward')));
        $packingList = trim(($this->input->post('packingList')));
        $dae = trim(($this->input->post('dae')));
        $farms = ($_POST['farms']);
        if(isset($farms->personal)){
            unset($farms->personal);
        }
        $country = ($_POST['country']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        $invoice_farm = 'invoice_farm' . uniqid();
        $data_invoice = [
            'invoice_farm' => $invoice_farm,
            'date' => $date,
            'to' => $to,
            'address' => $address,
            'customer' => $customer,
            'airline' => $airline,
            'shippement_date' => $shippementDate,
            'awb' => $awb,
            'hawb' => $hawb,
            'freigh_forward' => $freighForward,
            'packing_list' => $packingList,
            'dae' => $dae,
            'farms' => $farms,
            'country' => $country,
            'details' => $arrayRequest,
            'status' => 0,
        ];
      $resquest=  $this->invoice_farm->create($data_invoice);
      if($resquest){
        echo json_encode(['status' => 200, 'msj' => 'correcto']);
        exit();
      }else{
        echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
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
