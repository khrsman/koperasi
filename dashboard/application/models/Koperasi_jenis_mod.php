<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koperasi_jenis_mod extends CI_Model {


		function get_all_koperasi_jenis(){
			$this->db->where('parent !=', NULL);
			return $this->db->get('koperasi_jenis');
		}
	

}

/* End of file Koperasi_jenis_mod.php */
/* Location: ./application/models/Koperasi_jenis_mod.php */