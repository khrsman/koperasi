<?php

class Trading extends CI_Controller {


	public function __construct()

	{
        parent::__construct();
        $this->load->model('datacell_model');
        $this->load->model('datacell_transaction_model');
        $this->session->set_userdata('referred_from', current_url());
	}



	function index(){
        $data['page'] = 'trading/trading_list_view';
        $this->load->view('main_view',$data);
	}

	

}