<?php

class Cron extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->helper("mabuya");
		//@session_start();
		//$this->load_language();
		$this->init_form_validation();
	}
	public function generate_invoice_farm()
	{
		ini_set('max_execution_time', '0');
		$this->load->model('Fixed_orders_model', 'fixed_orders');
		$this->load->model('Invoice_farm_model', 'invoice_farm');
		$date = date('Y-m-d');
		$dayNumber = date('l-d', strtotime($date));
		$separado = explode('-', $dayNumber);
		$day = $separado[0];
		$numberDay = 0;
		if ($day == 'Monday') {
			$numberDay = 1;
		} else if ($day == 'Tuesday') {
			$numberDay = 2;
		} else if ($day == 'Wednesday') {
			$numberDay = 3;
		} else if ($day == 'Thursday') {
			$numberDay = 4;
		} else if ($day == 'Friday') {
			$numberDay = 5;
		} else if ($day == 'Saturday') {
			$numberDay = 6;
		} else {
			$numberDay = 7;
		}
		$all_fixed_orders = $this->fixed_orders->get_all(['is_active' => 1, 'dayCreate' => $numberDay]);
		foreach ($all_fixed_orders as $item) {
			$awb = '';
			$invoice_number = $item->invoice_number;
			$dispatch = $this->dispatchDayDate($numberDay, $item->dispatch_day);
			$farms = $item->farms;
			$markings = $item->markings;
			$arrayRequest =  $item->details;
			$invoice_farm = 'invoice_farm' . uniqid();
			$date_create = date("Y-m-d H:i:s");
			$data_invoice = [
				'invoice_farm' => $invoice_farm,
				'invoice_number' => $invoice_number,
				'dispatch_day' => $dispatch,
				'awb' => $awb,
				'markings' => $markings,
				'farms' => $farms,
				'details' => $arrayRequest,
				'status' => 0,
				'date_create' => $date_create,
				'timestamp' => strtotime($date_create)
			];
			$this->invoice_farm->create($data_invoice);
		}
		$this->sendEmail();
	}
	public function sendEmail()
	{
		ini_set('max_execution_time', '0');
		$this->load->library('email');
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.zoho.com';
		$config['smtp_user'] = 'pedro@datalabcenter.com';
		$config['smtp_pass'] = "01420109811";
		$config['smtp_port'] = '465';
		$config['smtp_crypto'] = 'ssl';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$html = "Crontab de crear ordenes completado date:" . date("Y-m-d H:i:s");
		$this->email->from('pedro@datalabcenter.com');
		$this->email->from('pedro@datalabcenter.com', 'Info');

		$this->email->to('pedroduran014@gmail.com');
		$this->email->subject("Crontab ejecutado correctamente");
		$this->email->message($html);
		$this->email->send();
	}
	public function dispatchDayDate($numberDay, $dispatchDay)
	{
		$dateDispatchDay = '';
		$date = date('Y-m-d');
		if ($numberDay == 1 && $dispatchDay == 1) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 7 days"));
		} else if ($numberDay == 1 && $dispatchDay == 2) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 1 days"));
		} else if ($numberDay == 1 && $dispatchDay == 3) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 2 days"));
		} else if ($numberDay == 1 && $dispatchDay == 4) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 3 days"));
		} else if ($numberDay == 1 && $dispatchDay == 5) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 4 days"));
		} else if ($numberDay == 1 && $dispatchDay == 6) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 5 days"));
		} else if ($numberDay == 1 && $dispatchDay == 7) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 6 days"));
		} else if ($numberDay == 2 && $dispatchDay == 1) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 6 days"));
		} else if ($numberDay == 2 && $dispatchDay == 2) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 7 days"));
		} else if ($numberDay == 2 && $dispatchDay == 3) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 1 days"));
		} else if ($numberDay == 2 && $dispatchDay == 4) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 2 days"));
		} else if ($numberDay == 2 && $dispatchDay == 5) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 3 days"));
		} else if ($numberDay == 2 && $dispatchDay == 6) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 4 days"));
		} else if ($numberDay == 2 && $dispatchDay == 7) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 5 days"));
		} else if ($numberDay == 3 && $dispatchDay == 1) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 5 days"));
		} else if ($numberDay == 3 && $dispatchDay == 2) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 6 days"));
		} else if ($numberDay == 3 && $dispatchDay == 3) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 7 days"));
		} else if ($numberDay == 3 && $dispatchDay == 4) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 1 days"));
		} else if ($numberDay == 3 && $dispatchDay == 5) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 2 days"));
		} else if ($numberDay == 3 && $dispatchDay == 6) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 3 days"));
		} else if ($numberDay == 3 && $dispatchDay == 7) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 4 days"));
		} else if ($numberDay == 4 && $dispatchDay == 1) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 4 days"));
		} else if ($numberDay == 4 && $dispatchDay == 2) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 5 days"));
		} else if ($numberDay == 4 && $dispatchDay == 3) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 6 days"));
		} else if ($numberDay == 4 && $dispatchDay == 4) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 7 days"));
		} else if ($numberDay == 4 && $dispatchDay == 5) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 1 days"));
		} else if ($numberDay == 4 && $dispatchDay == 6) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 2 days"));
		} else if ($numberDay == 4 && $dispatchDay == 7) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 3 days"));
		} else if ($numberDay == 5 && $dispatchDay == 1) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 3 days"));
		} else if ($numberDay == 5 && $dispatchDay == 2) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 4 days"));
		} else if ($numberDay == 5 && $dispatchDay == 3) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 5 days"));
		} else if ($numberDay == 5 && $dispatchDay == 4) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 6 days"));
		} else if ($numberDay == 5 && $dispatchDay == 5) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 7 days"));
		} else if ($numberDay == 5 && $dispatchDay == 6) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 1 days"));
		} else if ($numberDay == 5 && $dispatchDay == 7) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 2 days"));
		} else if ($numberDay == 6 && $dispatchDay == 1) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 2 days"));
		} else if ($numberDay == 6 && $dispatchDay == 2) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 3 days"));
		} else if ($numberDay == 6 && $dispatchDay == 3) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 4 days"));
		} else if ($numberDay == 6 && $dispatchDay == 4) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 5 days"));
		} else if ($numberDay == 6 && $dispatchDay == 5) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 6 days"));
		} else if ($numberDay == 6 && $dispatchDay == 6) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 7 days"));
		} else if ($numberDay == 6 && $dispatchDay == 7) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 1 days"));
		} else if ($numberDay == 7 && $dispatchDay == 1) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 1 days"));
		} else if ($numberDay == 7 && $dispatchDay == 2) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 2 days"));
		} else if ($numberDay == 7 && $dispatchDay == 3) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 3 days"));
		} else if ($numberDay == 7 && $dispatchDay == 4) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 4 days"));
		} else if ($numberDay == 7 && $dispatchDay == 5) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 5 days"));
		} else if ($numberDay == 7 && $dispatchDay == 6) {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 6 days"));
		} else {
			$dateDispatchDay = date("d-m-Y", strtotime($date . "+ 7 days"));
		}

		return $dateDispatchDay;
	}
}
