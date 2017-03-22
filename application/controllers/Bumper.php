<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bumper extends CI_Controller {
    public function __construct(){
        parent::__construct(); //inherit dari parent
        $this->session->set_userdata('referred_from', current_url_full());
                    $this->load->model('auth_model');
                            $this->load->model('product_model');
        $this->load->model('product_category_model');
            $this->load->model('alamat_model');
    }
    
    function index(){
        // var_dump($this->session->all_userdata());
        //             die();
        
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/bumper_view';

        $cover = array('foto' => "smi-logo.png" );

        $data['logo_cover'] = $cover;
        $data['produk'] = $cover;
        $data['source_logo'] = base_url()."assets/compro/";
        $this->load->view('main_view',$data);
    }

  
}