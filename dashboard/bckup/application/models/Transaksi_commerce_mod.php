<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_commerce_mod extends CI_Model {

	
	function get_transaksi($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
		$this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
        $this->db->from('transaksi');
        $this->db->join('user_info','transaksi.id_user=user_info.id_user', 'LEFT');
        $this->db->join('koperasi','user_info.koperasi=koperasi.id_koperasi', 'LEFT');
        $this->db->join('user_detail','user_info.id_user=user_detail.id_user', 'LEFT');
        if($this->session->userdata('level') == "2"){
            $this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
        }
         if($this->session->userdata('level') == "3"){
            $this->db->where('user_info.id_user', $this->session->userdata('id_user'));
        }
        
        // Filter    
        if (!empty($param_query['filter_tanggal'])) {
            if (is_array($param_query['filter_tanggal'])) {
                foreach ($param_query['filter_tanggal'] as $k => $v) {
                    $this->db->or_having('transaksi.tanggal',$v['parameter']);
                }
            } else{
                $this->db->having('transaksi.tanggal',$param_query['filter_tanggal']);    
            }
            
        }    
        if (!empty($param_query['filter_bulan'])) {
            if (is_array($param_query['filter_bulan'])) {
                foreach ($param_query['filter_bulan'] as $k => $v) {
                    $this->db->or_having('transaksi.bulan',$v['parameter']);
                }
            } else{
                $this->db->having('transaksi.bulan',$param_query['filter_bulan']);    
            }
            
        }
        if (!empty($param_query['filter_tahun'])) {
            if (is_array($param_query['filter_tahun'])) {
                foreach ($param_query['filter_tahun'] as $k => $v) {
                    $this->db->or_having('transaksi.tahun',$v['parameter']);
                }
            } else{
                $this->db->having('transaksi.tahun',$param_query['filter_tahun']);    
            }
            
        }


        $a = $param_query['filter_koperasi'];
        foreach ($a as $key => $m) {
        if ($m['parameter'] != NULL or $m['parameter'] != "") {
                    if (is_array($param_query['filter_koperasi'])) {
                        foreach ($param_query['filter_koperasi'] as $k => $v) {
                            $this->db->or_having('koperasi.id_koperasi',$v['parameter']);
                        }
                    } else{
                        $this->db->having('koperasi.id_koperasi', "!= NULL");    
                    }
                    
                }
        }

        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->like($param_query['keyword_by']);
            } else{
                $this->db->like($param_query['keyword_by'],$keyword);
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

	function get_id_nama($id){
		$this->db->select('id_koperasi, nama');
		$this->db->like('nama', $id);
		return $this->db->get('koperasi');
	}

    function get_detail_transaksi($id){
        $this->db->select('*');
        $this->db->from('detail_transaksi');
        $this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk');
        $this->db->join('transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi');
        $this->db->where('transaksi.no_transaksi', $id);

        return $this->db->get();
    }   	
}

/* End of file Transaksi_commerce_mod.php */
/* Location: ./application/models/Transaksi_commerce_mod.php */