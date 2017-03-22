<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konten_event_mod extends CI_Model {

	function __construct()
		{
			parent::__construct();
			//Do your magic here
		}


	function get_all_event_admin(){
			$this->db->select('konten_event.*, user_detail.nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('user_detail', 'konten_event.id_user = user_detail.id_user');
			$this->db->where('konten_event.level_akses', '1');
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


	function get_all_event_koperasi(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_event.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('koperasi', 'konten_event.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('id_event_koperasi'));

			$this->db->where('konten_event.level_akses', '2');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "2"){
			$this->db->select('konten_event.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('koperasi', 'konten_event.id_user = koperasi.id_user');
			$this->db->where('konten_event.level_akses', '2');
			$this->db->where('koperasi.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if koperasi

		if($this->session->userdata('level') == "3"){
			$this->db->select('konten_event.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('koperasi', 'konten_event.id_user = koperasi.id_user');
			$this->db->where('konten_event.level_akses', '2');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get();


		} //if anggota_koperasi

	}

	function get_all_event_komunitas(){
		if($this->session->userdata('level') == "1"){
			$this->db->select('konten_event.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('komunitas', 'konten_event.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('id_event_komunitas'));
			$this->db->where('konten_event.level_akses', '4');
			return $this->db->get();
		} //if admin

		if($this->session->userdata('level') == "4"){
			$this->db->select('konten_event.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('komunitas', 'konten_event.id_user = komunitas.id_user');
			$this->db->where('konten_event.level_akses', '4');
			$this->db->where('komunitas.id_user', $this->session->userdata('id_user'));
			return $this->db->get();

		} //if komunitas

		if($this->session->userdata('level') == "5"){
			$this->db->select('konten_event.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('komunitas', 'konten_event.id_user = komunitas.id_user');
			$this->db->where('konten_event.level_akses', '4');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas'));
			return $this->db->get();
		}
	}

	function get_event_by_id(){
		if($this->session->userdata('level_data_event') == "koperasi") {
			$this->db->select('konten_event.*, koperasi.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('koperasi', 'konten_event.id_user = koperasi.id_user');
			$this->db->where('id_event', $this->session->userdata('id_event'));
			return $this->db->get();
		}
		if($this->session->userdata('level_data_event') == "komunitas") {
			$this->db->select('konten_event.*, komunitas.nama as nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('komunitas', 'konten_event.id_user = komunitas.id_user');
			$this->db->where('id_event', $this->session->userdata('id_event'));
			return $this->db->get();
		}
		else {
			$this->db->select('konten_event.*, user_detail.nama_lengkap');
			$this->db->from('konten_event');
			$this->db->join('user_detail', 'konten_event.id_user = user_detail.id_user');
			$this->db->where('id_event', $this->session->userdata('id_event'));
			return $this->db->get();
		}
	}





	function add_event(){
		$date = new DateTime($this->input->post('tanggal_event')); 
        $tanggal_event = $date->format('Y-m-d H:i:s'); 

		$data = array('id_event' => $this->session->userdata('id_event'),
					  'id_user' => $this->session->userdata('id_user'),
					  'level_akses' => $this->session->userdata('level'),
					  'judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'link_gambar'=>$this->session->userdata('photo'),
					  'tanggal_event' => $tanggal_event,
					  'tanggal_dibuat'=> date("Y-m-d H:i:s"),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		// print_r($data);
		$this->db->insert('konten_event', $data);

	}

	function edit_event(){
		$date = new DateTime($this->input->post('tanggal_event')); 
        $tanggal_event = $date->format('Y-m-d H:i:s'); 

		$data = array('judul'=>$this->input->post('judul'),
					  'isi'=>$this->input->post('isi'),
					  'tanggal_event'=>$tanggal_event,
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'update',
					  'service_user' => $this->session->userdata('id_user'));
		$this->db->where('id_event', $this->session->userdata('id_event'));
		$this->db->update('konten_event', $data);
	}

	function edit_foto_event(){
		$data = array('link_gambar' => $this->session->userdata('photo'),
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => 'insert',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->where('id_event', $this->session->userdata('id_event'));
		$this->db->update('konten_event', $data);
	}


	function delete_event(){
		$this->db->where('id_event', $this->session->userdata('id_event'));
		$this->db->delete('konten_event');
	}

		

}

/* End of file event_data.php */
/* Location: ./application/views/event/event_data.php */