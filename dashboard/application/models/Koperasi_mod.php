<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koperasi_mod extends CI_Model {

	private $tablename = "koperasi";

	public function __construct()
	{
		parent::__construct();
		
		
	}




	function get_all_koperasi(){
		$this->db->select('user_info.username, koperasi.alamat, koperasi.telp, koperasi.nama, koperasi.id_koperasi, koperasi.parent_koperasi');
		$this->db->from('koperasi');
		$this->db->where('koperasi.status_active', "1");
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
		return $this->db->get();
		
		
	}


	function get_id_and_nama($id){
		$this->db->select('koperasi.id_koperasi, koperasi.nama, user_info.foto');
		$this->db->from('koperasi');
		$this->db->join('user_info', 'koperasi.id_user = user_info.id_user');
		$this->db->like('koperasi.nama', $id);
		return $this->db->get();
	}

	function get_all_koperasi_induk($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
		$this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
        $this->db->from('koperasi');
		$this->db->where('koperasi.status_active', "1");
		$this->db->where('koperasi.parent_koperasi', "0");
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
        
        // Filter        
         
        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->or_having($param_query['keyword_by']);
            } else{
                $this->db->or_having($param_query['keyword_by'],$keyword);
            }
        }

        $this->db->limit($limit,$offset);
        $this->db->order_by($param_query['sort'],$param_query['sort_order']);
               
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;

        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
	}

	function get_all_koperasi_cabang($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
		$this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);

		if($this->session->userdata('level') == "1"){
			$this->db->from('koperasi');
			$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
			$this->db->where('koperasi.status_active', "1");
			$this->db->where('parent_koperasi !=', 0);
		}

		else if ($this->session->userdata('level') == "2"){
			$this->db->from('koperasi');
			$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
			$this->db->where('koperasi.status_active', "1");
			$this->db->where('parent_koperasi !=', 0);
			$this->db->where('parent_koperasi', $this->session->userdata('koperasi'));
		}
        
        // Filter        
         
        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->or_having($param_query['keyword_by']);
            } else{
                $this->db->having($param_query['keyword_by'],$keyword);
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


	function get_alamat_koperasi($id){
		$this->db->select('koperasi_alamat.*, ref_provinsi.nama as nama_provinsi, ref_kabupaten.nama as nama_kabupaten, ref_kecamatan.nama as nama_kecamatan, ref_kelurahan.nama as nama_kelurahan');
		$this->db->from('koperasi_alamat');
		$this->db->join('ref_provinsi', 'koperasi_alamat.provinsi = ref_provinsi.id_provinsi');
		$this->db->join('ref_kabupaten', 'koperasi_alamat.kabupaten = ref_kabupaten.id_kabupaten');
		$this->db->join('ref_kecamatan', 'koperasi_alamat.kecamatan = ref_kecamatan.id_kecamatan');
		$this->db->join('ref_kelurahan', 'koperasi_alamat.kelurahan = ref_kelurahan.id_kelurahan');
		$this->db->where('id_koperasi', $id);
		return $this->db->get();

	}

	function get_koperasi_cabang_(){
		$this->db->select('user_info.id_user');
		$this->db->from('user_info');
		$this->db->where('koperasi.status_active', "1");
		$this->db->join('koperasi', 'user_info.id_user = koperasi.id_user');
		return $this->db->get();
	}

	function get_nama_koperasi($id){
		$this->db->select('nama');
		$this->db->where('id_koperasi', $id);
		$query = $this->db->get('koperasi');
		$result = $query->result_array();
		if($query->num_rows() > 0){ return $result; } else { return FALSE; }
	}

	function get_induk_koperasi($id){
		$this->db->select('nama');
		$this->db->where('id_koperasi', $id);
		return $this->db->get('koperasi');
	}

	function get_id_nama(){
		$this->db->select('id_koperasi, nama');
		$this->db->where('status_active', "1");
		return $this->db->get('koperasi');
	}


	function get_koperasi_by_id($id){
		$this->db->select('koperasi.*, user_info.username, user_info.password, user_info.foto');
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
		$this->db->where('id_koperasi', $id);
		return $this->db->get('koperasi');
	}

	function get_koperasi_by_id_profile($id){
		$this->db->select('koperasi.*, koperasi.parent_koperasi as koperasi, koperasi.nama as nama_lengkap, user_info.username, user_info.password');
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
		$this->db->where('koperasi.id_user', $id);
		return $this->db->get('koperasi');
	}


	function select_max(){
		$this->db->select('MAX(id_koperasi) as id_koperasi');
		$this->db->from('koperasi');
		$result = $this->db->get();
			if($result->num_rows() > 0 || $result->num_rows() != NULL){
				return $result;
			}
			else {
				return FALSE;
			}
	}


	function update_basic($id_koperasi){

			if($this->session->userdata('level') != "2"){
			$parent_koperasi = $this->input->post('koperasi');
			}
			else if($this->session->userdata('parent_koperasi') == "0"){
				$parent_koperasi = $this->session->userdata('id_koperasi');
			}
			else {
				$parent_koperasi = $this->session->userdata('parent_koperasi');
			}

			$koperasi = array('nama'					=>$this->input->post('nama'),
							  'alamat' 					=> $this->input->post('alamat'),
							  'tgl_berdiri'				=> $this->input->post('berdiri'),
							  'legal' 					=> $this->input->post('legal'),
							  'ketua_koperasi' 			=> $this->input->post('ketua'),
							  'ketua_koperasi_telp'	 	=> $this->input->post('ketua_telp'),
							  'parent_koperasi'			=> $parent_koperasi,
							  'polis'					=> $this->input->post('polis'),
							  'jenis_koperasi'			=> $this->input->post('jenis'),
							  'keterangan_koperasi'		=> $this->input->post('keterangan'),
							  'service_time' 			=> date("Y-m-d H:i:s"),
							  'service_action' 			=> "update",
							  'service_users'			=>$this->session->userdata('id_user'));

			$this->db->where('koperasi.id_koperasi', $id_koperasi);
			$this->db->update($this->tablename, $koperasi);

	}

	function update_password($id){
		$object = array('password' 			=> sha1(md5(strrev($this->input->post('new_password')))),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_user' 		=> $this->session->userdata('id_user'));


		$this->db->where('id_user', $id);
		$this->db->update("user_info", $object);
	}

	function update_contact($id_koperasi){
		$object = array('email' 			=> $this->input->post('email'),
						'telp' 				=> $this->input->post('telepon'),
						'service_time' 		=> date('Y/m/d H:i:s'),
						'service_action' 	=> 'update',
						'service_users' 	=> $this->session->userdata('id_user'));

		$this->db->where('id_koperasi', $id_koperasi);
		$this->db->update("koperasi", $object);
	}

	function add_koperasi($id){
		$id_user = "9".time();
		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));

		if($this->session->userdata('level') == "1"){
			$koperasi = $this->input->post('koperasi');
		}
		else {
			$koperasi = $this->session->userdata('koperasi');
		}

		$user_info = array('id_user' => $id_user,
						   'koperasi' => $id,
						   'username' => $this->input->post('username'),
						   'password' => $password,
						   'status_active' => "1",
						   'level' => "2",
						   'service_time' => date("Y-m-d H:i:s"),
						   'service_action' => "insert",
						   'service_user'=>$this->session->userdata('id_user'));


		$koperasi = array('id_koperasi' => $id,
						  'id_user'=>$id_user,
						  'nama'=>$this->input->post('nama'),
						  'status_active' => "1",
						  'service_time'=>date("Y-m-d H:i:s"),
						  'email' => $this->input->post('email'),
						  'service_action'=>"insert",
						  'service_users'=>$this->session->userdata('id_user'),
						  'alamat' => $this->input->post('alamat'),
						  'telp'=> $this->input->post('telepon'),
						  'tgl_berdiri'=> $this->input->post('berdiri'),
						  'legal' => $this->input->post('legal'),
						  'ketua_koperasi' => $this->input->post('ketua'),
						  'ketua_koperasi_telp' => $this->input->post('ketua_telp'),
						  'keterangan_koperasi'=> $this->input->post('keterangan'),
						  'parent_koperasi' => $koperasi,
						  'polis' => $this->input->post('polis'),
						  'jenis_koperasi' => $this->input->post('jenis')
						  );

		$koperasi_alamat = array('id_koperasi' => $id,
								 'alamat' => $this->input->post('alamat'),
								 'kelurahan' => $this->input->post('kel'),
								 'kecamatan' => $this->input->post('kec'),
								 'kabupaten' => $this->input->post('kab'),
								 'provinsi' => $this->input->post('prop'),
								 'kode_pos' => $this->input->post('kode_pos'),
								 'no_tlp' => $this->input->post('telepon'));


		$this->db->insert('user_info', $user_info);
		$this->db->insert($this->tablename, $koperasi);
		$this->db->insert('koperasi_alamat', $koperasi_alamat);
	}


	function delete_koperasi(){
		$data = array('status_active' => "0",
					  'service_time'=>date("Y-m-d H:i:s"),
					  'service_action'=>"delete",
					  'service_user'=>$this->session->userdata('id_user') );

		$data2 = array('status_active' => "0",
					  'service_time'=>date("Y-m-d H:i:s"),
					  'service_action'=>"delete",
					  'service_users'=>$this->session->userdata('id_user') );


		$this->db->where('koperasi', $this->session->userdata('id'));
		$this->db->update('user_info', $data);

		$this->db->where('id_koperasi', $this->session->userdata('id'));
		$this->db->update($this->tablename, $data2);
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


	function update_alamat($id){

		$koperasi = array('id_koperasi' => $id,
						  'alamat' => $this->input->post('alamat'),
						  'kelurahan' => $this->input->post('kel'),
						  'kecamatan' => $this->input->post('kec'),
						  'kabupaten' => $this->input->post('kota'),
						  'provinsi'  => $this->input->post('prop'),
						  'kode_pos'  => $this->input->post('kode_pos'));

		if($this->get_alamat_koperasi($id)->num_rows() == 0){
			$this->db->insert('koperasi_alamat', $koperasi);
		}
		else{

			$this->db->where('id_koperasi', $id);
			$this->db->update('koperasi_alamat', $koperasi);
		}


		


	}

	function upload_profile($photo){


		$data = array('foto' => $photo );

		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->update('user_info', $data);
	}

	function upload_cover($photo){


		$data = array('cover_foto' => $photo );

		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->update('koperasi', $data);
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

	function cek_password_lama(){
		$this->db->select('password');
		$this->db->where('id_user', $this->session->userdata('id'));
		$return = $this->db->get('user_info');

		if($return->num_rows() == "1"){
			return $return;
		}
		else {
			return FALSE;
		}
	}


	function get_share_cabang($id){
		$this->db->select('koperasi.nama, koperasi.share_cabang');
		$this->db->where('id_koperasi', $id);
		$return = $this->db->get('koperasi');


		if($return->num_rows() > 0){
			return $return;
		}
		else {
			return FALSE;
		}
	}

	function update_share_profit($id){
		$profit = array('share_cabang' => $this->input->post('profit'),
						'service_time' => date("Y-m-d H:i:s"),
						'service_action' => "update",
						'service_users'=>$this->session->userdata('id_user'));

		$this->db->where('id_koperasi', $id);
		$this->db->update('koperasi', $profit);
	}
}

/* End of file m_koperasi.php */
/* Location: ./application/models/m_koperasi.php */