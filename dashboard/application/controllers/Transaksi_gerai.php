<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_gerai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
         if (empty($this->session->userdata('id_user'))) {
            redirect(SMIDUMAY , 'refresh');
        }
        $this->load->model('koperasi_mod');
		$this->load->model('transaksi_gerai_mod');
        $this->load->helper('form');
        $this->load->helper('query_string_helper');
	}

	   function list_transaksi()
	{
        $data['page_name']          = 'Log Transaksi';
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
                            'gerai_transaksi.no_transaksi'      => $keyword,
                            'user_detail.nama_lengkap'                => $keyword,
                        ),
                ),
      
            array(
                'alias'     =>'no_transaksi',
                'parameter' =>'gerai_transaksi.no_transaksi',
                ),
            array(
                'alias'     =>'nama',
                'parameter' =>'user_detail.nama_lengkap',
                )
        );


        $sort = array(
            array(
                'alias'     =>'nama',
                'parameter' =>'user_detail.nama_lengkap',
                ),
             array(
                'alias'     =>'tgl_transaksi',
                'parameter' =>'gerai_transaksi.tanggal_transaksi',
                ),
              array(
                'alias'     =>'no_transaksi',
                'parameter' =>'gerai_transaksi.no_transaksi',
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
        $filter_tanggal = array(
        array(
            'alias'     =>'TANGGAL',
            'parameter' =>NULL,
            )
        );

        for ($i=1; $i<=31 ; $i++) {
            if(strlen($i) == 1){$i = "0".$i;} 
            array_push($filter_tanggal, array(
                    'alias'     => strtoupper($i),
                    'parameter' => strtolower($i),
                ));
        }

        $filter_bulan = array(
        array(
            'alias'     =>'BULAN',
            'parameter' =>NULL,
            )
        );

        for ($i=1; $i<=12 ; $i++) { 
            if(strlen($i) == 1){$i = "0".$i;} 
            array_push($filter_bulan, array(
                    'alias'     => strtoupper($i),
                    'parameter' => strtolower($i),
                ));
        }

        $filter_tahun = array(
        array(
            'alias'     =>'TAHUN',
            'parameter' =>NULL,
            )
        );

        for ($i=2016; $i<=2021 ; $i++) { 
            array_push($filter_tahun, array(
                    'alias'     => strtoupper($i),
                    'parameter' => strtolower($i),
                ));
        }


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

        
        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        
        // Filter
        $data['filter_tanggal'] = $filter_tanggal;
        $data['filter_bulan'] = $filter_bulan;
        $data['filter_tahun'] = $filter_tahun;
        $data['filter_koperasi'] = $filter_koperasi;


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
        

        $def_param_sort = 'gerai_transaksi.no_transaksi';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'no_transaksi';
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


        // Filter
        $def_param_filter_tanggal = $filter_tanggal;
        $get_filter_tanggal = $this->input->get('filter_tanggal');
        $param_filter_tanggal   = strtoupper($get_filter_tanggal);
        $data['param_filter_tanggal'] = $filter_tanggal;
        if (isset($param_filter_tanggal)) {
            $data['param_filter_tanggal'] = $param_filter_tanggal;
            $key = array_search($param_filter_tanggal,array_column($filter_tanggal,'alias'));
            if ($key) {
                $param_filter_tanggal = $filter_tanggal[$key]['parameter'];
                $data['param_filter_tanggal'] = $filter_tanggal[$key]['alias'];
            } else{
                $param_filter_tanggal = $def_param_filter_tanggal;
            }
        }else{
            $param_filter_tanggal = $def_param_filter_tanggal;
        }



        $def_param_filter_bulan = $filter_bulan;
        $get_filter_bulan = $this->input->get('filter_bulan');
        $param_filter_bulan   = strtoupper($get_filter_bulan);
        $data['param_filter_bulan'] = $filter_bulan;
        if (isset($param_filter_bulan)) {
            $data['param_filter_bulan'] = $param_filter_bulan;
            $key = array_search($param_filter_bulan,array_column($filter_bulan,'alias'));
            if ($key) {
                $param_filter_bulan = $filter_bulan[$key]['parameter'];
                $data['param_filter_bulan'] = $filter_bulan[$key]['alias'];
            } else{
                $param_filter_bulan = $def_param_filter_bulan;
            }
        }else{
            $param_filter_bulan = $def_param_filter_bulan;
        }


        $def_param_filter_tahun = $filter_tahun;
        $get_filter_tahun = $this->input->get('filter_tahun');
        $param_filter_tahun   = strtoupper($get_filter_tahun);
        $data['param_filter_tahun'] = $filter_tahun;
        if (isset($param_filter_tahun)) {
            $data['param_filter_tahun'] = $param_filter_tahun;
            $key = array_search($param_filter_tahun,array_column($filter_tahun,'alias'));
            if ($key) {
                $param_filter_tahun = $filter_tahun[$key]['parameter'];
                $data['param_filter_tahun'] = $filter_tahun[$key]['alias'];
            } else{
                $param_filter_tahun = $def_param_filter_tahun;
            }
        }else{
            $param_filter_tahun = $def_param_filter_tahun;
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



        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // Filter
        $param_query['filter_tanggal']    = $param_filter_tanggal;
        $param_query['filter_bulan']    = $param_filter_bulan;
        $param_query['filter_tahun']    = $param_filter_tahun;
        $param_query['filter_koperasi'] = $param_filter_koperasi;

        // print_r($param_query);
        
        ///// END Setting Filter /////
 





        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('transaksi/gerai');
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
        $datadb = $this->transaksi_gerai_mod->get_transaksi($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['title']          = 'Log Transaksi';
        $data['is_content_header']  = TRUE;

        
        $this->load->view('log_transaksi/log_transaksi_gerai_view',$data);
	}

    
}

/* End of file Transaksi_commerce.php */
/* Location: ./application/controllers/Transaksi_commerce.php */