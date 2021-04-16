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
        $ip = $_SERVER['REMOTE_ADDR'];
        //$ip = '78.107.156.105';
        $dataSolicitud = null;
        try {
            $informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
            $dataSolicitud = json_decode($informacionSolicitud);
            $dataSolicitud = $dataSolicitud->geoplugin_countryCode;
        } catch (\Throwable $th) {
            $dataSolicitud = null;
        }
        $this->load->model('Farm_model', 'farm');
        $this->load->model('Product_model', 'product');
        $this->load->model('Box_model', 'box');
        $this->load->model('measure_model', 'measure');
        $this->load->model('Country_model', 'country');
        $this->load->model('Categoria_model', 'categoria');
        $this->load->model('User_model', 'user');
        $data['request_server'] = $dataSolicitud;
        $data['categories']  = $this->categoria->get_all(['is_active' => 1]);
        $data['clients'] = $this->user->get_all(['role_id' => 3, 'is_delete' => 0]);
        $data['farms'] = $this->farm->get_all_providers(['is_active' => 1]);;
        $data['boxs_type'] = $this->box->get_all(['is_active' => 1]);
        $data['measures'] = $this->measure->get_all(['is_active' => 1]);
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
        $farms = (object)($_POST['farms']);
        $markings = ($_POST['markings']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        $invoice_farm = 'invoice_farm' . uniqid();
        $date_create = date("Y-m-d H:i:s");

        foreach ($arrayRequest as $item) {
            $item->id = uniqid();
            $item->status = 0;
            foreach ($item->varieties as $v) {
                $v->id = uniqid();
            }
        }
        $data_invoice = [
            'invoice_farm' => $invoice_farm,
            'invoice_number' => $invoceNumber,
            'dispatch_day' => $dispatchDay,
            'awb' => $awb,
            'markings' => $markings,
            'farms' => $farms,
            'details' => $arrayRequest,
            'status' => 0,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create)
        ];
        $resquest =  $this->invoice_farm->create($data_invoice);
        if ($resquest) {
            $this->load->model('Farm_model', 'farm');
            $obj_farm = $this->farm->get_provider_by_id($farms->farm_id);
            if ($obj_farm) {
                if (isset($obj_farm->varieties)) {
                    $arrayTemp = $obj_farm->varieties;
                    $arrayProducts = [];
                    foreach ($arrayRequest as $rq) {
                        $encontro = false;
                        foreach ($obj_farm->varieties as $item) {
                            if ($item->product_id == $rq->products->product_id) {
                                $encontro = true;
                            }
                        }
                        if (!$encontro) {
                            $arrayTemp[] = $rq->products;
                        }
                    }
                    if (count($obj_farm->varieties) != count($arrayTemp)) {
                        $data = [
                            'varieties' => $arrayTemp,
                        ];
                        $this->farm->update_provider($farms->farm_id, $data);
                    }
                }
            }
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

    function update_invoice_farm_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $object = $this->invoice_farm->get_by_id($id);

        if ($object) {
            $this->load->model('Farm_model', 'farm');
            $this->load->model('Product_model', 'product');
            $this->load->model('Box_model', 'box');
            $this->load->model('measure_model', 'measure');
            $this->load->model('Country_model', 'country');
            $this->load->model('Categoria_model', 'categoria');
            $this->load->model('User_model', 'user');
            $data['categories']  = $this->categoria->get_all(['is_active' => 1]);
            $data['clients'] = $this->user->get_all(['role_id' => 3, 'is_delete' => 0]);
            $data['farms'] = $this->farm->get_all_providers(['is_active' => 1]);;
            $data['boxs_type'] = $this->box->get_all(['is_active' => 1]);
            $data['measures'] = $this->measure->get_all(['is_active' => 1]);
            $data['object'] = $object;
            $this->load_view_admin_g('invoice_farm/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $invoice_id = $this->input->post('invoiceId');
        $awb = trim(($this->input->post('awb')));
        $invoceNumber = trim(($this->input->post('invoceNumber')));
        $dispatchDay = trim(($this->input->post('dispatchDay')));
        $farms = (object)($_POST['farms']);
        $markings = ($_POST['markings']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        $object = $this->invoice_farm->get_by_id($invoice_id);
        foreach ($arrayRequest as $item) {
            if (isset($item->id)) {
                foreach ($item->varieties as $v) {
                    if (!isset($v->id)) {
                        $v->id = uniqid();
                        $v->new = true;
                        $v->date_create = date('Y-m-d)');
                    }
                }
            } else {
                $item->id = uniqid();
                $item->new = true;
                $item->status = 0;
                $item->date_create = date('Y-m-d)');
                foreach ($item->varieties as $v) {
                    $v->id = uniqid();
                    $v->new = true;
                    $v->date_create = date('Y-m-d)');
                }
            }
        }
        $data_invoice = [
            'invoice_number' => $invoceNumber,
            'dispatch_day' => $dispatchDay,
            'awb' => $awb,
            'markings' => $markings,
            'farms' => $farms,
            'details' => $arrayRequest,
        ];
        $result =  $this->arraysDift($object->details, $arrayRequest);
        $resquest =  $this->invoice_farm->update($invoice_id, $data_invoice);
        if ($resquest) {
            $this->load->model('Farm_model', 'farm');
            $obj_farm = $this->farm->get_provider_by_id($farms->farm_id);
            if ($obj_farm) {
                if (isset($obj_farm->varieties)) {
                    $arrayTemp = $obj_farm->varieties;
                    foreach ($arrayRequest as $rq) {
                        $encontro = false;
                        foreach ($obj_farm->varieties as $item) {
                            if ($item->product_id == $rq->products->product_id) {
                                $encontro = true;
                            }
                        }
                        if (!$encontro) {
                            $arrayTemp[] = $rq->products;
                        }
                    }
                    if (count($obj_farm->varieties) != count($arrayTemp)) {
                        $data = [
                            'varieties' => $arrayTemp,
                        ];
                        $this->farm->update_provider($farms->farm_id, $data);
                    }
                }
            }
            if ($object) {
                $dataChange = ['changes' => $result];
                $this->invoice_farm->create_change_invoice_farm($invoice_id, $dataChange);
                if (count($result->arrayBoxsDelete) > 0) {
                    foreach ($result->arrayBoxsDelete as $item) {
                        if ($item->status == 1) {
                            $response = $this->invoice_farm->get_box_by_invoice_farm($item->id, $invoice_id);
                            if ($response) {
                                $this->invoice_farm->delete_box_id($response->invoice, $response->detail_id, $response->id);
                                $detail = $this->invoice_farn->get_detail_invoice_client_by_id($response->invoice, $response->detail_id);
                                if (count($detail->boxs) == 0) {
                                    $this->invoice_farm->delete_detail_invoice_cliente_by_id($response->invoice, $response->detail_id);
                                }
                                $dataDelete = [
                                    'date_create' => date('Y-m-d'),
                                    'timestamp' => (int) strtotime(date('Y-m-d')),
                                    'delete' => $item,
                                    'farm' => $farms
                                ];
                                $this->invoice_farm->create_change_invoice_client($response->invoice, $dataDelete);
                            }
                        }
                    }
                }
                if (count($result->arrayBoxsEdit) > 0) {
                    foreach ($result->arrayBoxsEdit as $item) {
                        if ($item->change && $item->edit->status == 1) {
                            $response = $this->invoice_farm->get_box_by_invoice_farm($item->boxId, $invoice_id);
                            if ($response) {
                                $this->invoice_farm->update_detail_box($response->invoice, $response->detail_id, $response->id, $item->edit);
                                $dataEdit = [
                                    'date_create' => date('Y-m-d'),
                                    'timestamp' => (int) strtotime(date('Y-m-d')),
                                    'edit' => $item,
                                    'farm' => $farms
                                ];
                                $this->invoice_farm->create_change_invoice_client($response->invoice, $dataEdit);
                            }
                        }
                    }
                }
            }
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
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

    public function search_number_invoice()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $invoiceNumber = $this->input->post('invoiceNumber');
        $invoice =  $this->invoice_farm->get_by_number_invoice($invoiceNumber);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'invoice' => $invoice]);
        exit();
    }
    public function index_wait()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_invoice_farm = $this->invoice_farm->get_all(['status' => 0]);
        $data['all_invoice_farm'] = $all_invoice_farm;
        $this->load_view_admin_g("invoice_farm/index_wait", $data);
    }
    public function add_invoice_client()
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
        $marking = ($_POST['marking']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        foreach ($arrayRequest as $item) {
            $item->id = uniqid('detail-');
        }
        $invoice = 'invoice_' . uniqid();
        $date_create = date("Y-m-d H:i:s");
        $data_invoice = [
            'invoice' => $invoice,
            'awb' => $awb,
            'marking' => $marking,
            'details' => $arrayRequest,
            'status' => 0,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create)
        ];
        $resquest =  $this->invoice_farm->create_invoice_client($data_invoice);
        if ($resquest) {
            foreach ($arrayRequest as $item) {
                foreach ($item->boxs as $box) {
                    $this->invoice_farm->update_invoice_farm_details($box->id, ['status' => 1]);
                    $response =   $this->invoice_farm->get_all_details_status($box->id, 0);
                    if (!$response) {
                        $this->invoice_farm->update_invoice_farm($box->id, ['status' => 1]);
                    }
                }
            }
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function example()
    {
        $q =   $this->invoice_farm->get_detail_invoice_client_by_id('invoice_606e2f57bbb4a', '606e2f57bbb44');
        var_dump($q);
        die();
    }

    public function index_invoice_client()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_invoice = $this->invoice_farm->get_all_invoice_client(['status' => $this->mongo_db->ne(-1)]);
        $data['all_invoice'] = $all_invoice;
        $this->load_view_admin_g("invoice_farm/index_invoice_client", $data);
    }

    public function search_invoice_by_awb()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $awb = $this->input->post('searchAwb');

        $resquest =  $this->invoice_farm->get_all_invoice_client(['awb' => $awb, 'status' => $this->mongo_db->ne(-1)], true);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $resquest]);
        exit();
    }
    public function update_invoice_client()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        $invoice = $this->input->post('invoice');
        $data_invoice = [
            'details' => $arrayRequest,
        ];
        $resquest =  $this->invoice_farm->update_invoice_client($invoice, $data_invoice);
        if ($resquest) {
            foreach ($arrayRequest as $item) {
                foreach ($item->boxs as $box) {
                    $this->invoice_farm->update_invoice_farm_details($box->id, ['status' => 1]);
                    $response =   $this->invoice_farm->get_all_details_status($box->id, 0);
                    if (!$response) {
                        $this->invoice_farm->update_invoice_farm($box->id, ['status' => 1]);
                    }
                }
            }
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }

    public function updateStatusAndId()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_invoice_farm = $this->invoice_farm->get_all();

        foreach ($all_invoice_farm as $item) {
            foreach ($item->details as $box) {
                $box->id = uniqid();
                var_dump(uniqid());
                // $box->status = 0;
            }

            //   $result = $this->invoice_farm->update($item->invoice_farm, ['details' => $item->details]);
            //   var_dump($result);
        }
        die();
    }
    function cancel_invoice_client($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $invoice = $this->invoice_farm->get_by_id_invoice_client($id);

        if ($invoice) {
            foreach ($invoice->details as $item) {
                foreach ($item->boxs as $box) {
                    $this->invoice_farm->update_invoice_farm_details($box->id, ['status' => 0]);
                    $this->invoice_farm->update_invoice_farm($box->id, ['status' => 0]);
                }
            }
            $this->invoice_farm->update_invoice_client($id, ['status' => -1]);
            redirect("invoice_farm/index_invoice_client");
        } else {
            show_404();
        }
    }
    function arraysDift($arrayOLd, $arrayEdit)
    {
        $arrayBoxsDelete = [];
        $arrayBoxsNew = [];
        $arrayBoxsEdit = [];
        foreach ($arrayOLd as $a) {
            $v = false;
            foreach ($arrayEdit as $b) {
                if (isset($b->new)) {
                    unset($b->new);
                    $arrayBoxsNew[] = $b;
                } else {
                    $obj = (object)['boxId' => $a->id, 'edit' => $b];
                    if ($a->id == $b->id) {
                        $changeBox = false;
                        $change = false;
                        $v = true;
                        if ($a->typeBoxs->box_id != $b->typeBoxs->box_id) {
                            $obj->typeBoxs = [$a->typeBoxs, $b->typeBoxs];
                            $changeBox = true;
                            $change = true;
                        }
                        if ($a->boxNumber != $b->boxNumber) {
                            $obj->boxNumber = [$a->boxNumber, $b->boxNumber];
                            $changeBox = true;
                            $change = true;
                        }
                        $obj->changeBox = $changeBox;
                        $e = false;
                        $obj->varietiesDelete = [];
                        $obj->varietiesEdit = [];
                        $obj->varietiesNew = [];
                        foreach ($a->varieties as $c) {
                            foreach ($b->varieties as $d) {
                                if (isset($d->new)) {
                                    unset($d->new);
                                    $obj->varietiesNew[] = $d;
                                    $change = true;
                                } else {
                                    if ($c->id == $d->id) {
                                        $objV = (object)['id' => $c->id];
                                        $e = true;
                                        $changeVariety = false;
                                        if ($c->products->product_id != $d->products->product_id) {
                                            $objV->products = [$c->products, $d->products];
                                            $changeVariety = true;
                                            $change = true;
                                        }
                                        if ($c->measures->measure_id != $d->measures->measure_id) {
                                            $objV->measures = [$c->measures, $d->measures];
                                            $changeVariety = true;
                                            $change = true;
                                        }
                                        if ($c->price != $d->price) {
                                            $objV->price = [$c->price, $d->price];
                                            $changeVariety = true;
                                            $change = true;
                                        }
                                        if ($c->bunches != $d->bunches) {
                                            $objV->bunches = [$c->bunches, $d->bunches];
                                            $changeVariety = true;
                                            $change = true;
                                        }
                                        if ($c->stems != $d->stems) {
                                            $objV->stems = [$c->stems, $d->stems];
                                            $changeVariety = true;
                                            $change = true;
                                        }
                                        if ($changeVariety) {
                                            $objV->changeVariety = $changeVariety;
                                            $obj->varietiesEdit[] = $objV;
                                        }
                                    }
                                }
                            }
                            if (!$e) {
                                $obj->varietiesDelete[] = $a;
                            }
                        }
                        if ($change) {
                            $obj->change = $change;
                            $arrayBoxsEdit[] = $obj;
                        }
                    }
                }
            }
            if (!$v) {
                $arrayBoxsDelete[] = $a;
            }
        }
        return (object)['arrayBoxsDelete' => $arrayBoxsDelete, 'arrayBoxsNew' => $arrayBoxsNew, 'arrayBoxsEdit' => $arrayBoxsEdit];
    }

    public function delete_items_invoice_client()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        $invoice = $this->input->post('invoice');
        foreach ($arrayRequest as $item) {
            $response =   $this->invoice_farm->delete_box_id($invoice, $item->detailId, $item->id);
            if ($response) {
                $this->invoice_farm->update_invoice_farm($item->id, ['status' => 0]);
            }
        }

        echo json_encode(['status' => 200, 'msj' => 'correcto']);
        exit();
    }
}
