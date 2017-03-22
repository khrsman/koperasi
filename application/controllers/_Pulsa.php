<?php
class Pulsa extends CI_Controller {

	public function __construct()
	{
	        parent::__construct();
	        $this->load->model('datacell_model');
	        $this->load->model('datacell_transaction_model');
	        $this->session->set_userdata('referred_from', current_url());
	}


	function index(){
        $data['page'] = 'pulsa/pulsa_list_view';
        $this->load->view('main_view',$data);
	}


	function topup($provider=NULL){

		if (!is_login()) {
			redirect('masuk','REFRESH');
		}

		if ($provider==NULL) {
			redirect('pulsa');
		}

		$data['form_action'] = site_url('pulsa/topup_confirm');

		switch ($provider) {
			case 'indosat':
				$data['operator_id']	= 'INDOSAT';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);
				
				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'indosat.png';
				$data['provider_name'] 	= 'Indosat';
				
				break;
			case 'telkomsel':
				$data['operator_id']	= 'TELKOMSEL';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'telkomsel.png';
				$data['provider_name'] 	= 'Telkomsel';
				
				break;
			case 'xl':
				$data['operator_id']	= 'XL';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'XL.png';
				$data['provider_name'] 	= 'XL';
				
				break;
			case 'esia':
				$data['operator_id']	= 'ESIA';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'esia.png';
				$data['provider_name'] 	= 'Esia';
				
				break;
			case 'smartfren':
				$data['operator_id']	= 'SMART';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'smartfren.png';
				$data['provider_name'] 	= 'Smartfren';
				
				break;
			case 'flexi':
				$data['operator_id']	= 'FLEXI';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'flexi.png';
				$data['provider_name'] 	= 'Flexi';
				
				break;
			case 'axis':
				$data['operator_id']	= 'AXIS';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'axis.png';
				$data['provider_name'] 	= 'Axis';
				
				break;
			case 'tri':
				$data['operator_id']	= '3_THREE';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'3.png';
				$data['provider_name'] 	= 'Tri';
				
				break;

			case 'ceria':
				$data['operator_id']	= 'CERIA';
				$data['products']		= $this->datacell_model->get_vendor_price_by_id($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'3.png';
				$data['provider_name'] 	= 'Ceria';
				
				break;	
			
			default:
				redirect('pulsa');
				/*$data['page'] = "under_404";
				$this->load->view('main_view',$data);*/
				break;
		}
		$data['page'] = "pulsa/pulsa_topup_form_view";
		$this->load->view('main_view',$data);
        
	}


	function topup_confirm(){
		$post = $this->input->post();
		if (!isset($post['operator_id']) || !isset($post['operator_code']) || !is_login()) {
			redirect('pulsa');
		}

		$get_product = $this->datacell_model->get_vendor_price($post['operator_id'],$post['operator_code']);
		if ($get_product==FALSE) {
			$data['product'] = NULL;
		}else{
			$data['product'] = $get_product;
			$data['product']['phone_number'] 	= $post['phone_number'];
		}


		$data['provider_name'] 	= $post['provider_name'];
		$data['provider_logo'] 	= $post['provider_logo'];

		$data['form_action'] = site_url('pulsa/topup_transaction');
		$data['page'] 		 = "pulsa/pulsa_topup_confirm_form_view";
		$this->cache->clean();
		$this->load->view('main_view',$data);
	}

	function topup_transaction(){
		$post = $this->input->post();
		

		if (!isset($post['operator_id']) || !isset($post['operator_code']) || !isset($post['pin'])  || !is_login()) {
			redirect('pulsa');
		}

		$get_product = $this->datacell_model->get_vendor_price($post['operator_id'],$post['operator_code']);
		if ($get_product==FALSE) {
			return 'ERROR';
		}

		$service_user 	= $this->session->userdata('id_user');
		$service_action = 'insert';
		$trasaction_id 	= '16'.time();



		$data_insert = array(
			'no_transaksi_pulsa' 	=> $trasaction_id,
			'id_user' 				=> $this->session->userdata('id_user'),
			'id_operator' 			=> $post['operator_id'],
			'msisdn' 				=> $post['phone_number'],
			'kode_operator' 		=> $post['operator_code'],
			'tanggal_transaksi' 	=> date('Y-m-d H:i:s'),
			'keterangan' 			=> 'Gerai : '.$get_product['harga_gerai'].', Datacell : '.$get_product['harga_datacell'],
			'service_user'			=> $service_user,
			'service_action'		=> $service_action
			);
		/*$this->load->library('datacell_api');
        $data = array(
            'service_user' 	=> $service_user,
            'oprcode'   	=> $post['operator_code'],
            'msisdn'    	=> $post['no_hp'],
            'ref_trxid' 	=> $trasaction_id,
            );
        $request_charge = $this->datacell_api->charge($data);*/

        $insert = $this->datacell_transaction_model->insert($data_insert);
        $data_report['provider_name'] 	= $post['provider_name'];
		$data_report['provider_logo'] 	= $post['provider_logo'];
        $data_report['product'] 		= $get_product;
        $data_report['data_insert'] 	= $data_insert;
        if ($insert!=FALSE) {
            $data_report['flash_msg']      = TRUE;
            $data_report['flash_msg_type'] = "success";
            $data_report['flash_msg_status'] = TRUE;
            $data_report['flash_msg_text'] = "Transaksi Berhasil.";
            $this->session->set_userdata('report',$data_report);
            redirect('pulsa/topup_report');
        } else {
            $data_report['flash_msg']      = TRUE;
            $data_report['flash_msg_type'] = "danger";
            $data_report['flash_msg_status'] = FALSE;
            $data_report['flash_msg_text'] = "Transaksi Gagal.";
            $this->session->set_userdata('report',$data_report);
            // redirect('pulsa/topup_report');
        }
       
        $this->cache->clean();

	}

	function topup_report(){
		if (!$this->session->has_userdata('report')) {
			redirect('pulsa');
		}
		$report =  $this->session->userdata('report');
		$this->session->unset_userdata('report');
		// print_r($this->session->userdata('report'));

		$data['report'] = $report;
		
		$data['page'] 		 = "pulsa/pulsa_topup_report_form_view";
		$this->load->view('main_view',$data);
	}
	
}