<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_tabungan_mod extends CI_Model {

	function get_saldo_rekening_tabungan_anggota(){
		$this->db->select('saldo');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$return = $this->db->get('mcb_rekening_tabungan');

			if($return->num_rows() > 0){
				return $return;
			}
			else {
				return FALSE;
			}
	}

	function get_log_tabungan_anggota(){
		$this->db->select('*');
		$this->db->from('mcb_log_transaksi');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->having('sumber_dana', 'tunai');
		$this->db->or_having('jenis_account', 'tabungan');
		//$this->db->group_by('id_user');
		return $this->db->get();
	}	

}

/* End of file rekening_tabungan_mod.php */
/* Location: ./application/models/rekening_tabungan_mod.php */