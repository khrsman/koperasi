<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_mcb_transaksi_non_member_model extends CI_Model {

	public function __construct(){
		parent::__construct(); //inherit dari parent
	}


	
	function get_all($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
        $this->db->select('SQL_CALC_FOUND_ROWS mcb_log_transaksi_non_member.*,mcb_rekening_non_member.nama as pemilik_rekening',FALSE);
        $this->db->from('mcb_log_transaksi_non_member');
        $this->db->join('mcb_rekening_non_member','mcb_rekening_non_member.no_rekening=mcb_log_transaksi_non_member.no_rekening_non_member','LEFT');
        // Filter        
        

        if (!empty($param_query['filter_jenis_account'])) {
            if (is_array($param_query['filter_jenis_account'])) {
                foreach ($param_query['filter_jenis_account'] as $k => $v) {
                    $this->db->or_having('mcb_log_transaksi_non_member.jenis_account',$v['parameter']);
                }
            } else{
                $this->db->having('mcb_log_transaksi_non_member.jenis_account',$param_query['filter_jenis_account']);    
            }
            
        }


        if (!empty($param_query['filter_sumber_dana'])) {
            if (is_array($param_query['filter_sumber_dana'])) {
                foreach ($param_query['filter_sumber_dana'] as $k => $v) {
                    $parameter[]=$v['parameter'];
                }
                $this->db->where_in('mcb_log_transaksi_non_member.sumber_dana',$parameter);
            } else{
                $this->db->where('mcb_log_transaksi_non_member.sumber_dana',$param_query['filter_sumber_dana']);    
            }
            
        }


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
        // $result['count_all']= $this->count_project_all();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;

        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
    }


    function get_project_by_id($id){
        $this->db->select('*');
        $this->db->from('project');
        $this->db->join('project_status','project.project_status_id=project_status.project_status_id','LEFT');
        $this->db->where('project_id', $id);
        
        $query = $this->db->get();
        $result['data']  = $query->result_array();
        $result['count'] = $query->num_rows();

        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
    }



}
