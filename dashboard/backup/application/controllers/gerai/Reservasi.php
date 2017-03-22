<?php

class Reservasi extends CI_Controller {


	public function __construct()

	{
        parent::__construct();
        $this->load->model('datacell_model');
        $this->load->model('datacell_transaction_model');
        $this->session->set_userdata('referred_from', current_url());
	}



	function index(){
        $data['page'] = 'reservasi/reservasi_list_view';
        $this->load->view('main_view',$data);
	}

	

}