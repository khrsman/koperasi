<?php

class Pembayaran extends CI_Controller {


	public function __construct()

	{
        parent::__construct();
        $this->load->model('datacell_model');
        $this->load->model('datacell_transaction_model');
        $this->load->helper('core_banking_helper');
        $this->session->set_userdata('referred_from', current_url());
	}



	function index(){
        $data['page'] = 'pembayaran/pembayaran_list_view';
        $this->load->view('main_view',$data);
	}

	function charge($provider=NULL){

		if (!is_login()) {
			redirect('masuk','REFRESH');
		}

		if (!has_koperasi()) {
			$data['page'] = "auth/404_koperasi_view";
		}

		if ($provider==NULL) {
			redirect('gerai/pembayaran');
		}

		$data['form_action'] = site_url().'gerai/pembayaran/charge/'.$this->uri->segment(4);

		switch ($provider) {
			case 'pln_prabayar':
				$data['operator_id']	= 'pln_prabayar';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider/pembayaran').'/'.'listrikprabayar.png';
				$data['provider_name'] 	= 'Listrik PLN Prabayar';

				$data['page'] = "pembayaran/pembayaran_pln_prabayar_charge_form_view";
				break;
			
			case 'pln_pascabayar':
				$data['operator_id']	= 'pln_pascabayar';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider/pembayaran').'/'.'pln.png';
				$data['provider_name'] 	= 'PLN Pascabayar';

				$data['page'] = "pembayaran/pembayaran_pln_pascabayar_charge_form_view";
				break;
			
			default:
				redirect('gerai/pembayaran');
				break;
		}

		$this->load->view('main_view',$data);
	}

	function charge_confirm(){

	} 

	function charge_report(){
		if (!$this->session->has_userdata('report')) {
			redirect('gerai/pembayaran');
		}

		$report =  $this->session->userdata('report');
		$this->session->unset_userdata('report');

		$data['report'] = $report;

		$data['page'] 		 = "pembayaran/pembayaran_charge_report_form_view";
		$this->load->view('main_view',$data);
	}

	

}