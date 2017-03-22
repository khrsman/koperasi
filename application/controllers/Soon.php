<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soon extends CI_Controller {

    public function __construct(){
        parent::__construct(); //inherit dari parent

    }
    
    function index(){
        $data['page_name']         = 'Coming Soon';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_soon_view';
        $this->load->view('main_view',$data);
    }


}