<?php

class Pln_pasca extends CI_Controller {


	public function __construct()
	{
        parent::__construct();
        $this->load->model('datacell_model');
        $this->load->model('datacell_transaction_model');
        $this->load->helper('core_banking_helper');
        $this->session->set_userdata('referred_from', current_url());
	}



	function index(){
        $this->charge();
	}

	function charge(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_pelanggan','ID Pelanggan', 'required|xss_clean|numeric');

		if($this->form_validation->run() == FALSE){
			if (!is_login()) {
				redirect('login','REFRESH');
			}

			if (!has_koperasi()) {
				$data['page'] = "auth/404_koperasi_view";
			}

			$data['form_action'] 	= site_url().'gerai/listrik/pln_pasca';

			$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider/pembayaran').'/'.'pln.png';
			$data['provider_name'] 	= 'Listrik PLN Pasca Bayar';

			$data['page'] = "pembayaran/pln_pasca/pln_pasca_charge_form_view";

			$this->load->view('main_view',$data);

		}else{
			$post = $this->input->post();
			$this->session->set_flashdata('pembayaran', $post);
			redirect('gerai/listrik/pln_pasca/confirm', 'REFRESH');
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



	// PLN PASCABAYAR

	function confirm(){
		$this->session->unset_userdata('report');
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pin', 'pin', 'required|xss_clean|numeric|callback_is_pin_valid');
		$this->form_validation->set_rules('provider_name', 'provider_name', 'required|xss_clean');
		$this->form_validation->set_rules('provider_logo', 'provider_logo', 'required|xss_clean');
		$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'required|numeric|xss_clean');

		$service_user 	= $this->session->userdata('id_user');
		$service_action = 'INSERT';
		$trasaction_id 	= '6'.time();

		$operator_id 	= 'BAYAR_PLN';
		$operator_code 	= 'BAYAR.PLN';
		
		$this->load->library('datacell_api');

		if ($this->form_validation->run() == FALSE)
		{
			
			$post = $this->session->flashdata('pembayaran');
			
			if (!isset($post)) {
				$post = $this->input->post();
			}

			if (!isset($post['submit'])) {
				redirect('gerai/pembayaran');
			}
			
			
			if (!is_login()) {
				redirect('login');
			}

			$get_product = $this->datacell_model->get_vendor_price($operator_id,$operator_code);
			if ($get_product==FALSE) {
				redirect('gerai/pembayaran');
			}elseif($get_product['harga_gerai']<=$get_product['harga_datacell']){
				redirect('gerai/pembayaran');
			}

			// Ini hapus aja
			$data_pln = array(
	            'service_user' 	=> $service_user,
	            'oprcode'   	=> 'CEK.PLN',
	            'msisdn'    	=> $post['id_pelanggan'],
	            'ref_trxid' 	=> $trasaction_id,
	            );

			
			// REQUEST CEK PLN KE DATACELL
	        $request_charge = $this->datacell_api->charge($data_pln);
	        if ($request_charge==FALSE) {
	        	# SERVER CENTRAL ERROR. Redirect ke Report
	        	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal.Datacell Connection Error.";
	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/listrik/pln_pasca');
	        }else{
	        	$response_raw = $request_charge['message'];
	        	# Olah data response 
	        	$response = explode('a/n', $response_raw);
	        	$response = explode($post['id_pelanggan'], $response[1]);
	        	$nama_pelanggan = trim($response[0]);
	        	$post['nama_pelanggan'] = $nama_pelanggan;

	        	$response = explode('sebesar', $response_raw);
	        	$response = explode('.Untuk', $response[1]);
	        	$jumlah_tagihan = trim($response[0]);
	        	$post['jumlah_tagihan'] = $jumlah_tagihan;

	        	$post['biaya_admin']	= $get_product['harga_gerai'];
	        }

	        $this->session->set_flashdata('pembayaran', $post);


			$get_product = $this->datacell_model->get_vendor_price($operator_id,$operator_code);
			if ($get_product==FALSE) {
				$data['product'] = NULL;
			}else{
				$data['product'] = $get_product;
				$data['product']['id_pelanggan'] 	= $post['id_pelanggan'];
				$data['product']['nama_pelanggan'] 	= $post['nama_pelanggan'];
				$data['product']['jumlah_tagihan'] 	= $post['jumlah_tagihan'];
				$data['product']['biaya_admin'] 	= $post['biaya_admin'];
				$data['product']['total_bayar'] 	= $post['biaya_admin']+$post['jumlah_tagihan'];
			}

			$data['provider_name'] 	= $post['provider_name'];
			$data['provider_logo'] 	= $post['provider_logo'];

			$data['form_action']	= site_url('gerai/listrik/pln_pasca/confirm');
			$data['page']			= "pembayaran/pln_pasca/pln_pasca_confirm_form_view";
			
			$this->load->view('main_view',$data);
			
		}
		else
		{
			$pembayaran = $this->session->flashdata('pembayaran');
			
			$post = $this->input->post();
			if (!isset($post['pin'])) {
				redirect('gerai/pembayaran');
			}

			if (!is_login()) {
				redirect('login');
			}

			$get_product = $this->datacell_model->get_vendor_price($operator_id,$operator_code);
			if ($get_product==FALSE) {
				redirect('gerai/pembayaran');
			}

			$data_insert = array(
				'no_transaksi_pulsa' 	=> $trasaction_id,
				'id_user' 				=> $this->session->userdata('id_user'),
				'id_operator' 			=> $operator_id,
				'msisdn' 				=> $post['id_pelanggan'],
				'kode_operator' 		=> $operator_code,
				'tanggal_transaksi' 	=> date('Y-m-d H:i:s'),
				'keterangan' 			=> 'Gerai : '.$get_product['harga_gerai'].', Datacell : '.$get_product['harga_datacell'].', Tagihan : '.$pembayaran['jumlah_tagihan'],
				'harga_datacell'		=> $get_product['harga_datacell']+$pembayaran['jumlah_tagihan'],
				'harga_gerai'			=> $get_product['harga_gerai']+$pembayaran['jumlah_tagihan'],
				'tanggal'				=> date('d'),
				'bulan'					=> date('m'),
				'tahun'					=> date('Y'),
				'service_time'			=> date('Y-m-d H:i:s'),
				'service_user'			=> $service_user,
				'service_action'		=> $service_action
				);

			$this->load->library('datacell_api');

	        $data = array(
	            'service_user' 	=> $service_user,
	            'oprcode'   	=> $operator_code,
	            'msisdn'    	=> $post['id_pelanggan'],
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
	            redirect('gerai/listrik/pln_pasca/report');
	        }else{
	        	$this->load->library('core_banking_api');
				$id_user 			= $this->session->userdata('id_user');
				$total_debit 		= $get_product['harga_gerai']+$pembayaran['jumlah_tagihan'];
				$kode_transaksi 	= 'GERAI';
				$jenis_transaksi 	= 'BAYAR LISTRIK '.$operator_code;
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
				        	$response_raw = $request_charge['message'];
				        	$nama_pelanggan = explode('a/n', $response_raw);
				        	$nama_pelanggan = explode($post['id_pelanggan'], $nama_pelanggan[1]);
				        	$nama_pelanggan = trim($nama_pelanggan[0]);

				        	$data_report['id_pelanggan']		= $post['id_pelanggan'];
				        	$data_report['nama_pelanggan']		= $nama_pelanggan;
				        	$data_report['jumlah_tagihan']		= $pembayaran['jumlah_tagihan'];
				        	$data_report['biaya_admin']			= $get_product['harga_gerai'];
				        	$data_report['total_bayar']			= $total_debit;

				            $data_report['flash_msg']			= TRUE;
				            $data_report['flash_msg_type'] 		= "success";
				            $data_report['flash_msg_status'] 	= TRUE;
				            $data_report['flash_msg_text']		= "Transaksi Berhasil.".$debet_virtual_account['message'];
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/listrik/pln_pasca/report');

				        } else {
				            $data_report['flash_msg']        = TRUE;
				            $data_report['flash_msg_type'] 	 = "danger";
				            $data_report['flash_msg_status'] = FALSE;
				            $data_report['flash_msg_text']   = "Transaksi Gagal.";
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/listrik/pln_pasca/report');
				        }

					}else{
						$data_report['flash_msg']        = TRUE;
			            $data_report['flash_msg_type'] 	 = "danger";
			            $data_report['flash_msg_status'] = FALSE;
			            $data_report['flash_msg_text']   = "Transaksi Gagal.".$deposit_loyalty['message'];
			            $this->session->set_userdata('report',$data_report);
			            redirect('gerai/listrik/pln_pasca/report');
					}
					

				}else{
					$data_report['flash_msg']        = TRUE;
		            $data_report['flash_msg_type'] 	 = "danger";
		            $data_report['flash_msg_status'] = FALSE;
		            $data_report['flash_msg_text']   = "Transaksi Gagal.".$debet_virtual_account['message'];
		            $this->session->set_userdata('report',$data_report);
		            redirect('gerai/listrik/pln_pasca/report');
				}

	        	
	        }

	        $this->cache->clean();
		}

	}

	function report(){
		if (!$this->session->has_userdata('report')) {
			redirect('gerai/pembayaran');
		}

		$report =  $this->session->userdata('report');
		$this->session->unset_userdata('report');

		$data['report'] = $report;

		$data['page'] 		 = "pembayaran/pln_pasca/pln_pasca_report_form_view";
		$this->load->view('main_view',$data);
	}



}