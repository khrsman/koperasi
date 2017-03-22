<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct(){

        parent::__construct(); //inherit dari parent

        $this->load->model('auth_model');
        $this->load->model('store_koperasi_model');
        $this->load->model('store_product_model');
        $this->load->model('store_product_category_model');
        $this->load->model('store_transaction_model');
        $this->load->model('ref_alamat_model');

        $this->load->helper('core_banking_helper');
        
        $this->load->library('core_banking_api');
        // $this->session->set_userdata('referred_from', current_url_full());
    }


    function index(){
        $this->cart();
    }


    function cart(){

        $data = $this->get_category();

        if (!has_koperasi()) {
            $data['page']   = "auth/404_koperasi_view";
        }else{
            $data['page']   = "store/store_cart_view";
        }


        $group_cart = $this->get_group_cart();
        // print_r($group_cart);

        $data['cart']              = $this->cart->contents();
        $data['group_cart']        = $group_cart;
        $data['page_name']         = 'Cart';
        $data['page_sub_name']     = '';

        $this->load->view('main_view',$data);
    }





    function add(){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $get_post   = $this->input->post();
        $product_id = $get_post['produk'];
        $qty_item   = $get_post['qty_item'];

        $get_product = $this->store_product_model->get($product_id);
        if ($get_product==FALSE) {
            redirect('404');
        }

        if ($get_product['owner']==1) {
            $product_admin = $this->store_product_model->get_product_admin($get_product['id_produk']);
            $get_product['koperasi'] = $product_admin['user_target'];
        }

        $data_cart = array(
            'id'        => $get_product['id_produk'],
            'qty'       => $qty_item,
            'price_s'   => $get_product['price_s'],
            'price'     => $get_product['price_n'],
            'savings'   => $get_product['price_n']-$get_product['price_s'],
            'name'      => $get_product['nama_produk'],
            'foto_path' => $get_product['foto_path'], 
            'berat'     => $get_product['berat'],
            'owner'     => $get_product['owner'],
            'id_user'   => $get_product['id_user'],
            'koperasi'  => $get_product['koperasi'],
            'options'   => array()
        );

        $this->cart->insert($data_cart);
        redirect(site_url('store/product/item').'/'.$product_id,'REFRESH');
    }



    function update(){

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



    function remove($rowid){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $this->cart->remove($rowid);
        redirect(site_url('store/cart'));
    }



    function is_pin_valid(){
        $id_user = $this->session->userdata('id_user');
        $pin     = $this->input->post('pin');

        $permission = $this->core_banking_api->check_pin($id_user,$pin);
        
        if ($permission['status']==TRUE) {
            return TRUE;
        }else{
            $this->form_validation->set_message('is_pin_valid', $permission['message']);
            return FALSE;
        }
    }


    function check_out(){

        if (!has_koperasi()) {
            redirect('store/cart');
        }

        $cart  = $this->cart->contents();
        if (!isset($cart) || empty($cart)) {
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

            $group_cart = $this->get_group_cart();
            $data['group_cart']        = $group_cart;
            
            $data['form_action']       = site_url('store/cart/check_out');
            $data['page_name']         = 'Check Out';
            $data['page_sub_name']     = '';

            $this->load->view('main_view',$data);

        }else{
            
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
                    $group_cart     = $this->get_group_cart();
                    $id_user        = $session['id_user'];


                    // DEBIT PERMISSION KESELURUHAN TRANSAKSI : START //
                    $grand_total_price = $group_cart['summary']['grand_total_price'];
                    $debit_permission = $this->core_banking_api->debit_virtual_account_permission($id_user,$grand_total_price);
                    if ($debit_permission['status']==FALSE) {
                        $data_report['flash_msg']           = TRUE;
                        $data_report['flash_msg_type']      = "danger";
                        $data_report['flash_msg_status']    = FALSE;
                        $data_report['flash_msg_text']      = "Transaksi Gagal. ".$debit_permission['message'];
                        $this->session->set_flashdata($data_report);
                        redirect('store/cart/transaction');
                    }
                    // DEBIT PERMISSION KESELURUHAN TRANSAKSI : END //




                    foreach ($group_cart['detail'] as $k => $v) {
                        $get_post       = $this->input->post();
                        $now            = date('Y-m-d H:i:s');
                        $service_action = 'insert';
                        $id_transaction = rand(10,99).time();
                        
                        $total_harga_produk     = $group_cart['detail'][$k]['total_price'];
                        $total_harga_produk_s   = $group_cart['detail'][$k]['total_price_s'];

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


                        $data_transaksi_detail      = array();
                        $data_product_update        = array();
                        $data_product_update_cart   = array();

                        foreach ($group_cart['detail'][$k]['product'] as $m => $n) {
                            $get_product = $this->store_product_model->get($n['id']);
                            if ($get_product==FALSE) {
                                # Produk ID nya ternyata gak ada, harus gimana?
                                $data_transaksi_detail[] = NULL;
                            }else{

                                $data_transaksi_detail[] = array(
                                    'no_transaksi'        => $id_transaction,
                                    'id_produk'           => $n['id'],
                                    'harga'               => $n['price'],
                                    'jumlah'              => $n['qty'],
                                    'service_time_produk' => $now,    
                                );

                                $data_product_update[]  = array(
                                    'id_produk'     => $n['id'],
                                    'qty'           => $get_product['qty']-$n['qty'],
                                    'terjual'       => $get_product['terjual']+$n['qty'],
                                    'service_time'  => date('Y-m-d H:i:s'),
                                    'service_action' => 'update',
                                    'service_user'  => $id_user
                                );

                                $data_product_update_cart[]  = array(
                                    'rowid'         => $n['rowid'],
                                    'qty'           => $n['qty'],
                                );

                            }
                        }



                        $total_debit            = $total_harga_produk;
                        $kode_transaksi         = 'COMMERCE';
                        $jenis_transaksi        = 'COMMERCE TRANSAKSI ID : '.$id_transaction;
                        $debet_virtual_account  = $this->core_banking_api->debit_virtual_account($id_user,$total_debit,$kode_transaksi,$jenis_transaksi,$id_transaction);

                        

                        // DEBET VIRTUAL ACCOUNT
                        if ($debet_virtual_account['status']!=FALSE) {
                            
                            // FLAGING
                            $group_cart['detail'][$k]['payment_status']['debit']['status']     = $debet_virtual_account['status'];
                            $group_cart['detail'][$k]['payment_status']['debit']['message']    = $debet_virtual_account['message'];


                            // INSERT TRANSACTION : START //
                            $insert_transaksi = $this->store_transaction_model->insert($data_transaksi);
                            if ($insert_transaksi==FALSE) {
                                
                                // FLAGING
                                $group_cart['detail'][$k]['payment_status']['transaction']['status']     = FALSE;
                                $group_cart['detail'][$k]['payment_status']['transaction']['message']    = 'Gagal insert data transaksi';
                            
                            }else{

                                // FLAGING
                                $group_cart['detail'][$k]['payment_status']['transaction']['status']     = TRUE;
                                $group_cart['detail'][$k]['payment_status']['transaction']['message']    = 'Insert data transaksi berhasil';

                                $insert_detail_transaksi = $this->store_transaction_model->insert_detail_batch($data_transaksi_detail);
                                if ($insert_detail_transaksi==FALSE) {
                                
                                    // FLAGING
                                    $group_cart['detail'][$k]['payment_status']['transaction_detail']['status']     = FALSE;
                                    $group_cart['detail'][$k]['payment_status']['transaction_detail']['message']    = 'Gagal insert data transaksi detail';
                                
                                }else{
                                    
                                    // FLAGING
                                    $group_cart['detail'][$k]['payment_status']['transaction_detail']['status']     = TRUE;
                                    $group_cart['detail'][$k]['payment_status']['transaction_detail']['message']    = 'Insert data transaksi detail berhasil';

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

                                    $insert_pengiriman = $this->store_transaction_model->insert_pengiriman($data_pengiriman);
                                    if ($insert_pengiriman==FALSE) {
                                        # Pasti ada yang salah, insert transaksi pengiriman nya gagal!
                                        
                                        // FLAGING
                                        $group_cart['detail'][$k]['payment_status']['shipping']['status']     = FALSE;
                                        $group_cart['detail'][$k]['payment_status']['shipping']['message']    = 'Gagal insert data pengiriman';
                                    }else{
                                        # Berhasil hore 2..
                                        $update_product = $this->store_product_model->update_batch($data_product_update);

                                        // FLAGING
                                        $group_cart['detail'][$k]['payment_status']['shipping']['status']     = TRUE;
                                        $group_cart['detail'][$k]['payment_status']['shipping']['message']    = 'Insert data pengiriman berhasil';

                                        
                                        
                                        // SHARE PROFIT : START //
                                        $total_point        = $total_harga_produk-$total_harga_produk_s;
                                        $sumber_dana        = 'COMMERCE';
                                        
                                        $share_profit       = $this->core_banking_api->share_profit($id_user,$total_point,$sumber_dana,$jenis_transaksi,$id_transaction);

                                        // FLAGING
                                        $group_cart['detail'][$k]['payment_status']['share_profit']['status']     = $share_profit['status'];
                                        $group_cart['detail'][$k]['payment_status']['share_profit']['message']    = $share_profit['message'];
                                        // SHARE PROFIT : END //


                                        foreach ($data_product_update_cart as $i => $j) {
                                            $data_product_update_cart[$i]['qty'] = 0;
                                        }

                                        $this->cart->update($data_product_update_cart);


                                    }

                                }

                            }

                            // INSERT TRANSACTION : END // 




                        }else{
                            // DEBIT REKENING VIRTUAL GAGAL

                            // FLAGING
                            $group_cart['detail'][$k]['payment_status']['debit']['status']     = $debet_virtual_account['status'];
                            $group_cart['detail'][$k]['payment_status']['debit']['message']    = $debet_virtual_account['message'];
                        }


                    }


                    $data_report = $group_cart;
                    $data_report['flash_msg']           = TRUE;
                    $data_report['flash_msg_type']      = "success";
                    $data_report['flash_msg_status']    = TRUE;
                    $data_report['flash_msg_text']      = "Transaksi Telah Diproses.";
                    $this->session->set_flashdata($data_report);;
                    redirect('store/cart/transaction');


                    // TRANSACTION START //
/*
                    $get_post       = $this->input->post();
                    $id_user        = $session['id_user'];
                    $now            = date('Y-m-d H:i:s');
                    $service_action = 'insert';
                    $id_transaction = "76".time();

                    $total_harga_produk     = NULL;
                    $total_harga_produk_s   = NULL;
                    foreach ($cart as $k => $v) {
                        $get_product = $this->store_product_model->get($v['id']);
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

                            $insert_transaksi = $this->store_transaction_model->insert($data_transaksi);
                            if ($insert_transaksi==FALSE) {
                                # Transaksi Gagal harus gimana kak?
                                $data_report['flash_msg']        = TRUE;
                                $data_report['flash_msg_type']   = "danger";
                                $data_report['flash_msg_status'] = FALSE;
                                $data_report['flash_msg_text']   = "Transaksi Gagal. Server Error : Insert Transaction.";
                                $this->session->set_flashdata($data_report);
                                redirect('store/cart');
                            }else{

                                $insert_detail_transaksi = $this->store_transaction_model->insert_detail_batch($data_transaksi_detail);
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

                                    $insert_pengiriman = $this->store_transaction_model->insert_pengiriman($data_pengiriman);
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
                                        $update_product = $this->store_product_model->update_batch($data_product_update);

                                        $data_report['flash_msg']           = TRUE;
                                        $data_report['flash_msg_type']      = "success";
                                        $data_report['flash_msg_status']    = TRUE;
                                        $data_report['flash_msg_text']      = "Transaksi Berhasil. ".$debet_virtual_account['message'];
                                        $this->session->set_flashdata($data_report);
                                        $this->cart->destroy();
                                        redirect('store/cart/transaction');
                                    }

                                }

                            }

                        }else{
                            // DEPOSIN LOYALTI GAGAL
                            $data_report['flash_msg']        = TRUE;
                            $data_report['flash_msg_type']      = "success";
                            $data_report['flash_msg_status']    = TRUE;
                            $data_report['flash_msg_text']   = "Transaksi Berhasil (Not Sharing Profit Payment). ".$debet_virtual_account['message'];
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
                    */

                    // TRANSACTION END //



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

        $get_product_category = $this->store_product_category_model->get_all(NULL,NULL,NULL,NULL);
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






    private function get_group_cart(){
        $cart = $this->cart->contents();

        if (empty($cart) || !isset($cart)) {
            $group_cart = NULL;
            return $group_cart;
        }


        // Tambah data merchant di setiap item
        $merchant = array();
        $product  = array();
        foreach ($cart as $k => $v) {

            $get_product = $this->store_product_model->get($v['id']);
            $owner = $get_product['owner'];
            if ($owner==3) {
                $user_detail    = $this->auth_model->get_user_detail_by_id($v['id_user']);
                $user_info      = $this->auth_model->get_user_info_by_id($v['id_user']);
                $user_kopeasi   = $this->store_koperasi_model->get($user_info['koperasi']);
                $merchant_tmp['owner']           = 3;
                $merchant_tmp['id_user']         = $v['id_user'];
                $merchant_tmp['nama_user']       = $user_detail['nama_lengkap'];
                $kabupaten  = $this->ref_alamat_model->get_kabupaten_by_id($user_detail['kabupaten']);
                $provinsi   = $this->ref_alamat_model->get_provinsi_by_id($user_detail['provinsi']);
                $merchant_tmp['alamat_user']        = $user_detail['alamat'];
                $merchant_tmp['kabupaten_user']     = $kabupaten['nama'];
                $merchant_tmp['provinsi_user']      = $provinsi['nama'];
                $merchant_tmp['id_koperasi']     = $user_kopeasi['id_koperasi'];
                $merchant_tmp['nama_koperasi']   = $user_kopeasi['nama_koperasi'];
                $merchant_tmp['alamat_koperasi'] = $user_kopeasi['alamat'];
                $merchant_tmp['kabupaten_koperasi']       = $user_kopeasi['nama_kabupaten'];
                $merchant_tmp['provinsi_koperasi']        = $user_kopeasi['nama_provinsi'];
                $merchant_tmp['product']         = $v;

                array_push($merchant, $merchant_tmp);
                
            }

            if ($owner==2) {
                $user_detail    = $this->auth_model->get_user_detail_by_id($v['id_user']);
                $user_info      = $this->auth_model->get_user_info_by_id($v['id_user']);
                $user_kopeasi   = $this->store_koperasi_model->get($user_info['koperasi']);
                $merchant_tmp['owner']           = 2;
                $merchant_tmp['id_user']         = $v['id_user'];
                $merchant_tmp['nama_user']       = $user_detail['nama_lengkap'];
                $kabupaten  = $this->ref_alamat_model->get_kabupaten_by_id($user_detail['kabupaten']);
                $provinsi   = $this->ref_alamat_model->get_provinsi_by_id($user_detail['provinsi']);
                $merchant_tmp['alamat_user']        = $user_detail['alamat'];
                $merchant_tmp['kabupaten_user']     = $kabupaten['nama'];
                $merchant_tmp['provinsi_user']      = $provinsi['nama'];
                $merchant_tmp['id_koperasi']     = $user_kopeasi['id_koperasi'];
                $merchant_tmp['nama_koperasi']   = $user_kopeasi['nama_koperasi'];
                $merchant_tmp['alamat_koperasi'] = $user_kopeasi['alamat'];
                $merchant_tmp['kabupaten_koperasi']       = $user_kopeasi['nama_kabupaten'];
                $merchant_tmp['provinsi_koperasi']        = $user_kopeasi['nama_provinsi'];
                $merchant_tmp['product']         = $v;

                array_push($merchant, $merchant_tmp);

            }

            if ($owner==1) {
                $get_product_admin = $this->store_product_model->get_product_admin($v['id']);
                $user_detail       = $this->auth_model->get_user_detail_by_id($v['id_user']);
                $user_info         = $this->auth_model->get_user_info_by_id($v['id_user']);
                $user_kopeasi      = $this->store_koperasi_model->get($get_product_admin['user_target']);
                
                $merchant_tmp['owner']           = 2;
                $merchant_tmp['id_user']         = $v['id_user'];
                $merchant_tmp['nama_user']       = $user_detail['nama_lengkap'];
                $kabupaten  = $this->ref_alamat_model->get_kabupaten_by_id($user_detail['kabupaten']);
                $provinsi   = $this->ref_alamat_model->get_provinsi_by_id($user_detail['provinsi']);
                $merchant_tmp['alamat_user']        = $user_detail['alamat'];
                $merchant_tmp['kabupaten_user']     = $kabupaten['nama'];
                $merchant_tmp['provinsi_user']      = $provinsi['nama'];
                $merchant_tmp['id_koperasi']     = $user_kopeasi['id_koperasi'];
                $merchant_tmp['nama_koperasi']   = $user_kopeasi['nama_koperasi'];
                $merchant_tmp['alamat_koperasi'] = $user_kopeasi['alamat'];
                $merchant_tmp['kabupaten_koperasi']       = $user_kopeasi['nama_kabupaten'];
                $merchant_tmp['provinsi_koperasi']        = $user_kopeasi['nama_provinsi'];
                $merchant_tmp['product']         = $v;

                array_push($merchant, $merchant_tmp);
            }

        }



        // Grouping item produk berdasarkan merchant
        $group_cart = array();
        foreach ($merchant as $k => $v) {
            foreach ($merchant as $i => $j) {
                if ( ($v['owner']==2 || $v['owner']==1) && $v['id_koperasi']==$j['id_koperasi'] ) {
                    $data_merchant = $v;
                    $product       = $v['product'];
                    $group_cart_id = $v['id_koperasi'];

                    unset($data_merchant['product']);
                    $group_cart['detail'][$group_cart_id]['merchant']     = $data_merchant;
                    $group_cart['detail'][$group_cart_id]['product'][$k]  = $product;
                }

                if ( $v['owner']==3 && $v['id_user']==$j['id_user'] ) {
                    $data_merchant = $v;
                    $product       = $v['product'];
                    $group_cart_id = $v['id_user'];

                    unset($data_merchant['product']);
                    $group_cart['detail'][$group_cart_id]['merchant']     = $data_merchant;
                    $group_cart['detail'][$group_cart_id]['product'][$k]  = $product; 
                }
            }
        }


        // Membuat summary di setiap merchant
        $total_item = 0;
        $total_qty  = 0;
        foreach ($group_cart['detail'] as $k => $v) {
            foreach ($v['product'] as $i => $j) {
                $total[$k]['total_item'][]      = 1;
                $total[$k]['total_qty'][]       = $j['qty'];
                $total[$k]['total_price'][]     = $j['subtotal'];
                $total[$k]['total_price_s'][]   = $j['qty']*$j['price_s'];
                $total[$k]['total_savings'][]   = $j['qty']*$j['savings'];
            }
            $group_cart['detail'][$k]['total_item']       = array_sum($total[$k]['total_item']);
            $group_cart['detail'][$k]['total_qty']        = array_sum($total[$k]['total_qty']);
            $group_cart['detail'][$k]['total_price']      = array_sum($total[$k]['total_price']);
            $group_cart['detail'][$k]['total_price_s']    = array_sum($total[$k]['total_price_s']);
            $group_cart['detail'][$k]['total_savings']    = array_sum($total[$k]['total_savings']);
        }


        // Membuat summary keseluruhan
        $grand_total_item    = 0;
        $grand_total_qty     = 0;
        $grand_total_price   = 0;
        $grand_total_price_s = 0;
        $grand_total_savings = 0;
        if (isset($group_cart['detail'])) {
            foreach ($group_cart['detail'] as $k => $v) {
                $grand_total_item    = $grand_total_item+$v['total_item'];
                $grand_total_qty     = $grand_total_qty+$v['total_qty'];
                $grand_total_price   = $grand_total_price+$v['total_price'];
                $grand_total_price_s = $grand_total_price_s+$v['total_price_s'];
                $grand_total_savings = $grand_total_savings+$v['total_savings'];
            }
        }
        $group_cart['summary']['grand_total_item']      = $grand_total_item;
        $group_cart['summary']['grand_total_qty']       = $grand_total_qty;
        $group_cart['summary']['grand_total_price']     = $grand_total_price;
        $group_cart['summary']['grand_total_price_s']   = $grand_total_price_s;
        $group_cart['summary']['grand_total_savings']   = $grand_total_savings;


        if (!isset($group_cart)||empty($group_cart)) {
            $group_cart = NULL;
        }

        return $group_cart;
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



    function search_kabupaten($province_id){
        $q = $this->input->post('q');
        
        $this->load->model('ref_alamat_model');
        $kabupaten = $this->ref_alamat_model->search_kabupaten($q,$province_id);


        $json = array(
            array(
                'id'    => NULL,
                'text'  => 'Ketik nama kabupaten..'.$province_id,
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


    function select_kabupaten($province_id){
        $q = '';
        
        $this->load->model('ref_alamat_model');
        $kabupaten = $this->ref_alamat_model->search_kabupaten($q,$province_id);


        if ($kabupaten==FALSE) {
            echo "";
        }else{
            echo "<option>--Pilih Kabupaten--</option>";
            foreach ($kabupaten as $k => $v) {
                echo "<option value='".$v['id_kabupaten']."'>".utf8_encode($v['nama'])."</option>";
            }
        } 
        
    }


    function select_kecamatan($kabupaten_id){
        $q = '';
        
        $this->load->model('ref_alamat_model');
        $kecamatan = $this->ref_alamat_model->search_kecamatan($q,$kabupaten_id);


        if ($kecamatan==FALSE) {
            echo "";
        }else{
            echo "<option>--Pilih kecamatan--</option>";
            foreach ($kecamatan as $k => $v) {
                echo "<option value='".$v['id_kecamatan']."'>".utf8_encode($v['nama'])."</option>";
            }
        } 
        
    }

    function select_kelurahan($kecamatan_id){
        $q = '';
        
        $this->load->model('ref_alamat_model');
        $kelurahan = $this->ref_alamat_model->search_kelurahan($q,$kecamatan_id);


        if ($kelurahan==FALSE) {
            echo "";
        }else{
            echo "<option>--Pilih kelurahan--</option>";
            foreach ($kelurahan as $k => $v) {
                echo "<option value='".$v['id_kelurahan']."'>".utf8_encode($v['nama'])."</option>";
            }
        } 
        
    }


   

}