<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan_mod extends CI_Model {

	private $tablename = "pekerjaan";

	public function __construct()
	{
		parent::__construct();
		
		
	}

	function get_all_pekerjaan(){
		return $this->db->get($this->tablename);
	}

	function get_pekerjaan_by_id($id){
		$this->db->where('id_pekerjaan', $id);
		return $this->db->get($this->tablename);
	}

	function add_pekerjaan(){
		$id_pekerjaan = "6".time();

		$data = array('id_pekerjaan' => $id_pekerjaan,
					  'nama'=>$this->input->post('nama'),
					  'service_time'=>date("Y-m-d H:i:s"),
					  'service_action'=>"insert",
					  'service_users'=>$this->session->userdata('id_user') );

		$this->db->insert($this->tablename, $data);
	}

	function update_pekerjaan(){
		$data = array('nama'=>$this->input->post('nama'),
					  'service_time'=>date("Y-m-d H:i:s"),
					  'service_action'=>"update",
					  'service_users'=>$this->session->userdata('id_user') );

		$this->db->where('id_pekerjaan', $this->session->userdata('id'));
		$this->db->update($this->tablename, $data);
	}

	function delete_pekerjaan(){
		$data = array('status_active' => "0",
					  'service_time'=>date("Y-m-d H:i:s"),
					  'service_action'=>"delete",
					  'service_users'=>$this->session->userdata('id_user') );

		$this->db->where('id_pekerjaan', $this->session->userdata('id'));
		$this->db->update($this->tablename, $data);
	}
	

}

/* End of file m_pekerjaan.php */
/* Location: ./application/models/m_pekerjaan.php */