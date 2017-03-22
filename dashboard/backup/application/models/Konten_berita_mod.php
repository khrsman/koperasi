<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konten_berita_mod extends CI_Model {

	function __construct()
		{
			parent::__construct();
			//Do your magic here
		}


	function get_all_berita_admin(){
			$this->db->select('konten_berita.*, user_detail.nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('user_detail', 'konten_berita.id_user = user_detail.id_user');
			$this->db->where('konten_berita.level_akses', '1');
			return $this->db->get();
	}


	function get_id_nama_koperasi(){
		$this->db->select('id_koperasi, nama');
		$this->db->from('koperasi kop');
		return $this->db->get();
	}
	function get_id_nama_komunitas(){
		$this->db->select('id_komunitas, nama');
		$this->db->from('komunitas');
		return $this->db->get();
	}

	function get_all_berita_koperasi(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_berita.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('koperasi', 'konten_berita.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('id_berita_koperasi'));
			$this->db->where('konten_berita.level_akses', '2');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "2"){
			$this->db->select('konten_berita.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('koperasi', 'konten_berita.id_user = koperasi.id_user');
			$this->db->where('konten_berita.level_akses', '2');
			$this->db->where('koperasi.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if koperasi

		if($this->session->userdata('level') == "3"){
			$this->db->select('konten_berita.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('koperasi', 'konten_berita.id_user = koperasi.id_user');
			$this->db->where('konten_berita.level_akses', '2');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get();


		} //if anggota_koperasi

	}

	function get_all_berita_komunitas(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_berita.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('komunitas', 'konten_berita.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('id_berita_komunitas'));
			$this->db->where('konten_berita.level_akses', '4');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "4"){
			$this->db->select('konten_berita.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('komunitas', 'konten_berita.id_user = komunitas.id_user');
			$this->db->where('konten_berita.level_akses', '4');
			$this->db->where('komunitas.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if komunitas

		if($this->session->userdata('level') == "5"){
			$this->db->select('konten_berita.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('komunitas', 'konten_berita.id_user = komunitas.id_user');
			$this->db->where('konten_berita.level_akses', '4');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas'));
			return $this->db->get();
		}
	}

	function get_berita_by_id(){
		if($this->session->userdata('level_data_berita') == "koperasi") {
			$this->db->select('konten_berita.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('koperasi', 'konten_berita.id_user = koperasi.id_user');
			$this->db->where('id_berita', $this->session->userdata('id_berita'));
			return $this->db->get();
		}
		if($this->session->userdata('level_data_berita') == "komunitas") {
			$this->db->select('konten_berita.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('komunitas', 'konten_berita.id_user = komunitas.id_user');
			$this->db->where('id_berita', $this->session->userdata('id_berita'));
			return $this->db->get();
		}
		else {
			$this->db->select('konten_berita.*, user_detail.nama_lengkap');
			$this->db->from('konten_berita');
			$this->db->join('user_detail', 'konten_berita.id_user = user_detail.id_user');
			$this->db->where('id_berita', $this->session->userdata('id_berita'));
			return $this->db->get();
		}
	}





	function add_berita(){

		$data = array('id_berita' => $this->session->userdata('id_berita'),
					  'id_user' => $this->session->userdata('id_user'),
					  'level_akses' => $this->session->userdata('level'),
					  'judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'link_gambar'=>$this->session->userdata('photo'),
					  'tanggal_dibuat'=> date("Y-m-d H:i:s"),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->insert('konten_berita', $data);

	}

	function edit_berita(){
		$data = array('judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'update',
					  'service_user' => $this->session->userdata('id_user'));
		$this->db->where('id_berita', $this->session->userdata('id_berita'));
		$this->db->update('konten_berita', $data);
	}

	function edit_foto_berita(){
		$data = array('link_gambar' => $this->session->userdata('photo'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->where('id_berita', $this->session->userdata('id_berita'));
		$this->db->update('konten_berita', $data);
	}


	function delete_berita(){
		$this->db->where('id_berita', $this->session->userdata('id_berita'));
		$this->db->delete('konten_berita');
	}

		

}

/* End of file berita_data.php */
/* Location: ./application/views/berita/berita_data.php */