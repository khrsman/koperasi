<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct(){

        parent::__construct(); //inherit dari parent

        $this->load->model('store_order_model');
        $this->load->model('store_order_detail_model');
        $this->load->model('store_order_shipping_model');
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
                            'transaksi.no_transaksi'   => $keyword,
                        ),
                ),

        );


        $sort = array(
            array(
                'alias'     =>'tanggal transaksi',
                'parameter' =>'transaksi.tanggal_transaksi',
                ),

            array(
                'alias'     =>'no transaksi',
                'parameter' =>'transaksi.no_transaksi',
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
        /*$userdata = $this->session->userdata();
        print_r($userdata);*/
        $id_user    		= $this->session->userdata('id_user');
        $level_user 		= $this->session->userdata('level');
		$status_active_user	= $this->session->userdata('status_active');
        
        $koperasi               = $this->session->userdata('koperasi');
        $status_active_koperasi = $this->session->userdata('status_koperasi');
        
           
        if (empty($id_user)) {
            redirect('404');
        }

        
        switch ($level_user) {
            case 1:
                $param_query['owner'] = 1;
                break;
            case 2:
                $param_query['owner']    = $level_user;
                $param_query['koperasi'] = $koperasi;
                break;
            case 3:
                $param_query['owner']    = $level_user;
                $param_query['user'] = $id_user;
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


        $def_param_sort = 'transaksi.tanggal_transaksi';
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

       



        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // Filter
        


        ///// END Setting Filter /////


        //Setting Pagination

        $this->load->library('pagination');
        $config['base_url']             = site_url('store/order');
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

        $product = $this->store_order_detail_model->get_list_by_transaksi_owner($keyword,$limit,$offset,$param_query);
        $data['product'] = NULL;
        if ($product['count']!=0) {
            $data['product'] = $product['data'];
        }

        $config['total_rows']   = $product['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();
        $data['page_name']          = 'Product Order';
        $data['is_content_header']  = TRUE;
        $data['page']               = 'store/store_order_list_view';
       
        $this->load->view('main_view',$data);
    }


    function detail($no_transaksi=NULL){
        
        if ($no_transaksi==NULL) {
            redirect('404');
        }
        
        $id_user            = $this->session->userdata('id_user');
        $level_user         = $this->session->userdata('level');
        $status_active_user = $this->session->userdata('status_active');
        
        $koperasi               = $this->session->userdata('koperasi');
        $status_active_koperasi = $this->session->userdata('status_koperasi');
           
        if (empty($id_user)) {
            redirect('404');
        }


        $get_order = $this->store_order_model->get_by_transaksi($no_transaksi);
        if ($get_order==FALSE) {
            redirect('404');
        }


        $param_query['no_transaksi']=$no_transaksi;
        switch ($level_user) {
            case 1:
                $param_query['owner'] = $level_user;
                break;
            case 2:
                $param_query['owner']    = $level_user;
                $param_query['koperasi'] = $koperasi;
                break;
            case 3:
                $param_query['owner']    = $level_user;
                $param_query['user'] = $id_user;
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
        
        $get_order_detail = $this->store_order_detail_model->get_detail_by_transaksi_owner($param_query);
        if ($get_order_detail==FALSE) {
            $order_detail = NULL;
        }else{
            $order_detail = $get_order_detail;
        }

        // print_r($get_order_detail);

        $get_order_shipping = $this->store_order_shipping_model->get_by_transaksi($no_transaksi);
        if ($get_order_shipping==FALSE) {
            $order_shipping = NULL;
        }else{
            $order_shipping = $get_order_shipping[0];
        }

        // FIX NAMA ALAMAT
        $get_pengirim_kelurahan = $this->store_order_shipping_model->get_kelurahan_by_id($order_shipping['pengirim_kelurahan']);
        $order_shipping['pengirim_kelurahan'] = $get_pengirim_kelurahan['nama'];

        $get_pengirim_kecamatan = $this->store_order_shipping_model->get_kecamatan_by_id($order_shipping['pengirim_kecamatan']);
        $order_shipping['pengirim_kecamatan'] = $get_pengirim_kecamatan['nama'];

        $get_pengirim_kabupaten = $this->store_order_shipping_model->get_kabupaten_by_id($order_shipping['pengirim_kabupaten']);
        $order_shipping['pengirim_kabupaten'] = $get_pengirim_kabupaten['nama'];

        $get_pengirim_provinsi = $this->store_order_shipping_model->get_provinsi_by_id($order_shipping['pengirim_provinsi']);
        $order_shipping['pengirim_provinsi'] = $get_pengirim_provinsi['nama'];


        $get_penerima_kelurahan = $this->store_order_shipping_model->get_kelurahan_by_id($order_shipping['penerima_kelurahan']);
        $order_shipping['penerima_kelurahan'] = $get_penerima_kelurahan['nama'];

        $get_penerima_kecamatan = $this->store_order_shipping_model->get_kecamatan_by_id($order_shipping['penerima_kecamatan']);
        $order_shipping['penerima_kecamatan'] = $get_penerima_kecamatan['nama'];

        $get_penerima_kabupaten = $this->store_order_shipping_model->get_kabupaten_by_id($order_shipping['penerima_kabupaten']);
        $order_shipping['penerima_kabupaten'] = $get_penerima_kabupaten['nama'];

        $get_penerima_provinsi = $this->store_order_shipping_model->get_provinsi_by_id($order_shipping['penerima_provinsi']);
        $order_shipping['penerima_provinsi'] = $get_penerima_provinsi['nama'];




        $data = array(
            'order'             => $get_order,
            'order_detail'      => $order_detail,
            'order_shipping'    => $order_shipping,
            );

        $data['return'] = $this->session->userdata('referred_from');
       
        $data['page'] = 'store/store_order_detail_view';
        $this->load->view('main_view',$data);

    }


    function edit_status($no_transaksi=NULL){

        if ($no_transaksi==NULL) {
            redirect('404');
        }

        $id_user            = $this->session->userdata('id_user');
        $level_user         = $this->session->userdata('level');
        $status_active_user = $this->session->userdata('status_active');
        
        $koperasi               = $this->session->userdata('koperasi');
        $status_active_koperasi = $this->session->userdata('status_koperasi');
           
        if (empty($id_user)) {
            redirect('404');
        }


        $get_order = $this->store_order_model->get_by_transaksi($no_transaksi);
        if ($get_order==FALSE) {
            redirect('404');
        }


        $param_query['no_transaksi']=$no_transaksi;
        switch ($level_user) {
            case 1:
                $param_query['owner'] = $level_user;
                break;
            case 2:
                $param_query['owner']    = $level_user;
                $param_query['koperasi'] = $koperasi;
                break;
            case 3:
                $param_query['owner']    = $level_user;
                $param_query['user'] = $id_user;
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
        
        $get_order_detail = $this->store_order_detail_model->get_detail_by_transaksi_owner($param_query);
        if ($get_order_detail==FALSE) {
            $order_detail = NULL;
        }else{
            $order_detail = $get_order_detail;
        }

        // print_r($get_order_detail);

        $get_order_shipping = $this->store_order_shipping_model->get_by_transaksi($no_transaksi);
        if ($get_order_shipping==FALSE) {
            $order_shipping = NULL;
        }else{
            $order_shipping = $get_order_shipping[0];
        }

        // FIX NAMA ALAMAT
        $get_pengirim_kelurahan = $this->store_order_shipping_model->get_kelurahan_by_id($order_shipping['pengirim_kelurahan']);
        $order_shipping['pengirim_kelurahan'] = $get_pengirim_kelurahan['nama'];

        $get_pengirim_kecamatan = $this->store_order_shipping_model->get_kecamatan_by_id($order_shipping['pengirim_kecamatan']);
        $order_shipping['pengirim_kecamatan'] = $get_pengirim_kecamatan['nama'];

        $get_pengirim_kabupaten = $this->store_order_shipping_model->get_kabupaten_by_id($order_shipping['pengirim_kabupaten']);
        $order_shipping['pengirim_kabupaten'] = $get_pengirim_kabupaten['nama'];

        $get_pengirim_provinsi = $this->store_order_shipping_model->get_provinsi_by_id($order_shipping['pengirim_provinsi']);
        $order_shipping['pengirim_provinsi'] = $get_pengirim_provinsi['nama'];


        $get_penerima_kelurahan = $this->store_order_shipping_model->get_kelurahan_by_id($order_shipping['penerima_kelurahan']);
        $order_shipping['penerima_kelurahan'] = $get_penerima_kelurahan['nama'];

        $get_penerima_kecamatan = $this->store_order_shipping_model->get_kecamatan_by_id($order_shipping['penerima_kecamatan']);
        $order_shipping['penerima_kecamatan'] = $get_penerima_kecamatan['nama'];

        $get_penerima_kabupaten = $this->store_order_shipping_model->get_kabupaten_by_id($order_shipping['penerima_kabupaten']);
        $order_shipping['penerima_kabupaten'] = $get_penerima_kabupaten['nama'];

        $get_penerima_provinsi = $this->store_order_shipping_model->get_provinsi_by_id($order_shipping['penerima_provinsi']);
        $order_shipping['penerima_provinsi'] = $get_penerima_provinsi['nama'];


        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'status', 'required|xss_clean');


        if ($this->form_validation->run() == FALSE){

            $data = array(
                'order'             => $get_order,
                'order_detail'      => $order_detail,
                'order_shipping'    => $order_shipping,
                );

            $data['return'] = $this->session->userdata('referred_from');
           
            $data['form_action'] = site_url('store/order/edit_status').'/'.$no_transaksi;
            $data['page'] = 'store/store_order_status_form_view';
            $this->load->view('main_view',$data);

        }else{

            $input_status = $this->input->post('status');

            foreach ($order_detail as $k => $v) {
                $data_update = array(
                    'no_transaksi'      => $v['no_transaksi'],
                    'id_produk'         => $v['id_produk'],
                    'status_terkirim'   => $input_status
                    );
                $this->store_order_detail_model->edit_detail_by_transaksi_produk($data_update);
            }
            // print_r($order_detail);
            redirect(site_url('store/order/detail').'/'.$no_transaksi);


        }
        

    }

   

}