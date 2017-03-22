<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_order_detail_model extends CI_Model {

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }


    function get_by_transaksi($no_transaksi){
        $this->db->select('*,produk.nama as nama_produk,produk.id_produk as id_produk');
        $this->db->from('detail_transaksi');
        $this->db->join('produk','produk.id_produk=detail_transaksi.id_produk','LEFT');
        $this->db->join('produk_kategori_relation','produk.id_produk=produk_kategori_relation.id_produk','LEFT');
        $this->db->join('produk_kategori','produk_kategori_relation.id_kategori=produk_kategori.id_kategori','LEFT');
        $this->db->join('produk_foto','produk_foto.id_produk=produk.id_produk','LEFT');
        $this->db->where('detail_transaksi.no_transaksi',$no_transaksi);
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }


    function get_list_by_transaksi_owner($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS DISTINCT *',FALSE);
        $this->db->from('detail_transaksi');
        $this->db->join('transaksi','detail_transaksi.no_transaksi=transaksi.no_transaksi','LEFT');
        $this->db->join('produk','produk.id_produk=detail_transaksi.id_produk','LEFT');
        $this->db->join('produk_kategori_relation','produk.id_produk=produk_kategori_relation.id_produk','LEFT');
        $this->db->join('produk_kategori','produk_kategori_relation.id_kategori=produk_kategori.id_kategori','LEFT');
        $this->db->join('produk_foto','produk_foto.id_produk=produk.id_produk','LEFT');
        $this->db->join('user_info','produk.user=user_info.id_user','LEFT');
        

        switch ($param_query['owner']) {
            case 1:
                $this->db->where('produk.owner',$param_query['owner']);
                break;
            case 2:
                $this->db->where('produk.owner',$param_query['owner']);
                $this->db->where('user_info.koperasi',$param_query['koperasi']);
                break;
            case 3:
                $this->db->where('produk.owner',$param_query['owner']);
                $this->db->where('produk.user',$param_query['user']);
                break;
        }

        $this->db->group_by('detail_transaksi.no_transaksi');
        
        // Keyword By
        if ($keyword!=NULL) {
            $this->db->like('transaksi.no_transaksi',$keyword);
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


    function get_detail_by_transaksi_owner($param_query){
        $this->db->select('*,produk.nama as nama_produk,produk.id_produk as id_produk');
        $this->db->from('detail_transaksi');
        $this->db->join('produk','produk.id_produk=detail_transaksi.id_produk','LEFT');
        $this->db->join('produk_kategori_relation','produk.id_produk=produk_kategori_relation.id_produk','LEFT');
        $this->db->join('produk_kategori','produk_kategori_relation.id_kategori=produk_kategori.id_kategori','LEFT');
        $this->db->join('produk_foto','produk_foto.id_produk=produk.id_produk','LEFT');
        $this->db->join('user_info','produk.user=user_info.id_user','LEFT');
        $this->db->where('detail_transaksi.no_transaksi',$param_query['no_transaksi']);

        switch ($param_query['owner']) {
            case 1:
                $this->db->where('produk.owner',$param_query['owner']);
                break;
            case 2:
                $this->db->where('produk.owner',$param_query['owner']);
                $this->db->where('user_info.koperasi',$param_query['koperasi']);
                break;
            case 3:
                $this->db->where('produk.owner',$param_query['owner']);
                $this->db->where('produk.user',$param_query['user']);
                break;
        }
        
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    function edit_detail_by_transaksi_produk($data){
        $no_transaksi   = $data['no_transaksi'];
        $id_produk      = $data['id_produk'];
        unset($data['no_transaksi']);
        unset($data['id_produk']);
        $this->db->where('no_transaksi',$no_transaksi);
        $this->db->where('id_produk',$id_produk);
        $this->db->update('detail_transaksi', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    

}
