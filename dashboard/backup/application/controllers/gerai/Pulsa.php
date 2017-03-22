<?php

class Pulsa extends CI_Controller {


	public function __construct()

	{
        parent::__construct();
        $this->load->model('datacell_model');
        $this->load->model('datacell_transaction_model');
        $this->load->helper('core_banking_helper');
        $this->session->set_userdata('referred_from', current_url());
	}



	function index(){
		
		/*$this->load->library('datacell_api');
		$data = array(
			'oprcode'		=> 'IR.10',
			'msisdn' 		=> '085624137383',
			'ref_trxid' 	=> '12345',
			'service_user' 	=> '54312',
			);

		$charge = $this->datacell_api->charge($data);
        print_r($charge);*/

		/*$this->load->library('core_banking_api');
		$id_user 			= '91459698104';
		$total_debit 		= '1500';
		$kode_transaksi 	= 'GERAI';
		$jenis_transaksi 	= 'TOPUP PULSA IM3';
		$debet = $this->core_banking_api->debit_virtual_account($id_user,$total_debit,$kode_transaksi,$jenis_transaksi);
		print_r($debet);*/


		/*$this->load->library('core_banking_api');
		$id_user 			= '91459698104';
		$total_point 		= '1000';
		$sumber_dana 		= 'GERAI';
		$jenis_transaksi 	= 'TOPUP PULSA IM3';
		$deposit = $this->core_banking_api->deposit_loyalty_account($id_user,$total_point,$sumber_dana,$jenis_transaksi);
		print_r($deposit);*/

        $data['page'] = 'pulsa/pulsa_list_view';
        $this->load->view('main_view',$data);
	}


