<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Ref_alamat_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}


    //  SEARCH KELURAHAN
    function search_kelurahan($q,$kecamatan_id=NULL){
        $this->db->select('*');
        $this->db->from('ref_kelurahan');
        if ($kecamatan_id!=NULL) {
            $this->db->where('ref_kelurahan.id_kecamatan',$kecamatan_id);
        }
        $this->db->like('nama',$q);
        $this->db->group_by('nama');
        $this->db->limit(200);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    //  SEARCH KECAMATAN
    function search_kecamatan($q,$kabupaten_id=NULL){
        $this->db->select('*');
        $this->db->from('ref_kecamatan');
        if ($kabupaten_id!=NULL) {
            $this->db->where('ref_kecamatan.id_kabupaten',$kabupaten_id);
        }
        $this->db->like('nama',$q);
        $this->db->group_by('nama');
        $this->db->limit(100);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    //  SEARCH KABUPATEN
    function search_kabupaten($q,$province_id=NULL){
        $this->db->select('*,ref_kabupaten.nama as nama, ref_provinsi.nama as nama_provinsi');
        $this->db->from('ref_kabupaten');
        $this->db->join('ref_provinsi','ref_provinsi.id_provinsi=ref_kabupaten.id_provinsi','LEFT');
        if ($province_id!=NULL) {
            $this->db->where('ref_kabupaten.id_provinsi',$province_id);
        }
        $this->db->like('ref_kabupaten.nama',$q);
        $this->db->limit(100);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    //  SEARCH PROVINSI
    function search_provinsi($q){
        $this->db->select('*');
        $this->db->from('ref_provinsi');
        $this->db->like('nama',$q);
        $this->db->group_by('nama');
        $this->db->limit(50);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }



    function get_provinsi_by_id($id_provinsi){
        $this->db->select('*');
        $this->db->from('ref_provinsi');
        $this->db->where('id_provinsi',$id_provinsi);
        $this->db->limit(1);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function get_kabupaten_by_id($id_kabupaten){
        $this->db->select('*');
        $this->db->from('ref_kabupaten');
        $this->db->where('id_kabupaten',$id_kabupaten);
        $this->db->limit(1);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function get_kecamatan_by_id($id_kecamatan){
        $this->db->select('*');
        $this->db->from('ref_kecamatan');
        $this->db->where('id_kecamatan',$id_kecamatan);
        $this->db->limit(1);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

    function get_kelurahan_by_id($id_kelurahan){
        $this->db->select('*');
        $this->db->from('ref_kelurahan');
        $this->db->where('id_kelurahan',$id_kelurahan);
        $this->db->limit(1);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }



}

