<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datacell_transaction_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}
    

	function insert($data){
        $this->db->insert('gerai_transaksi', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function get($transaction_id){
        $this->db->select('*');
        $this->db->from('gerai_transaksi');
        $this->db->where('gerai_transaksi.no_transaksi_pulsa',$transaction_id);
        $this->db->limit(1);
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

}
