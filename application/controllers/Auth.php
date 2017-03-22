<?php
class Auth extends CI_Controller {

	public function __construct()
	{
	        parent::__construct();
	        // $this->load->model('member_model');
	        $this->load->model('auth_model');
	        $this->load->model('alamat_model');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
	  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

	}


	//Login
	function index() {
		$this->login();
	}

	function login(){
		$session_data = $this->session->all_userdata();
	    $this->session->sess_destroy();
		if($this->session->userdata('id_register') == NULL OR $this->session->userdata('id_register') == ""){
				$this->session->unset_userdata('id_register');
			}
        if (isset($session_data['username']) && isset($session_data['id_user'])) {
            redirect('home');
        } 

		$data['action_form']        = site_url('auth/login_p');
		    
        $data['page'] = 'auth/login_view';
        $this->load->view('main_view',$data);


	}

	function login_p(){

		$arr_post = $this->input->post();
		// print_r($arr_post);
		$post = array(
			'username'	=> $arr_post['username'],
			'password'	=> sha1(md5(strrev($arr_post['password']))),
			);

		$get_user		= $this->auth_model->login($post);
		

	

		if ($get_user==FALSE) {
			// echo "not match";
			redirect('masuk');
		}else{
			$data	= $get_user['data'][0];
			if ($data['status_active']==0) {
				echo "gagal 1";
				redirect('masuk');
			} else{
				$res_login = $get_user['data_com'];
				foreach ($res_login as $row) {
					$this->session->set_userdata('id_user', $row->id_user);
					$this->session->set_userdata('username', $row->username);
					$this->session->set_userdata('nama', $row->nama_lengkap);
					$this->session->set_userdata('foto_user', $row->foto);
					$this->session->set_userdata('level', $row->level);
					$this->session->set_userdata('last_login', $row->last_login);
					//Pembagian session sesuai kebutuhan
					if($this->session->userdata('level') == "2"){ //Jika yang login adl koperasi
						$this->session->set_userdata('koperasi', $row->id_koperasi);
						if($row->parent_koperasi != "0"){ //cek apakah dia koperasi induk atau cabang, kalo cabang do
							$this->session->set_userdata('status_koperasi', $this->auth_model->cek_status_active_koperasi($row->parent_koperasi)->row()->status_active);//cek status aktif koperasi induk
							$this->session->set_userdata('nama_koperasi', ''); 
							$this->session->set_userdata('parent_koperasi', $row->parent_koperasi);
							$this->session->set_userdata('id_koperasi', $row->id_koperasi);

						}
						else { //kalo induk do
							$this->session->set_userdata('id_koperasi', $row->id_koperasi);
							$this->session->set_userdata('parent_koperasi' ,"0");
							$this->session->set_userdata('status_koperasi', "1" );
						}
					}
					else if ($this->session->userdata("level") == "3") { //Jika yg login anggota koperasi
						if($row->koperasi != NULL){ //jika sudah terdaftar/memlihih koperasi
							$this->session->set_userdata('koperasi', $row->koperasi);
							$this->session->set_userdata('status_koperasi', $this->auth_model->cek_status_active_koperasi($row->koperasi)->row()->status_active); //cek status aktif koperasi
						}
						else {
							$this->session->set_userdata('status_koperasi', "N"); //jika belum pilih koperasi
						}
					}
					else if($this->session->userdata('level') == "4"){ //Jika yang login adl komunitas
						$this->session->set_userdata('komunitas', $row->id_komunitas);
						$this->session->set_userdata('komunitas_ID', $row->id_komunitas);
					}
					else if ($this->session->userdata("level") == "5") {
						//Jika Anggota Komunitas
						$this->session->set_userdata('komunitas', $row->komunitas);
						if($this->session->userdata('komunitas') != NULL){
							$this->session->set_userdata('komunitas', $row->komunitas);
							$this->session->set_userdata('status_komunitas', $this->auth_model->cek_status_active_komunitas($row->komunitas)->row()->status_active);
						}
						else {
							$this->session->set_userdata('status_komunitas', "N");
						}
					}
				}	
				// echo $this->session->userdata('komunitas');
				// die();
								
				$this->session->set_userdata($data);
				
				unset($data['password']);
				
				$this->auth_model->update_last_login($data['username']);
				// redirect($this->session->userdata('referred_from'),'REFRESH');
				// redirect('main','REFRESH');
				redirect(base_url().'dashboard/','REFRESH');
			}
			
		}


	}



