<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Majalah_mod extends CI_Model {

	function __construct()
		{
			parent::__construct();
			//Do your magic here
		}


	function get_all_majalah_admin(){
			$this->db->select('majalah.*, user_detail.nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('user_detail', 'majalah.id_user = user_detail.id_user');
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


	function get_all_majalah_koperasi(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('majalah.*, koperasi.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('koperasi', 'majalah.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('id_majalah_koperasi'));
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "2"){
			$this->db->select('majalah.*, koperasi.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('koperasi', 'majalah.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if koperasi

		if($this->session->userdata('level') == "3"){
			$this->db->select('majalah.*, koperasi.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('koperasi', 'majalah.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get();


		} //if anggota_koperasi

	}

	function get_all_majalah_komunitas(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('majalah.*, komunitas.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('komunitas', 'majalah.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('id_agenda_komunitas'));
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "4"){
			$this->db->select('majalah.*, komunitas.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('komunitas', 'majalah.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if komunitas

		if($this->session->userdata('level') == "5"){
			$this->db->select('majalah.*, komunitas.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('komunitas', 'majalah.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas'));
			return $this->db->get();
		}
	}

	function get_majalah_by_id(){
		if($this->session->userdata('level_data_majalah') == "koperasi") {
			$this->db->select('majalah.*, koperasi.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('koperasi', 'majalah.id_user = koperasi.id_user');
			$this->db->where('id_majalah', $this->session->userdata('id_majalah'));
			return $this->db->get();
		}
		if($this->session->userdata('level_data_majalah') == "komunitas") {
			$this->db->select('majalah.*, komunitas.nama as nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('komunitas', 'majalah.id_user = komunitas.id_user');
			$this->db->where('id_majalah', $this->session->userdata('id_majalah'));
			return $this->db->get();
		}
		else {
			$this->db->select('majalah.*, user_detail.nama_lengkap');
			$this->db->from('majalah');
			$this->db->join('user_detail', 'majalah.id_user = user_detail.id_user');
			$this->db->where('id_majalah', $this->session->userdata('id_majalah'));
			return $this->db->get();
		}
	}





	function add_majalah(){

		$data = array('id_majalah' => $this->session->userdata('id_majalah'),
					  'id_user' => $this->session->userdata('id_user'),
					  'judul'=>$this->input->post('judul'),
					  'deskripsi'=>$this->input->post('deskripsi'),
					  'file_path'=>$this->session->userdata('file'),
					  'tanggal_dibuat'=> date("Y-m-d H:i:s"),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		// print_r($data);
		$this->db->insert('majalah', $data);

	}

	function edit_majalah(){
		$data = array('judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'deskripsi'=>$this->input->post('deskripsi'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'update',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->where('id_majalah', $this->session->userdata('id_majalah'));
		$this->db->update('majalah', $data);
	}

	function edit_file_majalah(){
		$data = array('file_path' => $this->session->userdata('file'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'update',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->where('id_majalah', $this->session->userdata('id_majalah'));
		$this->db->update('majalah', $data);
	}


	function delete_majalah(){
		$this->db->where('id_majalah', $this->session->userdata('id_majalah'));
		$this->db->delete('majalah');
	}

		

}

/* End of file agenda_data.php */
/* Location: ./application/views/agenda/agenda_data.php */