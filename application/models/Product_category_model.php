<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_category_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}
    	
	function get_all($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
        $this->db->from('produk_kategori');
        
        // Filter
        /*if (!empty($param_query['filter_category'])) {
            if (is_array($param_query['filter_category'])) {
                foreach ($param_query['filter_category'] as $k => $v) {
                    $this->db->where('produk_kategori.id_kategori',$v['parameter']);
                }
            } else{
                $this->db->where('produk_kategori.id_kategori',$param_query['filter_category']);    
            }
            
        }*/


        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->or_like($param_query['keyword_by']);
            } else{
                $this->db->like($param_query['keyword_by'],$keyword);
            }
        }
        
        

        $this->db->limit($limit,$offset);
        $this->db->order_by($param_query['sort'],$param_query['sort_order']);
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        // $result['count_all']= $this->count_question_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;

        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
    }



}
