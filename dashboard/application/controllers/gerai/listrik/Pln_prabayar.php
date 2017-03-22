<?php

class Pln_prabayar extends CI_Controller {


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


	function get_product($operator_id,$nominal=NULL){
		$parameter_produk	= array(
					'kode_operator'			=> $operator_id,
					'kode_kategori_produk' 	=> 'LISTRIK',
					'jenis_transaksi' 		=> 'BELI',
					);
		if ($nominal!=NULL) {
			$parameter_produk['nominal_produk'] = $nominal;
		}
		$get_product = $this->gerai_vendor_produk_model->get_nominal($parameter_produk);
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


	function is_product_valid(){
		$operator_id = $this->input->post('operator_id');
		$nominal 	 = $this->input->post('nominal');
		$get_product = $this->get_product($operator_id,$nominal);

		if ($get_product==FALSE) {
			$this->form_validation->set_message('is_product_valid', 'Maaf Produk Tidak Ditemukan');
			return FALSE;
		}

		$id_user = $this->session->userdata('id_user');
		$total_debit = $get_product[0]['harga_gerai'];

		$permission = $this->core_banking_api->debit_virtual_account_permission($id_user,$total_debit);
		
		if ($permission['status']==TRUE) {
			return TRUE;
		}else{
			$this->form_validation->set_message('is_product_valid', 'Transaksi Tidak Diizinkan Karena '.$permission['message']);
			return FALSE;
		}

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
			}else{
				$data['page'] = "gerai/listrik/pln_prabayar/pln_prabayar_charge_form_view";
			}


			$data['form_action'] 	= site_url().'gerai/listrik/pln_prabayar';

			$data['operator_id']	= 'PLN';
			$data['products']		= $this->get_product($data['operator_id']);

			$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider/pembayaran').'/'.'listrikprabayar.png';
			$data['provider_name'] 	= 'Listrik PLN Prabayar';


			$this->load->view('main_view',$data);

		}else{
			$post = $this->input->post();
			$this->session->set_flashdata('pln_prabayar', $post);
			redirect('gerai/listrik/pln_prabayar/confirm', 'REFRESH');
		}
		
	}





	// PLN PRABAYAR

	function confirm(){
		$this->session->unset_userdata('report');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('pin', 'pin', 'required|xss_clean|numeric|callback_is_pin_valid');
		$this->form_validation->set_rules('provider_name', 'provider_name', 'required|xss_clean');
		$this->form_validation->set_rules('provider_logo', 'provider_logo', 'required|xss_clean');
		$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'required|xss_clean');
		$this->form_validation->set_rules('operator_id', 'operator_id', 'required|xss_clean');
		$this->form_validation->set_rules('nominal', 'nominal', 'required|xss_clean|callback_is_product_valid');


		if ($this->form_validation->run() == FALSE)
		{
			
			$post = $this->session->flashdata('pln_prabayar');
			$this->session->set_flashdata('pln_prabayar', $post);
			
			if (!isset($post)) {
				$post = $this->input->post();
			}
			
			if (!isset($post['submit'])) {
				redirect('gerai/pembayaran');
			}

			if (!isset($post['operator_id']) || !isset($post['nominal']) || !is_login()) {
				redirect('gerai/pembayaran');
			}


			$get_product = $this->get_product('PLN',$post['nominal']);
			if ($get_product==FALSE) {
				$data['product'] = NULL;
			}else{
				$data['product'] = $get_product[0];
				$data['product']['id_pelanggan'] 	= $post['id_pelanggan'];
			}


			// REQUEST INQUIRY PLN KE VSI
			$this->load->library('vsi_api');

			$service_user 		= $this->session->userdata('id_user');
			$transaction_id 	= '10'.time();
	        
	        $data_request_inquiry = array(
	            'service_user' 	=> $service_user,
	            'produk'   		=> 'INQ',
	            'tujuan'    	=> $post['id_pelanggan'],
	            'memberreff' 	=> $transaction_id,
	         );

	        $inquiry_pln = $this->vsi_api->charge($data_request_inquiry);

	        $data_report['provider_name'] 	= $post['provider_name'];
			$data_report['provider_logo'] 	= $post['provider_logo'];

			$data_report['no_transaksi']	= $transaction_id;
			$data_report['msisdn']			= $post['id_pelanggan'];
			$data_report['nama_pelanggan']	= NULL;
			$data_report['tarif_daya']		= NULL;
			$data_report['token']			= NULL;
			$data_report['kwh']				= NULL;
			$data_report['kode_operator']	= $data['product']['kode_operator'];
			$data_report['nominal_produk']	= $data['product']['nominal_produk'];
			$data_report['harga_gerai']		= $data['product']['harga_gerai'];

	        if ($inquiry_pln==FALSE) {
	        	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Mohon maaf, sementara tidak dapat melakukan transaksi, Internal Server sedang terjadi gangguan.";

	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/listrik/pln_prabayar/report');
	            
            }elseif ($inquiry_pln['status']==FALSE) {
            	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Terjadi kesalahan. ".$inquiry_pln['message']['response_message'];
	            
	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/listrik/pln_prabayar/report');            
	        }

	        $response = $inquiry_pln['message']['pesan'];
	        $extract_response = explode('AN:', $response);
	        $extract_response = explode('/', $extract_response[1]);

	        $data_report['nama_pelanggan']	= $extract_response[0];
			$data_report['tarif_daya']		= $extract_response[1].'/'.$extract_response[2];

	        /*
			[tanggal] => 2016/05/20 12:29:19
		    [idagen] => P0288
		    [refid] => 5AAF74BD62FD8217AD7574807FE55BC56593085180F47476A0D68CEF839921E3
		    [produk] => INQ
		    [tujuan] => 521082185138
		    [data] => WALUYO WIDODO/B1/2200VA/A0F77DE19166418FBEDC7DBD96752E81
		    [trxid] => 2258836
		    [rc] => 0000
		    [response_code] => 0000
		    [response_message] => SUKSES
		    [token] => 
		    [pesan] => #2258836 INQ ke:521082185138 SUKSES. AN:WALUYO WIDODO/B1/2200VA/A0F77DE19166418FBEDC7DBD96752E81. Sisa saldo Rp. 2.025.773 - Rp. 0 = Rp. 2.025.773
	        */

		    $data['report']			= $data_report;
			$data['provider_name'] 	= $post['provider_name'];
			$data['provider_logo'] 	= $post['provider_logo'];

			$data['form_action'] = site_url('gerai/listrik/pln_prabayar/confirm');
			$data['page'] 		 = "gerai/listrik/pln_prabayar/pln_prabayar_confirm_form_view";
			
			$this->load->view('main_view',$data);
			
		}
		else
		{
			$this->session->unset_userdata('report');

			$post = $this->input->post();
			if (!isset($post['operator_id']) || !isset($post['nominal']) || !isset($post['pin'])  || !is_login()) {
				redirect('gerai/pembayaran');
			}

			$get_product = $this->get_product('PLN',$post['nominal']);
			if ($get_product==FALSE) {
				redirect('gerai/pembayaran');
			}else{
				$get_product = $get_product[0];
			}


			if ($post['nominal']!=$get_product['nominal_produk']) {
				redirect('gerai/pembayaran');
			}


			$service_user 	= $this->session->userdata('id_user');
			$service_action = 'INSERT';
			$transaction_id 	= '11'.time();

			$data_insert = array(
				'no_transaksi' 			=> $transaction_id,
				'kode_vendor' 			=> $get_product['kode_vendor'],
				'kode_operator' 		=> $get_product['kode_operator'],
				'kode_produk' 			=> $get_product['kode_produk'],
				'kode_kategori_produk' 	=> $get_product['kode_kategori_produk'],
				'nama_produk' 			=> $get_product['nama_produk'],
				'nominal_produk' 		=> $get_product['nominal_produk'],
				'harga_vendor'			=> $get_product['harga_vendor'],
				'harga_gerai'			=> $get_product['harga_gerai'],
				'jenis_transaksi'		=> 'BELI',
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

			$this->load->library('vsi_api');

	        $data = array(
	            'service_user' 	=> $service_user,
	            'produk'   		=> $get_product['kode_produk'],
	            'tujuan'    	=> $post['id_pelanggan'],
	            'memberreff' 	=> $transaction_id,
	            );

	        $data_report['provider_name'] 	= $post['provider_name'];
			$data_report['provider_logo'] 	= $post['provider_logo'];

	        $data_report['no_transaksi']	= $transaction_id;
			$data_report['msisdn']			= $post['id_pelanggan'];
			$data_report['nama_pelanggan']	= $post['nama_pelanggan'];
			$data_report['tarif_daya']		= $post['tarif_daya'];
			$data_report['token']			= NULL;
			$data_report['kwh']				= NULL;
			$data_report['kode_operator']	= $get_product['kode_operator'];
			$data_report['nominal_produk']	= $get_product['nominal_produk'];
			$data_report['harga_gerai']		= $get_product['harga_gerai'];


			$permission = $this->core_banking_api->debit_virtual_account_permission($service_user,$get_product['harga_gerai']);
			if ($permission['status']==FALSE) {
				$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = $permission['message'];

	            $data_insert['status'] 			= 'GAGAL';
	            $data_insert['keterangan']  	= $permission['message'];
	            $data_report['data_insert'] 	= $data_insert;

	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/listrik/pln_prabayar/report');
			}

			

	        // REQUEST KE VSI
	        $request_charge = $this->vsi_api->charge($data);


	        if ($request_charge==FALSE) {
	        	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal.Maaf, Internal Server sedang terjadi gangguan.";
	            $this->session->set_userdata('report',$data_report);

	            $data_insert['keterangan']  = 'Internal Server Error. API Error';
	            $insert = $this->gerai_transaksi_model->insert($data_insert);

	            redirect('gerai/listrik/pln_prabayar/report');
            }elseif ($request_charge['status']==FALSE) {
            	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal. ".$request_charge['message']['response_message'];
	            $this->session->set_userdata('report',$data_report);

	            $data_insert['ref_trxid']   = $request_charge['message']['trxid'];
	            $data_insert['status'] 		= 'GAGAL';
	            $data_insert['keterangan']  = $request_charge['message']['response_message'];
	            $insert = $this->gerai_transaksi_model->insert($data_insert);
	            redirect('gerai/listrik/pln_prabayar/report');
            
	        }else{

	        	$extract_response = explode('SN:', $request_charge['message']['pesan']);
		        $extract_response = explode('/', $extract_response[1]);
		        $data_report['kwh']			= $extract_response[4];
	        	$data_report['token']		= $request_charge['message']['token'];

	        	$data_insert['ref_trxid']   = $request_charge['message']['trxid'];
	            $data_insert['status'] 		= 'SUKSES';
	            $data_insert['keterangan']  = $request_charge['message']['response_message'].'. TOKEN:'.$request_charge['message']['token'];
				$insert = $this->gerai_transaksi_model->insert($data_insert);

	        	$this->load->library('core_banking_api');
				$id_user 			= $this->session->userdata('id_user');
				$total_debit 		= $get_product['harga_gerai'];
				$kode_transaksi 	= 'GERAI';
				$jenis_transaksi 	= 'BELI TOKEN LISTRIK '.$get_product['nama_produk'];
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
				            $data_report['flash_msg_text']		= "Pembelian Token Listrik Berhasil. ".$debet_virtual_account['message'];
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/listrik/pln_prabayar/report');

				        } else {
				            $data_report['flash_msg']        = TRUE;
				            $data_report['flash_msg_type'] 	 = "danger";
				            $data_report['flash_msg_status'] = FALSE;
				            $data_report['flash_msg_text']   = "Transaksi Gagal.";
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/listrik/pln_prabayar/report');
				        }

					}else{
						$data_report['flash_msg']			= TRUE;
			            $data_report['flash_msg_type'] 		= "success";
			            $data_report['flash_msg_status'] 	= TRUE;
			            $data_report['flash_msg_text']		= "Pembelian Token Listrik Berhasil (Not Sharing Profit Payment). ".$debet_virtual_account['message'];
			            $this->session->set_userdata('report',$data_report);
			            redirect('gerai/listrik/pln_prabayar/report');

			            /*$data_report['flash_msg']        = TRUE;
			            $data_report['flash_msg_type'] 	 = "danger";
			            $data_report['flash_msg_status'] = FALSE;
			            $data_report['flash_msg_text']   = "Transaksi Gagal.".$share_profit['message'];
			            $this->session->set_userdata('report',$data_report);
			            redirect('gerai/listrik/pln_prabayar/report');*/
					}
					

				}else{
					$data_report['flash_msg']        = TRUE;
		            $data_report['flash_msg_type'] 	 = "danger";
		            $data_report['flash_msg_status'] = FALSE;
		            $data_report['flash_msg_text']   = "Pembelian Token Listrik Berhasil (Debet Failed) ".$debet_virtual_account['message'];
		            $this->session->set_userdata('report',$data_report);
		            redirect('gerai/listrik/pln_prabayar/report');
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

		$data['page'] 		 = "gerai/listrik/pln_prabayar/pln_prabayar_report_form_view";
		$this->load->view('main_view',$data);
	}



}