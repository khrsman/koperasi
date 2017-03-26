<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Validasi_manager extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// redirect(SMIDUMAY,'refresh');
		$this->load->model('login_mod');
	}

			function check_user(){
				//Get password yang username nya sesuai yg diinput
				$username = $this->input->post('username');
				//$pass = strrev($this->input->post('pas'sword'));
				$pass = strrev('managerkop');
				$password = sha1(md5($pass));
				$res_login = $this->login_mod->login($username, $password);
				// $res_login = $this->login_mod->login('managerkop', $password);

				if($res_login){
				$result = array('level' =>  $res_login[0]->level);
			} else{
				$result = array('level' =>  'x');
			}
					
			echo json_encode($result);


}



		}
