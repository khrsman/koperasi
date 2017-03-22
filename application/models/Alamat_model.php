<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat_model extends CI_Model {

	function __construct()
		{
			parent::__construct();
			
		}	

	function get_provinsi(){
		$result = array();
		$this->db->select('*');
		$this->db->from('ref_provinsi');
		$this->db->order_by('nama', 'asc');
		return $this->db->get();
	}

	function get_kabupaten($id_provinsi){
		$result = array();
		$this->db->select('*');
		$this->db->from('ref_kabupaten');
		$this->db->order_by('nama', 'asc');
		$this->db->where('id_provinsi', $id_provinsi);
		return $this->db->get();
	}

	function get_kecamatan($id_kabupaten){
		$result = array();
		$this->db->select('*');
		$this->db->from('ref_kecamatan');
		$this->db->where('id_kabupaten', $id_kabupaten);
		$this->db->order_by('nama', 'asc');
		return $this->db->get();
	}

	function get_kelurahan($id_kecamatan){
		$result = array();
		$this->db->select('*');
		$this->db->from('ref_kelurahan');
		$this->db->where('id_kecamatan', $id_kecamatan);
		$this->db->order_by('nama', 'asc');
		return $this->db->get();
	}

	function get_alamat_by_id($id){
		$this->db->select('user_alamat.*, user_alamat.status_default, user_alamat.id_alamat, ref_provinsi.nama as nama_provinsi, ref_kabupaten.nama as nama_kabupaten, ref_kecamatan.nama as nama_kecamatan, ref_kelurahan.nama as nama_kelurahan');
		$this->db->from('user_alamat');
		$this->db->join('user_info', 'user_info.id_user = user_alamat.id_user');
		$this->db->join('ref_provinsi', 'ref_provinsi.id_provinsi = user_alamat.pengirim_provinsi');
		$this->db->join('ref_kabupaten', 'ref_kabupaten.id_kabupaten= user_alamat.pengirim_kabupaten');
		$this->db->join('ref_kecamatan', 'ref_kecamatan.id_kecamatan= user_alamat.pengirim_kecamatan');
		$this->db->join('ref_kelurahan', 'ref_kelurahan.id_kelurahan= user_alamat.pengirim_kelurahan');
		$this->db->where('user_alamat.id_user', $id);

		return $this->db->get();
	}


	function get_alamat($id){
		$this->db->select('id_alamat');
		$this->db->from('user_alamat');
		$this->db->where('id_alamat', $id);
		return $this->db->get();

	}

	function get_alamat_by_id_and_user(){
		$this->db->select('user_alamat.pengirim_alamat, user_alamat.status_default, user_alamat.id_alamat, ref_provinsi.nama as nama_provinsi, ref_kabupaten.nama as nama_kabupaten, ref_kecamatan.nama as nama_kecamatan, ref_kelurahan.nama as nama_kelurahan');
		$this->db->from('user_alamat');
		$this->db->join('user_info', 'user_info.id_user = user_alamat.id_user');
		$this->db->join('ref_provinsi', 'ref_provinsi.id_provinsi = user_alamat.pengirim_provinsi');
		$this->db->join('ref_kabupaten', 'ref_kabupaten.id_kabupaten= user_alamat.pengirim_kabupaten');
		$this->db->join('ref_kecamatan', 'ref_kecamatan.id_kecamatan= user_alamat.pengirim_kecamatan');
		$this->db->join('ref_kelurahan', 'ref_kelurahan.id_kelurahan= user_alamat.pengirim_kelurahan');
		$this->db->where('user_info.id_user', $this->session->userdata('id_user'));

		return $this->db->get();
	}	
	function add_alamat($id){
		$id_alamat = "13".time();

		$alamat = array('id_user' => $id,
						'id_alamat' =>$id_alamat,
						'pengirim_alamat' => $this->input->post('alamat'),
						'pengirim_kelurahan' => $this->input->post('kel'),
						'pengirim_kecamatan' => $this->input->post('kec'),
						'pengirim_kabupaten' => $this->input->post('kota'),
						'pengirim_provinsi' => $this->input->post('prop'),
						'pengirim_no_tlp' => $this->input->post('telepon'),
						'status_default' => '0');


		$this->db->insert('user_alamat', $alamat);
	}

	function update_alamat($id){
		$alamat = array('pengirim_alamat' => $this->input->post('alamat'),
						'pengirim_kelurahan' => $this->input->post('kel'),
						'pengirim_kecamatan' => $this->input->post('kec'),
						'pengirim_kabupaten' => $this->input->post('kota'),
						'pengirim_provinsi' => $this->input->post('prop'),
						'pengirim_no_tlp' => $this->input->post('telepon')
						);

		$this->db->where('id_alamat', $id);
		$this->db->update('user_alamat', $alamat);
	}

	function set_default($id, $id_user){
		$query = $this->db->query("update user_alamat set status_default='0' where id_user='".$id_user."'");

		if($query){
			$data = array('status_default' => '1');

			$this->db->where('id_alamat', $id);
			$this->db->update('user_alamat', $data);
		}

	}

	function delete_alamat($id){
		$this->db->where('id_alamat', $id);
		$this->db->delete('user_alamat');
	}

}

/* End of file Alamat_mod.php */
/* Location: ./application/models/Alamat_mod.php */