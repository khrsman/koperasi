<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_mod extends CI_Model {

	function get_all_admin($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
		$this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
        $this->db->from('user_info');
		$this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
		$this->db->where('user_info.level', '1');
		$this->db->where('user_info.status_active', '1');
        
        // Filter        
         
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

	function get_admin_by_id($id){
		$this->db->select('user_detail.*, user_info.username as username, user_info.password as password');
		$this->db->from("user_detail");
		$this->db->join('user_info', 'user_info.id_user = user_detail.id_user', 'left');
		$this->db->where('user_detail.id_user', $id);
		return $this->db->get();
	}


	function get_basic_profile_admin(){
		$this->db->select('user_detail.nama_depan, user_detail.nama_belakang, user_detail.alamat, user_detail.jenis_kelamin');
		$this->db->from('user_detail');
		$this->db->join('user_info', 'user_info.id_user = user_detail.id_user', 'left');
		$this->db->where('user_detail.id_user', $id);
		return $this->db->get();
	}



	function update_basic($id){
		$object = array('nama_lengkap' 		=> $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
						'nama_depan' 		=> $this->input->post('nama_depan'),
						'nama_belakang' 	=> $this->input->post('nama_belakang'),
						'jenis_kelamin' 	=> $this->input->post('jkel'),
						'alamat' 			=> $this->input->post('alamat'),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_user' 		=> $this->session->userdata('id_user'));


		$this->db->where('id_user', $id);
		$this->db->update("user_detail", $object);
	}

	function update_password($id){
		$object = array('password' 			=> sha1(md5(strrev($this->input->post('new_password')))),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_user' 		=> $this->session->userdata('id_user'));


		$this->db->where('id_user');
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

	
	function insert_admin(){
		$id_user = "9".time();
		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));

		$data = array('id_user' => $id_user,
					  'username' => $this->input->post('username'),
					  'password' => $password,
					  'status_active' => 1,
					  'level' => "1",
					  'last_login'=> date('H:i:s'),
					  'service_time' => date('Y/m/d H:i:s'),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		$object = array('id_user' => $id_user,
						'nama_lengkap' => $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
						'nama_depan' => $this->input->post('nama_depan'),
						'nama_belakang' => $this->input->post('nama_belakang'),
						'jenis_kelamin' => $this->input->post('jkel'),
						'email' => $this->input->post('email'),
						'alamat' => $this->input->post('alamat'),
						'telp' => $this->input->post('telepon'),
						'service_time' => date('Y/m/d H:i:s'),
						'service_action' => 'insert',
						'service_user' => $this->session->userdata('id_user'));

		$this->db->insert("user_info", $data);
		$this->db->insert("user_detail", $object);
	}

	function delete_admin(){
		$object = array('status_active' => "0",
						'service_action' => "delete",
						'service_user' => $this->session->userdata('id_user'));



		$this->db->where('id_user', $this->session->userdata('id_admin'));
		$this->db->update('user_info', $object);
	}


	function upload_profile($photo){
		$data = array('foto' => $photo );

		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->update('user_info', $data);
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

	function cek_password(){
		$this->db->select('password');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$return = $this->db->get('user_info');

		if($return->num_rows() == "1"){
			return $return;
		}
		else {
			return FALSE;
		}
	}
}

/* End of file admin_mod.php */
/* Location: ./application/models/admin_mod.php */