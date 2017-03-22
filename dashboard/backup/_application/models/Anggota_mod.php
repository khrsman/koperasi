<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_mod extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		
		
	}

	function get_all_anggota($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
		$this->db->select('SQL_CALC_FOUND_ROWS *, user_info.id_user as user_id, user_detail.email as user_email',FALSE);
        $this->db->from('user_info');
		$this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
		$this->db->join('koperasi', 'user_info.koperasi = koperasi.id_koperasi');
		$this->db->where('user_info.level', "3");
		$this->db->where('user_info.status_active', "1");
		if($this->session->userdata('level') == "2"){
			$this->db->where('koperasi', $this->session->userdata('koperasi'));
        }
        
        // Filter
        if(!empty($param_query['filter_koperasi'])):        
        $a = $param_query['filter_koperasi'];
        foreach ($a as $key => $m) {
        if ($m['parameter'] != NULL or $m['parameter'] != "") {
                    if (is_array($param_query['filter_koperasi'])) {
                        foreach ($param_query['filter_koperasi'] as $k => $v) {
                            $this->db->or_having('koperasi.id_koperasi',$v['parameter']);
                        }
                    } else{
                        $this->db->having('koperasi.id_koperasi', "!= NULL");    
                    }
                    
                }
        }
        endif;
        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->like($param_query['keyword_by']);
            } else{
                $this->db->like($param_query['keyword_by'],$keyword);
            }
        }
        
        $this->db->limit($limit,$offset);
        $this->db->order_by($param_query['sort'],$param_query['sort_order']);
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        // $result['count_all']= $this->count_contact_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;

        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
	}

	function get_anggota_by_id($id){
		$this->db->select('user_info.*, user_detail.*');
		if($this->session->userdata('koperasi') != null){
			$this->db->select('koperasi.nama');
			$this->db->join('koperasi', 'koperasi.id_koperasi = user_info.koperasi');
		}
		$this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
		$this->db->where('user_info.id_user', $id);
		return $this->db->get('user_info');
	}




	function update_basic($id){
		$tanggal_lahir 						= new DateTime($this->input->post('tgl_lahir')); 
        $tgl_lahir                          = $tanggal_lahir->format('Y-m-d'); 


		$object = array('nama_lengkap' 		=> $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
						'nama_depan' 		=> $this->input->post('nama_depan'),
						'nama_belakang' 	=> $this->input->post('nama_belakang'),
						'no_ktp' 			=> $this->input->post('noktp'),
						'tempat_lahir' 		=> $this->input->post('tempat_lahir'),
						'tgl_lahir' 		=> $tgl_lahir,
						'jenis_kelamin' 	=> $this->input->post('jkel'),
						'alamat' 			=> $this->input->post('alamat'),
						'pekerjaan' 		=> $this->input->post('pekerjaan'),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_user' 		=> $this->session->userdata('id_user'));


		$this->db->where('id_user', $id);
		$this->db->update("user_detail", $object);
	}

	function update_password(){
		$object = array('password' 			=> sha1(md5(strrev($this->input->post('new_password')))),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_user' 		=> $this->session->userdata('id_user'));


		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->update("user_info", $object);
	}

	function update_contact($id){
		$object = array('email' 			=> $this->input->post('email'),
						'telp' 				=> $this->input->post('telepon'),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_user' 		=> $this->session->userdata('id_user'));

		$this->db->where('id_user', $id);
		$this->db->update("user_detail", $object);
	}

	function update_pin(){
		$object = array('user_ver' 			=> sha1(md5(strrev($this->input->post('new_pin')))),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_user' 		=> $this->session->userdata('id_user'));


		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->update("user_detail", $object);
	}





	function add_anggota(){
		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));
		$id_user = "9".time();

		if($this->session->userdata('level') == "1"){
			$koperasi = $this->input->post('koperasi');
		}

		else {
			$koperasi = $this->session->userdata('id_koperasi');
		}

		if($this->session->userdata('level') == "1"){
			$komunitas = $this->input->post('komunitas');
		}

		else {
			$komunitas = $this->session->userdata('komunitas');
		}

		$user_info = array('id_user' => $id_user,
						   'koperasi' => $koperasi,
						   'komunitas' => $komunitas,
						   'username' => $this->input->post('username'),
						   'password' => $password,
						   'status_active' => "1",
						   'level' => "3",
						   'service_time' => date("Y-m-d H:i:s"),
						   'service_action' => "insert",
						   'service_user'=>$this->session->userdata('id_user'));


		$user_detail = array('id_user' => $id_user,
							'nama_lengkap' => $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
							'nama_depan' => $this->input->post('nama_depan'),
							'nama_belakang' => $this->input->post('nama_belakang'),
							'no_ktp' => $this->input->post('noktp'),
							'jabatan'=>$this->input->post('jabatan'),
							'pekerjaan' => $this->input->post('pekerjaan'),
							'alamat' => $this->input->post('alamat'),
							'agama' => $this->input->post('agama'),
							'user_ver' => sha1(md5(strrev($this->input->post('pin')))),
							'jenis_kelamin' => $this->input->post('jkel'),
							'email' => $this->input->post('email'),
							'telp' => $this->input->post('telepon'),
							'service_time' => date('Y/m/d H:i:s'),
							'service_action' => 'insert',
							'service_user' => $this->session->userdata('id_user'));


		foreach ($this->get_question()->result() as $row){
			$question_answer = array('id_user' => $id_user,
								 	 'id_pertanyaan' => $row->id_pertanyaan,
								 	 'jawaban' => $this->input->post($row->id_pertanyaan));

			$this->db->insert('user_answer_question', $question_answer);
		}


		$this->db->insert('user_info', $user_info);
		$this->db->insert("user_detail", $user_detail);
	}


	public function get_question(){
		return $this->db->get('user_question');
	}

	function update_anggota(){
		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));

		$user_info = array('password' => $password,
						   'service_time' => date("Y-m-d H:i:s"),
						   'service_action' => "update",
						   'service_user'=>$this->session->userdata('id_user'));




		$user_detail = array('nama_lengkap' => $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
							'nama_depan' => $this->input->post('nama_depan'),
							'nama_belakang' => $this->input->post('nama_belakang'),
							'pekerjaan' => $this->input->post('pekerjaan'),
							'jabatan' => $this->input->post('jabatan'),
							'alamat' => $this->input->post('alamat'),
							'jenis_kelamin' => $this->input->post('jkel'),
							'no_ktp' => $this->input->post('noktp'),
							'email' => $this->input->post('email'),
							'user_ver' => sha1(md5(strrev($this->input->post('pin')))),
							'telp' => $this->input->post('telepon'),
							'service_time' => date('Y/m/d H:i:s'),
							'service_action' => 'update',
							'service_user' => $this->session->userdata('id_user'));

		foreach ($this->get_question()->result() as $row){
			$question_answer = array('id_user' => $id_user,
								 	 'id_pertanyaan' => $row->id_pertanyaan,
								 	 'jawaban' => $this->input->post($row->id_pertanyaan));

			$this->db->insert('user_answer_question', $question_answer);
		}
		if($this->session->userdata('koperasi') == NULL){
			$koperasi = array('koperasi' => $this->input->post('koperasi'));
			$this->db->update('user_info', $koperasi, array('id_user' => $this->session->userdata('id')));
		}

		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->update('user_info', $user_info);

		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->update("user_detail", $user_detail);
	}

	function delete_anggota(){
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
			 $this->db->where('user_info.koperasi', $this->session->userdata('koperasi'));
			 $this->db->order_by('user_info.last_login', 'desc');
			 return $this->db->get();
		}
		else if($this->session->userdata('level') == 1){
			 $this->db->select('user_detail.nama_lengkap, user_info.foto, user_info.last_login');
			 $this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
			 $this->db->where('user_info.level !=', "1");
			 $this->db->order_by('user_info.last_login', 'desc');
			 return $this->db->get('user_info', 8);
		}
		else if($this->session->userdata('level') == 4){
			 $this->db->select('user_detail.nama_lengkap, user_info.foto, user_info.last_login');
			 $this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
			 $this->db->where('user_info.level !=', "1");
			 $this->db->where('komunitas', $this->session->userdata('komunitas'));
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


	function cek_pin(){
		$this->db->select('user_ver');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$return = $this->db->get('user_detail');

		if($return->num_rows() == "1"){
			return $return;
		}
		else {
			return FALSE;
		}
	}
}

/* End of file anggota_mod.php */
/* Location: ./application/models/anggota_mod.php */