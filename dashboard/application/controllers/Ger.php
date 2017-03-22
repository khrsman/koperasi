<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ger extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		$this->load->model('login_mod');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}

	function index(){

    		$this->form_validation->set_rules('nama_depan', 'Nama Lengkap', 'required|xss_clean');
    		$this->form_validation->set_rules('nama_belakang', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
			$this->form_validation->set_rules('telp', 'Telepon', 'numeric|required|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|alpha_numeric|callback_cek_username');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

			if ($this->form_validation->run() == FALSE) {
					$data['question'] = $this->login_mod->get_question()->result();
				 	$this->load->view('registrasi', $data);
			}	
				
			else {
					$this->session->set_flashdata('msg','Terimakasih Telah Mendaftar, Silakan Login Di Form Dibawah Ini ');
					$this->login_mod->insert_user();
					redirect(base_url().'login','refresh');
			}			
	}
	

	public function cek_username($username){

		$username = $this->input->post('username');

		$result = $this->login_mod->cek_username($username);


		if(!$result){
			$this->form_validation->set_message('cek_username', 'Username sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}
}

/* End of file ger.php */
/* Location: ./application/controllers/ger.php */