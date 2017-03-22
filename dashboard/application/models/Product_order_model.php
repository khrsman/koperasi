<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_order_model extends CI_Model {

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }
        
    function get_all($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
        $this->db->from('transaksi');
        $this->db->join('user_info','transaksi.id_user=user_info.id_user','LEFT');
       
        // Filter
        if (!empty($param_query['filter_user'])) {
            if (is_array($param_query['filter_user'])) {
                foreach ($param_query['filter_user'] as $k => $v) {
                    $this->db->where('transaksi.id_user',$v['parameter']);
                }
            } else{
                $this->db->where('transaksi.id_user',$param_query['filter_user']);    
            }
            
        }

        // Filter
        if (!empty($param_query['filter_koperasi'])) {
            if (is_array($param_query['filter_koperasi'])) {
                foreach ($param_query['filter_koperasi'] as $k => $v) {
                    $this->db->where('user_info.koperasi',$v['parameter']);
                }
            } else{
                $this->db->where('user_info.koperasi',$param_query['filter_koperasi']);    
            }
            
        }

        /*if (!empty($param_query['filter_product_category'])) {
            if (is_array($param_query['filter_product_category'])) {
                foreach ($param_query['filter_product_category'] as $k => $v) {
                    $this->db->or_having('produk_kategori.id_kategori',$v['parameter']);
                }
            } else{
                $this->db->having('produk_kategori.id_kategori',$param_query['filter_product_category']);    
            }
            
        }*/


        // Keyword By
        if ($keyword!=NULL) {
            $this->db->like('transaksi.no_transaksi',$keyword);
        }
        
        

        $this->db->limit($limit,$offset);
        $this->db->order_by($param_query['sort'],$param_query['sort_order']);
        // $this->db->order_by('transaksi.tanggal_transaksi','DESC');
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        // $result['count_all']= $this->count_question_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;

        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
    }



    function get_by_transaksi($no_transaksi){
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('user_info','transaksi.id_user=user_info.id_user','LEFT');
        $this->db->join('user_detail','transaksi.id_user=user_detail.id_user','LEFT');
        $this->db->where('transaksi.no_transaksi',$no_transaksi);
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }



}
