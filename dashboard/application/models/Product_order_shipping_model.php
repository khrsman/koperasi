<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_order_shipping_model extends CI_Model {

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }
    

    function get_by_transaksi($no_transaksi){
        $this->db->select('*');
        $this->db->from('transaksi_pengiriman');
        $this->db->where('transaksi_pengiriman.no_transaksi',$no_transaksi);
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    function get_kelurahan_by_id($id){
        $this->db->select('*');
        $this->db->from('ref_kelurahan');
        $this->db->where('id_kelurahan',$id);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function get_kecamatan_by_id($id){
        $this->db->select('*');
        $this->db->from('ref_kecamatan');
        $this->db->where('id_kecamatan',$id);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function get_kabupaten_by_id($id){
        $this->db->select('*');
        $this->db->from('ref_kabupaten');
        $this->db->where('id_kabupaten',$id);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function get_provinsi_by_id($id){
        $this->db->select('*');
        $this->db->from('ref_provinsi');
        $this->db->where('id_provinsi',$id);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

}
