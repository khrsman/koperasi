<?php

class Pulsa extends CI_Controller {


	public function __construct()

	{
        parent::__construct();
        $this->load->model('gerai_admin_model');
        $this->load->model('gerai_transaksi_model');
        $this->load->model('gerai_vendor_produk_model');
        $this->load->model('core_banking_model');
        $this->load->library('core_banking_api');
        // $this->session->set_userdata('referred_from', current_url());
        if (!is_login()) {
			redirect('login','REFRESH');
		}
	}



	function index(){
		$session = $this->session->userdata();
	
		if ($session['level']==3 || $session['level']==4 || $session['level']==5) {
			redirect('404');
		}

        $data['page'] = 'gerai/admin/pulsa/pulsa_list_view';
        $this->load->view('main_view',$data);
	}



	function is_user_valid(){
		$id_user = $this->input->post('id_user');
		$get_user_anggota = $this->gerai_admin_model->get_anggota_koperasi_by_id($id_user);
		if ($get_user_anggota==FALSE) {
			$this->form_validation->set_message('is_user_valid', 'ID User #'.$id_user.' Bukan Anggota Koperasi atau Tidak Aktif.');
			return FALSE;
		}else{
			return TRUE;
		}
	}



	function is_virtual_account_valid(){
		$id_user = $this->input->post('id_user');
		$get_virtual_account = $this->core_banking_model->get_virtual_account_by_user($id_user);
		if ($get_virtual_account==FALSE) {
			$this->form_validation->set_message('is_virtual_account_valid', 'Virtual Account User #'.$id_user.' Tidak Ditemukan.');
			return FALSE;
		}else{
			if ($get_virtual_account[0]['status_rekening']!='ACTIVE') {
				$this->form_validation->set_message('is_virtual_account_valid', 'Virtual Account User #'.$id_user.' Tidak Aktif.');
				return FALSE;
			}else{
				return TRUE;	
			}
			
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

		$id_user = $this->input->post('id_user');
		$total_debit = $get_product[0]['harga_gerai'];

		$permission = $this->core_banking_api->debit_virtual_account_permission($id_user,$total_debit);
		
		if ($permission['status']==TRUE) {
			return TRUE;
		}else{
			$this->form_validation->set_message('is_product_valid', 'Transaksi Tidak Diizinkan Karena '.$permission['message']);
			return FALSE;
		}

	}



	function get_product($operator_id,$nominal=NULL){
		$parameter_produk	= array(
					'kode_operator'			=> $operator_id,
					'kode_kategori_produk' 	=> 'PULSA',
					'jenis_transaksi' 		=> 'BELI',
					);
		if ($nominal!=NULL) {
			$parameter_produk['nominal_produk'] = $nominal;
		}
		$get_product = $this->gerai_vendor_produk_model->get_nominal($parameter_produk);
		return $get_product;
	}


	function topup($provider=NULL){

	$session = $this->session->userdata();
	
	if ($session['level']==3 || $session['level']==4 || $session['level']==5) {
		redirect('404');
	}

	if ($provider==NULL) {
		redirect('gerai/admin/pulsa');
	}

	$this->load->library('form_validation');


	$this->form_validation->set_rules('id_user', 'ID Anggota', 'required|xss_clean|numeric|callback_is_user_valid|callback_is_virtual_account_valid');
	$this->form_validation->set_rules('phone_number','Nomor Telepon', 'required|xss_clean|numeric|min_length[10]|max_length[15]');

	if($this->form_validation->run() == FALSE){


		$data['form_action'] = site_url().'gerai/admin/pulsa/topup/'.$this->uri->segment(5);

		switch ($provider) {

			case 'indosat':

				$data['operator_id']	= 'INDOSAT';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'indosat.png';
				$data['provider_name'] 	= 'Indosat';

				break;

			case 'telkomsel':

				$data['operator_id']	= 'TELKOMSEL';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'telkomsel.png';
				$data['provider_name'] 	= 'Telkomsel';

				break;

			case 'xl':

				$data['operator_id']	= 'XL';
				$data['products']		= $this->get_product($data['operator_id']);


				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'XL.png';
				$data['provider_name'] 	= 'XL';

				break;

			case 'esia':

				$data['operator_id']	= 'ESIA';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'esia.png';
				$data['provider_name'] 	= 'Esia';

				break;

			case 'smartfren':

				$data['operator_id']	= 'SMARTFREN';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'smartfren.png';
				$data['provider_name'] 	= 'Smartfren';

				break;

			case 'flexi':

				$data['operator_id']	= 'FLEXI';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'flexi.png';
				$data['provider_name'] 	= 'Flexi';

				break;

			case 'axis':

				$data['operator_id']	= 'AXIS';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'axis.png';
				$data['provider_name'] 	= 'Axis';

				break;

			case 'tri':

				$data['operator_id']	= 'THREE';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'3.png';
				$data['provider_name'] 	= 'Tri';


				break;

			case 'ceria':

				$data['operator_id']	= 'CERIA';
				$data['products']		= $this->get_product($data['operator_id']);

				$data['provider_logo'] 	= base_url('assets/compro/IMAGE/provider').'/'.'3.png';
				$data['provider_name'] 	= 'Ceria';

				break;	

			default:

				redirect('gerai/admin/pulsa');

				/*$data['page'] = "under_404";
				$this->load->view('main_view',$data);*/

				break;

		}

		$data['page'] = "gerai/admin/pulsa/pulsa_topup_form_view";
		$this->load->view('main_view',$data);

	}
	else {
		$post = $this->input->post();
		$this->session->set_flashdata('pulsa', $post);
		redirect(base_url()."gerai/admin/pulsa/topup_confirm", 'REFRESH');
	}
	
}


function is_pin_valid(){
	$pin = $this->input->post('pin');
	$valid = is_pin_valid($pin);
	if ($valid==TRUE) {
		return TRUE;
	}else{
		$this->form_validation->set_message('is_pin_valid', 'PIN yang anda masukan salah.');
		return FALSE;
	}
}



function topup_confirm(){


		$this->load->library('form_validation');
		// $this->form_validation->set_rules('pin', 'pin', 'required|xss_clean|numeric|callback_is_pin_valid');
		$this->form_validation->set_rules('provider_name', 'provider_name', 'required|xss_clean');
		$this->form_validation->set_rules('provider_logo', 'provider_logo', 'required|xss_clean');
		$this->form_validation->set_rules('phone_number', 'phone_number', 'required|xss_clean');
		$this->form_validation->set_rules('operator_id', 'operator_id', 'required|xss_clean');
		$this->form_validation->set_rules('id_user', 'id_user', 'required|xss_clean');
		$this->form_validation->set_rules('nominal', 'nominal', 'required|xss_clean|callback_is_product_valid');

		if ($this->form_validation->run() == FALSE)
		{
			
			$post = $this->session->flashdata('pulsa');
			$this->session->set_flashdata('pulsa', $post);
			
			if (!isset($post)) {
				$post = $this->input->post();
			}
			
			if (!isset($post['submit'])) {
				redirect('gerai/admin/pulsa');
			}

			if (!isset($post['operator_id']) || !isset($post['nominal']) || !is_login()) {
				redirect('gerai/admin/pulsa');
			}


			$get_user_anggota 		= $this->gerai_admin_model->get_anggota_koperasi_by_id($post['id_user']);
			$data['user_anggota']	= $get_user_anggota;

			$get_user_anggota_virtual_account 		= $this->core_banking_model->get_virtual_account_by_user($post['id_user']);
			$data['user_anggota_virtual_account']	= $get_user_anggota_virtual_account[0];


			$get_product = $this->get_product($post['operator_id'],$post['nominal']);			
			if ($get_product==FALSE) {
				$data['product'] = NULL;
			}else{
				$data['product'] = $get_product[0];
				$data['product']['phone_number'] 	= $post['phone_number'];
			}


			$data['provider_name'] 	= $post['provider_name'];
			$data['provider_logo'] 	= $post['provider_logo'];

			$data['form_action'] = site_url('gerai/admin/pulsa/topup_confirm');
			$data['page'] 		 = "gerai/admin/pulsa/pulsa_topup_confirm_form_view";
			// print_r($data);
			$this->load->view('main_view',$data);
			
		}
		else
		{

			$post = $this->input->post();
			if (!isset($post['operator_id']) || !isset($post['nominal']) || !isset($post['id_user']) || !is_login()) {
				redirect('gerai/admin/pulsa');
			}

			

			$get_product = $this->get_product($post['operator_id'],$post['nominal']);
			if ($get_product==FALSE) {
				redirect('gerai/admin/pulsa');
			}else{
				$get_product = $get_product[0];
			}

			if ($post['nominal']!=$get_product['nominal_produk']) {
				redirect('gerai/admin/pulsa');
			}


			$service_user 	= $this->session->userdata('id_user');
			$service_action = 'INSERT';
			$trasaction_id 	= '13'.time();

			$data_insert = array(
				'no_transaksi' 			=> $trasaction_id,
				'kode_vendor' 			=> $get_product['kode_vendor'],
				'kode_operator' 		=> $get_product['kode_operator'],
				'kode_produk' 			=> $get_product['kode_produk'],
				'kode_kategori_produk' 	=> $get_product['kode_kategori_produk'],
				'nama_produk' 			=> $get_product['nama_produk'],
				'nominal_produk' 		=> $get_product['nominal_produk'],
				'harga_vendor'			=> $get_product['harga_vendor'],
				'harga_gerai'			=> $get_product['harga_gerai'],
				'jenis_transaksi'		=> 'BELI',
				'id_user'				=> $post['id_user'],
				'msisdn'				=> $post['phone_number'],
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
	            'tujuan'    	=> $post['phone_number'],
	            'memberreff' 	=> $trasaction_id,
	            );

	        $data_report['provider_name'] 	= $post['provider_name'];
			$data_report['provider_logo'] 	= $post['provider_logo'];
	        $data_report['product'] 		= $get_product;
	        $data_report['data_insert'] 	= $data_insert;


	        $permission = $this->core_banking_api->debit_virtual_account_permission($post['id_user'],$get_product['harga_gerai']);
			if ($permission['status']==FALSE) {
				$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = $permission['message'];

	            $data_insert['status'] 			= 'GAGAL';
	            $data_insert['keterangan']  	= $permission['message'];
	            $data_report['data_insert'] 	= $data_insert;

	            $this->session->set_userdata('report',$data_report);
	            redirect('gerai/admin/pulsa/topup_report');
			}


	        $get_user_anggota 		= $this->gerai_admin_model->get_anggota_koperasi_by_id($post['id_user']);
			if ($get_user_anggota==FALSE) {
				redirect('gerai/admin/pulsa');
			}
			$data_report['user_anggota'] = $get_user_anggota;


			$get_user_anggota_virtual_account 		= $this->core_banking_model->get_virtual_account_by_user($post['id_user']);
			if (!$get_user_anggota_virtual_account) {
				redirect('gerai/admin/pulsa');
			}
			$data_report['user_anggota_virtual_account']	= $get_user_anggota_virtual_account[0];



	        // REQUEST KE VSI
	        $request_charge = $this->vsi_api->charge($data);

	        if ($request_charge==FALSE) {
	        	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal.Maaf, Internal Server sedang ada gangguan.";
	            
	            $data_insert['status'] 			= 'GAGAL';
	            $data_insert['keterangan']  	= 'Internal Server Error. API Error';
	            $data_report['data_insert'] 	= $data_insert;
	            $this->session->set_userdata('report',$data_report);

	            $insert = $this->gerai_transaksi_model->insert($data_insert);
	            redirect('gerai/admin/pulsa/topup_report');
            }elseif ($request_charge['status']==FALSE) {
            	$data_report['flash_msg']        = TRUE;
	            $data_report['flash_msg_type'] 	 = "danger";
	            $data_report['flash_msg_status'] = FALSE;
	            $data_report['flash_msg_text']   = "Transaksi Gagal. ".$request_charge['message']['response_message'];
	            
	            $data_insert['ref_trxid']   	= $request_charge['message']['trxid'];
	            $data_insert['status'] 			= 'GAGAL';
	            $data_insert['keterangan']  	= $request_charge['message']['response_message'];
	            $data_report['data_insert'] 	= $data_insert;
	            $this->session->set_userdata('report',$data_report);
	            
	            $insert = $this->gerai_transaksi_model->insert($data_insert);
	            redirect('gerai/admin/pulsa/topup_report');
            
	        }else{

	        	//JUST FOR TEST
	        	/*print_r('<pre>');
	        	print_r($request_charge);
	        	print_r('</pre>');*/
	        	$data_insert['ref_trxid']   = $request_charge['message']['trxid'];
	            $data_insert['status'] 		= 'SUKSES';
	            $data_insert['keterangan']  = $request_charge['message']['response_message'];
	            $data_report['data_insert'] = $data_insert;
	            $this->session->set_userdata('report',$data_report);

				$insert = $this->gerai_transaksi_model->insert($data_insert);

	        	$this->load->library('core_banking_api');
				$id_user 			= $post['id_user'];
				$total_debit 		= $get_product['harga_gerai'];
				$kode_transaksi 	= 'GERAI';
				$jenis_transaksi 	= 'TOPUP PULSA '.$get_product['nama_produk'];
				$debet_virtual_account = $this->core_banking_api->debit_virtual_account($id_user,$total_debit,$kode_transaksi,$jenis_transaksi,$trasaction_id);
				
				// REQUEST KE DATACELL BERHASIL. DEBET VIRTUAL ACCOUNT
				if ($debet_virtual_account['status']!=FALSE) {
					$total_point 		= $get_product['harga_gerai']-$get_product['harga_vendor'];
					$sumber_dana 		= 'GERAI';
					
					// DEBET VIRTUAL ACCOUNT BERHASIL. DEPOSIT POINT LOYALTI
					$share_profit = $this->core_banking_api->share_profit($id_user,$total_point,$sumber_dana,$jenis_transaksi,$trasaction_id);

					if ($share_profit['status']!=FALSE) {
						
						// DEPOSTI LOYALTI BERHASIL. INSERT TRANSAKSI GERAI
						/*$data_insert['ref_trxid']   = $request_charge['message']['trxid'];
			            $data_insert['status'] 		= 'SUKSES';
			            $data_insert['keterangan']  = $request_charge['message']['response_message'];
						$insert = $this->gerai_transaksi_model->insert($data_insert);*/

				        if ($insert!=FALSE) {
				        	// INSERT TRANSAKSI GERAI BERHASIL
				            $data_report['flash_msg']			= TRUE;
				            $data_report['flash_msg_type'] 		= "success";
				            $data_report['flash_msg_status'] 	= TRUE;
				            $data_report['flash_msg_text']		= "Isi Pulsa Berhasil. ".$debet_virtual_account['message'];
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/admin/pulsa/topup_report');

				        } else {
				            $data_report['flash_msg']        = TRUE;
				            $data_report['flash_msg_type'] 	 = "danger";
				            $data_report['flash_msg_status'] = FALSE;
				            $data_report['flash_msg_text']   = "Transaksi Gagal.";
				            $this->session->set_userdata('report',$data_report);
				            redirect('gerai/admin/pulsa/topup_report');
				        }

					}else{
						$data_report['flash_msg']			= TRUE;
			            $data_report['flash_msg_type'] 		= "success";
			            $data_report['flash_msg_status'] 	= TRUE;
			            $data_report['flash_msg_text']		= "Isi Pulsa Berhasil (Not Sharing Profit Payment). ".$debet_virtual_account['message'];
			            $this->session->set_userdata('report',$data_report);
			            redirect('gerai/admin/pulsa/topup_report');

						/*$data_report['flash_msg']        = TRUE;
			            $data_report['flash_msg_type'] 	 = "warning";
			            $data_report['flash_msg_status'] = FALSE;
			            $data_report['flash_msg_text']   = "Transaksi Berhasil. Error Deposit Loyalty.".$share_profit['message'];
			            $this->session->set_userdata('report',$data_report);
			            redirect('gerai/admin/pulsa/topup_report');*/
					}
					

				}else{
					$data_report['flash_msg']        = TRUE;
		            $data_report['flash_msg_type'] 	 = "warning";
		            $data_report['flash_msg_status'] = FALSE;
		            $data_report['flash_msg_text']   = "Isi Pulsa Berhasil (Debet Failed) ".$debet_virtual_account['message'];
		            $this->session->set_userdata('report',$data_report);
		            redirect('gerai/admin/pulsa/topup_report');
				}

	        	
	        }

	        $this->cache->clean();
		}

		

	}



	function topup_report(){

		if (!$this->session->has_userdata('report')) {
			redirect('gerai/admin/pulsa');
		}

		$report =  $this->session->userdata('report');
		$this->session->unset_userdata('report');
		$this->cache->clean();
		
		$data['report'] = $report;
		
		$data['page'] 		 = "gerai/admin/pulsa/pulsa_topup_report_form_view";
		$this->load->view('main_view',$data);

	}



	function search_anggota_kopearasi(){
        $q = $this->input->post('q');
        $user = $this->gerai_admin_model->search_anggota_kopearasi($q);


        $json = array(
            array(
                'id'    => NULL,
                'text'  => 'Cari ID User atau Nama User..',
                )
            );
        $return_arr = array();
        if (empty($q)) {
            $return_arr = $json;
        }else{
            if ($user==FALSE) {
            $return_arr = $json;    
            }else{
                foreach ($user as $k => $v) {
                    $row_array['id'] = $v['id_user'];
                    $row_array['text'] = utf8_encode($v['id_user'].' ('.$v['nama_depan'].' '.$v['nama_belakang'].' | '.$v['nama'].')');
                    array_push($return_arr,$row_array);
                }
            }   
        }
        

        $ret = $return_arr;
        echo json_encode($ret);
    }

	

}