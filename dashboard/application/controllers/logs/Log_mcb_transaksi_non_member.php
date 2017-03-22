<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_mcb_transaksi_non_member extends CI_Controller {

    public function __construct(){
        parent::__construct(); //inherit dari parent

        $this->load->model('log_mcb_transaksi_non_member_model');

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: no-store, no-cache, must-revalidate"); 
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        
    }
    
    
    function index(){
        $this->l();
    }

    // List of project
    function l(){

        $data['page_name']          = 'Log MCB Transaksi';
        $data['page_sub_name']      = 'Non Member';

        $keyword = $this->input->get('q');
        

        $data['keyword'] = NULL;
        if ($keyword) {
            $data['keyword'] = $keyword;
        }

        ///// START Setting Filter /////
        // STEP. 1 : Array nama alias dan syntax db
        $keyword_by = array(
            array(
                'alias'=>'semua',
                'parameter'=> array
                        (   
                            'mcb_log_transaksi_non_member.no_transaksi'             => $keyword,
                            'mcb_log_transaksi_non_member.no_rekening_non_member'   => $keyword,
                            'mcb_log_transaksi_non_member.no_ref_transaksi'         => $keyword,
                        ),
                ),
      
            array(
                'alias'     =>'no. transaksi',
                'parameter' =>'mcb_log_transaksi_non_member.no_transaksi',
                ),
            array(
                'alias'     =>'rek. non member',
                'parameter' =>'mcb_log_transaksi_non_member.no_rekening_non_member',
                ),
            array(
                'alias'     =>'no. referensi',
                'parameter' =>'mcb_log_transaksi_non_member.no_ref_transaksi',
                ),
            
        );


        $sort = array(
            array(
                'alias'     =>'tgl. transaksi',
                'parameter' =>'mcb_log_transaksi_non_member.tanggal_transaksi',
                ),
            array(
                'alias'     =>'rek. non member',
                'parameter' =>'mcb_log_transaksi_non_member.no_rekening_non_member',
                ),
            array(
                'alias'     =>'no. referensi',
                'parameter' =>'mcb_log_transaksi_non_member.no_ref_transaksi',
                ),
            array(
                'alias'     =>'no. transaksi',
                'parameter' =>'mcb_log_transaksi_non_member.no_transaksi',
                ),
            
            );


        $sort_order = array(
            array(
                'alias'     =>'z-a',
                'parameter' =>'desc',
                ),
            array(
                'alias'     =>'a-z',
                'parameter' =>'asc',
                ),
        );

        // Filter


        $filter_sumber_dana = array(
        array(
            'alias'     =>'SEMUA',
            'parameter' =>NULL,
            ),
        array(
            'alias'     =>'GERAI',
            'parameter' =>'GERAI',
            ),
        array(
            'alias'     =>'COMMERCE',
            'parameter' =>'COMMERCE',
            ),
        );


        $filter_jenis_account = array(
        array(
            'alias'     =>'SEMUA',
            'parameter' =>NULL,
            ),
        array(
            'alias'     =>'SMIDUMAY',
            'parameter' =>'SMIDUMAY',
            ),
        array(
            'alias'     =>'KOPERASI INDUK',
            'parameter' =>'KOPERASI INDUK',
            ),
        array(
            'alias'     =>'KOPERASI CABANG',
            'parameter' =>'KOPERASI CABANG',
            ),
        array(
            'alias'     =>'KETUA',
            'parameter' =>'KETUA',
            ),
        array(
            'alias'     =>'OKNUM',
            'parameter' =>'OKNUM',
            ),
        array(
            'alias'     =>'ANGGOTA',
            'parameter' =>'ANGGOTA',
            ),
        );

        
        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;
        // Filter
        $data['filter_sumber_dana']     = $filter_sumber_dana;
        $data['filter_jenis_account']   = $filter_jenis_account;


        // STEP. 3 : Proses Parsing array Alias dan parameter        

        $def_param_keyword_by = $keyword_by[0]['parameter'];
        $param_keyword_by   = strtolower($this->input->get('keyword_by'));
        $data['param_keyword_by'] = 'semua';
        if (isset($param_keyword_by)) {
            $data['param_keyword_by'] = $param_keyword_by;
            $key = array_search($param_keyword_by, array_column($keyword_by,'alias'));
            if ($key) {
                $param_keyword_by = $keyword_by[$key]['parameter'];
                $data['param_keyword_by'] = $keyword_by[$key]['alias'];
            } else{
                $param_keyword_by = $def_param_keyword_by;
            }
        }else{
            $param_keyword_by = $def_param_keyword_by;
        }
        

        $def_param_sort = 'mcb_log_transaksi_non_member.tanggal_transaksi';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'nama';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }


        $def_param_sort_order = 'desc';
        $param_sort_order   = strtolower($this->input->get('sort_order'));
        $data['param_sort_order'] = 'z-a';
        if (isset($param_sort_order)) {
            $data['param_sort_order'] = $param_sort_order;
            $key = array_search($param_sort_order,array_column($sort_order,'alias'));
            if ($key) {
                $param_sort_order = $sort_order[$key]['parameter'];
                $data['param_sort_order'] = $sort_order[$key]['alias'];
            } else{
                $param_sort_order = $def_param_sort_order;
            }
        }else{
            $param_sort_order = $def_param_sort_order;
        }



        // Filter command
        $def_param_filter_sumber_dana = $filter_sumber_dana;
        $get_filter_sumber_dana = $this->input->get('filter_sumber_dana');
        $param_filter_sumber_dana   = strtoupper($get_filter_sumber_dana);
        $data['param_filter_sumber_dana'] = $filter_sumber_dana;
        if (isset($param_filter_sumber_dana)) {
            $data['param_filter_sumber_dana'] = $param_filter_sumber_dana;
            $key = array_search($param_filter_sumber_dana,array_column($filter_sumber_dana,'alias'));
            if ($key) {
                $param_filter_sumber_dana = $filter_sumber_dana[$key]['parameter'];
                $data['param_filter_sumber_dana'] = $filter_sumber_dana[$key]['alias'];
            } else{
                $param_filter_sumber_dana = $def_param_filter_sumber_dana;
            }
        }else{
            $param_filter_sumber_dana = $def_param_filter_sumber_dana;
        }

        $def_param_filter_jenis_account = $filter_jenis_account;
        $get_filter_jenis_account = $this->input->get('filter_jenis_account');
        $param_filter_jenis_account   = strtoupper($get_filter_jenis_account);
        $data['param_filter_jenis_account'] = $filter_jenis_account;
        if (isset($param_filter_jenis_account)) {
            $data['param_filter_jenis_account'] = $param_filter_jenis_account;
            $key = array_search($param_filter_jenis_account,array_column($filter_jenis_account,'alias'));
            if ($key) {
                $param_filter_jenis_account = $filter_jenis_account[$key]['parameter'];
                $data['param_filter_jenis_account'] = $filter_jenis_account[$key]['alias'];
            } else{
                $param_filter_jenis_account = $def_param_filter_jenis_account;
            }
        }else{
            $param_filter_jenis_account = $def_param_filter_jenis_account;
        }


        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // Filter
        $param_query['filter_sumber_dana']      = $param_filter_sumber_dana;
        $param_query['filter_jenis_account']    = $param_filter_jenis_account;
        
        ///// END Setting Filter /////
 


        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('logs/log_mcb_transaksi_non_member/l');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        
        $config['per_page']     = 50; 
        $config['num_links']    = 10;
        $config['uri_segment']  = 4;

        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $limit = $config['per_page'];
        $offset = $this->uri->segment(4);

        //Load Data from Database
        $datadb = $this->log_mcb_transaksi_non_member_model->get_all($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['is_content_header']  = TRUE;
        $data['page']               = 'logs/log_mcb_transaksi_non_member_view';
        $this->load->view('main_view',$data);
    }




   
}