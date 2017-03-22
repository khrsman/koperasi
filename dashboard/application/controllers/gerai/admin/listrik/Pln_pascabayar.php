<?php

class Pln_pascabayar extends CI_Controller {


	public function __construct()
	{
        parent::__construct();
        $this->load->model('gerai_transaksi_model');
        $this->load->model('gerai_vendor_produk_model');
        $this->load->helper('core_banking_helper');
        $this->load->library('core_banking_api');
	}



	function index(){
        $this->charge();
	}

	function charge(){

	}



	// PLN PASCABAYAR

	function confirm(){

	}

	function report(){
		
	}



}