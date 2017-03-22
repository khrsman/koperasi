<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komunitas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		// $this->session->set_userdata('level', "1");
		$this->load->model('komunitas_mod');
	}

	function komunitas_data()
	{
		$data['komunitas'] = $this->komunitas_mod->get_all_komunitas()->result();
		$data['no'] = 1;
		$data['title'] = "Data Komunitas";
		$this->load->view('komunitas/komunitas_data', $data);
	}


	function add_komunitas(){
		

		$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('berdiri', 'Tanggal Berdiri', 'required|xss_clean');
		$this->form_validation->set_rules('ketua', 'Ketua Koperasi', 'required|xss_clean');
		$this->form_validation->set_rules('ketua_telp', 'No Telepon Ketua Koperasi', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean|callback_cek_email');

		// $this->form_validation->set_rules('komunitas', 'Cabang Koperasi', 'xss_clean');

		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|alpha_numeric|callback_cek_username');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Tambah Komunitas";
			$data['data_kop'] = $this->komunitas_mod->get_id_nama()->result();
			$this->load->view('komunitas/add_komunitas', $data);
		} 
		else {
				$this->session->set_flashdata('msg','Data Komunitas berhasil ditambahkan');
				$this->komunitas_mod->add_komunitas();
				redirect(base_url().'komunitas','refresh');
	
		}
	}

	function edit_komunitas(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'komunitasupdate','refresh');
	}
	

	function update_komunitas(){
		
		$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('berdiri', 'Tanggal Berdiri', 'required|xss_clean');
		$this->form_validation->set_rules('ketua', 'Ketua Koperasi', 'required|xss_clean');
		$this->form_validation->set_rules('ketua_telp', 'No Telepon Ketua Koperasi', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean|callback_cek_email');


		if ($this->form_validation->run() == FALSE) {
			if($this->komunitas_mod->get_komunitas_by_id($this->session->userdata('id'))->num_rows() > 0){
				$data['komunitas'] = $this->komunitas_mod->get_komunitas_by_id($this->session->userdata('id'))->row_array();
				$data['title'] = "Edit Komunitas";
				
				$this->load->view('komunitas/edit_komunitas', $data);
			}
			else {
				redirect(base_url().'not_found','refresh');
			}
			
		} 
		else {
			$this->komunitas_mod->update_komunitas();
			$this->session->set_flashdata('msg','Data Komunitas berhasil diubah');
			redirect(base_url().'komunitas','refresh');
		}
	}

	function delete_komunitas(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'komunitas_delete','refresh');
	}

	function komunitas_delete(){
		if($this->komunitas_mod->get_komunitas_by_id($this->session->userdata('id'))->num_rows() > 0){
			$this->komunitas_mod->delete_komunitas();
			$this->session->set_flashdata('msg','Data Komunitas berhasil dihapus');
			redirect(base_url().'komunitas','refresh');
		}
		else {
				redirect(base_url().'not_found','refresh');
			}
	}

	public function cek_username($username){

		$username = $this->input->post('username');

		$result = $this->komunitas_mod->cek_username($username);


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

		$result = $this->komunitas_mod->cek_email($email);


		if(!$result){
			$this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}

}

/* End of file Koperasi.php */
/* Location: ./application/controllers/Koperasi.php */