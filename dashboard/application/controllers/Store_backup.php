<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_backup extends CI_Controller {

    public function __construct(){

        parent::__construct(); //inherit dari parent

        $this->load->model('product_model');
        $this->load->model('product_category_model');
        $this->load->helper('core_banking_helper');
        // $this->session->set_userdata('referred_from', current_url_full());
    }


    function index(){
        $this->l();
    }


    function l(){
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
                            'produk.nama'   => $keyword,
                            'produk.desk'   => $keyword,
                            'produk.warna'  => $keyword,
                            'produk.tipe'   => $keyword,
                        ),
                ),

            array(
                'alias'     =>'nama',
                'parameter' =>'produk.nama',
                ),

            array(
                'alias'     =>'deskripsi',
                'parameter' =>'produk.desk',
                ),

            array(
                'alias'     =>'warna',
                'parameter' =>'produk.warna',
                ),

            array(
                'alias'     =>'tipe',
                'parameter' =>'produk.tipe',
                ),

        );


        $sort = array(
            array(
                'alias'     =>'produk terbaru',
                'parameter' =>'produk.service_time',
                ),

            array(
                'alias'     =>'harga',
                'parameter' =>'produk.price_n',
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



        $id_user            = $this->session->userdata('id_user');
        $level_user         = $this->session->userdata('level');
        $status_active_user = $this->session->userdata('status_active');
        
        $koperasi               = $this->session->userdata('koperasi');
        $id_koperasi            = $this->session->userdata('id_koperasi');
        $status_active_koperasi = $this->session->userdata('status_koperasi');
        
           
        if (empty($id_user)) {
            redirect('404');
        }

        switch ($level_user) {
            case 1:
                
                break;
            case 2:
                
                break;   
            case 3:
                
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

        // print_r($this->session->userdata());

        $filter_owner    = $this->input->get('filter_owner');
        $data['param_filter_owner'] = $filter_owner;
        switch ($filter_owner) {
            case 'gerai':
                $filter_koperasi = array();
                $filter_owner_produk = array(
                array(
                    'alias'     =>'Level Owner',
                    'parameter' => 1,
                    )
                );
                break;
            case 'koperasi':
                $filter_koperasi = array(
                array(
                    'alias'     =>'ID Koperasi',
                    'parameter' => $koperasi,
                    )
                );
                $filter_owner_produk = array(
                array(
                    'alias'     =>'Level Owner',
                    'parameter' => 2,
                    )
                );
                break;
            case 'member':
                $filter_koperasi = array(
                array(
                    'alias'     =>'ID Koperasi',
                    'parameter' => $koperasi,
                    )
                );
                $filter_owner_produk = array(
                array(
                    'alias'     =>'Level Owner',
                    'parameter' => 3,
                    )
                );
                break;        
            
            default:
                $filter_koperasi = array();
                $filter_owner_produk = array(
                array(
                    'alias'     =>'Level Owner',
                    'parameter' => 1,
                    )
                );
                $data['param_filter_owner'] = 'gerai';
                break;
        }

        
        



        // Filter

        $get_product_category = $this->product_category_model->get_all(NULL,NULL,NULL,NULL);
        $data['product_category'] = $get_product_category['data'];

        $filter_product_category = array(
        array(
            'alias'     =>'SEMUA KATEGORI',
            'parameter' =>NULL,
            )
        );

        foreach ($get_product_category['data'] as $k => $v) {
            array_push($filter_product_category, array(
                'alias'     => strtoupper($v['nama']),
                'parameter' => strtolower($v['id_kategori']),
            ));
        }


        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        // Filter
        $data['filter_product_category'] = $filter_product_category;
        $data['filter_koperasi']         = $filter_koperasi;
        $data['filter_owner_produk']     = $filter_owner_produk;



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


        $def_param_sort = 'produk.service_time';
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

        $def_param_filter_product_category = $filter_product_category;
        $get_filter_product_category = $this->input->get('filter_product_category');
        $param_filter_product_category   = strtoupper($get_filter_product_category);
        $data['param_filter_product_category'] = $filter_product_category;
        if (isset($param_filter_product_category)) {
            $data['param_filter_product_category'] = $param_filter_product_category;
            $key = array_search($param_filter_product_category,array_column($filter_product_category,'alias'));
            if ($key) {
                $param_filter_product_category = $filter_product_category[$key]['parameter'];
                $data['param_filter_product_category'] = $filter_product_category[$key]['alias'];
            } else{
                $param_filter_product_category = $def_param_filter_product_category;
            }
        }else{
            $param_filter_product_category = $def_param_filter_product_category;
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



        $def_param_filter_owner_produk = $filter_owner_produk;
        $get_filter_owner_produk = $this->input->get('filter_owner_produk');
        $param_filter_owner_produk   = strtoupper($get_filter_owner_produk);
        $data['param_filter_owner_produk'] = $filter_owner_produk;
        if (isset($param_filter_owner_produk)) {
            $data['param_filter_owner_produk'] = $param_filter_owner_produk;
            $key = array_search($param_filter_owner_produk,array_column($filter_owner_produk,'alias'));
            if ($key) {
                $param_filter_owner_produk = $filter_owner_produk[$key]['parameter'];
                $data['param_filter_owner_produk'] = $filter_owner_produk[$key]['alias'];
            } else{
                $param_filter_owner_produk = $def_param_filter_owner_produk;
            }
        }else{
            $param_filter_owner_produk = $def_param_filter_owner_produk;
        }




        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // Filter
        $param_query['filter_product_category']    = $param_filter_product_category;
        $param_query['filter_koperasi']            = $param_filter_koperasi;
        $param_query['filter_owner_produk']        = $param_filter_owner_produk;


        ///// END Setting Filter /////


        //Setting Pagination

        $this->load->library('pagination');
        $config['base_url']             = site_url('store/l');
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

        $product = $this->product_model->get_all($keyword,$limit,$offset,$param_query);
        $data['product'] = NULL;
        if ($product['count']!=0) {
            $data['product'] = $product['data'];
        }

        $config['total_rows']   = $product['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();
        $data['page_name']          = 'Product';
        $data['is_content_header']  = TRUE;
        $data['page']               = 'store/store_list_view';
        $this->load->view('main_view',$data);
    }



    function item($product_id){

        $data = $this->get_category();
        $product = $this->product_model->get($product_id);
        $data['product'] = NULL;
        if ($product!=FALSE) {
            $data['product'] = $product;
        }else{
            redirect('404');
        }

        //CEK APAKAH TELAH MASUK CART

        $cart_content = $this->cart->contents();
        $is_item_on_cart    = FALSE;
        if (!empty($cart_content)) {
            foreach ($cart_content as $k => $v) {
                if ($v['id']==$product_id) {
                    $is_item_on_cart    = TRUE;
                    $data['is_on_cart'] = TRUE;
                    $data['form_action_cart'] = base_url('store/cart_update');
                    $data['qty_item'] = $v['qty'];
                    $data['rowid'] = $k;
                }
            }
        }


        if ($is_item_on_cart==FALSE) {
            $data['rowid'] = NULL;
            $data['is_on_cart'] = FALSE;
            $data['form_action_cart'] = base_url('store/cart_add');
            $data['qty_item'] = 1;
        }


        $data['page_name']          = 'Product Detail';
        $data['is_content_header']  = TRUE;
        $data['page']               = 'store/store_item_view';
        $this->load->view('main_view',$data);
    }



    function cart(){

        $data = $this->get_category();
        $data['cart'] = $this->cart->contents();

        $data['page_name']         = 'Cart';
        $data['page_sub_name']     = '';

        if (!has_koperasi()) {
            $data['page']   = "auth/404_koperasi_view";
        }else{
            $data['page']   = 'store/store_cart_view';
        }

        $this->load->view('main_view',$data);
    }





    function cart_add(){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $get_post = $this->input->post();
        $product_id = $get_post['produk'];
        $qty_item   = $get_post['qty_item'];

        $get_product = $this->product_model->get($product_id);
        if ($get_product==FALSE) {
            redirect('404');
        }

        $data_cart = array(
            'id'      => $get_product['id_produk'],
            'qty'     => $qty_item,
            'price_s'   => $get_product['price_s'],
            'price'  => $get_product['price_n'],
            'savings'    => $get_product['price_n']-$get_product['price_s'],
            'name'    => $get_product['nama_produk'],
            'foto_path' => $get_product['foto_path'], 
            'berat' => $get_product['berat'],
            'options' => array()
        );

        $this->cart->insert($data_cart);
        redirect(site_url('store/item').'/'.$product_id,'REFRESH');
    }



    function cart_update(){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $get_post = $this->input->post();
        $data_cart = array();
        foreach ($get_post['rowid'] as $k => $v) {
            $data_cart[$k]['rowid'] = $v;
        }

        foreach ($get_post['qty_item'] as $k => $v) {
            $data_cart[$k]['qty'] = $v;
        }


        $this->cart->update($data_cart);
        redirect(site_url('store/cart'));
    }



    function cart_remove($rowid){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $this->cart->remove($rowid);
        redirect(site_url('store/cart'));
    }



    function is_pin_valid(){
        $pin = $this->input->post('pin');
        $valid = is_pin_valid($pin);
        if ($valid==TRUE) {
            return TRUE;
        }else{
            $this->form_validation->set_message('is_pin_valid', 'PIN yang anda masukan salah.');
            return FALSE;
        }
    }


    function check_out(){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('penerima_nama', 'Nama Penerima', 'required|xss_clean');
        $this->form_validation->set_rules('penerima_alamat', 'Alamat Penerima', 'required|xss_clean');
        $this->form_validation->set_rules('penerima_kelurahan', 'Kelurahan Penerima', 'xss_clean');
        $this->form_validation->set_rules('penerima_kecamatan', 'Kecamatan Penerima', 'xss_clean');
        $this->form_validation->set_rules('penerima_kabupaten', 'Kabupaten Penerima', 'required|xss_clean');
        $this->form_validation->set_rules('penerima_provinsi', 'Provinsi Penerima', 'required|xss_clean');
        $this->form_validation->set_rules('penerima_kode_pos', 'Kode Pos Penerima', 'xss_clean|numeric');
        $this->form_validation->set_rules('penerima_no_tlp', 'No Telpon Penerima', 'xss_clean|numeric');

        $this->form_validation->set_rules('pengirim_nama', 'Nama Pengirim', 'required|xss_clean');
        $this->form_validation->set_rules('pengirim_alamat', 'Alamat Pengirim', 'required|xss_clean');
        $this->form_validation->set_rules('pengirim_kelurahan', 'Kelurahan Pengirim', 'xss_clean');
        $this->form_validation->set_rules('pengirim_kecamatan', 'Kecamatan Pengirim', 'xss_clean');
        $this->form_validation->set_rules('pengirim_kabupaten', 'Kabupaten Pengirim', 'required|xss_clean');
        $this->form_validation->set_rules('pengirim_provinsi', 'Provinsi Pengirim', 'required|xss_clean');
        $this->form_validation->set_rules('pengirim_kode_pos', 'Kode Pos Pengirim', 'xss_clean|numeric');
        $this->form_validation->set_rules('pengirim_no_tlp', 'No Telpon Pengirim', 'xss_clean|numeric');

        $this->form_validation->set_rules('pin', 'PIN', 'required|xss_clean|numeric|callback_is_pin_valid');


        if ($this->form_validation->run() == FALSE){

            $data = $this->get_category();
            $session = $this->session->userdata();
            if (!isset($session['id_user'])&&!isset($session['username'])&&!isset($session['last_login'])) {
                # redirect ke login
                redirect('masuk');
            }else{
                $data['page'] = 'store/store_check_out_view';
            }

            $data['form_action']       = site_url('store/check_out');
            $data['cart']              = $this->cart->contents();
            $data['page_name']         = 'Check Out';
            $data['page_sub_name']     = '';

            $this->load->view('main_view',$data);

        }else{
            
            $this->load->model('transaction_model');
            $session = $this->session->userdata();
            $cart    = $this->cart->contents();

            // START IF CART
            if (!isset($cart) || empty($cart) || !isset($session['id_user'])) {
                # redirect ke store cart
                redirect('store/cart');
            }else{

                // START IF LOGIN
                if (!isset($session['id_user'])&&!isset($session['username'])&&!isset($session['last_login'])) {
                    # redirect ke login
                    redirect(URL_LOGIN.'?return='.site_url('store/cart'));
                }else{
                    $get_post       = $this->input->post();
                    $id_user        = $session['id_user'];
                    $now            = date('Y-m-d H:i:s');
                    $service_action = 'insert';
                    $id_transaction = "76".time();

                    $total_harga_produk     = NULL;
                    $total_harga_produk_s   = NULL;
                    foreach ($cart as $k => $v) {
                        $get_product = $this->product_model->get($v['id']);
                        if ($get_product==FALSE) {

                            # Produk ID nya ternyata gak ada, harus gimana?
                            $data_transaksi_detail[] = NULL;

                        }else{

                            $data_transaksi_detail[] = array(
                                'no_transaksi'        => $id_transaction,
                                'id_produk'           => $v['id'],
                                'harga'               => $v['price'],
                                'jumlah'              => $v['qty'],
                                'service_time_produk' => $now,    
                                );

                            $data_product_update[]  = array(
                                'id_produk'     => $v['id'],
                                'qty'           => $get_product['qty']-$v['qty'],
                                'terjual'       => $get_product['terjual']+$v['qty'],
                                'service_time'  => date('Y-m-d H:i:s'),
                                'service_action'  => 'update',
                                'service_user'  => $id_user
                                );

                            $subtotal_harga_produk  = $get_product['price_n']*$v['qty'];
                            $total_harga_produk     = $total_harga_produk+$subtotal_harga_produk;

                            $subtotal_harga_produk_s  = $get_product['price_s']*$v['qty'];
                            $total_harga_produk_s     = $total_harga_produk_s+$subtotal_harga_produk_s;
                        }
                        
                    }


                    $data_transaksi = array(
                        'no_transaksi'      => $id_transaction,
                        'id_user'           => $id_user,
                        'tanggal_transaksi' => $now,
                        'total_harga'       => $total_harga_produk,
                        'tanggal'   => date('d'),
                        'bulan'     => date('m'),
                        'tahun'     => date('Y'),
                        'keterangan'        => 'Total Price_N = '.$total_harga_produk.', Total Price_S = '.$total_harga_produk_s,
                        'service_time'      => $now,
                        'service_action'    => $service_action,
                        'service_user'      => $id_user,
                        );



                    // INTEGRASI CORE BANKING
                    $this->load->library('core_banking_api');
                    $id_user            = $this->session->userdata('id_user');
                    $total_debit        = $total_harga_produk;
                    $kode_transaksi     = 'COMMERCE';
                    $jenis_transaksi    = 'COMMERCE TRANSAKSI ID : '.$id_transaction;
                    $debet_virtual_account = $this->core_banking_api->debit_virtual_account($id_user,$total_debit,$kode_transaksi,$jenis_transaksi,$id_transaction);


                    // DEBET VIRTUAL ACCOUNT
                    if ($debet_virtual_account['status']!=FALSE) {
                        $total_point        = $total_harga_produk-$total_harga_produk_s;
                        $sumber_dana        = 'COMMERCE';
                        
                        // DEBET VIRTUAL ACCOUNT BERHASIL. DEPOSIT POINT LOYALTI
                        $share_profit = $this->core_banking_api->share_profit($id_user,$total_point,$sumber_dana,$jenis_transaksi,$id_transaction);

                        if ($share_profit['status']!=FALSE) {

                            $insert_transaksi = $this->transaction_model->insert($data_transaksi);
                            if ($insert_transaksi==FALSE) {
                                # Transaksi Gagal harus gimana kak?
                                $data_report['flash_msg']        = TRUE;
                                $data_report['flash_msg_type']   = "danger";
                                $data_report['flash_msg_status'] = FALSE;
                                $data_report['flash_msg_text']   = "Transaksi Gagal. Server Error : Insert Transaction.";
                                $this->session->set_flashdata($data_report);
                                redirect('store/cart');
                            }else{

                                $insert_detail_transaksi = $this->transaction_model->insert_detail_batch($data_transaksi_detail);
                                if ($insert_detail_transaksi==FALSE) {
                                    # Pasti ada yang salah, insert transaksi detail nya gagal!
                                    $data_report['flash_msg']        = TRUE;
                                    $data_report['flash_msg_type']   = "danger";
                                    $data_report['flash_msg_status'] = FALSE;
                                    $data_report['flash_msg_text']   = "Transaksi Gagal. Server Error : Insert Detail Transaction.";
                                    $this->session->set_flashdata($data_report);
                                    redirect('store/cart');
                                }else{
                                    
                                    # Berhasil hore..
                                    // JUST CHECK UNIDENTIFIED FIELD
                                    if (!isset($get_post['pengirim_kelurahan'])||empty($get_post['pengirim_kelurahan'])) {
                                        $get_post['pengirim_kelurahan'] = NULL;
                                    }
                                    if (!isset($get_post['pengirim_kecamatan'])||empty($get_post['pengirim_kecamatan'])) {
                                        $get_post['pengirim_kecamatan'] = NULL;
                                    }
                                    if (!isset($get_post['penerima_kelurahan'])||empty($get_post['penerima_kelurahan'])) {
                                        $get_post['penerima_kelurahan'] = NULL;
                                    }
                                    if (!isset($get_post['penerima_kecamatan'])||empty($get_post['penerima_kecamatan'])) {
                                        $get_post['penerima_kecamatan'] = NULL;
                                    }

                                    $data_pengiriman = array(
                                        'no_transaksi'       => $id_transaction,
                                        'pengirim_nama'      => $get_post['pengirim_nama'],
                                        'pengirim_alamat'    => $get_post['pengirim_alamat'],
                                        'pengirim_kelurahan' => $get_post['pengirim_kelurahan'],
                                        'pengirim_kecamatan' => $get_post['pengirim_kecamatan'],
                                        'pengirim_kabupaten' => $get_post['pengirim_kabupaten'],
                                        'pengirim_provinsi'  => $get_post['pengirim_provinsi'],
                                        'pengirim_kode_pos'  => $get_post['pengirim_kode_pos'],
                                        'pengirim_no_tlp'    => $get_post['pengirim_no_tlp'],

                                        'penerima_nama'      => $get_post['penerima_nama'],
                                        'penerima_alamat'    => $get_post['penerima_alamat'],
                                        'penerima_kelurahan' => $get_post['penerima_kelurahan'],
                                        'penerima_kecamatan' => $get_post['penerima_kecamatan'],
                                        'penerima_kabupaten' => $get_post['penerima_kabupaten'],
                                        'penerima_provinsi'  => $get_post['penerima_provinsi'],
                                        'penerima_kode_pos'  => $get_post['penerima_kode_pos'],
                                        'penerima_no_tlp'    => $get_post['penerima_no_tlp'],
                                        );

                                    $insert_pengiriman = $this->transaction_model->insert_pengiriman($data_pengiriman);
                                    if ($insert_pengiriman==FALSE) {
                                        # Pasti ada yang salah, insert transaksi pengiriman nya gagal!
                                        $data_report['flash_msg']        = TRUE;
                                        $data_report['flash_msg_type']   = "danger";
                                        $data_report['flash_msg_status'] = FALSE;
                                        $data_report['flash_msg_text']   = "Transaksi Gagal. Server Error : Insert Data Pengiriman.";
                                        $this->session->set_flashdata($data_report);
                                        redirect('store/cart');
                                    }else{
                                        # Berhasil hore 2..
                                        $update_product = $this->product_model->update_batch($data_product_update);

                                        $data_report['flash_msg']           = TRUE;
                                        $data_report['flash_msg_type']      = "success";
                                        $data_report['flash_msg_status']    = TRUE;
                                        $data_report['flash_msg_text']      = "Transaksi Berhasil.".$debet_virtual_account['message'];
                                        $this->session->set_flashdata($data_report);
                                        $this->cart->destroy();
                                        redirect('store/transaction');
                                    }

                                }

                            }

                        }else{
                            // DEPOSIN LOYALTI GAGAL
                            $data_report['flash_msg']        = TRUE;
                            $data_report['flash_msg_type']   = "danger";
                            $data_report['flash_msg_status'] = FALSE;
                            $data_report['flash_msg_text']   = "Transaksi Gagal.".$deposit_loyalty['message'];
                            $this->session->set_flashdata($data_report);
                            redirect('store/cart');
                        }

                    }else{
                        // DEBIT REKENING VIRTUAL GAGAL
                        $data_report['flash_msg']        = TRUE;
                        $data_report['flash_msg_type']   = "danger";
                        $data_report['flash_msg_status'] = FALSE;
                        $data_report['flash_msg_text']   = "Transaksi Gagal.".$debet_virtual_account['message'];
                        $this->session->set_flashdata($data_report);
                        redirect('store/cart');

                    }



                }
                // END IF LOGIN


            }
            // END IF CART

        }

    }



    function transaction(){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $data = $this->get_category();
        $data['page_name']         = 'Cart';
        $data['page_sub_name']     = '';
        $data['page']              = 'store/store_transaction_view';

        $this->load->view('main_view',$data);
    }


















    private function get_category(){

        $get_product_category = $this->product_category_model->get_all(NULL,NULL,NULL,NULL);
        $data['product_category'] = $get_product_category['data'];

        $filter_product_category = array(
            array(
                'alias'     =>'SEMUA KATEGORI',
                'parameter' =>NULL,
            )
        );


        foreach ($get_product_category['data'] as $k => $v) {
            array_push($filter_product_category, array(
                'alias'     => strtoupper($v['nama']),
                'parameter' => strtolower($v['id_kategori']),
            ));
        }

        $data['filter_product_category'] = $filter_product_category;

        $def_param_filter_product_category = $filter_product_category;
        $get_filter_product_category = $this->input->get('filter_product_category');
        $param_filter_product_category   = strtoupper($get_filter_product_category);
        $data['param_filter_product_category'] = $filter_product_category;
        if (isset($param_filter_product_category)) {
            $data['param_filter_product_category'] = $param_filter_product_category;
            $key = array_search($param_filter_product_category,array_column($filter_product_category,'alias'));
            if ($key) {
                $param_filter_product_category = $filter_product_category[$key]['parameter'];
                $data['param_filter_product_category'] = $filter_product_category[$key]['alias'];
            } else{
                $param_filter_product_category = $def_param_filter_product_category;
            }
        }else{
            $param_filter_product_category = $def_param_filter_product_category;
        }

        return $data;
    }













    function search_kecamatan(){
        $q = $this->input->post('q');
        $this->load->model('ref_alamat_model');
        $kecamatan = $this->ref_alamat_model->search_kecamatan($q);


        $json = array(
            array(
                'id'    => NULL,
                'text'  => 'Ketik nama kecamatan..',
                )
            );
        $return_arr = array();
        if (empty($q)) {
            $return_arr = $json;
        }else{
            if ($kecamatan==FALSE) {
            $return_arr = $json;    
            }else{
                foreach ($kecamatan as $k => $v) {
                    $row_array['id'] = $v['id_kecamatan'];
                    $row_array['text'] = utf8_encode($v['nama']);
                    array_push($return_arr,$row_array);
                }
            }   
        }
        

        $ret = $return_arr;
        echo json_encode($ret);
    }


    function search_kelurahan(){
        $q = $this->input->post('q');
        $this->load->model('ref_alamat_model');
        $kelurahan = $this->ref_alamat_model->search_kelurahan($q);


        $json = array(
            array(
                'id'    => NULL,
                'text'  => 'Ketik nama kelurahan..',
                )
            );
        $return_arr = array();
        if (empty($q)) {
            $return_arr = $json;
        }else{
            if ($kelurahan==FALSE) {
            $return_arr = $json;    
            }else{
                foreach ($kelurahan as $k => $v) {
                    $row_array['id'] = $v['id_kelurahan'];
                    $row_array['text'] = utf8_encode($v['nama']);
                    array_push($return_arr,$row_array);
                }
            }   
        }
        

        $ret = $return_arr;
        echo json_encode($ret);
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
                    $row_array['text'] = utf8_encode($v['nama']);
                    array_push($return_arr,$row_array);
                }
            }   
        }
        

        $ret = $return_arr;
        echo json_encode($ret);
    }



    function search_provinsi(){
        $q = $this->input->post('q');
        $this->load->model('ref_alamat_model');
        $provinsi = $this->ref_alamat_model->search_provinsi($q);


        $json = array(
            array(
                'id'    => NULL,
                'text'  => 'Ketik nama provinsi..',
                )
            );
        $return_arr = array();
        if (empty($q)) {
            $return_arr = $json;
        }else{
            if ($provinsi==FALSE) {
            $return_arr = $json;    
            }else{
                foreach ($provinsi as $k => $v) {
                    $row_array['id'] = $v['id_provinsi'];
                    $row_array['text'] = utf8_encode($v['nama']);
                    array_push($return_arr,$row_array);
                }
            }   
        }
        

        $ret = $return_arr;
        echo json_encode($ret);
    }


   

}