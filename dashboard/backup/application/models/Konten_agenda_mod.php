<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konten_agenda_mod extends CI_Model {

	function __construct()
		{
			parent::__construct();
			//Do your magic here
		}


	function get_all_agenda_admin(){
			$this->db->select('konten_agenda.*, user_detail.nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('user_detail', 'konten_agenda.id_user = user_detail.id_user');
			$this->db->where('konten_agenda.level_akses', '1');
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


	function get_all_agenda_koperasi(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_agenda.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('koperasi', 'konten_agenda.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('id_agenda_koperasi'));
			$this->db->where('konten_agenda.level_akses', '2');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "2"){
			$this->db->select('konten_agenda.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('koperasi', 'konten_agenda.id_user = koperasi.id_user');
			$this->db->where('konten_agenda.level_akses', '2');
			$this->db->where('koperasi.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if koperasi

		if($this->session->userdata('level') == "3"){
			$this->db->select('konten_agenda.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('koperasi', 'konten_agenda.id_user = koperasi.id_user');
			$this->db->where('konten_agenda.level_akses', '2');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get();


		} //if anggota_koperasi

	}

	function get_all_agenda_komunitas(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_agenda.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('komunitas', 'konten_agenda.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('id_agenda_komunitas'));
			$this->db->where('konten_agenda.level_akses', '4');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "4"){
			$this->db->select('konten_agenda.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('komunitas', 'konten_agenda.id_user = komunitas.id_user');
			$this->db->where('konten_agenda.level_akses', '4');
			$this->db->where('komunitas.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if komunitas

		if($this->session->userdata('level') == "5"){
			$this->db->select('konten_agenda.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('komunitas', 'konten_agenda.id_user = komunitas.id_user');
			$this->db->where('konten_agenda.level_akses', '4');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas'));
			return $this->db->get();
		}
	}

	function get_agenda_by_id(){
		if($this->session->userdata('level_data_agenda') == "koperasi") {
			$this->db->select('konten_agenda.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('koperasi', 'konten_agenda.id_user = koperasi.id_user');
			$this->db->where('id_agenda', $this->session->userdata('id_agenda'));
			return $this->db->get();
		}
		if($this->session->userdata('level_data_agenda') == "komunitas") {
			$this->db->select('konten_agenda.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('komunitas', 'konten_agenda.id_user = komunitas.id_user');
			$this->db->where('id_agenda', $this->session->userdata('id_agenda'));
			return $this->db->get();
		}
		else {
			$this->db->select('konten_agenda.*, user_detail.nama_lengkap');
			$this->db->from('konten_agenda');
			$this->db->join('user_detail', 'konten_agenda.id_user = user_detail.id_user');
			$this->db->where('id_agenda', $this->session->userdata('id_agenda'));
			return $this->db->get();
		}
	}





	function add_agenda(){
		$date = new DateTime($this->input->post('tanggal_agenda')); 
        $tanggal_agenda = $date->format('Y-m-d H:i:s'); 

		$data = array('id_agenda' => $this->session->userdata('id_agenda'),
					  'id_user' => $this->session->userdata('id_user'),
					  'level_akses' => $this->session->userdata('level'),
					  'judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'link_gambar'=>$this->session->userdata('photo'),
					  'tanggal_agenda' => $tanggal_agenda,
					  'tanggal_dibuat'=> date("Y-m-d H:i:s"),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		// print_r($data);
		$this->db->insert('konten_agenda', $data);

	}

	function edit_agenda(){
		$date = new DateTime($this->input->post('tanggal_agenda')); 
        $tanggal_agenda = $date->format('Y-m-d H:i:s'); 

		$data = array('judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'tanggal_agenda'=>$tanggal_agenda,
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'update',
					  'service_user' => $this->session->userdata('id_user'));
		$this->db->where('id_agenda', $this->session->userdata('id_agenda'));
		$this->db->update('konten_agenda', $data);
	}

	function edit_foto_agenda(){
		$data = array('link_gambar' => $this->session->userdata('photo'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->where('id_agenda', $this->session->userdata('id_agenda'));
		$this->db->update('konten_agenda', $data);
	}


	function delete_agenda(){
		$this->db->where('id_agenda', $this->session->userdata('id_agenda'));
		$this->db->delete('konten_agenda');
	}

		

}

/* End of file agenda_data.php */
/* Location: ./application/views/agenda/agenda_data.php */