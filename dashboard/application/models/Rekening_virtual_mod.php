<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_virtual_mod extends CI_Model {

	function get_saldo_rekening_virtual_anggota(){
		$this->db->select('saldo');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$return = $this->db->get('mcb_rekening_virtual');

			if($return->num_rows() > 0){
				return $return;
			}
			else {
				return FALSE;
			}
	}

	function get_log_virtual_anggota(){
		$this->db->select('*');
		$this->db->from('mcb_log_transaksi');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->where('jenis_account', 'virtual');
		return $this->db->get();
	}	


}

/* End of file Rekening_virtual_mod.php */
/* Location: ./application/models/Rekening_virtual_mod.php */