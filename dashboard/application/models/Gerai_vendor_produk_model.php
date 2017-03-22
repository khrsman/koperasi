<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gerai_vendor_produk_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}
    	
	function get_nominal($parameter=NULL){
        $this->db->select('*');
        $this->db->from('gerai_vendor_produk');

        if ($parameter!=NULL && is_array($parameter)) {
            foreach ($parameter as $k => $v) {
                $this->db->where($k,$v);
            }
        }else{
            $this->db->limit(100);
        }

        $this->db->where('harga_vendor < harga_gerai');
        $this->db->group_by('nominal_produk');
        $this->db->group_by('kode_operator');
        $this->db->order_by('CAST(nominal_produk AS DECIMAL(10)) ASC');


        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }


    // KHUSUS PEMBAYARAN
    function get_admin_fee($parameter=NULL){
        $this->db->select('*');
        $this->db->from('gerai_vendor_produk');

        if ($parameter!=NULL && is_array($parameter)) {
            foreach ($parameter as $k => $v) {
                $this->db->where($k,$v);
            }
        }else{
            $this->db->limit(10);
        }

        $this->db->where('harga_vendor < harga_gerai');
        $this->db->group_by('kode_operator');
        $this->db->order_by('CAST(harga_vendor AS DECIMAL(10)) ASC');


        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }


}
