<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('id_user'))){
			// echo "id user tidak ada";
			// redirect(base_url());
		}

		$this->load->model('admin_mod');
		$this->load->model('anggota_mod');
		$this->load->model('koperasi_mod');
		$this->load->model('pekerjaan_mod');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
  		$this->session->set_userdata('id', $this->session->userdata('id_user'));
	}

	public function index()
	{

		// echo $this->session->userdata('level');
		// die();

		$data['title'] = "Dashboard";
		$data['user'] = $this->session->userdata('nama');
		$this->load->view('dashboard', $data);
	}


	function edit_profile(){
		$data['title'] = "Profile";


		if($this->session->userdata('level') == 1){
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
			$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');		
			if ($this->form_validation->run() == FALSE) {
				if($this->admin_mod->get_admin_by_id($this->session->userdata('id_user'))->num_rows() > 0){
					$data['user'] = $this->admin_mod->get_admin_by_id($this->session->userdata('id_user'))->row_array();

					$this->load->view('edit_profile', $data);
				}
				else {
					redirect(base_url().'not_found','refresh');
				}
			} 
			else {
					$this->admin_mod->update_admin();
					$this->session->set_flashdata('msg','Profil berhasil diubah');

					$this->session->set_userdata('nama', $this->input->post('nama'));
					redirect(base_url().'profile','refresh');
				}
		}

		else if($this->session->userdata('level') == 2){
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
			$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
			$this->form_validation->set_rules('berdiri', 'Tanggal Berdiri', 'required|xss_clean');
			$this->form_validation->set_rules('legal', 'Legal', 'xss_clean');
			$this->form_validation->set_rules('ketua', 'Ketua Koperasi', 'required|xss_clean');
			$this->form_validation->set_rules('ketua_telp', 'No Telepon Ketua Koperasi', 'numeric|required|xss_clean');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
			$this->form_validation->set_rules('koperasi', 'Cabang Koperasi', 'xss_clean');
			$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				if($this->koperasi_mod->get_koperasi_by_id($this->session->userdata('id_user'))->num_rows() > 0){
					$data['user'] = $this->koperasi_mod->get_koperasi_by_id($this->session->userdata('id_user'))->row_array();

					$data['data_kop'] = $this->koperasi_mod->get_id_nama()->result();
					$this->session->set_userdata('id', $this->session->userdata('user_id'));

					$this->load->view('edit_profile', $data);
				}
				else {
					redirect(base_url().'not_found','refresh');
				}
				
			} 
			else {
				$this->koperasi_mod->update_koperasi();
					$this->session->set_flashdata('msg','Profil berhasil diubah');

				$this->session->set_userdata('nama', $this->input->post('nama'));\
				redirect(base_url().'profile','refresh');
			}
		}

		else if ($this->session->userdata('level') == 3){
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
			$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('koperasi', 'Koperasi', 'required|xss_clean');
			$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				if($this->anggota_mod->get_anggota_by_id($this->session->userdata('id_user'))->num_rows() > 0){
					$data['user'] = $this->anggota_mod->get_anggota_by_id($this->session->userdata('id_user'))->row_array();
					$data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
					$data['koperasi'] = $this->koperasi_mod->get_all_koperasi()->result();

					$this->session->set_userdata('id', $this->session->userdata('user_id'));
					$this->load->view('edit_profile', $data);
				}
				else {
					redirect(base_url().'not_found','refresh');
				}
			} 
			else {
					$this->anggota_mod->update_anggota();
					$this->session->set_flashdata('msg','Profil berhasil diubah');
					$this->session->set_userdata('nama', $this->input->post('nama'));
					redirect(base_url().'profile','refresh');
			}
		}
	}

	function upload_photo_profile(){
		$config['upload_path'] = 'assets/images/user';


		$config['allowed_types'] = 'jpg|png';
		$config['encrypt_name'] = TRUE;	
		
		
		$this->load->library('upload', $config);


		
		if ( !$this->upload->do_upload('photo')){
			$this->session->set_flashdata('msg', $this->upload->display_errors());
			redirect(base_url().'profile/' ,'refresh');
		}
		else{
			$this->session->set_userdata('error', "");
			$this->session->set_flashdata('msg','Profil berhasil diubah');


			if(!empty($this->session->userdata('foto_user'))){
				unlink(FCPATH."assets/images/user/".$this->session->userdata('foto_user'));}
			
			if($this->session->userdata('level') == "1"){

				$this->admin_mod->upload_profile($this->upload->data()['file_name']);
				$this->session->set_userdata('foto_user', $this->upload->data()['file_name']);
				redirect(base_url().'profile','refresh');
			}
			else if($this->session->userdata('level') == "2"){
				$this->koperasi_mod->upload_profile($this->upload->data()['file_name']);
				$this->session->set_userdata('foto_user', $this->upload->data()['file_name']);

				redirect(base_url().'profile','refresh');
			}
			else if($this->session->userdata('level') == "3"){
				$this->anggota_mod->upload_profile($this->upload->data()['file_name']);
				$this->session->set_userdata('foto_user', $this->upload->data()['file_name']);

				redirect(base_url().'profile','refresh');
			}
			

		}
	}
}
