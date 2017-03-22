<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_koperasi_model extends CI_Model {

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }
        
   
    function get_all($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS *,
                koperasi.id_koperasi as id_koperasi,
                koperasi.nama as nama_koperasi,
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
     
        if (!empty($param_query['filter_kabupaten'])) {
            if (is_array($param_query['filter_kabupaten'])) {
                foreach ($param_query['filter_kabupaten'] as $k => $v) {
                    $this->db->or_where('koperasi_alamat.kabupaten',$v['parameter']);
                }
            } else{
                $this->db->where('koperasi_alamat.kabupaten',$param_query['filter_kabupaten']);    
            }
            
        }

        if (!empty($param_query['filter_kodepos'])) {
            if (is_array($param_query['filter_kodepos'])) {
                foreach ($param_query['filter_kodepos'] as $k => $v) {
                    $this->db->or_where('koperasi_alamat.kodepos',$v['parameter']);
                }
            } else{
                $this->db->where('koperasi_alamat.kode_pos',$param_query['filter_kodepos']);    
            }
            
        }


        // Keyword By
        if ($keyword!=NULL) {
            $this->db->like('koperasi.nama',$keyword);
        }
        
        

        $this->db->limit($limit,$offset);
       
        
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
            ref_kelurahan.nama as nama_kelurahan,
            ref_kecamatan.nama as nama_kecamatan,
            ref_kabupaten.nama as nama_kabupaten,
            ref_provinsi.nama as nama_provinsi, 
            koperasi_alamat.alamat as alamat_koperasi,
            koperasi_alamat.kode_pos as kode_pos
            ',FALSE);
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
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

}
