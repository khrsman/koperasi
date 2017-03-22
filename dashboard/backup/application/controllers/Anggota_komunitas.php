<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_komunitas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		// $this->session->set_userdata('level', '3');
		
		$this->load->model('anggota_komunitas_mod');
		$this->load->model('komunitas_mod');
		$this->load->model('pekerjaan_mod');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}

	function data_anggota_komunitas()
	{
		$data['anggota_komunitas'] = $this->anggota_komunitas_mod->get_all_anggota_komunitas()->result();
		$data['title'] = "Data Anggota Komunitas Komunitas";
		$data['no'] = 1;
		$this->load->view('user/anggota_komunitas_data', $data);
	}
	public function agama(){
		$agama = array(		   'Islam' => "Islam",
							   'Kristen Katolik' => "Kristen Katolik",
							   'Kristen Protestan' => "Kristen Protestan",
							   'Hindu' => "Hindu",
							   'Budha' => "Budha");

		return $agama;
	}

	function add_anggota_komunitas(){
		$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
		$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean|callback_cek_email');
		$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|callback_cek_username');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		// $this->form_validation->set_rules('komunitas', 'Komunitas', 'required|xss_clean');
		// $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$data['question'] = $this->anggota_komunitas_mod->get_question()->result();
			$data['agama'] = $this->agama();
			$data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
			$data['komunitas'] = $this->komunitas_mod->get_all_komunitas()->result();
			$data['title'] = "Tambah Anggota Komunitas";
			$this->load->view('user/add_anggota_komunitas', $data);
		} 
		else {
			$this->anggota_komunitas_mod->add_anggota_komunitas();
			$this->session->set_flashdata('msg','Data Anggota Komunitas berhasil ditambahkan');
			redirect(base_url().'anggota_komunitas','refresh');
		}

	}


	function edit_anggota_komunitas(){
			$this->session->set_userdata('id',$this->uri->rsegment(3));
			redirect(base_url().'update_anggota_komunitas','refresh');
	}


	function anggota_komunitas_edit(){
		$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
		$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			if($this->anggota_komunitas_mod->get_anggota_komunitas_by_id($this->session->userdata('id'))->num_rows() > 0){
				$data['user'] = $this->anggota_komunitas_mod->get_anggota_komunitas_by_id($this->session->userdata('id'))->row_array();
				$data['agama'] = $this->agama();
				$data['question'] = $this->anggota_komunitas_mod->get_question()->result();
				$data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
				$data['komunitas'] = $this->komunitas_mod->get_all_komunitas()->result();
				$data['title'] = "Edit Anggota Komunitas";
				$this->load->view('user/edit_anggota_komunitas', $data);
			}
			else {
				redirect(base_url().'not_found','refresh');
			}
		} 
		else {
				$this->anggota_komunitas_mod->update_anggota_komunitas();
				$this->session->set_flashdata('msg','Data Anggota Komunitas berhasil diubah');
				redirect(base_url().'anggota_komunitas','refresh');
		}

	}


	function delete_anggota_komunitas(){
			$this->session->set_userdata('id',$this->uri->rsegment(3));
			redirect(base_url().'anggota_komunitas_delete','refresh');
	}

	function anggota_komunitas_delete(){
		if($this->anggota_komunitas_mod->get_anggota_komunitas_by_id($this->session->userdata('id'))->row_array() > 0){
			$this->anggota_komunitas_mod->delete_anggota_komunitas();
			$this->session->set_flashdata('msg','Data Anggota Komunitas berhasil dihapus');

			redirect(base_url().'anggota_komunitas','refresh');
		}
		else {
			redirect(base_url().'not_found','refresh');
		}
	}



	public function cek_username($username){

		$username = $this->input->post('username');
		$result = $this->anggota_komunitas_mod->cek_username($username);


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

		$result = $this->anggota_komunitas_mod->cek_email($email);


		if(!$result){
			$this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}





}

/* End of file Anggota Komunitas.php */
/* Location: ./application/controllers/Anggota Komunitas.php */