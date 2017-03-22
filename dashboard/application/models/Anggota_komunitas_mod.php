<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_komunitas_mod extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		
		
	}



	function get_all_anggota_komunitas(){

		if($this->session->userdata('level') == "1"){
			$this->db->select('user_info.username,user_info.id_user, user_detail.alamat, user_detail.telp,user_detail.email, user_detail.nama_lengkap, komunitas.nama');
			$this->db->from('user_info');
			$this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
			$this->db->join('komunitas', 'user_info.komunitas = komunitas.id_komunitas');
			$this->db->where('user_info.level', "5");
			$this->db->where('user_info.status_active', "1");
			return $this->db->get();
		}
		else {
			$this->db->select('user_info.username,user_info.id_user, user_detail.alamat, user_detail.telp,user_detail.email, user_detail.nama_lengkap, komunitas.nama');
			$this->db->from('user_info');
			$this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
			$this->db->join('komunitas', 'user_info.komunitas = komunitas.id_komunitas');
			$this->db->where('user_info.level', "5");
			$this->db->where('user_info.status_active', "1");
			$this->db->where('komunitas', $this->session->userdata('komunitas'));
			return $this->db->get();
		}
	}

	function get_anggota_komunitas_by_id($id){
		$this->db->select('user_info.*, user_detail.*');

		if($this->session->userdata('komunitas') != null){
			$this->db->select('komunitas.nama');
			$this->db->join('komunitas', 'komunitas.id_komunitas = user_info.komunitas');
		}


		$this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
		$this->db->where('user_info.id_user', $id);
		return $this->db->get('user_info');
	}

	function add_anggota_komunitas(){
		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));
		$id_user = "9".time();
		if($this->session->userdata('level') == "1"){
			$komunitas = $this->input->post('komunitas');
		}

		else {
			$komunitas = $this->session->userdata('komunitas');
		}

		$user_info = array('id_user' => $id_user,
						   'komunitas' => $komunitas,
						   'username' => $this->input->post('username'),
						   'password' => $password,
						   'status_active' => "1",
						   'level' => "5",
						   'komunitas' =>$komunitas,
						   'service_time' => date("Y-m-d H:i:s"),
						   'service_action' => "insert",
						   'service_user'=>$this->session->userdata('id_user'));


		$user_detail = array('id_user' => $id_user,
							'nama_lengkap' => $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
							'nama_depan' => $this->input->post('nama_depan'),
							'nama_belakang' => $this->input->post('nama_belakang'),
							'pekerjaan' => $this->input->post('pekerjaan'),
							'alamat' => $this->input->post('alamat'),
							'agama' => $this->input->post('agama'),
							'jenis_kelamin' => $this->input->post('jkel'),
							'jabatan' => $this->input->post('jabatan'),
							'no_ktp' => $this->input->post('noktp'),
							'email' => $this->input->post('email'),
							'telp' => $this->input->post('telepon'),
							'service_time' => date('Y/m/d H:i:s'),
							'service_action' => 'insert',
							'service_user' => $this->session->userdata('id_user'));



		// var_dump($user_info);
		// var_dump($user_detail);

		$this->db->insert('user_info', $user_info);
		$this->db->insert("user_detail", $user_detail);	
		foreach ($this->get_question()->result() as $row){
			$question_answer = array('id_user' => $id_user,
								 	 'id_pertanyaan' => $row->id_pertanyaan,
								 	 'jawaban' => $this->input->post($row->id_pertanyaan));

			$this->db->insert('user_answer_question', $question_answer);
		}
	}

	public function get_question(){
		return $this->db->get('user_question');
	}

	function update_anggota_komunitas(){
		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));
		if ($this->session->userdata('level') == "5"){
			$user_info = array('password' => $password,
							   'service_time' => date("Y-m-d H:i:s"),
							   'service_action' => "update",
							   'service_user'=>$this->session->userdata('id_user'));
		}
		else {
			$user_info = array('service_time' => date("Y-m-d H:i:s"),
							   'service_action' => "update",
							   'service_user'=>$this->session->userdata('id_user'));
		}



		$user_detail = array('nama_lengkap' => $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
							'nama_depan' => $this->input->post('nama_depan'),
							'nama_belakang' => $this->input->post('nama_belakang'),
							'pekerjaan' => $this->input->post('pekerjaan'),
							'alamat' => $this->input->post('alamat'),
							'jenis_kelamin' => $this->input->post('jkel'),
							'email' => $this->input->post('email'),
							'jabatan' => $this->input->post('jabatan'),
							'no_ktp' => $this->input->post('noktp'),
							'telp' => $this->input->post('telepon'),
							'service_time' => date('Y/m/d H:i:s'),
							'service_action' => 'update',
							'service_user' => $this->session->userdata('id_user'));

		foreach ($this->get_question()->result() as $row){
			$question_answer = array(
								 	 'id_pertanyaan' => $row->id_pertanyaan,
								 	 'jawaban' => $this->input->post($row->id_pertanyaan));
			$this->db->where('id_user', $this->session->userdata('id_user'));
			$this->db->update('user_answer_question', $question_answer);
		}
		if($this->session->userdata('komunitas') == NULL){
			$komunitas = array('komunitas' => $this->input->post('komunitas'));
			$this->db->update('user_info', $komunitas, array('id_user' => $this->session->userdata('id')));
		}

		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->update('user_info', $user_info);

		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->update("user_detail", $user_detail);
	}

	function delete_anggota_komunitas(){
		$this->db->where('id_user', $this->session->userdata('id'));

		$object = array('status_active' => "0",
						'service_action' => "delete",
						'service_user' => $this->session->userdata('id_user') );

		$this->db->update('user_info', $object);
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

		
	function upload_profile($photo){


		$data = array('foto' => $photo );

		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->update('user_info', $data);
	}

	function last_login(){

		if($this->session->userdata('level') == 2){
			 $this->db->select('user_detail.nama_lengkap, user_info.foto, user_info.last_login');
			 $this->db->from('user_info');
			 $this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
			 $this->db->where('user_info.komunitas', $this->session->userdata('komunitas'));
			 $this->db->order_by('user_info.last_login', 'desc');
			 return $this->db->get();
		}
		else if($this->session->userdata('level') == 1){
			 $this->db->select('user_detail.nama_lengkap, user_info.foto, user_info.last_login');
			 $this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
			 $this->db->where('user_info.level', "3");
			 $this->db->order_by('user_info.last_login', 'desc');
			 return $this->db->get('user_info', 8);
		}
		else {
			return FALSE;
		}
	}

	function cek_email($email){

		$this->db->select('user_detail.email, koperasi.email, komunitas.email');
		$this->db->from('user_detail, koperasi, komunitas');
		$this->db->or_where('komunitas.email', $email);
		$this->db->or_where('user_detail.email', $email);
		$this->db->or_where('koperasi.email', $email);
		$query = $this->db->get();

		if($query->num_rows() == 0){
			return TRUE;
		}
		else {
			return FALSE;
		}

	}
}

/* End of file anggota_komunitas_mod.php */
/* Location: ./application/models/anggota_komunitas_mod.php */