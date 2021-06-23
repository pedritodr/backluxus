<?php

class Fixed_orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Fixed_orders_model', 'fixed_orders');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_fixed_orders = $this->fixed_orders->get_all(['is_active' => 1]);
        $data['all_fixed_orders'] = $all_fixed_orders;
        $this->load_view_admin_g("fixed_orders/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
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
        $this->load_view_admin_g('fixed_orders/add', $data);
    }

    public function add()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $invoceNumber = (int)$this->input->post('invoceNumber');
        $dayCreate = (int)$this->input->post('dayCreate');
        $dispatchDay = (int) $this->input->post('dispatchDay');
        $farms = (object)($_POST['farms']);
        $markings = ($_POST['markings']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
        $fixed_orders = 'fixed_orders' . uniqid();
        $date_create = date("Y-m-d H:i:s");

        foreach ($arrayRequest as $item) {
            $item->id = uniqid();
            $item->status = 0;
            foreach ($item->varieties as $v) {
                $v->id = uniqid();
            }
        }
        $data_invoice = [
            'fixed_orders' => $fixed_orders,
            'invoice_number' => $invoceNumber,
            'dispatch_day' => $dispatchDay,
            'markings' => $markings,
            'farms' => $farms,
            'details' => $arrayRequest,
            'status' => 0,
            'date_create' => $date_create,
            'dayCreate' => $dayCreate,
            'timestamp' => strtotime($date_create),
            'is_active' => 1
        ];
        $resquest =  $this->fixed_orders->create($data_invoice);
        if ($resquest) {
            $this->load->model('Farm_model', 'farm');
            $obj_farm = $this->farm->get_provider_by_id($farms->farm_id);
            $this->farm->update_provider($farms->farm_id, ['numberOrder' => $invoceNumber]);
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $object = $this->fixed_orders->get_by_id($id);

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
            $this->load_view_admin_g('fixed_orders/update', $data);
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $order = $this->input->post('order');
        $dayCreate = (int)$this->input->post('dayCreate');
        $dispatchDay = (int)$this->input->post('dispatchDay');
        $farms = (object)($_POST['farms']);
        $markings = ($_POST['markings']);
        $arrayRequest =  json_decode($_POST['arrayRequest']);
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
            'dispatch_day' => $dispatchDay,
            'dayCreate' => $dayCreate,
            'markings' => $markings,
            'farms' => $farms,
            'details' => $arrayRequest,
        ];
        $resquest =  $this->fixed_orders->update($order, $data_invoice);
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
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $bouquet_object = $this->fixed_orders->get_by_id($id);

        if ($bouquet_object) {
            $this->fixed_orders->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("fixed_orders/index");
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
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $invoiceNumber = $this->input->post('invoiceNumber');
        $invoice =  $this->fixed_orders->get_by_number_invoice($invoiceNumber);
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'invoice' => $invoice]);
        exit();
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
}
