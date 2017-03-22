<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_mod extends CI_Model {

	public function get_password($username){
		$this->db->select('password');
		$this->db->where('username', $username);
		$result = $this->db->get('user_info');


		if($result->num_rows() == 1){
			return $result->row_array();
		}
		else {
			return FALSE;
		}
		
	}

	public function get_question(){
		return $this->db->get('user_question');
	}

	function login($username, $password){
		$this->db->select('user_info.id_user, user_info.username, user_info.password, user_info.level, user_info.last_login');
		$this->db->where('user_info.username', $username);
		$this->db->where('user_info.password', $password);
		$this->db->from('user_info');
		$result = $this->db->get();

		if($result->num_rows() > 0){
			//begin koperasi
			if($result->row()->level == '2'){
				$this->db->select('user_info.id_user, user_info.foto, user_info.username, user_info.password, koperasi.nama as nama_lengkap, user_info.level, user_info.last_login, koperasi.parent_koperasi, koperasi.id_koperasi, koperasi.status_active as status_active, koperasi.cover_foto');
				$this->db->from('user_info');
				$this->db->join('koperasi', 'koperasi.id_user = user_info.id_user');
				$this->db->where('user_info.username', $username);
				$result = $this->db->get();
				if($result->num_rows() > 0){
					return $result->result();
				}
				else {
					return FALSE;
				}
			} //end of koperasi


			// begin komunitas
			else if ($result->row()->level == '4'){

				$this->db->select('user_info.id_user,
								   user_info.foto,
								   user_info.username,
								   user_info.password,
								   komunitas.nama as nama_lengkap,
								   komunitas.cover_foto,
								   user_info.level, user_info.last_login,
								   komunitas.id_komunitas,
								   komunitas.status_active as status_active');



				$this->db->from('user_info');
				$this->db->join('komunitas', 'komunitas.id_user = user_info.id_user');
				$this->db->where('user_info.username', $username);
				$result = $this->db->get();
				if($result->num_rows() > 0){
					return $result->result();
				}
				else {
					return FALSE;
				}
			}




		else{

				$this->db->select('user_info.id_user, user_info.username, user_info.foto, user_info.password, user_detail.nama_lengkap, user_info.level, user_info.last_login, user_info.koperasi, user_info.komunitas');
				$this->db->where('user_info.username', $username);
				$this->db->from('user_info');
				$this->db->join('user_detail', 'user_detail.id_user = user_info.id_user');
				$result = $this->db->get();
				if($result->num_rows() > 0){
					return $result->result();
				}
				else {
					return FALSE;
				}
			}
		}
		

		else{
			return FALSE;
		} //end of user

		


		

	}

	function update_lastlogin($username){
		$this->db->where('username', $username);

		$object = array('last_login' => date("Y-m-d H:i:s"),
						'session_token' => "5".time() );


		$this->db->update('user_info', $object);
	}

	
	
	function insert_user(){

		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));
		$id_user = "9".time();
		$user_info = array('id_user' => $id_user,
						  'username' => $this->input->post('username'),
						  'password' => $password,
						  'status_active' => 1,
						  'level' => "5",
						  'last_login'=> date('H:i:s'),
						  'service_time' => date('Y/m/d H:i:s'),
						  'service_action' => 'insert');

		$user_detail = array('id_user' => $id_user,
							 'nama_lengkap' => $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
							 'nama_depan' => $this->input->post('nama_depan'),
							 'nama_belakang' => $this->input->post('nama_belakang'),
							 'alamat' => $this->input->post('alamat'),
							 'jenis_kelamin' => $this->input->post('jkel'),
							 'email' => $this->input->post('email'),
							 'telp' => $this->input->post('telp'),
							 'service_time' => date('Y/m/d H:i:s'),
							 'service_action' => 'insert');
		
		foreach ($this->get_question()->result() as $row){
			$question_answer = array('id_user' => $id_user,
								 	 'id_pertanyaan' => $row->id_pertanyaan,
								 	 'jawaban' => $this->input->post($row->id_pertanyaan));

			$this->db->insert('user_answer_question', $question_answer);
		}
		
		
		$this->db->insert("user_info", $user_info);
		$this->db->insert("user_detail", $user_detail);
	}

	function cek_username($username){

		$this->db->select('username');
		$this->db->where('username', $username);
		$query = $this->db->get('user_info');

		if($query->num_rows() == 0){
			return TRUE;
		}
		else {
			return FALSE;
		}

	}

	function cek_status_active_koperasi($id){
			$this->db->select('status_active');
			$this->db->where('id_koperasi', $id);
			return $this->db->get('koperasi');
	}

	function cek_status_active_komunitas($id){
			$this->db->select('status_active');
			$this->db->where('id_komunitas', $id);
			return $this->db->get('komunitas');
	}
}

/* End of file login_mod.php */
/* Location: ./application/models/login_mod.php */