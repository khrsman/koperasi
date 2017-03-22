<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Ref_alamat_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}


    //  SEARCH KELURAHAN
    function search_kelurahan($q){
        $this->db->select('*');
        $this->db->from('ref_kelurahan');
        $this->db->like('nama',$q);
        $this->db->group_by('nama');
        $this->db->limit(50);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    //  SEARCH KECAMATAN
    function search_kecamatan($q){
        $this->db->select('*');
        $this->db->from('ref_kecamatan');
        $this->db->like('nama',$q);
        $this->db->group_by('nama');
        $this->db->limit(50);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    //  SEARCH KABUPATEN
    function search_kabupaten($q){
        $this->db->select('*');
        $this->db->from('ref_kabupaten');
        $this->db->like('nama',$q);
        $this->db->group_by('nama');
        $this->db->limit(50);

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



}

