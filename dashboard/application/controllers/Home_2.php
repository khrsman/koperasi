<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct(); //inherit dari parent

    }
    
    function index(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_view';
        $this->load->view('compro/main_view',$data);
    }

    function feature(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_feature_view';
        $this->load->view('compro/main_view',$data);
    }

    function aboutus(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_aboutus_view';
        $this->load->view('compro/main_view',$data);
    }

    function contact(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_contact_view';
        $this->load->view('compro/main_view',$data);
    }

}