	// Logout
	function logout_p(){

	    $this->session->sess_destroy();
	    $data = array(
	    	'id_user',
	    	'koperasi',
	    	'username',
	    	'status_active',
	    	'session_token',
	    	'last_login',
	    	'level',
	    	'foto',
	    	'service_time',
	    	'service_action',
	    	'service_user',
	    	);
	    $this->session->unset_userdata($data);
	    redirect(base_url());
	    // redirect($this->session->userdata('referred_from'));

	}



	// Register

	function register(){
			
			if($this->session->userdata('id_register') == NULL OR $this->session->userdata('id_register') == ""){
				redirect(base_url().'auth','refresh');


			}



			$this->load->model('compro_model');

    		$this->form_validation->set_rules('nama_depan', 'Nama Lengkap', 'required|xss_clean');
    		$this->form_validation->set_rules('nama_belakang', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean|callback_cek_email');
			$this->form_validation->set_rules('telp', 'Telepon', 'numeric|required|xss_clean');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|alpha_numeric|callback_cek_username');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]|xss_clean');
			$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'xss_clean');
			$this->form_validation->set_rules('instansi', 'Instansi', 'required|xss_clean');
			$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('kel', 'Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi', 'required|xss_clean');

			if ($this->form_validation->run() == FALSE) {
				$data['question'] 		   = $this->auth_model->get_question()->result();
				$data['komunitas']		   = $this->compro_model->get_all_komunitas()->result();
				$data['provinsi'] 		   = $this->alamat_model->get_provinsi();
				$data['page_name']         = 'Registrasi Page';
		        $data['page_sub_name']     = '';
		        $data['page']              = 'auth/register_view';
		        $this->load->view('main_view',$data);
			 	
			 	// $this->load->view('registrasi', $data);
			}	
				
			else {
				$this->session->set_flashdata('msg','Terimakasih Telah Mendaftar, Silakan Login Di Form Dibawah Ini ');
				$this->auth_model->insert_user();
				redirect(base_url().'masuk','refresh');
			}			
	}
	

	function select_kabupaten($id_provinsi){
		 $kab=$this->alamat_model->get_kabupaten($id_provinsi);
		   echo"<option value=''>Pilih Kota/Kab</option>";
		  foreach($kab as $k){
		    echo "<option value='{$k->id_kabupaten}'>{$k->nama}</option>";
		  }
	}

	function select_kecamatan(){
		$kec=$this->alamat_model->get_kecamatan($id_kabupaten);
		   echo"<option value=''>Pilih Kecamatan</option>";
		  foreach($kec as $k){
		    echo "<option value='{$k->id_kecamatan}'>{$k->nama}</option>";
		  }
	}

	function select_kelurahan(){
		$kel=$this->alamat_model->get_kelurahan($id_kecamtan);
		   echo"<option value=''>Pilih Kelurahan</option>";
		  foreach($kab as $k){
		    echo "<option value='{$k->id_kelurahan}'>{$k->nama}</option>";
		  }
	}

	function cek_username($username){

		$username = $this->input->post('username');

		$result = $this->auth_model->cek_username($username);

		if(!$result){
			$this->form_validation->set_message('cek_username', 'Username sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}

	function cek_email($email){
		$email = $this->input->post('email');
		$result = $this->auth_model->cek_email($email);
		if(!$result){
			$this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}



	function choose_register(){
		
		$this->session->set_userdata('id_register', $this->uri->segment(3));

		
		redirect(base_url().'daftar','refresh');
	}


	function get_instansi(){

		  $search = strip_tags(trim($this->input->get('q')));
	      $query = $this->auth_model->get_instansi($search);

	      if($query->num_rows() > 0){
	        foreach ($query->result() as $r) {
	            $data[] = array('id' => $r->id,
	                          	'text' =>$r->nama );   
	        }
	      }
	      else {
	        $data[] = array('id' => '0',
	                      	'text'=>'Instansi Tidak Ditemukan' );
	      }
	      echo json_encode($data);
	    }
}
	