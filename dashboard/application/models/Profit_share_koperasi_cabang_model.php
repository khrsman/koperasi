<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profit_share_koperasi_cabang_model extends CI_Model {

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }
        
   
    function get_all($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS *,
                koperasi.id_koperasi as id_koperasi,
                koperasi.nama as nama_koperasi,
                koperasi.share_cabang as share_cabang,
                ref_kelurahan.nama as nama_kelurahan,
                ref_kecamatan.nama as nama_kecamatan,
                ref_kabupaten.nama as nama_kabupaten,
                ref_provinsi.nama as nama_provinsi, 
                koperasi_alamat.alamat as alamat_koperasi,
                koperasi_alamat.kode_pos as kode_pos
            ',
            FALSE
        );
        $this->db->from('koperasi');
        $this->db->join('koperasi_alamat','koperasi_alamat.id_koperasi=koperasi.id_koperasi','LEFT');

        $this->db->join('ref_kelurahan','koperasi_alamat.kelurahan=ref_kelurahan.id_kelurahan','LEFT');
        $this->db->join('ref_kecamatan','koperasi_alamat.kecamatan=ref_kecamatan.id_kecamatan','LEFT');
        $this->db->join('ref_kabupaten','koperasi_alamat.kabupaten=ref_kabupaten.id_kabupaten','LEFT');
        $this->db->join('ref_provinsi','ref_kabupaten.id_provinsi=ref_provinsi.id_provinsi','LEFT');

        $this->db->having('koperasi.status_active',1);
        $this->db->having('koperasi.parent_koperasi',$param_query['koperasi']);
     


        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->or_like($param_query['keyword_by'],$keyword);
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


     function get($id_koperasi){
        $this->db->select('SQL_CALC_FOUND_ROWS *,
                koperasi.id_koperasi as id_koperasi,
                koperasi.nama as nama_koperasi,
                koperasi.share_cabang as share_cabang,
                ref_kelurahan.nama as nama_kelurahan,
                ref_kecamatan.nama as nama_kecamatan,
                ref_kabupaten.nama as nama_kabupaten,
                ref_provinsi.nama as nama_provinsi, 
                koperasi_alamat.alamat as alamat_koperasi,
                koperasi_alamat.kode_pos as kode_pos
            ',
            FALSE
        );
        $this->db->from('koperasi');
        $this->db->join('koperasi_alamat','koperasi_alamat.id_koperasi=koperasi.id_koperasi','LEFT');

        $this->db->join('ref_kelurahan','koperasi_alamat.kelurahan=ref_kelurahan.id_kelurahan','LEFT');
        $this->db->join('ref_kecamatan','koperasi_alamat.kecamatan=ref_kecamatan.id_kecamatan','LEFT');
        $this->db->join('ref_kabupaten','koperasi_alamat.kabupaten=ref_kabupaten.id_kabupaten','LEFT');
        $this->db->join('ref_provinsi','ref_kabupaten.id_provinsi=ref_provinsi.id_provinsi','LEFT');

        $this->db->where('koperasi.status_active',1);
        $this->db->where('koperasi.id_koperasi',$id_koperasi);
     

        $this->db->limit(1);
       
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        // $result['count_all']= $this->count_question_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function update($data){
        $id_koperasi = $data['id_koperasi'];
        unset($data['id_koperasi']);
        $this->db->where('id_koperasi',$id_koperasi);
        $this->db->update('koperasi', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }


}
