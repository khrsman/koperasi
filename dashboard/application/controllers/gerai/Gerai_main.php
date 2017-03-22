<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Gerai_main extends CI_Controller {



    public function __construct(){

        parent::__construct(); //inherit dari parent

        $this->session->set_userdata('referred_from', current_url_full());



    }

    

    function index(){

        $data['page_name']         = 'Gerai';

        $data['page_sub_name']     = '';

        $data['page']              = 'compro/gerai_view';

        $this->load->view('main_view',$data);

    }

    





}