	function topup($provider=NULL){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('phone_number','Nomor Telepon', 'required|xss_clean|numeric|min_length[10]|max_length[12]');

		if($this->form_validation->run() == FALSE){

			if (!is_login()) {
				redirect('masuk','REFRESH');
			}

			if (!has_koperasi()) {
				$data['page'] = "auth/404_koperasi_view";
			}else{
				$data['page'] = "pulsa/pulsa_topup_form_view";
			}

			if ($provider==NULL) {
				redirect('gerai/pulsa');
			}


			$data['form_action'] = site_url().'gerai/pulsa/topup/'.$this->uri->segment(4);

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

					redirect('gerai/pulsa');

					/*$data['page'] = "under_404";
					$this->load->view('main_view',$data);*/

					break;

			}

			$this->load->view('main_view',$data);

		}
		else {
			$post = $this->input->post();
			$this->session->set_flashdata('pulsa', $post);
			redirect(base_url()."gerai/pulsa/topup_confirm", 'REFRESH');
		}

		
	}


	function is_pin_valid(){
		$pin = $this->input->post('pin');
		$valid = is_pin_valid($pin); //AUTH HELPER
		if ($valid==TRUE) {
			return TRUE;
		}else{
			$this->form_validation->set_message('is_pin_valid', 'PIN yang anda masukan salah.');
			return FALSE;
		}
	}


	function topup_confirm(){


		$this->load->library('form_validation');
		$this->form_validation->set_rules('pin', 'pin', 'required|xss_clean|numeric|callback_is_pin_valid');
		$this->form_validation->set_rules('provider_name', 'provider_name', 'required|xss_clean');
		$this->form_validation->set_rules('provider_logo', 'provider_logo', 'required|xss_clean');
		$this->form_validation->set_rules('phone_number', 'phone_number', 'required|xss_clean');
		$this->form_validation->set_rules('operator_id', 'operator_id', 'required|xss_clean');
		$this->form_validation->set_rules('operator_code', 'operator_code', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			
			$post = $this->session->flashdata('pulsa');
			$this->session->set_flashdata('pulsa', $post);
			
			if (!isset($post)) {
				$post = $this->input->post();
			}
			
			if (!isset($post['operator_id']) || !isset($post['operator_code']) || !is_login()) {
				redirect('gerai/pulsa');
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

			$data['form_action'] = site_url('gerai/pulsa/topup_confirm');
			$data['page'] 		 = "pulsa/pulsa_topup_confirm_form_view";
			
			$this->load->view('main_view',$data);
			
		}
		else
		{

			$post = $this->input->post();
			if (!isset($post['operator_id']) || !isset($post['operator_code']) || !isset($post['pin'])  || !is_login()) {
				redirect('gerai/pulsa');
			}

			$get_product = $this->datacell_model->get_vendor_price($post['operator_id'],$post['operator_code']);
			if ($get_product==FALSE) {
				redirect('gerai/pulsa');
			}

			$service_user 	= $this->session->userdata('id_user');
			$service_action = 'INSERT';
			$trasaction_id 	= '8'.time();

			$data_insert = array(
				'no_transaksi_pulsa' 	=> $trasaction_id,
				'id_user' 				=> $this->session->userdata('id_user'),
				'id_operator' 			=> $post['operator_id'],
				'msisdn' 				=> $post['phone_number'],
				'kode_operator' 		=> $post['operator_code'],
				'tanggal_transaksi' 	=> date('Y-m-d H:i:s'),
				'keterangan' 			=> 'Gerai : '.$get_product['harga_gerai'].', Datacell : '.$get_product['harga_datacell'],
				'harga_datacell'		=> $get_product['harga_datacell'],
				'harga_gerai'			=> $get_product['harga_gerai'],
				'service_time'			=> date('Y-m-d H:i:s'),
				'service_user'			=> $service_user,
				'service_action'		=> $service_action
				);

			$this->load->library('datacell_api');

	        $data = array(
	            'service_user' 	=> $service_user,
	            'oprcode'   	=> $post['operator_code'],
	            'msisdn'    	=> $post['phone_number'],
	            'ref_trxid' 	=> $trasaction_id,
	            );

	        $data_report['provider_name'] 	= $post['provider_name'];
			$data_report['provider_logo'] 	= $post['provider_logo'];
	        $data_report['product'] 		= $get_product;
	        $data_report['data_insert'] 	= $data_insert;

	        // REQUEST KE DATACELL
	        $request_charge = $this->datacell_api->charge($data);

	        if ($request_charge==FALSE) {
	        	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal.Datacell Connection Error.";
	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/pulsa/topup_report');
	        }else{
	        	$this->load->library('core_banking_api');
				$id_user 			= $this->session->userdata('id_user');
				$total_debit 		= $get_product['harga_gerai'];
				$kode_transaksi 	= 'GERAI';
				$jenis_transaksi 	= 'TOPUP PULSA '.$post['operator_code'];
				$debet_virtual_account = $this->core_banking_api->debit_virtual_account($id_user,$total_debit,$kode_transaksi,$jenis_transaksi);
				
				// REQUEST KE DATACELL BERHASIL. DEBET VIRTUAL ACCOUNT
				if ($debet_virtual_account['status']!=FALSE) {
					$total_point 		= $get_product['harga_gerai']-$get_product['harga_datacell'];
					$sumber_dana 		= 'GERAI';
					
					// DEBET VIRTUAL ACCOUNT BERHASIL. DEPOSIT POINT LOYALTI
					$deposit_loyalty = $this->core_banking_api->deposit_loyalty_account($id_user,$total_point,$sumber_dana,$jenis_transaksi);

					if ($deposit_loyalty['status']!=FALSE) {
						
						// DEPOSTI LOYALTI BERHASIL. INSERT TRANSAKSI GERAI
						$insert = $this->datacell_transaction_model->insert($data_insert);

				        if ($insert!=FALSE) {
				        	// INSERT TRANSAKSI GERAI BERHASIL
				            $data_report['flash_msg']			= TRUE;
				            $data_report['flash_msg_type'] 		= "success";
				            $data_report['flash_msg_status'] 	= TRUE;
				            $data_report['flash_msg_text']		= "Transaksi Berhasil.".$debet_virtual_account['message'];
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/pulsa/topup_report');

				        } else {
				            $data_report['flash_msg']        = TRUE;
				            $data_report['flash_msg_type'] 	 = "danger";
				            $data_report['flash_msg_status'] = FALSE;
				            $data_report['flash_msg_text']   = "Transaksi Gagal.";
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/pulsa/topup_report');
				        }

					}else{
						$data_report['flash_msg']        = TRUE;
			            $data_report['flash_msg_type'] 	 = "danger";
			            $data_report['flash_msg_status'] = FALSE;
			            $data_report['flash_msg_text']   = "Transaksi Gagal.".$deposit_loyalty['message'];
			            $this->session->set_userdata('report',$data_report);
			            redirect('gerai/pulsa/topup_report');
					}
					

				}else{
					$data_report['flash_msg']        = TRUE;
		            $data_report['flash_msg_type'] 	 = "danger";
		            $data_report['flash_msg_status'] = FALSE;
		            $data_report['flash_msg_text']   = "Transaksi Gagal.".$debet_virtual_account['message'];
		            $this->session->set_userdata('report',$data_report);
		            redirect('gerai/pulsa/topup_report');
				}

	        	
	        }

	        $this->cache->clean();
		}

		

	}



	function topup_report(){

		if (!$this->session->has_userdata('report')) {
			redirect('gerai/pulsa');
		}

		$report =  $this->session->userdata('report');
		$this->session->unset_userdata('report');

		$data['report'] = $report;

		$data['page'] 		 = "pulsa/pulsa_topup_report_form_view";
		$this->load->view('main_view',$data);

	}

	

}