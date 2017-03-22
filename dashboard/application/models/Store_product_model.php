<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_product_model extends CI_Model {

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }
        
    function get_koperasi_all($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS 
            produk_admin.user_target,
            produk.*,
            produk_foto.foto_path,
            produk_kategori.*,
            produk.id_produk as id_produk,
            produk.nama as nama_produk,
            produk_kategori.nama as nama_kategori,
            user_info.koperasi as id_koperasi
        ',FALSE);
        $this->db->from('produk');
        $this->db->join('produk_kategori_relation','produk.id_produk=produk_kategori_relation.id_produk','LEFT');
        $this->db->join('produk_kategori','produk_kategori_relation.id_kategori=produk_kategori.id_kategori','LEFT');
        $this->db->join('produk_foto','produk_foto.id_produk=produk.id_produk','LEFT');
        $this->db->join('user_info','produk.user=user_info.id_user','LEFT');
        $this->db->join('user_detail','produk.user=user_detail.id_user','LEFT');
        $this->db->join('produk_admin','produk.id_produk=produk_admin.id_produk','LEFT');
        $this->db->where('produk.status',1);
        
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

        if (!empty($param_query['filter_product_category'])) {
            if (is_array($param_query['filter_product_category'])) {
                foreach ($param_query['filter_product_category'] as $k => $v) {
                    $this->db->or_having('produk_kategori.id_kategori',$v['parameter']);
                }
            } else{
                $this->db->having('produk_kategori.id_kategori',$param_query['filter_product_category']);    
            }
            
        }

        if (!empty($param_query['filter_owner_produk'])) {
            if (is_array($param_query['filter_owner_produk'])) {
                foreach ($param_query['filter_owner_produk'] as $k => $v) {
                    $array_produk_owner[]=$v['parameter'];
                }
                $this->db->where_in('produk.owner',$array_produk_owner);
            } else{
                $this->db->where('produk.owner',$param_query['filter_owner_produk']);    
            }
            
        }

        $this->db->where('user_info.koperasi',$param_query['filter_koperasi']);
        $this->db->or_where('produk_admin.user_target',$param_query['filter_koperasi']);


        // Keyword By
        if ($keyword!=NULL) {
            $this->db->like('produk.nama',$keyword);
        }
        
        

        $this->db->limit($limit,$offset);
        // $this->db->order_by($param_query['sort'],$param_query['sort_order']);
        $this->db->order_by('produk_kategori.urutan','ASC');
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        // $result['count_all']= $this->count_question_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;
        
        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
    }



    function get_member_all($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS 
            produk.*,
            produk_foto.foto_path,
            produk_kategori.*,
            produk.id_produk as id_produk,
            produk.nama as nama_produk,
            produk_kategori.nama as nama_kategori,
            user_info.koperasi as id_koperasi
        ',FALSE);
        $this->db->from('produk');
        $this->db->join('produk_kategori_relation','produk.id_produk=produk_kategori_relation.id_produk','LEFT');
        $this->db->join('produk_kategori','produk_kategori_relation.id_kategori=produk_kategori.id_kategori','LEFT');
        $this->db->join('produk_foto','produk_foto.id_produk=produk.id_produk','LEFT');
        $this->db->join('user_info','produk.user=user_info.id_user','LEFT');
        $this->db->join('user_detail','produk.user=user_detail.id_user','LEFT');
        $this->db->where('produk.status',1);
        
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

        if (!empty($param_query['filter_product_category'])) {
            if (is_array($param_query['filter_product_category'])) {
                foreach ($param_query['filter_product_category'] as $k => $v) {
                    $this->db->or_having('produk_kategori.id_kategori',$v['parameter']);
                }
            } else{
                $this->db->having('produk_kategori.id_kategori',$param_query['filter_product_category']);    
            }
            
        }

        if (!empty($param_query['filter_owner_produk'])) {
            if (is_array($param_query['filter_owner_produk'])) {
                foreach ($param_query['filter_owner_produk'] as $k => $v) {
                    $array_produk_owner[]=$v['parameter'];
                }
                $this->db->where_in('produk.owner',$array_produk_owner);
            } else{
                
            }
            
        }


        // Keyword By
        if ($keyword!=NULL) {
            $this->db->like('produk.nama',$keyword);
        }
        
        

        $this->db->limit($limit,$offset);
        // $this->db->order_by($param_query['sort'],$param_query['sort_order']);
        $this->db->order_by('produk_kategori.urutan','ASC');
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        // $result['count_all']= $this->count_question_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;
        
        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
    }



    function get($product_id){
        $this->db->select('*,produk.id_produk as id_produk,produk.nama as nama_produk,produk_kategori.nama as nama_kategori');
        $this->db->from('produk');
        $this->db->join('produk_kategori_relation','produk.id_produk=produk_kategori_relation.id_produk','LEFT');
        $this->db->join('produk_kategori','produk_kategori_relation.id_kategori=produk_kategori.id_kategori','LEFT');
        $this->db->join('produk_foto','produk_foto.id_produk=produk.id_produk','LEFT');
        $this->db->join('user_info','produk.user=user_info.id_user','LEFT');
        $this->db->where('produk.id_produk',$product_id);
        $this->db->where('produk.status',1);
        $this->db->limit(1);
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function get_product_admin($product_id){
        $this->db->select('*');
        $this->db->from('produk_admin');
        $this->db->where('id_produk',$product_id);
        $this->db->limit(1);
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }


    function update_batch($data){
        $this->db->update_batch('produk', $data, 'id_produk');
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }


}
