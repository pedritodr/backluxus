<?php

class Request extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Request_model', 'request');
        $this->load->model('Product_model', 'product');

        $this->load->model('Request_product_box_model', 'request_product_box');
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

        $all_requests = $this->request->get_all_request();


        $data['all_requests'] = $all_requests;


        $this->load_view_admin_g("request/index", $data);
    }

    public function get_all()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $id = $this->input->post('id');

        $all_request = $this->request->get_all_request_by_id($id);
        foreach ($all_request as $item) {
            $item->box = $this->request_product_box->get_all_request_box_by_id($item->request_product_id);
            //   $item->measure = $this->variety->get_by_measure($item->variety_measure_id);
        }
        echo json_encode($all_request);
        exit();
    }
    public function get_provider_by_variety()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Provider_model', 'provider');

        $id = $this->input->post('id');

        $all_providers = $this->provider->get_all_providers_by_variety($id);

        echo json_encode($all_providers);
        exit();
    }


    public function add_buy_request_index($id)
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Buy_element_model', 'buy_element');


        $object_request = $this->request->get_by_id($id);

        if ($object_request) {

            $all_varieties = $this->request->get_all_request_variety_by_id($id);

            foreach ($all_varieties as $item) {
                $item->box = $this->request_product_box->get_all_request_box_by_id($item->request_product_id);
                $item->buy = $this->buy_element->get_buy_by_id($item->request_product_id);
            }

            $data['all_varieties'] = $all_varieties;

            $data['object_request'] = $object_request;
            // var_dump($data);
            // die();
            $this->load_view_admin_g("request/buy_request_index", $data);
        } else {
            show_404();
        }
    }

    public function add_buy()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_model', 'request');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');

        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');



        $request_variety_id = $this->input->post('request_variety_id');
        $buy_id = $this->input->post('buy_id');

        $date = date("y-m-d");
        $user_id = $this->session->userdata('user_id');

        //$data = [];
        $data = json_decode($_POST['array']);

        $object_request_variety = $this->request_product->get_by_id($request_variety_id);
        $object_buy = $this->buy->get_by_request_id($object_request_variety->request_id);


        if ($object_buy) {
            $buy = $object_buy->buy_id;
        } else {
            $data_buy = [
                'request_id' => $object_request_variety->request_id,
                'user_id' => $user_id
            ];

            $buy = $this->buy->create($data_buy);
        }



        for ($i = 0; $i < count($data); $i++) {
            $provider_id = $data[$i]->provider_id;
            $qty = $data[$i]->cantidad;
            $price = $data[$i]->precio;


            $data_buy_element = [
                'provider_id' => $provider_id,
                'qty' => $qty,
                'price' => $price,
                'request_product_id' => $request_variety_id,
                'buy_id' => $buy,
                'date' => $date
            ];
            $buy_element = $this->buy_element->create($data_buy_element);
        }


        /*   $all_varieties = $this->request->get_all_request_variety_by_id( $object_request_variety->request_id);
        foreach ($all_varieties as $item) {
            $item->buy = $this->buy_element->get_buy_by_id($item->request_variety_id);

        }*/
        //  $this->request_variety->update($request_variety_id, $data);
        $this->response->set_message("compra realizada correctamente", ResponseMessage::SUCCESS);

        echo json_encode($buy_element);
        exit();
    }

    public function get_all_buy()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Product_model', 'product');

        $this->load->model('Request_product_model', 'request_product');

        $id = $this->input->post('id');


        $all_request = $this->request_product->get_by_id_request($id);
        /* foreach ($all_request as $item) {
            $item->box = $this->request_variety_box->get_all_request_box_by_id($item->request_variety_id);
            $item->variety = $this->variety->get_by_id($item->variety_id);
        }*/
        echo json_encode($all_request);
        exit();
    }

    function export_excel()
    {
        $this->load->library("excel");
        $object = new PHPExcel();
        $this->load->model('Request_product_model', 'request_product');
        $id = $this->input->post('id');
        $all_request = $this->request_product->get_by_id_request($id);

        // $object->setActiveSheetIndex(0);
        $object->setActiveSheetIndex(0)->mergeCells('A3:H3');
        //  $object->setActiveSheetIndex(0)->mergeCells('A2:B2');

        $object->getActiveSheet()->setCellValueByColumnAndRow('A3', 3, $all_request[0]->purchase_order);
        $object->getActiveSheet()->getStyle('A3:H3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $object->getActiveSheet()->getStyle('A4:H4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //  $object->getActiveSheet()->getStyle('A3:H3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);





        $object->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);
        $table_columns = array("FINCA", "VARIEDAD", "MEDIDA", "CAJAS", "TIPO DE CAJAS", "TALLOS", "MARCACION", "DESTINO");
        //  $object->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);



        // $object->getActiveSheet()->getStyle('A2:I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        // $object->getActiveSheet()->getStyle('A2:I2')->getFill()->getStartColor()->setARGB('29bb04');
        // Add some data


        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'H'; $col++) {
            $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $estilo = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //  $object->getActiveSheet()->getStyle('A2:J2')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:H4')->applyFromArray($estilo);


        // $object->getActiveSheet()->getStyle("A2:H2")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A3:H3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:H4")->getFont()->setBold(true);



        $excel_row = 5;
        $total_box = 0;
        foreach ($all_request as $item) {

            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);

            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->product);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->measure);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->qty_buy);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $item->box_type);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $item->total_steams);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $item->dialing);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $item->destination);




            $total_box = $total_box + $item->qty_buy;

            $excel_row++;
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "TOTAL: " . $total_box . " CAJAS");
        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);



        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Compra.xls"');
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }

    public function export_pdf()
    {
        $this->load->model('Request_product_model', 'request_product');
        $id = $this->input->post('id2');

        $all_request = $this->request->get_all_request_by_id($id);
        foreach ($all_request as $item) {
            $item->box = $this->request_product_box->get_all_request_box_by_id($item->request_product_id);
            // $item->measure = $this->variety->get_by_measure($item->variety_measure_id);
        }

        $data['all_request'] =  $all_request;
        $hoy = date("dmyhis");

        //load the view and saved it into $html variable
        /*  $html =
            "<style>@page {
			    margin-top: 0.5cm;
			    margin-bottom: 0.5cm;
			    margin-left: 0.5cm;
			    margin-right: 0.5cm;
			}
			</style>" .
            "<body><div style='margin-left: 100px; margin-right: 100px;'><div style='width: 355px; height:auto; float: left;'><img id='logo_cliente' style='width: 355px; height:100px;' class='img img-rounded img-responsive' src=' />" .
            "<h2>Orden de Compra</h2><div style=' background-color: #f4f4f4; width: 355px; height:auto;'><strong><p id='cliente_name'>Pedro Duran</p>" .
            "</strong><strong>Fecha de recepcion:</strong<p id='fecha_pedido'>20/14/2050</p></div'</div><div style=' background-color: #f4f4f4; width: 355px; height:auto; float: right;'>" .
            "<p id='nro_orden'><strong>Nro de orden:</strong>PO20188901 </p><p id='fecha_pedido'><strong>Fecha de la orden:</strong>20/12/2099</p><div style='padding:18px; background-color: #ffffff; width: 355px; height:auto;'>" .
            "</div><div style='background-color: #f4f4f4; width: 355px; height:auto;'><strong>Direccion:</strong><p id='direccion'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate iure nisi sunt, obcaecatiexplicabo reiciendis officia eligendi dicta minus illum perspiciatis animi pariatur quis! Molestias harum similique voluptate laudantium quae.</p></div></div>" .
            "<div style=' background-color: #f4f4f4; width: 85.5%; height:auto;position: absolute; bottom: 300px;'><table id='tabla' class='table'><thead><tr><th style='width:350px;'>Variedad</th> <th style='width:150px;'>Unidad</th><th style='width:180px;' class='text-center'>Tipo de caja</th><th class='text-center' style='width:150px;'>Destino</th><th style='width:150px;'>Marcación</th>" .
            "<th style='width:150px;'>Cantidad</th><th -style='width:160px;'>Precio por unidad</th><th style='width:180px;'>Total precio</th></tr></thead><tbody id='cuerpo'></tbody><tfoot><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td> <td style='width:150px;'><strong><h4>Total</h4></strong><h3 id='totales'></h3></td><td class='text-right'></td></tr><tr></tr></tfoot></table></div></div></body>";
*/
        $html = $this->load->view('request/pdf', $data, true);

        //$html="asdf";
        //this the the PDF filename that user will get to download
        $pdfFilePath = "Dimention_flowers_PO.pdf";

        //load mPDF library
        $this->load->library('M_pdf');
        $mpdf = new mPDF('c', 'A4-L');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, "D");
        // //generate the PDF from the given html
        //  $this->m_pdf->pdf->WriteHTML($html);

        //  //download it.
        //  $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    public function provider_index($id = 0)
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');



        $all_request = $this->buy->get_by_request_id2($id);
        foreach ($all_request as $item) {
            $item->provider = $this->buy_element->get_element_by_provider_id($item->request_id);
            $item->invoice_provider = $this->invoice_provider->get_by_id($item->provider_id, $item->buy_id);
        }

        $data['all_request'] = $all_request;


        $this->load_view_admin_g("request/provider_index", $data);
    }
    public function confirmar_factura($id = 0)
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }


        $this->load->model('Buy_element_model', 'buy_element');

        $all_buy_element   = $this->buy_element->get_element_by_provider_id($id);

        //var_dump($all_buy_element);
        //  die();
        $data['all_buy_element'] = $all_buy_element;


        $this->load_view_admin_g("request/index_factura_provider", $data);
    }
    public function confirmar_factura_ajax()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');

        $this->load->model('Buy_element_model', 'buy_element');

        $all_buy_element   = $this->buy_element->get_element_by_provider_id($id);

        //var_dump($all_request);
        //   die();
        echo json_encode($all_buy_element);
        exit();
    }
    public function update_request()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $data = ['state' => 1];
        $request_id = $this->input->post('request_id');
        $row = $this->request->update($request_id, $data);

        echo json_encode($row);
        exit();
    }
    public function update_buy_element()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Pending_model', 'pending');
        $this->load->model('buy_model', 'buy');



        $buy_element_id = $this->input->post('buy_element_id');
        $provider_id = $this->input->post('provider_id');
        $reason = $this->input->post('reason');
        $qty = (int) $this->input->post('qty');
        $price = (float) $this->input->post('precio');


        $object_buy_element = $this->buy_element->get_by_id($buy_element_id);

        $object_buy = $this->buy->get_by_id($object_buy_element->buy_id);
        $request_id = $object_buy->request_id;
        if ($object_buy_element) {

            if ($qty == $object_buy_element->qty) {
                $data_buy_element = [
                    'price' => $price
                ];
                $this->buy_element->update($buy_element_id, $data_buy_element);
            } else {

                if ($qty > 0) {
                    $cantidad_pendiente = $object_buy_element->qty - $qty;
                    $data_pending = [
                        'provider_id' => $provider_id,
                        'qty' => $cantidad_pendiente,
                        'request_id' =>  $object_buy->request_id,
                        'reason' =>  $reason

                    ];

                    $this->pending->create($data_pending);
                    $data_buy_element = [
                        'qty' => $qty,
                        'price' => $price
                    ];
                    $this->buy_element->update($buy_element_id, $data_buy_element);
                    $object_request_variety = $this->request_product->get_by_id($object_buy_element->request_product_id);
                    $object_request_variety_box = $this->request_product_box->get_by_box_id($object_buy_element->request_product_id);

                    $cantidad_cajas =  $object_request_variety_box->qty - $cantidad_pendiente;
                    $data_box = ['qty' => $cantidad_cajas];
                    $this->request_product_box->update($object_request_variety_box->request_product_box_id, $data_box);
                    $precio_total = $cantidad_cajas *  $object_request_variety->unit_price;
                    $data_request_variety = ['total_price' => $precio_total];
                    $this->request_product->update($object_buy_element->request_product_id, $data_request_variety);
                    //actualiza el buy element
                    //result es la cantidad pendiente
                } elseif ($qty == 0) {
                    $cantidad_pendiente = $object_buy_element->qty;
                    $data_pending = [
                        'provider_id' => $provider_id,
                        'qty' => $cantidad_pendiente,
                        'request_id' =>  $object_buy->request_id,
                        'reason' =>  $reason
                    ];

                    $this->pending->create($data_pending);

                    $this->buy_element->delete($buy_element_id);
                    $object_request_variety_box = $this->request_product_box->get_by_box_id($object_buy_element->request_product_id);
                    $cantidad_box = $object_request_variety_box->qty - $cantidad_pendiente;
                    if ($cantidad_box > 0) {
                        $object_request_variety = $this->request_product->get_by_id($object_buy_element->request_product_id);
                        $data_box = ['qty' => $cantidad_box];
                        $this->request_product_box->update($object_request_variety_box->request_product_box_id, $data_box);
                        $precio_total = $cantidad_box *  $object_request_variety->unit_price;
                        $data_request_variety = ['total_price' => $precio_total];
                        $this->request_product->update($object_buy_element->request_product_id, $data_request_variety);
                    } elseif ($cantidad_box == 0) {
                        $this->request_product_box->delete($object_request_variety_box->request_product_box_id);
                        $this->request_product->delete($object_request_variety_box->request_product_id);
                    }

                    //elimina el buy element
                }
            }
        }
        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id, "location", 301);
    }
    public function confirmar_invoice()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Request_model', 'request');


        $nro_invoice = $this->input->post('nro_invoice');
        $provider_id = $this->input->post('provider_id');
        $buy_id = $this->input->post('buy_id');
        $object_buy = $this->buy->get_by_id($buy_id);
        $data = [
            'provider_id' => $provider_id,
            'nro_invoice' =>  $nro_invoice,
            'buy_id' => $buy_id
        ];
        $data_request = [
            'state' => 2
        ];
        $this->request->update($object_buy->request_id, $data_request);
        $this->invoice_provider->create($data);
        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("request/provider_index/" . $provider_id, "location", 301);
    }

    function exportar_factura_provider($provider_id = 0, $buy_id)
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');

        // $all_request = $this->buy->get_by_request_id2($id);

        // $item->provider = $this->buy_element->get_element_by_provider_id($item->request_id);
        $invoice_provider = $this->invoice_provider->get_all_invoice($provider_id, $buy_id);

        //var_dump($invoice_provider);
        //die();


        /*$all_request = $this->buy->get_by_request_factura($id);

        foreach ($all_request as $item) {
            $item->invoice_provider = $this->invoice_provider->get_by_id($item->provider_id, $item->buy_id);
        }*/


        // $object->setActiveSheetIndex(0);
        $object->setActiveSheetIndex(0)->mergeCells('A3:F3');
        //  $object->setActiveSheetIndex(0)->mergeCells('A2:B2');

        $object->getActiveSheet()->setCellValueByColumnAndRow('A', 3, "Finca: " . $invoice_provider[0]->provider);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, "Nro invoice: " . $invoice_provider[0]->nro_invoice);
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, 4, "PO: " . $invoice_provider[0]->purchase_order);

        $object->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
        $table_columns = array("VARIEDAD", "MEDIDA/PESO", "TALLOS", "NRO CAJAS", "PRECIO", "TOTAL");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'F'; $col++) {
            $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $estilo = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('A3:F3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:F4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F5')->applyFromArray($estilo);

        $object->getActiveSheet()->getStyle("A3:F3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:F4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:F5")->getFont()->setBold(true);

        $excel_row = 6;
        $total = 0;
        foreach ($invoice_provider as $item) {

            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);


            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->product);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->measure);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->total_steams);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->qty);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $item->price);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,  $item->qty * $item->price);

            $total = $total + ($item->qty * $item->price);

            $excel_row++;
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "TOTAL = " . $total);
        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Factura por finca.xls"');
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }
    public function exportar_factura($id = 0)
    {
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');



        $all_request = $this->buy->get_by_request_id2($id);
        foreach ($all_request as $item) {
            $item->provider = $this->buy_element->get_element_by_provider_id($item->request_id);
            $item->invoice_provider = $this->invoice_provider->get_by_id($item->provider_id, $item->buy_id);
        }
        var_dump($all_request);
        die();
        $data['all_request'] = $all_request;

        $html = $this->load->view('request/factura_pdf', $data, true);

        $pdfFilePath = "Dimention_flowers_PO.pdf";

        //load mPDF library
        $this->load->library('M_pdf');
        $mpdf = new mPDF('c', 'A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, "D");
    }
}
