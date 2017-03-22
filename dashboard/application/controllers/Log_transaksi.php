<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->model('anggota_mod');
		$this->load->model('koperasi_mod');
		$this->load->model('rekening_mod');

	}

	function data_anggota()
	{
		$data['title'] = "Data Anggota Koperasi";
		$data['no'] = 1;
		$data['page_name']          = 'Data Admin';
        $data['page_sub_name']      = '';

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
                            'user_detail.nama_depan'       => $keyword,
                            'user_detail.nama_belakang'    => $keyword,
                            'user_detail.nama_lengkap'     => $keyword,
                        ),
                ),
             array(
                'alias'=>'Nama',
                'parameter'=> array
                        (   
                            'user_detail.nama_depan'       => $keyword,
                            'user_detail.nama_belakang'    => $keyword,
                            'user_detail.nama_lengkap'     => $keyword,
                        ),
                ),
        );


        $sort = array(
            array(
                'alias'     =>'Nama',
                'parameter' =>'user_detail.nama_lengkap',
                ),
             array(
                'alias'     =>'Username',
                'parameter' =>'user_info.username',
                ),
              array(
                'alias'     =>'Email',
                'parameter' =>'user_detail.email',
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
        
        $get_id_koperasi = $this->input->get('filter_koperasi');
        $get_nama_koperasi = $this->koperasi_mod->get_nama_koperasi($get_id_koperasi);

        

        if($get_nama_koperasi){
            
                $filter_koperasi = array( array(
                    'alias'     => $get_nama_koperasi[0]['nama'],
                    'parameter' => $get_id_koperasi,
                ));
            
        }
        else {
            $filter_koperasi = array(array(
                'alias'     => 'Cari Berdasarkan Koperasi',
                'parameter' => NULL,
            ));
        }
        $data['koperasi'] = $filter_koperasi;

        $data['filter_koperasi'] = $filter_koperasi;
        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        
        // Filter
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


        $def_param_sort = 'user_detail.nama_lengkap';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'semua';
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
        

        $def_param_filter_koperasi = $filter_koperasi;
        $get_filter_koperasi = $this->input->get('filter_koperasi');
        $param_filter_koperasi   = strtoupper($get_filter_koperasi);
        $data['param_filter_koperasi'] = $filter_koperasi;
        if (isset($param_filter_koperasi)) {
            $data['param_filter_koperasi'] = $param_filter_koperasi;
            $key = array_search($param_filter_koperasi,array_column($filter_koperasi,'alias'));
            if ($key) {
                $param_filter_koperasi = $filter_koperasi[$key]['parameter'];
                $data['param_filter_koperasi'] = $filter_koperasi[$key]['alias'];
            } else{
                $param_filter_koperasi = $def_param_filter_koperasi;
            }
        }else{
            $param_filter_koperasi = $def_param_filter_koperasi;
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


        // Filter

        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // Filter
        $param_query['filter_koperasi'] = $param_filter_koperasi;
        
        ///// END Setting Filter /////
 

        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('admin');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        
        $config['per_page']     = 50; 
        $config['num_links']    = 10;
        $config['uri_segment']  = 3;

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
        $offset = $this->uri->segment(3);

        //Load Data from Database
        $datadb = $this->anggota_mod->get_all_anggota($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        $data ['no'] = 1;
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['is_content_header']  = TRUE;

		$this->load->view('log_transaksi/data_anggota', $data);
	}

	function cek_log(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'log_view','refresh');
	}

	function lihat_log(){
		if($this->rekening_mod->all_transaksi()->num_rows() > 0){
			$data['saldo'] = $this->rekening_mod->all_transaksi();
		}
		else {
			$data['saldo'] = NULL;
		}
		$data['title'] = 'Log Transaksi';
		$data['no'] = 1;
		$this->load->view('log_transaksi/log_transaksi', $data);
	}

}

/* End of file Log_transaksi.php */
/* Location: ./application/controllers/Log_transaksi.php */