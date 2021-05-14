<?php

class Credit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Credit_model', 'credit');
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

        $credits = $this->credit->get_all(['is_active' => 1]);
        $data['credits'] = $credits;
        $this->load_view_admin_g("credit/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Reason_credit_model', 'reason_credit');
        $this->load->model('User_model', 'user');
        $reason_credits = $this->reason_credit->get_all(['is_active' => 1]);
        $data['reason_credits'] = $reason_credits;
        $data['clients'] = $this->user->get_all(['role_id' => 3, 'is_delete' => 0]);
        $this->load_view_admin_g('credit/add', $data);
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
        $this->load->model('Invoice_farm_model', 'invoice_farm');
        $invoice = json_decode($this->input->post('invoice'));
        $arrItemsCredit = json_decode($this->input->post('arrItemsCredit'));
        $marking = json_decode($this->input->post('marking'));
        $farm = json_decode($this->input->post('farm'));
        $description = $this->input->post('description');
        $credit_id = 'credit_' . uniqid();
        $date_create = date("Y-m-d H:i:s");
        $dataCredit = [
            'credit_id' => $credit_id,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create),
            'inovice' => $invoice,
            'items' => $arrItemsCredit,
            'farm' => $farm,
            'marking' => $marking,
            'description' => $description
        ];
        $dataCreditMinClient = [
            'credit_id' => $credit_id,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create),
            'invoice' => $invoice,
            'items' => $arrItemsCredit,
            'farm' => $farm,
            'description' => $description
        ];
        $this->credit->create($dataCredit);
        $this->invoice_farm->create_credit_invoice_client($invoice->invoice, $dataCreditMinClient);
        foreach ($arrItemsCredit as $item) {
            $this->invoice_farm->create_credit_farm($item->itemSelected->invoceFarm, $item);
        }
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $credit_id]);
        exit();
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $reason_object = $this->reason_credit->get_by_id($id);

        if ($reason_object) {
            $data['reason_object'] = $reason_object;
            $this->load_view_admin_g('reason_credit/update', $data);
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
        $reason = $this->input->post('reason');
        $reason_credit_id = $this->input->post('reason_credit_id');
        $this->form_validation->set_rules('reason', translate('reason_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("reason_credit/update_index/" . $reason_credit_id);
        } else {
            $data = ['reason' => $reason];
            $row =  $this->reason_credit->update($reason_credit_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("reason_credit/index", "location", 301);
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $reason_object = $this->reason_credit->get_by_id($id);

        if ($reason_object) {
            $this->reason_credit->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("reason_credit/index");
        } else {
            show_404();
        }
    }
    public function loadMotivos()
    {
        $strJson = json_decode('[{"motivo_id":"1","motivo":"motivo de prueba actualizado","is_active":"2"}, {"motivo_id":"2","motivo":"plaga con gripe","is_active":"2"}, {"motivo_id":"3","motivo":"Botrytis","is_active":"1"}, {"motivo_id":"4","motivo":"Da\u00f1os mec\u00e1nicos","is_active":"1"}, {"motivo_id":"5","motivo":"Maltrato","is_active":"1"}, {"motivo_id":"6","motivo":"Tallos cortos","is_active":"1"}, {"motivo_id":"7","motivo":"Tallos torcidos","is_active":"1"}, {"motivo_id":"8","motivo":"Fumigaci\u00f3n","is_active":"1"}, {"motivo_id":"9","motivo":"Color incorrecto","is_active":"1"}, {"motivo_id":"10","motivo":"Empaque incorrecto","is_active":"1"}, {"motivo_id":"11","motivo":"Follaje caf\u00e9","is_active":"1"}, {"motivo_id":"12","motivo":"Trips","is_active":"1"}, {"motivo_id":"13","motivo":"Acaros","is_active":"1"}, {"motivo_id":"14","motivo":"Punto de corte abierto","is_active":"1"}, {"motivo_id":"15","motivo":"Punto de corte cerrado","is_active":"1"}, {"motivo_id":"16","motivo":"Marcas en los p\u00e9talos","is_active":"1"}, {"motivo_id":"17","motivo":"Exceso de follaje","is_active":"1"}, {"motivo_id":"18","motivo":"Inconsistencias ","is_active":"1"}, {"motivo_id":"19","motivo":"Desprendimiento de cabezas","is_active":"1"}, {"motivo_id":"20","motivo":"Bajo conteo de botones","is_active":"1"}, {"motivo_id":"21","motivo":"Deshidrataci\u00f3n","is_active":"1"}, {"motivo_id":"22","motivo":"Variedad incorrecta","is_active":"1"}, {"motivo_id":"23","motivo":"Tama\u00f1o incorrecto","is_active":"1"}, {"motivo_id":"24","motivo":"Receta equivocada","is_active":"1"}, {"motivo_id":"25","motivo":"Tallos partidos","is_active":"1"}, {"motivo_id":"26","motivo":"P\u00e9talos bronceados","is_active":"1"}, {"motivo_id":"27","motivo":"Cabezas peque\u00f1as","is_active":"1"}, {"motivo_id":"28","motivo":"Decoloraci\u00f3n","is_active":"1"}, {"motivo_id":"29","motivo":"Capuch\u00f3n incorrecto","is_active":"1"}, {"motivo_id":"30","motivo":"UPC incorrecto","is_active":"1"}, {"motivo_id":"31","motivo":"Hongos","is_active":"1"}, {"motivo_id":"32","motivo":"Deformaci\u00f3n","is_active":"1"}, {"motivo_id":"33","motivo":"Comida incorrecta","is_active":"1"}, {"motivo_id":"34","motivo":"Negreamiento","is_active":"1"}, {"motivo_id":"35","motivo":"Puntas da\u00f1adas","is_active":"1"}, {"motivo_id":"36","motivo":"Mala calidad","is_active":"1"}, {"motivo_id":"37","motivo":"Destino equivocado","is_active":"1"}, {"motivo_id":"38","motivo":"Bot\u00f3n peque\u00f1o","is_active":"1"}, {"motivo_id":"39","motivo":"Cajas HB (Usa Bqt)","is_active":"1"}, {"motivo_id":"40","motivo":"Hold para fumigaci\u00f3n","is_active":"1"}, {"motivo_id":"41","motivo":"Comisi\u00f3n 4Season ","is_active":"1"}, {"motivo_id":"42","motivo":"CRUCE DE CUENTAS ","is_active":"1"}, {"motivo_id":"43","motivo":"AJUSTE DE PRECIO ","is_active":"1"}, {"motivo_id":"44","motivo":"REETIQUETADO","is_active":"1"}, {"motivo_id":"45","motivo":"Capuch\u00f3n rojo","is_active":"1"}, {"motivo_id":"46","motivo":"No se entrego la caja en la carguera","is_active":"1"}]');

        foreach ($strJson as $item) {
            if ($item->is_active == 1) {
                $obj = $this->reason_credit->get_motivo_by_id((int)$item->motivo_id);
                if (!$obj) {
                    $reason_credit_id = 'reason_credit_' . uniqid();
                    $data = ['reason_credit_id' => $reason_credit_id, 'reason' => $item->motivo, 'is_active' => 1, 'motivo_id' => (int)$item->motivo_id];
                    $this->reason_credit->create($data);
                }
            }
        }
    }
    public function add_images()
    {
        ini_set('max_execution_time', '0');
        define('UPLOAD_DIR', './uploads/credit/');
        $id = $this->input->post('id');
        $images = json_decode($_POST['images']);
        if (count($images) > 0) {
            foreach ($images as $item) {
                $img =  $item->img;
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = UPLOAD_DIR . uniqid() . '.png';
                $success = file_put_contents($file, $data);
                $img_id = 'img_' . uniqid();
                $this->credit->create_images($id, ['img_id' => $img_id, 'img' => $file, 'credit_id' => $id]);
            }
            echo json_encode(['status' => 200]);
            exit();
        } else {
            echo json_encode(['status' => 200]);
            exit();
        }
    }
}
