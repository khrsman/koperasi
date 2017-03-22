<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gerai_admin_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}
    

	function search_anggota_kopearasi($q){
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->join('koperasi','koperasi.id_koperasi=user_info.koperasi','LEFT');
        $this->db->join('user_detail','user_detail.id_user=user_info.id_user','LEFT');
        $this->db->where('user_info.level',3);

        $session =  $this->session->userdata();
        if ($session['level']==2) {
            $this->db->where('user_info.koperasi',$session['koperasi']);
        }

        $like = "(user_detail.nama_depan LIKE '%{$q}%' OR user_detail.nama_belakang LIKE '%{$q}%' OR user_info.id_user LIKE '%{$q}%' OR user_info.username LIKE '%{$q}%')";
        $this->db->where($like);

        /*$this->db->like('user_detail.nama_depan',$q);
        $this->db->or_like('user_detail.nama_belakang',$q);
        $this->db->or_like('user_info.id_user',$q);
        $this->db->or_like('user_info.username',$q);*/
        $this->db->limit(30);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data']; } else { return FALSE; }
    }

    function get_anggota_koperasi_by_id($id_user){
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->join('koperasi','koperasi.id_koperasi=user_info.koperasi','LEFT');
        $this->db->join('user_detail','user_detail.id_user=user_info.id_user','LEFT');
        $this->db->where('user_info.level',3);
        $this->db->where('user_info.id_user',$id_user);
        $this->db->where('user_info.status_active',1);
        
        $this->db->limit(1);

        $query = $this->db->get();
        $result['data']  = $query->result_array();

        if($query->num_rows() > 0){ return $result['data'][0]; } else { return FALSE; }
    }

}
