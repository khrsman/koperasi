<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Core_banking_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}


    //  LOYALTY ACCOUNT
    function get_loyalty_account_by_user($id_user){
        $this->db->select('*');
        $this->db->from('mcb_rekening_loyalti');
        $this->db->where('id_user',$id_user);

        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    function update_loyalty_account_batch($data){
        $this->db->update_batch('mcb_rekening_loyalti', $data, 'no_rekening_loyalti');
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }



    //  VIRTUAL ACCOUNT
    function get_virtual_account_by_user($id_user){
        $this->db->select('*');
        $this->db->from('mcb_rekening_virtual');
        $this->db->where('id_user',$id_user);

        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    function update_virtual_account($data){
        $virtual_account_number = $data['no_rekening_virtual'];
        unset($data['no_rekening_virtual']);
        $this->db->where('no_rekening_virtual',$virtual_account_number);
        $this->db->update('mcb_rekening_virtual', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }



    //  TRANSAKSI
    function insert_transaksi($data){
        $this->db->insert('mcb_transaksi_rekening', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }



    //  LOG TRANSAKSI
    function insert_log_transaksi($data){
        $this->db->insert('mcb_log_transaksi', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }


}

