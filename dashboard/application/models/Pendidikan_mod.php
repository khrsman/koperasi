<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan_mod extends CI_Model {

	
	function get_all_pendidikan(){
		return $this->db->get('ref_pendidikan');
	}	

}

/* End of file pendidikan_mod.php */
/* Location: ./application/models/pendidikan_mod.php */