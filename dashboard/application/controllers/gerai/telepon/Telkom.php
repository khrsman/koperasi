<?php

class Telkom extends CI_Controller {


	public function __construct()
	{
        parent::__construct();
        $this->load->model('gerai_transaksi_model');
        $this->load->model('gerai_vendor_produk_model');
        $this->load->helper('core_banking_helper');
        $this->load->library('core_banking_api');
        // $this->session->set_userdata('referred_from', current_url());
	}


	function index(){
        $this->charge();
	}

	function get_product($operator_id){
		$parameter_produk	= array(
					'kode_operator'			=> $operator_id,
					'kode_kategori_produk' 	=> 'TELEPON',
					'jenis_transaksi' 		=> 'BAYAR',
					);
		
		$get_product = $this->gerai_vendor_produk_model->get_admin_fee($parameter_produk);
		return $get_product;
	}

	function is_pin_valid(){
		$id_user = $this->session->userdata('id_user');
		$pin 	 = $this->input->post('pin');

		$permission = $this->core_banking_api->check_pin($id_user,$pin);
		
		if ($permission['status']==TRUE) {
			return TRUE;
		}else{
			$this->form_validation->set_message('is_pin_valid', $permission['message']);
			return FALSE;
		}
	}



	function charge(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('kode_area','Kode Area', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('no_telepon','Nomor Telepon', 'required|xss_clean|numeric');

		if($this->form_validation->run() == FALSE){
			if (!is_login()) {
				redirect('login','REFRESH');
			}

			if (!has_koperasi()) {
				$data['page'] = "auth/404_koperasi_view";
			}else{
				$data['page'] = "gerai/telepon/telkom/telkom_charge_form_view";
			}


			$data['form_action'] 	= site_url().'gerai/telepon/telkom';

			$data['operator_id']	= 'TELKOM';
			$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider/pembayaran').'/'.'telkom.png';
			$data['provider_name'] 	= 'Telkom (Telepon dan Internet)';

			$this->load->view('main_view',$data);

		}else{
			$post = $this->input->post();
			$this->session->set_flashdata('telkom', $post);
			redirect('gerai/telepon/telkom/confirm', 'REFRESH');
		}
		
	}





	// TELKOM pascabayar

	function confirm(){
		$this->session->unset_userdata('report');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('pin', 'pin', 'required|xss_clean|numeric|callback_is_pin_valid');
		$this->form_validation->set_rules('provider_name', 'provider_name', 'required|xss_clean');
		$this->form_validation->set_rules('provider_logo', 'provider_logo', 'required|xss_clean');
		$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'required|xss_clean');
		$this->form_validation->set_rules('operator_id', 'operator_id', 'required|xss_clean');

		$this->form_validation->set_rules('no_handphone', 'No. Handphone', 'required|numeric|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			
			$post = $this->session->flashdata('telkom');
			$this->session->set_flashdata('telkom', $post);
			
			if (!isset($post)) {
				$post = $this->input->post();
			}

			if (!isset($post['submit'])) {
				redirect('gerai/pembayaran');
			}

			if (!isset($post['operator_id']) || !is_login()) {
				redirect('gerai/pembayaran');
			}


			$post['id_pelanggan'] = $post['kode_area'].$post['no_telepon'];

			$get_product = $this->get_product('TELKOM');
			if ($get_product==FALSE) {
				redirect('gerai/pembayaran');
			}else{
				$data['product'] = $get_product[0];
				$data['product']['id_pelanggan'] 	= $post['id_pelanggan'];
			}


			// REQUEST INQUIRY TELKOM KE DATACELL
			$this->load->library('datacell_api');

			$service_user 		= $this->session->userdata('id_user');
			$transaction_id 	= '12'.time();
	        
	        $data_request_inquiry = array(
	            'service_user' 	=> $service_user,
	            'produk'   		=> 'CEK.TELKOM',
	            'tujuan'    	=> $post['id_pelanggan'],
	            'memberreff' 	=> $transaction_id,
	         );


	        $inquiry = $this->datacell_api->charge($data_request_inquiry);

	        // print_r($inquiry);

	        $data_report['provider_name'] 	= $post['provider_name'];
			$data_report['provider_logo'] 	= $post['provider_logo'];
			$data_report['kode_operator'] 	= $post['operator_id'];

			$data_report['no_transaksi']	= $transaction_id;
			$data_report['msisdn']			= $post['id_pelanggan'];
			$data_report['kode_area'] 		= $post['kode_area'];
			$data_report['no_telepon'] 		= $post['no_telepon'];

			$data_report['nama_pelanggan']	= NULL;	//WARNING HARDCODE !!!!
			$data_report['biaya_tagihan'] 	= NULL; //WARNING HARDCODE !!!!
			$data_report['biaya_admin'] 	= $data['product']['harga_gerai'];
			$data_report['biaya_total'] 	= NULL; //WARNING HARDCODE !!!!

			if ($inquiry==FALSE) {
	        	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Mohon maaf, sementara tidak dapat melakukan transaksi, Internal Server sedang terjadi gangguan.";

	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/telepon/telkom/report');
	            
            }elseif ($inquiry['status']==FALSE) {
            	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Terjadi kesalahan. ".$inquiry['message']['message'];
	            
	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/telepon/telkom/report');            
	        }


	        // GET Nama Pelanggan
	        $response = $inquiry['message']['message'];
	        $extract_response = explode('a/n', $response);
	        $extract_response = explode(trim($post['id_pelanggan']), $extract_response[1]);

	        $data_report['nama_pelanggan']	= trim($extract_response[0]);


	        // GET Biaya Tagihan
	        $response = $inquiry['message']['message'];
	        $extract_response = explode('sebesar', $response);
	        $extract_response = explode('.', $extract_response[1]);

	        $data_report['biaya_tagihan']	= trim($extract_response[0]);



	        $data_report['biaya_total'] 	= $data_report['biaya_tagihan']+$data_report['biaya_admin'];


		    $data['report']			= $data_report;
			$data['provider_name'] 	= $post['provider_name'];
			$data['provider_logo'] 	= $post['provider_logo'];

			$data['form_action'] = site_url('gerai/telepon/telkom/confirm');
			$data['page'] 		 = "gerai/telepon/telkom/telkom_confirm_form_view";
			
			$this->load->view('main_view',$data);
			
		}
		else
		{
			
			$this->session->unset_userdata('report');

			$post = $this->input->post();
			if (!isset($post['operator_id']) || !isset($post['pin']) || !isset($post['no_handphone']) || !isset($post['biaya_tagihan'])  || !isset($post['biaya_admin'])  || !isset($post['biaya_total'])  || !is_login()) {
				redirect('gerai/pembayaran');
			}
			
			$get_product = $this->get_product('TELKOM');
			if ($get_product==FALSE) {
				redirect('gerai/pembayaran');
			}else{
				$get_product = $get_product[0];
			}


			$service_user 	= $this->session->userdata('id_user');
			$service_action = 'INSERT';
			$transaction_id 	= '12'.time();

			$data_insert = array(
				'no_transaksi' 			=> $transaction_id,
				'kode_vendor' 			=> $get_product['kode_vendor'],
				'kode_operator' 		=> $get_product['kode_operator'],
				'kode_produk' 			=> $get_product['kode_produk'],
				'kode_kategori_produk' 	=> $get_product['kode_kategori_produk'],
				'nama_produk' 			=> $get_product['nama_produk'],
				'nominal_produk' 		=> $post['biaya_tagihan'],
				'harga_vendor'			=> $post['biaya_tagihan']+$get_product['harga_vendor'],
				'harga_gerai'			=> $post['biaya_tagihan']+$get_product['harga_gerai'],
				'jenis_transaksi'		=> 'BAYAR',
				'id_user'				=> $service_user,
				'msisdn'				=> $post['id_pelanggan'],
				'tanggal_transaksi'		=> date('Y-m-d H:i:s'),
				'tanggal'			=> date('d'),
				'bulan'				=> date('m'),
				'tahun'				=> date('Y'),
				'service_time'			=> date('Y-m-d H:i:s'),
				'service_user'			=> $service_user,
				'service_action'		=> $service_action
				);



	        $data_report['provider_name'] 	= $post['provider_name'];
			$data_report['provider_logo'] 	= $post['provider_logo'];
			$data_report['kode_operator'] 	= $post['operator_id'];

	        $data_report['no_transaksi']	= $transaction_id;
			$data_report['msisdn']			= $post['id_pelanggan'];
			$data_report['kode_area'] 		= $post['kode_area'];
			$data_report['no_telepon'] 		= $post['no_telepon'];
			
			$data_report['nama_pelanggan']	= $post['nama_pelanggan'];
			$data_report['biaya_tagihan'] 	= $post['biaya_tagihan'];
			$data_report['biaya_admin'] 	= $get_product['harga_gerai'];
			$data_report['biaya_total'] 	= $post['biaya_tagihan']+$get_product['harga_gerai'];


			$permission = $this->core_banking_api->debit_virtual_account_permission($service_user,$post['biaya_total']);
			if ($permission['status']==FALSE) {
				$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = $permission['message'];

	            $data_insert['status'] 			= 'GAGAL';
	            $data_insert['keterangan']  	= $permission['message'];
	            $data_report['data_insert'] 	= $data_insert;

	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/telepon/telkom/report');
			}


			// REQUEST KE DATACELL

			$this->load->library('datacell_api');

	        $data = array(
	            'service_user' 	=> $service_user,
	            'produk'   		=> $get_product['kode_produk'],
	            'tujuan'    	=> $post['id_pelanggan'].'.'.$post['biaya_tagihan'].'.'.$post['no_handphone'],
	            'memberreff' 	=> $transaction_id,
	        );

	        $request_charge = $this->datacell_api->charge($data);


	        if ($request_charge==FALSE) {
	        	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal.Maaf, Internal Server sedang terjadi gangguan.";
	            $this->session->set_userdata('report',$data_report);

	            $data_insert['keterangan']  = 'Internal Server Error. API Error';
	            $insert = $this->gerai_transaksi_model->insert($data_insert);

	            redirect('gerai/telepon/telkom/report');
            }elseif ($request_charge['status']==FALSE) {
            	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal. ".$request_charge['message']['message'];
	            $this->session->set_userdata('report',$data_report);

	            $data_insert['ref_trxid']   = $request_charge['message']['trxid'];
	            $data_insert['status'] 		= 'GAGAL';
	            $data_insert['keterangan']  = $request_charge['message']['message'];
	            $insert = $this->gerai_transaksi_model->insert($data_insert);
	            redirect('gerai/telepon/telkom/report');
            
	        }else{

	        	$data_insert['ref_trxid']   = $request_charge['message']['trxid'];
	            $data_insert['status'] 		= 'SUKSES';
	            $data_insert['keterangan']  = $request_charge['message']['message'];
				$insert = $this->gerai_transaksi_model->insert($data_insert);


	        	$this->load->library('core_banking_api');
				$id_user 			= $this->session->userdata('id_user');
				$total_debit 		= $post['biaya_total'];
				$kode_transaksi 	= 'GERAI';
				$jenis_transaksi 	= 'BAYAR TELEPON : '.$get_product['nama_produk'];
				$debet_virtual_account = $this->core_banking_api->debit_virtual_account($id_user,$total_debit,$kode_transaksi,$jenis_transaksi,$transaction_id);
				
				// REQUEST KE DATACELL BERHASIL. DEBET VIRTUAL ACCOUNT
				if ($debet_virtual_account['status']!=FALSE) {
					$total_point 		= $get_product['harga_gerai']-$get_product['harga_vendor'];
					$sumber_dana 		= 'GERAI';
					
					// DEBET VIRTUAL ACCOUNT BERHASIL. DEPOSIT POINT LOYALTI
					$share_profit = $this->core_banking_api->share_profit($id_user,$total_point,$sumber_dana,$jenis_transaksi,$transaction_id);

					if ($share_profit['status']!=FALSE) {
						
						// DEPOSTI LOYALTI BERHASIL. INSERT TRANSAKSI GERAI

				        if ($insert!=FALSE) {
				        	// INSERT TRANSAKSI GERAI BERHASIL
				            $data_report['flash_msg']			= TRUE;
				            $data_report['flash_msg_type'] 		= "success";
				            $data_report['flash_msg_status'] 	= TRUE;
				            $data_report['flash_msg_text']		= "Pembayaran Tagihan Berhasil. ".$debet_virtual_account['message'];
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/telepon/telkom/report');

				        } else {
				            $data_report['flash_msg']        = TRUE;
				            $data_report['flash_msg_type'] 	 = "danger";
				            $data_report['flash_msg_status'] = FALSE;
				            $data_report['flash_msg_text']   = "Transaksi Gagal.";
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/telepon/telkom/report');
				        }

					}else{
						$data_report['flash_msg']			= TRUE;
			            $data_report['flash_msg_type'] 		= "success";
			            $data_report['flash_msg_status'] 	= TRUE;
			            $data_report['flash_msg_text']		= "Pembayaran Tagihan Berhasil (Not Sharing Profit Payment). ".$debet_virtual_account['message'];
			            $this->session->set_userdata('report',$data_report);
			            redirect('gerai/telepon/telkom/report');
					}
					

				}else{
					$data_report['flash_msg']        = TRUE;
		            $data_report['flash_msg_type'] 	 = "danger";
		            $data_report['flash_msg_status'] = FALSE;
		            $data_report['flash_msg_text']   = "Pembayaran Tagihan Berhasil (Debet Failed) ".$debet_virtual_account['message'];
		            $this->session->set_userdata('report',$data_report);
		            redirect('gerai/telepon/telkom/report');
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

		$data['page'] 		 = "gerai/telepon/telkom/telkom_report_form_view";
		$this->load->view('main_view',$data);
	}



}