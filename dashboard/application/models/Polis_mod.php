<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polis_mod extends CI_Model {

	function get_all_polis($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
		$this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
        $this->db->from('ref_polis');
        
        // Filter        
         
        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->or_like($param_query['keyword_by']);
            } else{
                $this->db->or_like($param_query['keyword_by'],$keyword);
            }
        }

        $this->db->limit($limit,$offset);
        $this->db->order_by($param_query['sort'],$param_query['sort_order']);
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        // $result['count_all']= $this->count_contact_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;

        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
	}


    function get_polis($id){
        $this->db->select('*');
        $this->db->like('deskripsi', $id);
        return $this->db->get('ref_polis');
    }

	function get_polis_by_id($id){
		$this->db->select('*');
		$this->db->from('ref_polis');
		$this->db->where('id_polis', $id);
		$result = $this->db->get();


		if($result->num_rows() > 0){
			return $result;
		}
		else {
			return FALSE;
		}
	}
	

    function add_polis($photo){
        $ref_polis = array( 'id_polis' => '',
                            'deskripsi' => $this->input->post('nama_polis'),
                            'logo' => $photo,
                            'service_time' => date('Y-m-d H:i:s'),
                            'service_action' => "insert",
                            'service_user' => $this->session->userdata('id_user'));

        $this->db->insert('ref_polis', $ref_polis);
    }


    function update_logo_polis($photo, $id){

        $logo = array('logo' => $photo,
                     'service_time' => date('Y-m-d H:i:s'),
                     'service_action' => "update",
                     'service_user' => $this->session->userdata('id_user'));


        $this->db->where('id_polis', $id);
        $this->db->update('ref_polis', $logo);
    }


    function update_polis($id){
        $ref_polis = array('deskripsi' => $this->input->post('nama_polis'),
                          'service_time' => date('Y-m-d H:i:s'),
                          'service_action' => "update",
                          'service_user' => $this->session->userdata('id_user'));

        $this->db->where('id_polis', $id);
        $this->db->update('ref_polis', $ref_polis);
    }


    function delete_polis($id){
        $this->db->where('id_polis', $id);
        $this->db->delete('ref_polis');
    }
}

/* End of file Polis_mod.php */
/* Location: ./application/models/Polis_mod.php */