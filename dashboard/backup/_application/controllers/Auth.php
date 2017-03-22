<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// redirect(SMIDUMAY,'refresh');
		$this->load->model('login_mod');
		$this->load->library('form_validation');
		$this->load->driver('cache');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}
			function index()
				{

					// var_dump($this->session->all_userdata());
					// die();
					

					if(empty($this->session->userdata('id_user'))){
						$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
						$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|callback_check_password');
						if ($this->form_validation->run() == FALSE) {
							$data['title'] = "Login";
							$this->load->view('login', $data);
						}
						else
						{
							if ($this->session->userdata('level') == "5"){
								redirect(URL_FRONTEND.'komunitas','refresh');
							}
							else {
								redirect(base_url().'home','refresh'); //jika berhasil redirect ke dashboard
							}
						}
					}
					else {
							redirect(base_url().'home','refresh'); //jika berhasil redirect ke dashboard
							
					}
				
					
				
			}
			function check_password($password){
				//Get password yang username nya sesuai yg diinput
				$username = $this->input->post('username');
				$pass = strrev($this->input->post('password'));
				$password = sha1(md5($pass));
				$res_login = $this->login_mod->login($username, $password);


							if($res_login){
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
										$this->session->set_userdata('foto_cover', $row->cover_foto);
										if($row->parent_koperasi != "0"){ //cek apakah dia koperasi induk atau cabang, kalo cabang do
											$this->session->set_userdata('status_koperasi', $this->login_mod->cek_status_active_koperasi($row->parent_koperasi)->row()->status_active);//cek status aktif koperasi induk
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
											$this->session->set_userdata('status_koperasi', $this->login_mod->cek_status_active_koperasi($row->koperasi)->row()->status_active); //cek status aktif koperasi
										}
										else {
											$this->session->set_userdata('status_koperasi', "N"); //jika belum pilih koperasi
										}
									}
									else if($this->session->userdata('level') == "4"){ //Jika yang login adl komunitas
										$this->session->set_userdata('komunitas', $row->id_komunitas);
										$this->session->set_userdata('foto_cover', $row->cover_foto);

									}
									else if ($this->session->userdata("level") == "5") {
										//Jika Anggota Komunitas
										$this->session->set_userdata('komunitas', $row->komunitas);
										if($this->session->userdata('komunitas') != NULL){
											$this->session->set_userdata('komunitas', $row->komunitas);
											$this->session->set_userdata('status_komunitas', $this->login_mod->cek_status_active_komunitas($row->komunitas)->row()->status_active);
										}
										else {
											$this->session->set_userdata('status_komunitas', "N");
										}
									}
								}
								$this->session->set_flashdata('msg','Login sukses, redirecting');
								$this->login_mod->update_lastlogin($username);
								return TRUE;
							}
							else {
								$this->form_validation->set_message('check_password', 'Invalid username or password');
								return FALSE;
							}
						}
		
		function logout(){
			var_dump($this->session->all_userdata());
			$this->session->sess_destroy();
			$this->cache->clean();
			// redirect(base_url().'login','refresh');
			var_dump($this->session->all_userdata());
			
		}
		
		}