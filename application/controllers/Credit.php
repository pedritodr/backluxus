<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

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

        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5])) {
            $this->log_out();
            redirect('login/index');
        }

        $credits = $this->credit->get_all(['is_active' => 1]);
        $data['credits'] = $credits;
        $this->load_view_admin_g("credit/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Reason_credit_model', 'reason_credit');
        $this->load->model('User_model', 'user');
        $reason_credits = $this->reason_credit->get_all(['is_active' => 1]);
        $data['reason_credits'] = $reason_credits;
        $data['clients'] = $this->user->get_all(['role_id' => 9, 'is_delete' => 0]);
        $this->load_view_admin_g('credit/add', $data);
    }

    public function add()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5])) {
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
            'description' => $description,
            'is_active' => 1
        ];
        $dataCreditMinClient = [
            'credit_id' => $credit_id,
            'date_create' => $date_create,
            'timestamp' => strtotime($date_create),
            'invoice' => $invoice,
            'items' => $arrItemsCredit,
            'farm' => $farm,
            'description' => $description,
            'is_active' => 1
        ];
        $this->credit->create($dataCredit);
        $this->invoice_farm->create_credit_invoice_client($invoice->invoice, $dataCreditMinClient);
        foreach ($arrItemsCredit as $item) {
            $item->credit_id = $credit_id;
            $this->invoice_farm->create_credit_farm($item->itemSelected->invoceFarm, $item);
            $this->invoice_farm->update_box_variety($item->itemSelected->invoceFarm, $item->itemSelected->boxId, $item->itemSelected->id, $item);
            $this->invoice_farm->update_box_variety_invoice_cliente($invoice->invoice, $item->itemSelected->detailId, $item->itemSelected->boxId, $item->itemSelected->id, $item);
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
        $this->load->model('Reason_credit_model', 'reason_credit');
        $this->load->model('User_model', 'user');
        $reason_credits = $this->reason_credit->get_all(['is_active' => 1]);
        $data['reason_credits'] = $reason_credits;
        $data['clients'] = $this->user->get_all(['role_id' => 3, 'is_delete' => 0]);

        $object = $this->credit->get_by_id($id);

        if ($object) {
            $data['credit'] = $object;
            $this->load_view_admin_g('credit/update', $data);
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
        $this->load->model('Invoice_farm_model', 'invoice_farm');
        $items = json_decode($this->input->post('items'));
        $arrItemsCredit = json_decode($this->input->post('arrItemsCredit'));
        $description = $this->input->post('description');
        $creditId = $this->input->post('creditId');
        $invoiceId = $this->input->post('invoiceId');
        $dataCredit = [
            'items' => $arrItemsCredit,
            'description' => $description,
            'images' => []
        ];
        $this->credit->update($creditId, $dataCredit);
        $this->invoice_farm->update_credit_invoice_client($invoiceId, $creditId, $arrItemsCredit, $description);
        foreach ($items as $item) {
            $this->invoice_farm->delete_credit_farm($item->itemSelected->invoceFarm, []);
            $this->invoice_farm->update_box_variety_invoice_cliente($invoiceId, $item->itemSelected->detailId, $item->itemSelected->boxId, $item->itemSelected->id, false);
            $this->invoice_farm->update_box_variety($item->itemSelected->invoceFarm, $item->itemSelected->boxId, $item->itemSelected->id, false);
        }
        foreach ($arrItemsCredit as $item) {
            $item->credit_id = $creditId;
            $this->invoice_farm->create_credit_farm($item->itemSelected->invoceFarm, $item);
            $this->invoice_farm->update_box_variety($item->itemSelected->invoceFarm, $item->itemSelected->boxId, $item->itemSelected->id, $item);
            $this->invoice_farm->update_box_variety_invoice_cliente($invoiceId, $item->itemSelected->detailId, $item->itemSelected->boxId, $item->itemSelected->id, $item);
        }
        echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $creditId]);
        exit();
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $object = $this->credit->get_by_id($id);
        if ($object) {
            $this->load->model('Invoice_farm_model', 'invoice_farm');
            $this->credit->update($id, ['is_active' => 0]);
            if (count($object->images) > 0) {
                foreach ($object->images as $item) {
                    $item->img;
                    if (file_exists($item->img))
                        unlink($item->img);
                }
            }
            foreach ($object->items as $item) {
                $this->invoice_farm->delete_credit_farm($item->itemSelected->invoceFarm, []);
                $this->invoice_farm->update_box_variety_invoice_cliente($object->inovice->invoice, $item->itemSelected->detailId, $item->itemSelected->boxId, $item->itemSelected->id, false);
                $this->invoice_farm->update_box_variety($item->itemSelected->invoceFarm, $item->itemSelected->boxId, $item->itemSelected->id, false);
            }
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("credit/index");
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

    public function delete_images()
    {
        $images = json_decode($_POST['images']);
        if (count($images) > 0) {
            foreach ($images as $item) {
                $item->img;
                if (file_exists($item->img))
                    unlink($item->img);
            }
            echo json_encode(['status' => 200]);
            exit();
        } else {
            echo json_encode(['status' => 200]);
            exit();
        }
    }
    public function export_credit($creditId)
    {
        $object = $this->credit->get_by_id($creditId);

        if ($object) {

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $sheet->setTitle("Factura");
            $styleArray = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                ],
            ];
            $styleImages = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $styleLeft = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];
            $styleNota = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];
            $styleBoderBottom = [
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '666699'],
                    ],
                ]
            ];
            $styleBoderBottom2 = [
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ]
            ];
            $styleClientBorder = [
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '666699'],
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '666699'],
                    ],
                ]
            ];
            foreach (range('B', 'N') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }


            $sheet->mergeCells('C3:J3');
            $sheet->setCellValueByColumnAndRow(3, 3, "LUXUS BLUMEN S.A");
            $sheet->getStyle('C3')->getFont()->setSize(20);
            $sheet->getStyle('C3')->getFont()->setBold(true);
            $sheet->getStyle("C3")->getAlignment()->setWrapText(true);
            $sheet->getRowDimension('3')->setRowHeight(40);
            $sheet->getStyle('L3')->applyFromArray($styleNota);
            $sheet->setCellValueByColumnAndRow(12, 3, "Nota de Crédito");
            $sheet->getStyle('L3')->getFont()->setBold(true);
            $sheet->getStyle('L3')->getFont()->setSize(10);

            $sheet->getStyle('B3:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B3:O3')->getFill()->getStartColor()->setARGB('ffffff');

            $sheet->getStyle('B4:O4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B4:O4')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('B4:L4')->applyFromArray($styleBoderBottom);
            $sheet->getStyle('B4:O4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B4:O4')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('M4:N4')->applyFromArray($styleClientBorder);
            $sheet->setCellValueByColumnAndRow(13, 4, $object->marking->name_commercial);
            $sheet->getStyle('M4')->getFont()->setBold(true);
            $sheet->getStyle('M4')->getFont()->setSize(18);
            $sheet->getRowDimension('4')->setRowHeight(30);
            $sheet->getStyle('B5:N5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B5:N5')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('B5:N5')->applyFromArray($styleBoderBottom2);
            $sheet->getRowDimension('5')->setRowHeight(6);
            $sheet->getStyle('B6:O6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B6:O6')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->setCellValueByColumnAndRow(3, 6, "Facturar a:");
            $sheet->setCellValueByColumnAndRow(4, 6, $object->farm->farm->name_commercial);
            $sheet->getStyle('D6')->getFont()->setSize(16);
            $sheet->getStyle('D6')->getFont()->setBold(true);
            $sheet->getRowDimension('6')->setRowHeight(30);
            $sheet->getStyle('B7:O7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B7:O7')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('C8')->getFont()->setSize(10);
            $sheet->getStyle('C8')->getFont()->setBold(true);
            $sheet->getStyle('E8:M8')->getFont()->setSize(10);
            $sheet->getStyle('E8:M8')->getFont()->setBold(true);
            $sheet->setCellValueByColumnAndRow(3, 8, "Cliente");
            $sheet->setCellValueByColumnAndRow(4, 8, $object->marking->name_commercial);
            $sheet->setCellValueByColumnAndRow(13, 8, "Varios");
            $sheet->getStyle('B8:O8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B8:O8')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->setCellValueByColumnAndRow(3, 9, "FACTURA");
            $sheet->setCellValueByColumnAndRow(4, 9, "000");
            $sheet->setCellValueByColumnAndRow(13, 9, "Fecha UIO");
            $sheet->setCellValueByColumnAndRow(14, 9, "??");
            $sheet->getStyle('B9:O9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B9:O9')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('B10:O10')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B11:O11')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('B11:O11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('B10:O10')->getFill()->getStartColor()->setARGB('ffffff');
            $sheet->getStyle('B11:O11')->getFont()->setSize(12);
            $sheet->getStyle('B11:O11')->getFont()->setBold(true);
            $sheet->setCellValueByColumnAndRow(3, 11, "Cant Rosas");
            $sheet->setCellValueByColumnAndRow(4, 11, "Tamano");
            $sheet->setCellValueByColumnAndRow(5, 11, "Variedad");
            $sheet->mergeCells('F10:L10');
            $sheet->setCellValueByColumnAndRow(6, 11, "Descripción");
            $sheet->setCellValueByColumnAndRow(13, 11, "Precio");
            $sheet->setCellValueByColumnAndRow(14, 11, "TOTAL");
            $excel_row = 12;

            if (count($object->items) > 0) {
                $acumTotalStems = 0;
                $acumTotalPrice = 0;
                foreach ($object->items as $item) {
                    $acumTotalStems += (int)$item->qtyStems;
                    $priceTotal = (int)$item->qtyStems * (float) $item->itemSelected->price;
                    $acumTotalPrice += $priceTotal;
                    $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                    $sheet->getStyle('N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle('N' . $excel_row)->getFill()->getStartColor()->setARGB('FFFFCC');
                    $sheet->getStyle('B' . $excel_row . ':O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle('B' . $excel_row . ':O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                    $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFont()->setSize(10);
                    $sheet->getStyle('C' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
                    $sheet->getStyle('L' . $excel_row . ':N' . $excel_row)->getFont()->setBold(true);
                    $sheet->getStyle('B' . $excel_row . ':F' . $excel_row)->applyFromArray($styleLeft);
                    $sheet->getStyle('L' . $excel_row . ':N' . $excel_row)->applyFromArray($styleArray);
                    $sheet->setCellValueByColumnAndRow(3, $excel_row, $item->qtyStems);
                    $separado = explode(' ', $item->itemSelected->measures->name);
                    $size = $separado[0];
                    $sheet->setCellValueByColumnAndRow(4, $excel_row, $size);
                    $sheet->setCellValueByColumnAndRow(5, $excel_row, strtoupper($item->itemSelected->products->name));
                    $sheet->mergeCells('F' . $excel_row . ':L' . $excel_row);
                    $sheet->setCellValueByColumnAndRow(6, $excel_row, strtoupper($item->reasonCredit->reason));
                    $sheet->setCellValueByColumnAndRow(13, $excel_row, '$ ' . number_format((float) $item->itemSelected->price, 2));
                    $sheet->setCellValueByColumnAndRow(14, $excel_row, '$ ' . number_format($priceTotal));
                    $excel_row++;
                }
                $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('N' . $excel_row)->getFill()->getStartColor()->setARGB('FFFFCC');
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFont()->setSize(10);
                $sheet->getStyle('C' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
                $sheet->getStyle('L' . $excel_row . ':N' . $excel_row)->getFont()->setBold(true);
                $sheet->getStyle('B' . $excel_row . ':F' . $excel_row)->applyFromArray($styleLeft);
                $sheet->getStyle('L' . $excel_row . ':N' . $excel_row)->applyFromArray($styleArray);
                $sheet->setCellValueByColumnAndRow(3, $excel_row, $acumTotalStems);
                $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
                $sheet->setCellValueByColumnAndRow(5, $excel_row, '');
                $sheet->mergeCells('F' . $excel_row . ':L' . $excel_row);
                $sheet->setCellValueByColumnAndRow(6, $excel_row, '');
                $sheet->setCellValueByColumnAndRow(13, $excel_row, 'Subtotal');
                $sheet->setCellValueByColumnAndRow(14, $excel_row, '$ ' . number_format($acumTotalPrice));
                $excel_row++;
                $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('N' . $excel_row)->getFill()->getStartColor()->setARGB('FFFFCC');
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFont()->setSize(10);
                $sheet->getStyle('C' . $excel_row . ':E' . $excel_row)->getFont()->setBold(true);
                $sheet->getStyle('L' . $excel_row . ':N' . $excel_row)->getFont()->setBold(true);
                $sheet->setCellValueByColumnAndRow(3, $excel_row, '');
                $sheet->setCellValueByColumnAndRow(4, $excel_row, '');
                $sheet->setCellValueByColumnAndRow(5, $excel_row, '');
                $sheet->mergeCells('F' . $excel_row . ':L' . $excel_row);
                $sheet->setCellValueByColumnAndRow(6, $excel_row, '');
                $sheet->setCellValueByColumnAndRow(13, $excel_row, 'Envío  UIO-MOS');
                $sheet->setCellValueByColumnAndRow(14, $excel_row, '');
                $excel_row++;
                $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('N' . $excel_row)->getFill()->getStartColor()->setARGB('FFFFCC');
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $excel_row++;
                $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('N' . $excel_row)->getFill()->getStartColor()->setARGB('FFFFCC');
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $excel_row++;
                $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('N' . $excel_row)->getFill()->getStartColor()->setARGB('FFFFCC');
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('B' . $excel_row . ':M' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFont()->setSize(10);
                $sheet->getStyle('M' . $excel_row . ':N' . $excel_row)->getFont()->setBold(true);
                $sheet->getStyle('L' . $excel_row . ':N' . $excel_row)->applyFromArray($styleArray);
                $sheet->setCellValueByColumnAndRow(3, $excel_row, 'Comentarios');
                $sheet->mergeCells('D' . $excel_row . ':L' . $excel_row);
                $sheet->setCellValueByColumnAndRow(4, $excel_row, $object->description);
                $sheet->setCellValueByColumnAndRow(13, $excel_row, 'TOTAL');
                $sheet->setCellValueByColumnAndRow(14, $excel_row,  '$ ' . number_format($acumTotalPrice, 2));
                $excel_row++;
                $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getRowDimension($excel_row)->setRowHeight(50);
                $excel_row++;
                $sheet->getStyle('O' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('O' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->getFill()->getStartColor()->setARGB('ffffff');
                $sheet->getStyle('B' . $excel_row . ':N' . $excel_row)->applyFromArray($styleBoderBottom);
            }

            //Segunda hoha
            $spreadsheet->createSheet();
            $sheet = $spreadsheet->getSheet(1);
            $sheet->setTitle('FOTOS');
            foreach (range('A', 'C') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
            $excel_row = 1;
            if (count($object->images) > 0) {
                if (count($object->images) > 3) {
                    $arrImges = array_chunk($object->images, 3, true);
                } else {
                    $arrImges = $object->images;
                }
                $Celdas = ['A', 'B', 'C'];
                $y = 0;
                foreach ($arrImges as $arr) {
                    $pivote = 0;
                    $x = 0;
                    foreach ($arr as $item) {
                        $celda = $Celdas[$pivote] . (string)$excel_row;
                        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                        $drawing->setName('Luxus' . $item->img_id);
                        $drawing->setDescription('Luxus' . $item->img_id);
                        $drawing->setPath($item->img);
                        $drawing->setCoordinates($celda);
                        $drawing->setWorksheet($sheet);
                        $drawing->setOffsetX($x);
                        $drawing->setOffsetY($y);
                        $drawing->setHeight(300);
                        $x += 550;
                        $pivote++;
                    }
                    $y += 300;
                    $excel_row++;
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

            $nombreDelDocumento = "Credit-" . $object->credit_id . '-' . time() . ".xlsx";

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
