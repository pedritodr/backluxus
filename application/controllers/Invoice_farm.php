<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $data['farms'] = $this->farm->get_all_providers(['is_active' => 1]);
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
        $this->load->model('User_model', 'user');
        $awb = trim(($this->input->post('awb')));
        $marking = ($_POST['marking']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        foreach ($arrayRequest as $item) {
            $item->id = uniqid('detail-');
        }
        $invoice = 'invoice_' . uniqid();
        $date_create = date("Y-m-d H:i:s");
        $objUser = $this->user->get_min_client_by_marking_id($marking['marking_id']);
        $numberSecuencial = 0;
        if (isset($objUser->secuencial)) {
            if ($objUser->secuencial > 0) {
                $numberSecuencial = (int)$objUser->secuencial + 1;
            } else {
                $numberSecuencial =  1;
            }
        } else {
            $numberSecuencial = 1;
        }

        $data_invoice = [
            'invoice' => $invoice,
            'awb' => $awb,
            'marking' => $marking,
            'details' => $arrayRequest,
            'status' => 0,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create),
            'number_invoice' => $numberSecuencial
        ];
        $resquest =  $this->invoice_farm->create_invoice_client($data_invoice);
        if ($resquest) {
            $this->user->update($objUser->user_id, ['secuencial' => $numberSecuencial]);
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
        $awb = (int)$this->input->post('searchAwb');

        $resquest =  $this->invoice_farm->get_all_invoice_client(['awb' => $awb, 'status' => $this->mongo_db->ne(-1)], true);
        if ($resquest) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $resquest]);
        } else {
            $resquest =  $this->invoice_farm->get_all_invoice_client(['number_invoice' => $awb, 'status' => $this->mongo_db->ne(-1)], true);
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $resquest]);
        }
        exit();
    }
    public function search_invoice_by_awb_id()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $awb = (int)$this->input->post('searchAwb');

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
        $invoiceActual = $this->invoice_farm->get_by_id_invoice_client($invoice);
        $dataChange = ['change' => [$invoiceActual->details, $arrayRequest], 'date_create' => date('Y-m-d')];
        foreach ($arrayRequest as $item) {
            $response =   $this->invoice_farm->delete_box_id($invoice, $item->detailId, $item->id);
            if ($response) {
                $this->invoice_farm->update_invoice_farm_details($item->id, ['status' => 0]);
                $this->invoice_farm->update_invoice_farm($item->id, ['status' => 0]);
            }
        }
        $this->invoice_farm->create_change_invoice_client($invoice, $dataChange);
        $invoice = $this->invoice_farm->get_by_id_invoice_client($invoice);

        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $invoice->details]);
        exit();
    }
    public function search_user_by_marking()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('User_model', 'user');
        $marking = $this->input->post('marking');
        $objUser = $this->user->get_min_client_by_marking_id($marking);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $objUser]);
        exit();
    }
    public function update_awb()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $invoice = $this->input->post('invoice');
        $awb = $this->input->post('awb');
        $resquest =  $this->invoice_farm->get_all_invoice_client(['awb' => $awb, 'status' => $this->mongo_db->ne(-1)], true);
        if ($resquest) {
            echo json_encode(['status' => 404, 'msj' => 'correcto', 'data' => $resquest]);
        } else {
            $this->invoice_farm->update_invoice_client($invoice, ['awb' => $awb]);
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
        }
        exit();
    }
    public function viewed_check()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $id = $this->input->post('id');
        $response = $this->invoice_farm->update($id, ['viewed' => true]);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $response]);
        exit();
    }

    public function search_invoice_by_marking()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $id = $this->input->post('id');
        $response = $this->invoice_farm->get_min_invoices_by_marking($id);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $response]);
        exit();
    }


    public function export_invoice($invoiceId)
    {
        $object = $this->invoice_farm->get_by_id_invoice_client($invoiceId);

        if ($object) {
            $arrClavel = [];
            $arrRose = [];
            $arrOtros = [];
            $arrCategory = [];
            foreach ($object->details as $item) {
                $arrBoxClavel = [];
                $arrBoxRose = [];
                $arrBoxOtros = [];
                if (count($item->boxs) > 0) {
                    foreach ($item->boxs as $box) {
                        if (count($arrCategory) == 0) {
                            $objTemp = ['category' => $box->varieties[0]->products->categoria, 'arr' => [$box]];
                            $arrCategory[] = $objTemp;
                        } else {
                            $encontroCat = false;
                            for ($i = 0; $i < count($arrCategory); $i++) {
                                if ($arrCategory[$i]['category']->category_id == $box->varieties[0]->products->categoria->category_id) {
                                    $arrTemp = $arrCategory[$i]['arr'];
                                    $arrTemp[] = $box;
                                    $arrCategory[$i]['arr'] = $arrTemp;
                                    $encontroCat = true;
                                }
                            }

                            if (!$encontroCat) {
                                $objTemp = ['category' => $box->varieties[0]->products->categoria, 'arr' => [$box]];
                                $arrCategory[] = $objTemp;
                            }
                        }
                        if ($box->varieties[0]->products->categoria->category_id == 'category_5fea02c2aff96') {
                            //rose
                            $arrBoxRose[] = $box;
                        } else if ($box->varieties[0]->products->categoria->category_id == 'category_5ffa111033da5') {
                            //clavel
                            $arrBoxClavel[] = $box;
                        } else {
                            //otros
                            $arrBoxOtros[] = $box;
                        }
                    }
                }
                if (count($arrBoxRose) > 0) {
                    $arrR = ['farm' => $item->farm, 'boxs' => $arrBoxRose];
                    $arrRose[] = $arrR;
                }
                if (count($arrBoxClavel) > 0) {
                    $arrC = ['farm' => $item->farm, 'boxs' => $arrBoxClavel];
                    $arrClavel[] = $arrC;
                }
                if (count($arrBoxOtros) > 0) {
                    $arrO = ['farm' => $item->farm, 'boxs' => $arrBoxOtros];
                    $arrOtros[] = $arrO;
                }
            }
            $tempLuxus = null;
            if (count($arrRose) > 1) {
                for ($i = 0; $i < count($arrRose); $i++) {
                    if ($arrRose[$i]['farm']->farm_id == 'farm_60256e217cb10') {
                        $tempLuxus = $arrRose[$i];
                        unset($arrRose[$i]);
                    }
                }
                array_unshift($arrRose, $tempLuxus);
                $tempLuxus = null;
            }
            if (count($arrClavel) > 1) {
                for ($i = 0; $i < count($arrClavel); $i++) {
                    if ($arrClavel[$i]['farm']->farm_id == 'farm_60256e217cb10') {
                        $tempLuxus = $arrClavel[$i];
                        unset($arrClavel[$i]);
                    }
                }
                array_unshift($arrClavel, $tempLuxus);
                $tempLuxus = null;
            }
            if (count($arrOtros) > 1) {
                for ($i = 0; $i < count($arrOtros); $i++) {
                    if ($arrOtros[$i]['farm']->farm_id == 'farm_60256e217cb10') {
                        $tempLuxus = $arrOtros[$i];
                        unset($arrOtros[$i]);
                    }
                }
                array_unshift($arrOtros, $tempLuxus);
            }
            $tempLuxusCat = null;
            if (count($arrCategory) > 1) {
                for ($i = 0; $i < count($arrCategory); $i++) {
                    if ($arrCategory[$i]['category']->category_id == 'farm_60256e217cb10') {
                        $tempLuxusCat = $arrCategory[$i];
                        unset($arrCategory[$i]);
                    }
                }
                array_unshift($arrCategory, $tempLuxusCat);
            }
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle("Información");
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        /*   'color' => ['argb' => '00ffff'], */
                    ],
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];
            foreach (range('A', 'E') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            $sheet->setCellValueByColumnAndRow(1, 1, "LUXUS BLUMEN");

            $sheet->getStyle('A1')->getFont()->setSize(20);
            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle("A1:E1")->getAlignment()->setWrapText(true);
            $sheet->getRowDimension('1')->setRowHeight(40);
            $sheet->getStyle('A1:E1')->applyFromArray($styleArray);
            $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A1:E1')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 2, "Factura");
            $sheet->setCellValueByColumnAndRow(3, 2, $object->number_invoice);
            $sheet->setCellValueByColumnAndRow(5, 2, "IN");
            $sheet->getStyle('A2')->getFont()->setSize(16);
            $sheet->getStyle('C2:E2')->getFont()->setSize(10);
            $sheet->getStyle('A2:E2')->getFont()->setBold(true);
            $sheet->getRowDimension('2')->setRowHeight(20);
            $sheet->getStyle("A2")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A2:E2')->applyFromArray($styleArray);
            $sheet->getStyle('A2:E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A2:E2')->getFill()->getStartColor()->setARGB('efefef');

            $sheet->getRowDimension('3')->setRowHeight(4);
            $sheet->getStyle('A3:E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A3:E3')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 4, "Fecha:");
            $sheet->setCellValueByColumnAndRow(2, 4, "");
            $sheet->setCellValueByColumnAndRow(4, 4, "Fecha ams:");
            $sheet->setCellValueByColumnAndRow(5, 4, "");
            $sheet->getStyle('A4:E4')->getFont()->setSize(10);
            $sheet->getStyle('A4:D4')->getFont()->setBold(true);
            $sheet->getStyle("A4:E4")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A4:E4')->applyFromArray($styleArray);
            $sheet->getStyle('A4:E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A4:E4')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 5, "Aerolinea:");
            $sheet->setCellValueByColumnAndRow(2, 5, "0");
            $sheet->getStyle('A5:E5')->getFont()->setSize(10);
            $sheet->getStyle('A5:E5')->getFont()->setBold(true);
            $sheet->getStyle("A5:E5")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A5:E5')->applyFromArray($styleArray);
            $sheet->getStyle('A5:E5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A5:E5')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 6, "AWB:");
            $sheet->setCellValueByColumnAndRow(2, 6, $object->awb);
            $sheet->getStyle('A6:E6')->getFont()->setSize(10);
            $sheet->getStyle('A6:E6')->getFont()->setBold(true);
            $sheet->getStyle("A6:E6")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A6:E6')->applyFromArray($styleArray);
            $sheet->getStyle('A6:E6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A6:E6')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 7, "Peso:");
            $sheet->setCellValueByColumnAndRow(3, 7, "0");
            $sheet->setCellValueByColumnAndRow(4, 7, "Kg");
            $sheet->getStyle('A7:E7')->getFont()->setSize(10);
            $sheet->getStyle('A7:E7')->getFont()->setBold(true);
            $sheet->getStyle("A7:E7")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A7:E7')->applyFromArray($styleArray);
            $sheet->getStyle('A7:E7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A7:E7')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 8, "Destino:");
            $sheet->setCellValueByColumnAndRow(3, 8, "AMS");
            $sheet->getStyle('A8:E8')->getFont()->setSize(10);
            $sheet->getStyle('A8:E8')->getFont()->setBold(true);
            $sheet->getStyle("A8:E8")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A8:E8')->applyFromArray($styleArray);
            $sheet->getStyle('A8:E8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A8:E8')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 9, "Fulles:");
            $sheet->setCellValueByColumnAndRow(3, 9, 0.00);
            $sheet->setCellValueByColumnAndRow(4, 9, "Cajas");
            $sheet->getStyle('A9:E9')->getFont()->setSize(10);
            $sheet->getStyle('A9:E9')->getFont()->setBold(true);
            $sheet->getStyle("A9:E9")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A9:E9')->applyFromArray($styleArray);
            $sheet->getStyle('A9:E9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A9:E9')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 10, "Tallos:");
            $sheet->setCellValueByColumnAndRow(3, 10, 0.00);
            $sheet->setCellValueByColumnAndRow(4, 10, "Tallos");
            $sheet->getStyle('A10:E10')->getFont()->setSize(10);
            $sheet->getStyle('A10:E10')->getFont()->setBold(true);
            $sheet->getStyle("A10:E10")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A10:E10')->applyFromArray($styleArray);
            $sheet->getStyle('A10:E10')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A10:E10')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->getRowDimension('11')->setRowHeight(4);
            $sheet->getStyle('A11:E11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A11:E11')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 12, "Fincas de Rosas:");
            $sheet->setCellValueByColumnAndRow(3, 12, "Tallos");
            $sheet->setCellValueByColumnAndRow(4, 12, "Fulles");
            $sheet->setCellValueByColumnAndRow(5, 12, "Factura ($)");
            $sheet->getStyle('A12:E12')->getFont()->setSize(10);
            $sheet->getStyle('A12:E12')->getFont()->setBold(true);
            $sheet->getStyle("A12:E12")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A12:E12')->applyFromArray($styleArray);
            $sheet->getStyle('A12:E12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A12:E12')->getFill()->getStartColor()->setARGB('ffff99');

            $excel_row = 13;
            $acumRosesFulles = 0;
            $acumRosesTotalStems = 0;
            $acumRosesTotalPrice = 0;
            $acumOtrasFulles = 0;
            $acumOtrasTotalStems = 0;
            $acumOtrasTotalPrice = 0;
            $acumClavelFulles = 0;
            $acumClavelTotalStems = 0;
            $acumClavelTotalPrice = 0;

            if (count($arrRose) > 0) {
                foreach ($arrRose as $item) {
                    $acumTotalStems = 0;
                    $acumTotalPrice = 0;
                    $acumHb = 0;
                    $acumQb = 0;
                    $acumEb = 0;
                    foreach ($item['boxs'] as $box) {
                        if (strtoupper(trim($box->typeBoxs->name)) === "HB") {
                            $acumHb += (int) $box->boxNumber;
                        } else if (strtoupper(trim($box->typeBoxs->name)) === "QB") {
                            $acumQb += (int) $box->boxNumber;
                        } else {
                            $acumEb += (int) $box->boxNumber;
                        }
                        $acumBoxTotalStems = 0;
                        $acumBoxTotalPrice = 0;
                        foreach ($box->varieties as $var) {
                            $acumBoxTotalStems += (int) $var->bunches * (int) $var->stems;
                            $acumBoxTotalPrice +=  (int) $var->bunches * (int) $var->stems * (float)$var->price;
                        }
                        $acumTotalStems +=  $acumBoxTotalStems * (int)$box->boxNumber;
                        $acumTotalPrice +=  $acumBoxTotalPrice * (int)$box->boxNumber;
                    }

                    $fulles = ($acumHb * 0.50) + ($acumQb * 0.25) + ($acumEb * 0.125);
                    if ($acumEb > 0) {
                        $fulles = (float)number_format($fulles, 3);
                    } else {
                        $fulles = (float)number_format($fulles, 2);
                    }
                    $acumRosesFulles += $fulles;
                    $acumRosesTotalStems += $acumTotalStems;
                    $acumRosesTotalPrice += $acumTotalPrice;
                    if ($item['farm']->farm_id == 'farm_60256e217cb10') {
                        $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('99ccff');
                    }
                    $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
                    $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
                    $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $sheet->setCellValueByColumnAndRow(1, $excel_row, $item['farm']->name_commercial);
                    $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
                    $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumTotalStems);
                    $sheet->setCellValueByColumnAndRow(4, $excel_row, $fulles);
                    $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumTotalPrice);
                    $excel_row++;
                }
            }
            //total rosas
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Total de Rosas');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumRosesTotalStems);
            $sheet->setCellValueByColumnAndRow(4, $excel_row, $acumRosesFulles);
            $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumRosesTotalPrice);
            $excel_row += 2;

            //fincas de otras
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Fincas de Otras');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, 'Tallos');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, 'Fulles');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 'Factura ($)');
            $excel_row++;
            if (count($arrOtros) > 0) {
                foreach ($arrOtros as $item) {
                    $acumTotalStems = 0;
                    $acumTotalPrice = 0;
                    $acumHb = 0;
                    $acumQb = 0;
                    $acumEb = 0;
                    foreach ($item['boxs'] as $box) {
                        if (strtoupper(trim($box->typeBoxs->name)) === "HB") {
                            $acumHb += (int) $box->boxNumber;
                        } else if (strtoupper(trim($box->typeBoxs->name)) === "QB") {
                            $acumQb += (int) $box->boxNumber;
                        } else {
                            $acumEb += (int) $box->boxNumber;
                        }
                        $acumBoxTotalStems = 0;
                        $acumBoxTotalPrice = 0;
                        foreach ($box->varieties as $var) {
                            $acumBoxTotalStems += (int) $var->bunches * (int) $var->stems;
                            $acumBoxTotalPrice +=  (int) $var->bunches * (int) $var->stems * (float)$var->price;
                        }
                        $acumTotalStems +=  $acumBoxTotalStems * (int)$box->boxNumber;
                        $acumTotalPrice +=  $acumBoxTotalPrice * (int)$box->boxNumber;
                    }

                    $fulles = ($acumHb * 0.50) + ($acumQb * 0.25) + ($acumEb * 0.125);
                    if ($acumEb > 0) {
                        $fulles = (float)number_format($fulles, 3);
                    } else {
                        $fulles = (float)number_format($fulles, 2);
                    }
                    $acumOtrasFulles += $fulles;
                    $acumOtrasTotalStems += $acumTotalStems;
                    $acumOtrasTotalPrice += $acumTotalPrice;
                    if ($item['farm']->farm_id == 'farm_60256e217cb10') {
                        $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('99ccff');
                    }
                    $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
                    $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
                    $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $sheet->setCellValueByColumnAndRow(1, $excel_row, $item['farm']->name_commercial);
                    $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
                    $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumTotalStems);
                    $sheet->setCellValueByColumnAndRow(4, $excel_row, $fulles);
                    $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumTotalPrice);
                    $excel_row++;
                }
            }
            //total otras
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Total fulles de otras flores');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumOtrasTotalStems);
            $sheet->setCellValueByColumnAndRow(4, $excel_row, $acumOtrasFulles);
            $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumOtrasTotalPrice);
            $excel_row += 2;

            //fincas de otras
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Fincas de clavel');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, 'Tallos');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, 'Fulles');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 'Factura ($)');
            $excel_row++;

            //fincas de clavel
            if (count($arrClavel) > 0) {
                foreach ($arrClavel as $item) {
                    $acumTotalStems = 0;
                    $acumTotalPrice = 0;
                    $acumHb = 0;
                    $acumQb = 0;
                    $acumEb = 0;
                    foreach ($item['boxs'] as $box) {
                        if (strtoupper(trim($box->typeBoxs->name)) === "HB") {
                            $acumHb += (int) $box->boxNumber;
                        } else if (strtoupper(trim($box->typeBoxs->name)) === "QB") {
                            $acumQb += (int) $box->boxNumber;
                        } else {
                            $acumEb += (int) $box->boxNumber;
                        }
                        $acumBoxTotalStems = 0;
                        $acumBoxTotalPrice = 0;
                        foreach ($box->varieties as $var) {
                            $acumBoxTotalStems += (int) $var->bunches * (int) $var->stems;
                            $acumBoxTotalPrice +=  (int) $var->bunches * (int) $var->stems * (float)$var->price;
                        }
                        $acumTotalStems +=  $acumBoxTotalStems * (int)$box->boxNumber;
                        $acumTotalPrice +=  $acumBoxTotalPrice * (int)$box->boxNumber;
                    }

                    $fulles = ($acumHb * 0.50) + ($acumQb * 0.25) + ($acumEb * 0.125);
                    if ($acumEb > 0) {
                        $fulles = (float)number_format($fulles, 3);
                    } else {
                        $fulles = (float)number_format($fulles, 2);
                    }
                    $acumClavelFulles += $fulles;
                    $acumClavelTotalStems += $acumTotalStems;
                    $acumClavelTotalPrice += $acumTotalPrice;
                    if ($item['farm']->farm_id == 'farm_60256e217cb10') {
                        $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('99ccff');
                    }
                    $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
                    $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
                    $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $sheet->setCellValueByColumnAndRow(1, $excel_row, $item['farm']->name_commercial);
                    $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
                    $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumTotalStems);
                    $sheet->setCellValueByColumnAndRow(4, $excel_row, $fulles);
                    $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumTotalPrice);
                    $excel_row++;
                }
            }

            //total clavel
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Total de clavel');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumClavelTotalStems);
            $sheet->setCellValueByColumnAndRow(4, $excel_row, $acumClavelFulles);
            $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumClavelTotalPrice);
            $excel_row += 2;

            //total flores
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Total de flores');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumClavelTotalPrice + $acumOtrasTotalPrice + $acumRosesTotalPrice);
            $excel_row++;
            //comision luxus
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('99ccff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Comisión Luxus Blumen');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '0%');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 0);
            $excel_row++;
            //comision
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Comisión');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '0%');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 0);
            $excel_row++;
            //comision
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Guía aerea (AWB)');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 0);
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getRowDimension($excel_row)->setRowHeight(4);
            $sheet->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, '');
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Total de factura');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumClavelTotalStems);
            $sheet->setCellValueByColumnAndRow(4, $excel_row, $acumClavelFulles);
            $sheet->setCellValueByColumnAndRow(5, $excel_row, $acumClavelTotalPrice);
            $excel_row += 2;
            $sheet->getStyle('A' . $excel_row . ':D' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':D' . $excel_row)->getFill()->getStartColor()->setARGB('ccffcc');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':D' . $excel_row)->applyFromArray($styleArray);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Otro');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, 'Precooling/Kg.');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, 'EUR/$');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, 'Otro');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, '');
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ccffcc');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Precooling');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 0);
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, '');
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':C' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('D' . $excel_row)->getFill()->getStartColor()->setARGB('ccffcc');
            $sheet->getStyle('E' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '$/full');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, '');
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ccffcc');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('B' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Aduana');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, 0);
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 0);
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, '');
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFill()->getStartColor()->setARGB('99cc00');
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $excel_row . ':E' . $excel_row)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Total');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(5, $excel_row, 0);
            $excel_row++;
            //Segunda hoha
            $spreadsheet->createSheet();
            $sheet = $spreadsheet->getSheet(1);
            $sheet->setTitle('Factura');
            foreach (range('A', 'O') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            $sheet->setCellValueByColumnAndRow(1, 1, "LUXUS BLUMEN");
            $sheet->setCellValueByColumnAndRow(4, 1, "AWB");
            $sheet->setCellValueByColumnAndRow(5, 1, $object->awb);
            $sheet->setCellValueByColumnAndRow(15, 1, "IN");
            $sheet->getStyle('A1:O1')->getFont()->setSize(9);
            $sheet->getStyle('A1:O1')->getFont()->setBold(true);
            $sheet->getStyle("A1:O1")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A1:O1')->applyFromArray($styleArray);
            $sheet->getStyle('A1:O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A1:O1')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 2, "0");
            $sheet->setCellValueByColumnAndRow(4, 2, "Fecha AMS:");
            $sheet->setCellValueByColumnAndRow(5, 2, "20/20/20");
            $sheet->setCellValueByColumnAndRow(15, 2, "FB");
            $sheet->getStyle('A2:O2')->getFont()->setSize(9);
            $sheet->getStyle('A2:O2')->getFont()->setBold(true);
            $sheet->getStyle("A2:O2")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A2:O2')->applyFromArray($styleArray);
            $sheet->getStyle('A2:O2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A2:O2')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->setCellValueByColumnAndRow(1, 3, "№");
            $sheet->setCellValueByColumnAndRow(2, 3, "№");
            $sheet->setCellValueByColumnAndRow(3, 3, "Finca");
            $sheet->setCellValueByColumnAndRow(4, 3, "Ramo");
            $sheet->setCellValueByColumnAndRow(5, 3, "Variedad");
            $sheet->mergeCells('F3:L3');
            $sheet->setCellValueByColumnAndRow(6, 3, "Largo");
            $sheet->setCellValueByColumnAndRow(13, 3, "Total");
            $sheet->setCellValueByColumnAndRow(14, 3, "Precio unidad");
            $sheet->setCellValueByColumnAndRow(15, 3, "Total");
            $sheet->getStyle('A3:O3')->getFont()->setSize(9);
            $sheet->getStyle('A3:O3')->getFont()->setBold(true);
            $sheet->getStyle("A3:O3")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A3:O3')->applyFromArray($styleArray);
            $sheet->getStyle('A3:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A3:O3')->getFill()->getStartColor()->setARGB('ffff99');

            $sheet->setCellValueByColumnAndRow(1, 4, "Caja");
            $sheet->setCellValueByColumnAndRow(2, 4, "Factura");
            $sheet->setCellValueByColumnAndRow(4, 4, "Tallos");
            $sheet->setCellValueByColumnAndRow(6, 4, "40");
            $sheet->setCellValueByColumnAndRow(7, 4, "50");
            $sheet->setCellValueByColumnAndRow(8, 4, "60");
            $sheet->setCellValueByColumnAndRow(9, 4, "70");
            $sheet->setCellValueByColumnAndRow(10, 4, "80");
            $sheet->setCellValueByColumnAndRow(11, 4, "90");
            $sheet->setCellValueByColumnAndRow(12, 4, "100");
            $sheet->setCellValueByColumnAndRow(13, 4, "Tallos");
            $sheet->setCellValueByColumnAndRow(14, 4, "$");
            $sheet->setCellValueByColumnAndRow(15, 4, "$");
            $sheet->getStyle('A4:O4')->getFont()->setSize(9);
            $sheet->getStyle('A4:O4')->getFont()->setBold(true);
            $sheet->getStyle("A4:O4")->getAlignment()->setWrapText(true);
            $sheet->getStyle('A4:O4')->applyFromArray($styleArray);
            $sheet->getStyle('A4:O4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A4:O4')->getFill()->getStartColor()->setARGB('ffff99');
            $excel_row = 6;
            $acumTotalPriceFact = 0;
            $acumTotalStemsFact = 0;
            $acumFullesFact = 0;
            $acum40 = 0;
            $acum50 = 0;
            $acum60 = 0;
            $acum70 = 0;
            $acum80 = 0;
            $acum90 = 0;
            $acum100 = 0;
            if (count($object->details) > 0) {
                foreach ($object->details as $item) {
                    $acumTotalStems = 0;
                    $acumTotalPrice = 0;
                    $acumHb = 0;
                    $acumQb = 0;
                    $acumEb = 0;
                    foreach ($item->boxs as $box) {
                        if (strtoupper(trim($box->typeBoxs->name)) === "HB") {
                            $acumHb += (int) $box->boxNumber;
                        } else if (strtoupper(trim($box->typeBoxs->name)) === "QB") {
                            $acumQb += (int) $box->boxNumber;
                        } else {
                            $acumEb += (int) $box->boxNumber;
                        }
                        if (count($box->varieties) > 1) {
                            $count = 0;
                            foreach ($box->varieties as $var) {
                                if ($count == 0) {
                                    $sheet->getStyle('A' . $excel_row . ':O' . $excel_row)->getFont()->setSize(10);
                                    $sheet->getStyle('A' . $excel_row . ':O' . $excel_row)->applyFromArray($styleArray);
                                    $sheet->getStyle('O' . $excel_row . ':N' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                                    $sheet->setCellValueByColumnAndRow(1, $excel_row, $box->boxNumber . '-' . $box->typeBoxs->name);
                                    $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
                                    $sheet->setCellValueByColumnAndRow(3, $excel_row, $item->farm->name_commercial);
                                    $sheet->setCellValueByColumnAndRow(4, $excel_row, (int)$var->stems);
                                    $sheet->setCellValueByColumnAndRow(5, $excel_row, $var->products->name);
                                    if (strtoupper(trim($var->measures->name)) == '40 CM') {
                                        $acum40 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '50 CM') {
                                        $acum50 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '60 CM') {
                                        $acum60 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '70 CM') {
                                        $acum70 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '80 CM') {
                                        $acum80 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '90 CM') {
                                        $acum90 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '100 CM') {
                                        $acum100 +=  $var->bunches;
                                    }
                                    $sheet->setCellValueByColumnAndRow(6, $excel_row, strtoupper(trim($var->measures->name)) == '40 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(7, $excel_row, strtoupper(trim($var->measures->name)) == '50 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(8, $excel_row, strtoupper(trim($var->measures->name)) == '60 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(9, $excel_row, strtoupper(trim($var->measures->name)) == '70 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(10, $excel_row, strtoupper(trim($var->measures->name)) == '80 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(11, $excel_row, strtoupper(trim($var->measures->name)) == '90 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(12, $excel_row, strtoupper(trim($var->measures->name)) == '100 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(13, $excel_row, (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber);
                                    $sheet->setCellValueByColumnAndRow(14, $excel_row, (float) $var->price);
                                    $sheet->setCellValueByColumnAndRow(15, $excel_row, (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber * (float) $var->price);
                                    $excel_row++;
                                } else {
                                    $sheet->getStyle('A' . $excel_row . ':O' . $excel_row)->getFont()->setSize(10);
                                    $sheet->getStyle('A' . $excel_row . ':O' . $excel_row)->applyFromArray($styleArray);
                                    $sheet->getStyle('O' . $excel_row . ':N' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                                    $sheet->setCellValueByColumnAndRow(1, $excel_row, '');
                                    $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
                                    $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
                                    $sheet->setCellValueByColumnAndRow(4, $excel_row, (int)$var->stems);
                                    $sheet->setCellValueByColumnAndRow(5, $excel_row, $var->products->name);
                                    if (strtoupper(trim($var->measures->name)) == '40 CM') {
                                        $acum40 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '50 CM') {
                                        $acum50 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '60 CM') {
                                        $acum60 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '70 CM') {
                                        $acum70 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '80 CM') {
                                        $acum80 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '90 CM') {
                                        $acum90 +=  $var->bunches;
                                    } else if (strtoupper(trim($var->measures->name)) == '100 CM') {
                                        $acum100 +=  $var->bunches;
                                    }
                                    $sheet->setCellValueByColumnAndRow(6, $excel_row, strtoupper(trim($var->measures->name)) == '40 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(7, $excel_row, strtoupper(trim($var->measures->name)) == '50 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(8, $excel_row, strtoupper(trim($var->measures->name)) == '60 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(9, $excel_row, strtoupper(trim($var->measures->name)) == '70 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(10, $excel_row, strtoupper(trim($var->measures->name)) == '80 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(11, $excel_row, strtoupper(trim($var->measures->name)) == '90 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(12, $excel_row, strtoupper(trim($var->measures->name)) == '100 CM' ? $var->bunches : '');
                                    $sheet->setCellValueByColumnAndRow(13, $excel_row, (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber);
                                    $sheet->setCellValueByColumnAndRow(14, $excel_row, (float) $var->price);
                                    $sheet->setCellValueByColumnAndRow(15, $excel_row, (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber * (float) $var->price);
                                    $acumTotalStemsFact += (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber;
                                    $acumTotalPriceFact += (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber * (float) $var->price;
                                    $excel_row++;
                                }
                            }
                        } else {
                            foreach ($box->varieties as $var) {
                                $sheet->getStyle('A' . $excel_row . ':O' . $excel_row)->getFont()->setSize(10);
                                $sheet->getStyle('A' . $excel_row . ':O' . $excel_row)->applyFromArray($styleArray);
                                $sheet->getStyle('O' . $excel_row . ':N' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                                $sheet->setCellValueByColumnAndRow(1, $excel_row, $box->boxNumber . '-' . $box->typeBoxs->name);
                                $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
                                $sheet->setCellValueByColumnAndRow(3, $excel_row, $item->farm->name_commercial);
                                $sheet->setCellValueByColumnAndRow(4, $excel_row, (int)$var->stems);
                                $sheet->setCellValueByColumnAndRow(5, $excel_row, $var->products->name);
                                if (strtoupper(trim($var->measures->name)) == '40 CM') {
                                    $acum40 +=  $var->bunches;
                                } else if (strtoupper(trim($var->measures->name)) == '50 CM') {
                                    $acum50 +=  $var->bunches;
                                } else if (strtoupper(trim($var->measures->name)) == '60 CM') {
                                    $acum60 +=  $var->bunches;
                                } else if (strtoupper(trim($var->measures->name)) == '70 CM') {
                                    $acum70 +=  $var->bunches;
                                } else if (strtoupper(trim($var->measures->name)) == '80 CM') {
                                    $acum80 +=  $var->bunches;
                                } else if (strtoupper(trim($var->measures->name)) == '90 CM') {
                                    $acum90 +=  $var->bunches;
                                } else if (strtoupper(trim($var->measures->name)) == '100 CM') {
                                    $acum100 +=  $var->bunches;
                                }
                                $sheet->setCellValueByColumnAndRow(6, $excel_row, strtoupper(trim($var->measures->name)) == '40 CM' ? $var->bunches : '');
                                $sheet->setCellValueByColumnAndRow(7, $excel_row, strtoupper(trim($var->measures->name)) == '50 CM' ? $var->bunches : '');
                                $sheet->setCellValueByColumnAndRow(8, $excel_row, strtoupper(trim($var->measures->name)) == '60 CM' ? $var->bunches : '');
                                $sheet->setCellValueByColumnAndRow(9, $excel_row, strtoupper(trim($var->measures->name)) == '70 CM' ? $var->bunches : '');
                                $sheet->setCellValueByColumnAndRow(10, $excel_row, strtoupper(trim($var->measures->name)) == '80 CM' ? $var->bunches : '');
                                $sheet->setCellValueByColumnAndRow(11, $excel_row, strtoupper(trim($var->measures->name)) == '90 CM' ? $var->bunches : '');
                                $sheet->setCellValueByColumnAndRow(12, $excel_row, strtoupper(trim($var->measures->name)) == '100 CM' ? $var->bunches : '');
                                $sheet->setCellValueByColumnAndRow(13, $excel_row, (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber);
                                $sheet->setCellValueByColumnAndRow(14, $excel_row, (float) $var->price);
                                $sheet->setCellValueByColumnAndRow(15, $excel_row, (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber * (float) $var->price);
                                $acumTotalStemsFact += (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber;
                                $acumTotalPriceFact += (int) $var->stems * (int)$var->bunches * (int)$box->boxNumber * (float) $var->price;
                                $excel_row++;
                            }
                        }
                    }

                    $fulles = ($acumHb * 0.50) + ($acumQb * 0.25) + ($acumEb * 0.125);
                    if ($acumEb > 0) {
                        $fulles = (float)number_format($fulles, 3);
                    } else {
                        $fulles = (float)number_format($fulles, 2);
                    }
                    $acumFullesFact += $fulles;
                }
            }
            $excel_row++;
            $sheet->getStyle('A' . $excel_row . ':M' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $excel_row . ':M' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('A' . $excel_row . ':M' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('A' . $excel_row . ':M' . $excel_row)->applyFromArray($styleArray);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, 'Total rosas');
            $sheet->setCellValueByColumnAndRow(2, $excel_row, '');
            $sheet->setCellValueByColumnAndRow(6, $excel_row, $acum40);
            $sheet->setCellValueByColumnAndRow(7, $excel_row, $acum50);
            $sheet->setCellValueByColumnAndRow(8, $excel_row, $acum60);
            $sheet->setCellValueByColumnAndRow(9, $excel_row, $acum70);
            $sheet->setCellValueByColumnAndRow(10, $excel_row, $acum80);
            $sheet->setCellValueByColumnAndRow(11, $excel_row, $acum90);
            $sheet->setCellValueByColumnAndRow(12, $excel_row, $acum100);
            $excel_row += 2;
            $sheet->getStyle('F' . $excel_row . ':O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('F' . $excel_row . ':O' . $excel_row)->getFill()->getStartColor()->setARGB('ffff99');
            $sheet->getStyle('F' . $excel_row . ':O' . $excel_row)->getFont()->setSize(10);
            $sheet->getStyle('F' . $excel_row . ':O' . $excel_row)->applyFromArray($styleArray);
            $sheet->setCellValueByColumnAndRow(6, $excel_row, 'Total fulles rosas');
            $sheet->setCellValueByColumnAndRow(15, $excel_row, $acumFullesFact);
            //tercera hoja
            $spreadsheet->createSheet();
            $sheet = $spreadsheet->getSheet(2);
            $sheet->setTitle('AWB');
            foreach (range('A', 'O') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            $sheet->setCellValueByColumnAndRow(4, 3, "Tarifa kg");
            $sheet->getStyle('D3')->getFont()->setSize(10);
            $sheet->getStyle("A3")->getAlignment()->setWrapText(true);
            $sheet->getStyle('D3')->applyFromArray($styleArray);

            $sheet->setCellValueByColumnAndRow(2, 4, "Precio");
            $sheet->getStyle('B4')->getFont()->setSize(10);
            $sheet->getStyle("B4")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B4')->applyFromArray($styleArray);

            $sheet->setCellValueByColumnAndRow(2, 5, "Impuesto");
            $sheet->getStyle('B5')->getFont()->setSize(10);
            $sheet->getStyle("B5")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B5')->applyFromArray($styleArray);

            $sheet->setCellValueByColumnAndRow(2, 6, "Otros cargos");
            $sheet->getStyle('B6')->getFont()->setSize(10);
            $sheet->getStyle("B6")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B6')->applyFromArray($styleArray);

            $sheet->setCellValueByColumnAndRow(2, 7, "Total AWB");
            $sheet->setCellValueByColumnAndRow(5, 7, 0);
            $sheet->getStyle('B7:E7')->getFont()->setSize(10);
            $sheet->getStyle("B7:E7")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B7:E7')->applyFromArray($styleArray);

            $sheet->setCellValueByColumnAndRow(2, 11, "Pais de origen");
            $sheet->setCellValueByColumnAndRow(3, 11, "ECUADOR");
            $sheet->setCellValueByColumnAndRow(2, 12, "Numero AWB:");
            $sheet->setCellValueByColumnAndRow(3, 12, $object->awb);
            $sheet->setCellValueByColumnAndRow(2, 13, "Fecha de vuelo (AWB):");
            $sheet->setCellValueByColumnAndRow(3, 13, '12/12/12');
            $sheet->setCellValueByColumnAndRow(2, 14, "Peso bruto AWB, kg:");
            $sheet->setCellValueByColumnAndRow(3, 14, 0);
            $sheet->setCellValueByColumnAndRow(2, 15, "Piezas en AWB:");
            $sheet->setCellValueByColumnAndRow(3, 15, 0);
            $sheet->setCellValueByColumnAndRow(2, 16, "Broker/No invoice./marcacion/piezas");
            $sheet->setCellValueByColumnAndRow(3, 16, "LUXUS BLUMEN");
            $sheet->setCellValueByColumnAndRow(4, 16, "Nx-h");
            $sheet->setCellValueByColumnAndRow(5, 16, 0);
            $sheet->setCellValueByColumnAndRow(6, 16, 0);

            $sheet->setCellValueByColumnAndRow(2, 18, "Nombre del tipo de flor");
            $sheet->setCellValueByColumnAndRow(3, 18, "Largo");
            $sheet->setCellValueByColumnAndRow(4, 18, "Unidad");
            $sheet->setCellValueByColumnAndRow(5, 18, "Cantidad");
            $sheet->getStyle('B11:E11')->getFont()->setSize(10);
            $sheet->getStyle("B11:E11")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B11:E11')->applyFromArray($styleArray);
            $sheet->getStyle('B12:E12')->getFont()->setSize(10);
            $sheet->getStyle("B12:E12")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B12:E12')->applyFromArray($styleArray);
            $sheet->getStyle('B13:E13')->getFont()->setSize(10);
            $sheet->getStyle("B13:E13")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B13:E13')->applyFromArray($styleArray);
            $sheet->getStyle('B14:E14')->getFont()->setSize(10);
            $sheet->getStyle("B14:E14")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B14:E14')->applyFromArray($styleArray);
            $sheet->getStyle('B15:E15')->getFont()->setSize(10);
            $sheet->getStyle("B15:E15")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B15:E15')->applyFromArray($styleArray);
            $sheet->getStyle('B16:F16')->getFont()->setSize(10);
            $sheet->getStyle("B16:F16")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B16:F16')->applyFromArray($styleArray);
            $sheet->getStyle('B18:E18')->getFont()->setSize(10);
            $sheet->getStyle("B18:E18")->getAlignment()->setWrapText(true);
            $sheet->getStyle('B18:E18')->applyFromArray($styleArray);
            $sheet->getStyle('B18:E18')->getFont()->setBold(true);
            $excel_row = 19;
            foreach ($arrCategory as $item) {
                foreach ($item['arr'] as $arr) {
                    foreach ($arr->varieties as $var) {
                        $sheet->getStyle('B' . $excel_row . ':F' . $excel_row)->getFont()->setSize(10);
                        $sheet->getStyle('B' . $excel_row . ':F' . $excel_row)->applyFromArray($styleArray);
                        //   $sheet->getStyle('D' . $excel_row . ':E' . $excel_row)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $sheet->setCellValueByColumnAndRow(2, $excel_row, $item['category']->name);
                        $size = trim(str_replace("CM", "", $var->measures->name));
                        $sheet->setCellValueByColumnAndRow(3, $excel_row, $size);
                        $sheet->setCellValueByColumnAndRow(4, $excel_row, $var->stems);
                        $sheet->setCellValueByColumnAndRow(5, $excel_row, $var->bunches);
                        $sheet->setCellValueByColumnAndRow(6, $excel_row, (int)$var->stems * (int)$var->bunches);
                        $excel_row++;
                    }
                }
            }
            $spreadsheet
                ->getProperties()
                ->setCreator("Luxus")
                ->setLastModifiedBy('Luxus') // última vez modificado por
                ->setTitle('Documento creado con PhpSpreadSheet Luxus')
                ->setSubject('Invoice client')
                ->setDescription('Este documento fue generado para luxusflowers.com')
                ->setKeywords('etiquetas o palabras clave separadas por espacios')
                ->setCategory('Invoice');

            $nombreDelDocumento = "Invoice-" . $object->number_invoice . '-' . time() . ".xlsx";

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        } else {
            show_404();
        }
    }
}
