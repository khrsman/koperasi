<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_loyalty_mod extends CI_Model {

	function get_saldo_rekening_loyalty_anggota(){
		$this->db->select('saldo, jenis_rekening');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$return = $this->db->get('mcb_rekening_loyalti');

			if($return->num_rows() > 0){
				return $return;
			}
			else {
				return FALSE;
			}
	}

	function get_log_loyalty_anggota(){
		$this->db->select('*');
		$this->db->from('mcb_log_transaksi');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->where('jenis_account', 'LOYALTI');
		return $this->db->get();
	}	

}

/* End of file Rekening_loyalty_mod.php */
/* Location: ./application/models/Rekening_loyalty_mod.php */