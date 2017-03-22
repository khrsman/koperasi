<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profit_share_koperasi_cabang extends CI_Controller {

    public function __construct(){

        parent::__construct(); //inherit dari parent
        $this->load->model('profit_share_koperasi_cabang_model');
    }


    function index(){
        $this->l();
    }


    function l(){
        // $this->session->set_userdata('referred_from', current_url_full());

        $data['page_name']          = 'Page Name';
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
                            'koperasi.id_koperasi'   => $keyword,
                            'koperasi.nama'   => $keyword,
                        ),
                ),

        );


        $sort = array(
            array(
                'alias'     =>'nama koperasi',
                'parameter' =>'koperasi.nama',
                ),

            array(
                'alias'     =>'id koperasi',
                'parameter' =>'koperasi.id_koperasi',
                ),

        );


        $sort_order = array(
            array(
                'alias'     =>'a-z',
                'parameter' =>'asc',
                ),
            array(
                'alias'     =>'z-a',
                'parameter' =>'desc',
                ),

        );



        // Filter
        /*$userdata = $this->session->userdata();
        print_r($userdata);*/
        $id_user    		= $this->session->userdata('id_user');
        $level_user 		= $this->session->userdata('level');
		$status_active_user	= $this->session->userdata('status_active');
        
        $koperasi               = $this->session->userdata('koperasi');
        $status_active_koperasi = $this->session->userdata('status_koperasi');
        
        $get_koperasi = $this->profit_share_koperasi_cabang_model->get($koperasi);
        if ($get_koperasi==FALSE || $get_koperasi['parent_koperasi']!=0) {
            redirect('404');
        }
           
        if (empty($id_user)) {
            redirect('404');
        }

        
        switch ($level_user) {
            case 1:
                redirect('404');
                break;
            case 2:
                $param_query['koperasi'] = $koperasi;
                break;
            case 3:
                redirect('404');
                break;
            case 4:
                redirect('404');
                break;
            case 5:
                redirect('404');
                break;
            
            default:
                redirect('404');
                break;
        }



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


        $def_param_sort = 'koperasi.nama';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'pesanan terbaru';
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

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // Filter
        


        ///// END Setting Filter /////


        //Setting Pagination

        $this->load->library('pagination');
        $config['base_url']             = site_url('profit_share_koperasi_cabang/l');
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

        $data_koperasi = $this->profit_share_koperasi_cabang_model->get_all($keyword,$limit,$offset,$param_query);
        $data['data_koperasi'] = NULL;
        if ($data_koperasi['count']!=0) {
            $data['data_koperasi'] = $data_koperasi['data'];
        }
        
        $config['total_rows']   = $data_koperasi['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();
        $data['page_name']          = 'Profit Share Koperasi Cabang';
        $data['is_content_header']  = TRUE;
        $data['page']               = 'profit_share_koperasi_cabang_view';
       
        $this->load->view('main_view',$data);
    }



    function edit_share($id_koperasi){

        if ($id_koperasi==NULL) {
            redirect('404');
        }

        $id_user            = $this->session->userdata('id_user');
        $level_user         = $this->session->userdata('level');
        $status_active_user = $this->session->userdata('status_active');
        
        $koperasi               = $this->session->userdata('koperasi');
        $status_active_koperasi = $this->session->userdata('status_koperasi');
        
        $get_koperasi_induk = $this->profit_share_koperasi_cabang_model->get($koperasi);
        if ($get_koperasi_induk==FALSE || $get_koperasi_induk['parent_koperasi']!=0) {
            redirect('404');
        }

        $get_koperasi_cabang = $this->profit_share_koperasi_cabang_model->get($id_koperasi);
        if ($get_koperasi_cabang==FALSE || $get_koperasi_cabang['parent_koperasi']!=$koperasi) {
            redirect('404');
        }

        if (empty($id_user)) {
            redirect('404');
        }


        switch ($level_user) {
            case 1:
                redirect('404');
                break;
            case 2:
                
                break;
            case 3:
                redirect('404');
                break;
            case 4:
                redirect('404');
                break;
            case 5:
                redirect('404');
                break;
            
            default:
                redirect('404');
                break;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('share', 'share', 'required|xss_clean|numeric|greater_than_equal_to[0]|less_than_equal_to[100]');


        if ($this->form_validation->run() == FALSE){
            $data['data_koperasi']    = $get_koperasi_cabang;
            $data['form_action'] = site_url('profit_share_koperasi_cabang/edit_share').'/'.$id_koperasi;
            $data['page'] = 'profit_share_koperasi_cabang_form_view';
            $this->load->view('main_view',$data);
        }else{

            $share = $this->input->post('share');

            $data_update = array(
                'id_koperasi'       => $get_koperasi_cabang['id_koperasi'],
                'share_cabang'      => $share,
                'service_time'      => date('Y-m-d H:i:s'),
                'service_action'    => 'update',
                'service_users'     => $id_user,
                );
            $this->profit_share_koperasi_cabang_model->update($data_update);

            $data_report['flash_msg']           = TRUE;
            $data_report['flash_msg_type']      = "success";
            $data_report['flash_msg_status']    = TRUE;
            $data_report['flash_msg_text']      = 'Data Share '.$get_koperasi_cabang['nama_koperasi'].' berhasil diubah';
            $this->session->set_flashdata($data_report);

            redirect(site_url('profit_share_koperasi_cabang'));


        }
        

    }

   

}