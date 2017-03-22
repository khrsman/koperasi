<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		$this->load->model('auth_model');
		$this->load->library('encrypt');

		
	}

	 function recovery()
	{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean|callback_cek_email');


			if ($this->form_validation->run() == FALSE) {
				$data['page'] 				= 'auth/forgot_password_view';
				$data['action_form']        = site_url('recovery');    
		        $this->load->view('main_view',$data);
			} 
			else {
					$email = $this->input->post('email');
					$get_data = $this->auth_model->get_username_by_email($email);

					if($get_data){
						$username = $get_data->row_array()['username'];
						$encrypted_username = $this->encrypt->encode(($username));



						$encrypted_username = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypted_username);

						$data['nama'] = $get_data->row_array()['nama'];
						$data['username'] = $username;

						$data['link'] = base_url()."reset_password/".$encrypted_username;

						$message = $this->load->view('auth/email_view',$data,TRUE);




						$this->load->library('email');
						$config['mailtype'] = "html";

						$this->email->initialize($config);
						$this->email->from('recovery@smidumay.com', 'SMIDUMAY Account Recovery');
						$this->email->to($email);
						$this->email->cc('');
						$this->email->bcc('');
			
						$this->email->subject('SMIDUMAY Account Recovery');
						$this->email->message($message);



						
						

						$this->email->send();

						$data['page'] 				= 'auth/confirm_forgot_password_view';
				        $this->load->view('main_view',$data);

					}
					else{
						$this->session->set_flashdata('msg', 'Email tidak terdaftar');
						redirect(base_url().'recovery','refresh');
					}
			}
	}

		function cek_email($email){

        $email = $this->input->post('email');

        $result = $this->auth_model->cek_email($email);


        if(!$result){
            $this->form_validation->set_message('cek_email', 'Email tidak terdaftar');
            return FALSE;
        }
        else{
            return TRUE;
        }
	}


	function reset_password(){
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|callback_cek_confirm_password');
			$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|xss_clean');

			if ($this->form_validation->run() == FALSE) {
					$decrypted_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->rsegment(3));

					$cek_username = $this->auth_model->cek_reset_password_username($decrypted_username);

					if(!$cek_username || $cek_username->row_array()['username'] == "0"){
						redirect(base_url().'auth','refresh');
					}
					$data['page'] 				= 'auth/reset_password_view';
					$data['action_form']        = site_url('reset_password/'.$this->uri->rsegment(3));    
			        $this->load->view('main_view',$data);


			} else {
				$decrypted_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->rsegment(3));
				$this->auth_model->update_password($decrypted_username);
				$this->session->set_flashdata('msg', 'Password Berhasil Di-reset');
				redirect(base_url().'auth','refresh');
			}
						
	}

	function cek_confirm_password(){
		$password = $this->input->post('password');

		if($this->input->post('confirm_password') == $password){
			return TRUE;
		}
		else{
				$this->form_validation->set_message('cek_confirm_password', 'Password yang anda masukan tidak sama, silakan cek kembali');
				return FALSE;
		}
	}

}

/* End of file Forgot_password.php */
/* Location: .//private/var/folders/jb/z3qj00991klcbt3zcnvqfl6h0000gn/T/fz3temp-1/Forgot_password.php */