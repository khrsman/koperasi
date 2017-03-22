<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->model('pekerjaan_mod');
	}

	function pekerjaan_data()
	{
		$data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
		$data['no'] = 1;
		$this->load->view('pekerjaan/pekerjaan_data', $data);
	}

	function add_pekerjaan(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('pekerjaan/add_pekerjaan');
		} 
		else {
			$this->pekerjaan_mod->add_pekerjaan();
			redirect(base_url().'pekerjaan','refresh');
		}
	}

	function edit_pekerjaan(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'pekerjaanupdate','refresh');
	}
	function delete_pekerjaan(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'pekerjaan_delete','refresh');
	}

	function update_pekerjaan(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$data['pekerjaan'] = $this->pekerjaan_mod->get_pekerjaan_by_id($this->session->userdata('id'))->row_array();
			$this->load->view('pekerjaan/edit_pekerjaan', $data);
		} 
		else {
			$this->pekerjaan_mod->update_pekerjaan();
			redirect(base_url().'pekerjaan','refresh');
		}
	}

	function pekerjaan_delete(){
		$this->pekerjaan_mod->delete_pekerjaan();
		redirect(base_url().'pekerjaan','refresh');
	}

}

/* End of file Pekerjaan.php */
/* Location: ./application/controllers/Pekerjaan.php */