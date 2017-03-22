<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konten_compro_mod extends CI_Model {

	function __construct()
		{
			parent::__construct();
			//Do your magic here
		}


	function get_all_compro_admin(){
			$this->db->select('konten_compro.*, user_detail.nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('user_detail', 'konten_compro.id_user = user_detail.id_user');
			$this->db->where('konten_compro.level_akses', '1');
			return $this->db->get();
	}


	function get_id_nama_koperasi(){
		$this->db->select('id_koperasi, nama');
		$this->db->from('koperasi');
		return $this->db->get();
	}
	function get_id_nama_komunitas(){
		$this->db->select('id_komunitas, nama');
		$this->db->from('komunitas');
		return $this->db->get();
	}


	function get_all_compro_koperasi(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_compro.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('koperasi', 'konten_compro.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('id_compro_koperasi'));
			$this->db->where('konten_compro.level_akses', '2');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "2"){
			$this->db->select('konten_compro.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('koperasi', 'konten_compro.id_user = koperasi.id_user');
			$this->db->where('konten_compro.level_akses', '2');
			$this->db->where('koperasi.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if koperasi

		if($this->session->userdata('level') == "3"){
			$this->db->select('konten_compro.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('koperasi', 'konten_compro.id_user = koperasi.id_user');
			$this->db->where('konten_compro.level_akses', '2');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get();


		} //if anggota_koperasi

	}

	function get_all_compro_komunitas(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_compro.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('komunitas', 'konten_compro.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('id_compro_komunitas'));
			$this->db->where('konten_compro.level_akses', '4');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "4"){
			$this->db->select('konten_compro.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('komunitas', 'konten_compro.id_user = komunitas.id_user');
			$this->db->where('konten_compro.level_akses', '4');
			$this->db->where('komunitas.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if komunitas

		if($this->session->userdata('level') == "5"){
			$this->db->select('konten_compro.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('komunitas', 'konten_compro.id_user = komunitas.id_user');
			$this->db->where('konten_compro.level_akses', '4');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas'));
			return $this->db->get();
		}
	}

	function get_compro_by_id(){
		if($this->session->userdata('level_data_compro') == "koperasi") {
			$this->db->select('konten_compro.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('koperasi', 'konten_compro.id_user = koperasi.id_user');
			$this->db->where('id_compro', $this->session->userdata('id_compro'));
			return $this->db->get();
		}
		if($this->session->userdata('level_data_compro') == "komunitas") {
			$this->db->select('konten_compro.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('komunitas', 'konten_compro.id_user = komunitas.id_user');
			$this->db->where('id_compro', $this->session->userdata('id_compro'));
			return $this->db->get();
		}
		else {
			$this->db->select('konten_compro.*, user_detail.nama_lengkap');
			$this->db->from('konten_compro');
			$this->db->join('user_detail', 'konten_compro.id_user = user_detail.id_user');
			$this->db->where('id_compro', $this->session->userdata('id_compro'));
			return $this->db->get();
		}
	}





	function add_compro(){

		$data = array('id_compro' => $this->session->userdata('id_compro'),
					  'id_user' => $this->session->userdata('id_user'),
					  'level_akses' => $this->session->userdata('level'),
					  'judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'link_gambar'=>$this->session->userdata('photo'),
					  'tanggal_dibuat'=> date("Y-m-d H:i:s"),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->insert('konten_compro', $data);

	}

	function edit_compro(){
		$data = array('judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'update',
					  'service_user' => $this->session->userdata('id_user'));
		$this->db->where('id_compro', $this->session->userdata('id_compro'));
		$this->db->update('konten_compro', $data);
	}

	function edit_foto_compro(){
		$data = array('link_gambar' => $this->session->userdata('photo'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->where('id_compro', $this->session->userdata('id_compro'));
		$this->db->update('konten_compro', $data);
	}


	function delete_compro(){
		$this->db->where('id_compro', $this->session->userdata('id_compro'));
		$this->db->delete('konten_compro');
	}

		

}

/* End of file compro_data.php */
/* Location: ./application/views/compro/compro_data.php */