<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agama_mod extends CI_Model {

	function get_all_agama(){
		return $this->db->get('ref_agama');
	}
	

}

/* End of file agama_mod.php */
/* Location: ./application/models/agama_mod.php */