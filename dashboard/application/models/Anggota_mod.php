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
		$this->db->where('user_info.status_validasi', "Y");
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
      //  echo("<pre>");
     //   echo $this->db->last_query();
//print_R($result);
//die;
        
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
		
		$date = new DateTime($this->input->post('tanggal_lahir'));
        $tgl_lahir =  $date->format('Y-m-d'); 


        if($this->session->userdata('level') == '1'){
        	$user_info = array('koperasi' => $this->input->post('koperasi'),
        					   'service_time' 			=> date('Y/m/d H:i:s'),
							   'service_action' 		=> 'update',
							   'service_user' 			=> $this->session->userdata('id_user'));

        	$this->db->where('id_user', $id);
        	$this->db->update('user_info', $user_info);

        }


		$object = array(	'no_ktp' 		=> $this->input->post('noktp'),

							'nama_lengkap' 	=> $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),

							'nama_depan' 	=> $this->input->post('nama_depan'),

							'nama_belakang' => $this->input->post('nama_belakang'),

							'no_anggota' 	=> $this->input->post('no_anggota'),

							'tempat_lahir' 	=> $this->input->post('tempat_lahir'),

							'tgl_lahir' 	=> $tgl_lahir,

							'jabatan'		=>$this->input->post('jabatan'),

							'pekerjaan' 	=> $this->input->post('pekerjaan'),

							'jenis_kelamin' => $this->input->post('jkel'),

							'golongan_darah'=> $this->input->post('gol_darah'),

							'agama' 		=> $this->input->post('agama'),

							'npwp' 			=> $this->input->post('npwp'),

							'pendidikan_terakhir' 	=> $this->input->post('pendidikan'),

							'jumlah_tanggungan'  	=> $this->input->post('tanggungan'),

							'jumlah_hp_aktif' 	  	=> $this->input->post('jumlah_hp'),

							'jumlah_akun_bank' 		=> $this->input->post('jumlah_bank'),

							'jumlah_kartu_kredit' 	=> $this->input->post('jumlah_cc'),

							'jumlah_sepeda_motor' 	=> $this->input->post('jum_motor'),

							'jumlah_mobil' 			=> $this->input->post('jum_mobil'),

							'jumlah_rumah' 			=> $this->input->post('jumlah_rumah'),

							'service_time' 			=> date('Y/m/d H:i:s'),

							'service_action' 		=> 'update',

							'service_user' 			=> $this->session->userdata('id_user'));

		foreach ($this->get_question()->result() as $row){
			$question_answer = array('jawaban' => $this->input->post($row->id_pertanyaan));

			$this->db->where('id_user', $id);
			$this->db->where('id_pertanyaan', $row->id_pertanyaan);
			$this->db->update('user_answer_question', $question_answer);
		}


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
						'telp2' 			=> $this->input->post('telepon2'),
						'telp3' 			=> $this->input->post('telepon3'),
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

		$id_user = "9".time();
		$id_alamat = "13".time();

		$pass = strrev($this->input->post('password'));
		$password = sha1(md5($pass));


		if($this->session->userdata('level') == "1"){
			$koperasi = $this->input->post('koperasi');
			$status_validasi = "Y";
			$tanggal_validasi = date("Y-m-d");
		}
		else {
			$koperasi = $this->session->userdata('id_koperasi');
			$status_validasi = "Y";
			$tanggal_validasi = date("Y-m-d");
		}




        $date = new DateTime($this->input->post('tanggal_lahir'));
        $tgl_lahir =  $date->format('Y-m-d');

        $tanggal_mulai_polis = new DateTime($this->input->post('mulai_polis'));
        $mulai_polis =  $tanggal_mulai_polis->format('Y-m-d');

        $tanggal_akhir_polis = new DateTime($this->input->post('akhir_polis'));
        $akhir_polis =  $tanggal_akhir_polis->format('Y-m-d');

		$user_info = array('id_user' 		=> $id_user,
						   'koperasi' 		=> $koperasi,
						   'komunitas' 		=> NULL,
						   'username' 		=> $this->input->post('username'),
						   'password' 		=> $password,
						   'status_active'  => "1",
						   'level' 			=> "3",
						   'status_validasi'=> $status_validasi,
						   'service_time' 	=> date("Y-m-d H:i:s"),
						   'service_action' => "insert",
						   'service_user'	=> $this->session->userdata('id_user'));


		$user_detail = array('id_user' 		=> $id_user,

							'no_ktp' 		=> $this->input->post('noktp'),

							'nama_lengkap' 	=> $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),

							'nama_depan' 	=> $this->input->post('nama_depan'),

							'nama_belakang' => $this->input->post('nama_belakang'),

							'no_anggota' 	=> $this->input->post('no_anggota'),

							'tempat_lahir' 	=> $this->input->post('tempat_lahir'),

							'tgl_lahir' 	=> $tgl_lahir,

							'alamat' 		=> $this->input->post('alamat'),

							'jabatan'		=>$this->input->post('jabatan'),

							'pekerjaan' 	=> $this->input->post('pekerjaan'),

							'telp' 			=> $this->input->post('telepon'),

							'telp2' 		=> $this->input->post('telepon2'),

							'telp3' 		=> $this->input->post('telepon3'),

							'jenis_kelamin' => $this->input->post('jkel'),

							'golongan_darah'=> $this->input->post('gol_darah'),

							'agama' 		=> $this->input->post('agama'),

							'kelurahan' 	=> $this->input->post('kel'),

							'kecamatan' 	=> $this->input->post('kec'),

							'kabupaten' 	=> $this->input->post('kota'),

							'provinsi' 		=> $this->input->post('prop'),

							'rt' 			=> $this->input->post('rt'),

							'rw' 			=> $this->input->post('rw'),

							'kode_pos' 		=> $this->input->post('kode_pos'),

							'npwp' 			=> $this->input->post('npwp'),

							'email' 		=> $this->input->post('email'),

							'user_ver' 		=> sha1(md5(strrev($this->input->post('pin')))),

							'pendidikan_terakhir' 	=> $this->input->post('pendidikan'),

							'jumlah_tanggungan'  	=> $this->input->post('tanggungan'),

							'jumlah_hp_aktif' 	  	=> $this->input->post('jumlah_hp'),

							'jumlah_akun_bank' 		=> $this->input->post('jumlah_bank'),

							'jumlah_kartu_kredit' 	=> $this->input->post('jumlah_cc'),

							'jumlah_sepeda_motor' 	=> $this->input->post('jum_motor'),

							'jumlah_mobil' 			=> $this->input->post('jum_mobil'),

							'jumlah_rumah' 			=> $this->input->post('jumlah_rumah'),

							'tgl_efektif_polis'		=> $mulai_polis,

							'tgl_berakhir_polis'	=> $akhir_polis,

							'service_time' 			=> date('Y/m/d H:i:s'),

							'service_action' 		=> 'insert',

							'service_user' 			=> $this->session->userdata('id_user'));

		 
		$alamat = array('id_user' => $id_user,
                        'id_alamat' =>$id_alamat,
                        'pengirim_nama' => $this->input->post('nama_depan')."&nbsp;".$this->input->post('nama_belakang'),
                        'pengirim_alamat' => $this->input->post('alamat'),
                        'pengirim_kelurahan' => $this->input->post('kel'),
                        'pengirim_kecamatan' => $this->input->post('kec'),
                        'pengirim_kabupaten' => $this->input->post('kota'),
                        'pengirim_provinsi' => $this->input->post('prop'),
                        'pengirim_kode_pos' => $this->input->post('kode_pos'),
                        'pengirim_no_tlp' => $this->input->post('telp'),
                        'status_default' => '1');
        


		
		$this->db->insert('user_info', $user_info);
        $this->db->insert('user_alamat', $alamat);
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

	function get_question_answered($id_user, $id_pertanyaan){
		$this->db->select('jawaban');
		$this->db->from('user_answer_question');
		$this->db->join('user_question', 'user_question.id_pertanyaan = user_answer_question.id_pertanyaan', 'left');
		$this->db->where('user_answer_question.id_user', $id_user);
		$this->db->where('user_answer_question.id_pertanyaan', $id_pertanyaan);



		$return = $this->db->get();

		if($return->num_rows() > 0){
			return $return;
		}
		else {
			return FALSE;
		}
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
			 $this->db->where('user_info.komunitas', $this->session->userdata('komunitas_ID'));
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