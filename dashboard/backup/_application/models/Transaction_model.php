<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}
    	
	function insert($data){
        $this->db->insert('transaksi', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function insert_pengiriman($data){
        $this->db->insert('transaksi_pengiriman', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function insert_detail_batch($data){
        $this->db->insert_batch('detail_transaksi', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }


}
