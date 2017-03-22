<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datacell_mod extends CI_Model {

	function get_all_datacell(){
			$this->db->select('*');
			$this->db->from('gerai_harga_vendor');
			return $this->db->get();

	}


	function get_datacell_by_id($id){
		$this->db->select('*');
		$this->db->from('gerai_harga_vendor');
		$this->db->where('kode_operator', $id);

		return $this->db->get();
	}

	function update_datacell($id){

		$data = array('harga_gerai' => $this->input->post('harga_gerai'),
					  'service_time' => date('Y-m-d H:i:s'),
					  'service_action' => 'update',
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->where('kode_operator', $id);
		$this->db->update('gerai_harga_vendor', $data);

	}

}

/* End of file datacell_mod.php */
/* Location: ./application/models/datacell_mod.php */