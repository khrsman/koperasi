<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koperasi extends CI_Controller {

    public function __construct(){

        parent::__construct(); //inherit dari parent

        $this->load->model('store_koperasi_model');
        $this->load->helper('core_banking_helper');
        // $this->session->set_userdata('referred_from', current_url_full());

        $session = $this->session->userdata();
        if (!isset($session['id_user'])&&!isset($session['username'])&&!isset($session['last_login'])) {
            redirect('login');
        }
    }


    function index(){
        $session = $this->session->userdata();
        if ($session['level']==2) {
            redirect('store/product');
        }

        $this->form_validation->set_data($this->input->get());
        $this->form_validation->set_rules('filter_kabupaten', 'Kabupaten', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('filter_kodepos', 'Kode Pos', 'xss_clean|numeric');

        if ($this->form_validation->run() == FALSE){

            $data['form_action']       = site_url('store/koperasi');
            $data['page_name']         = 'Cari Koperasi';
            $data['page_sub_name']     = '';

            $data['page'] = 'store/store_koperasi_search_form_view';
            $this->load->view('main_view',$data);

        }else{
            $this->l();    
        }
        
    }


    function l(){
        $data['page_name']          = 'List Koperasi';
        $data['page_sub_name']      = '';

        $keyword = $this->input->get('q');

        $data['keyword'] = NULL;
        if ($keyword) {
            $data['keyword'] = $keyword;
        }

        ///// START Setting Filter /////

        // STEP. 1 : Array nama alias dan syntax db

        $sort = array(
            array(
                'alias'     =>'nama',
                'parameter' =>'koperasi.nama',
                ),

            array(
                'alias'     =>'id koperasi',
                'parameter' =>'koperasi.id_koperasi',
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

        


        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        // Filter
        



        // STEP. 3 : Proses Parsing array Alias dan parameter        

        $def_param_sort = 'koperasi.nama';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'produk terbaru';
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



        $def_param_sort_order = 'asc';
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




        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;
        $param_query['filter_kabupaten'] = $this->input->get('filter_kabupaten');
        $param_query['filter_kodepos'] = $this->input->get('filter_kodepos');

        // Filter
       



        ///// END Setting Filter /////


        //Setting Pagination

        $this->load->library('pagination');
        $config['base_url']             = site_url('store/koperasi');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        $config['per_page']     = 28; 
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
        // $offset = $limit*$this->uri->segment(3);


        //Load Data from Database

        $koperasi = $this->store_koperasi_model->get_all($keyword,$limit,$offset,$param_query);
        $data['koperasi'] = NULL;
        if ($koperasi['count']!=0) {
            $data['koperasi'] = $koperasi['data'];
        }

        $config['total_rows']   = $koperasi['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();
        $data['page_name']          = 'Product';
        $data['is_content_header']  = TRUE;

        $data['form_action']       = site_url('store/koperasi');
        $data['page']               = 'store/store_koperasi_list_view';
        $this->load->view('main_view',$data);
    }

    


    function search_kabupaten(){
        $q = $this->input->post('q');
        $this->load->model('ref_alamat_model');
        $kabupaten = $this->ref_alamat_model->search_kabupaten($q);


        $json = array(
            array(
                'id'    => NULL,
                'text'  => 'Ketik nama kabupaten..',
                )
            );
        $return_arr = array();
        if (empty($q)) {
            $return_arr = $json;
        }else{
            if ($kabupaten==FALSE) {
            $return_arr = $json;    
            }else{
                foreach ($kabupaten as $k => $v) {
                    $row_array['id'] = $v['id_kabupaten'];
                    $row_array['text'] = utf8_encode($v['nama'].' (Provinsi '.$v['nama_provinsi'].')');
                    array_push($return_arr,$row_array);
                }
            }   
        }
        

        $ret = $return_arr;
        echo json_encode($ret);
    }



   

}