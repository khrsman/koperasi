<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Vsi_server extends CI_Controller {



    public function __construct(){

        parent::__construct(); //inherit dari parent

    }

    

    

    function send_response(){

        $get_xml = '<respon><tanggal>2015/12/03 04:20:11</tanggal><idagen>P0002</idagen><refid> ADA6677226C76A84CDEBC11BE2620756D2949D61B1A96C1A84C9D05D704BAC71</refid><produk>XR5</produk><tujuan>081788998899</tujuan><data/><trxid>32114</trxid><rc>0000</rc><response_code>0000</response_code><response_message>SUKSES</response_message><token/><pesan>#32114 XR5 ke:081788998899 SUKSES. Isi pulsa XR5 berhasil untuk nomor 6281788998899 sebesar 5.000, refnum 4F94B9D87B14D1AA44E0000000000000 pada tgl 03/12/15 16:09. Sisa saldo Rp. 59,011,350 - Rp. 6,300 = Rp. 59,005,050</pesan></respon>';


        echo trim($get_xml);

    }

    function test(){
    	$this->load->library('vsi_api_test');
    	$session = $this->session->userdata();

    	$produk 	= 'SAL';
    	$tujuan 	= '085624137383';
    	$id_user 	= $session['id_user'];
    	$memberreff = time();

    	if (!isset($id_user)) {
    		redirect('404');
    	}

    	$data_vsi = array(
    		'produk' 		=> $produk,
    		'tujuan' 		=> $tujuan,
    		'memberreff' 	=> $memberreff,
    		'service_user' 	=> $id_user,
    		);
    	$charge = $this->vsi_api_test->charge($data_vsi);
    	
    	print_r('<pre>');
    	print_r($charge);
    	print_r('</pre>');

    	$session = $this->session->userdata();
    	if (isset($session['vsi'])) {
    		$data_charge 	= $session['vsi'];
    		$data_charge[] 	= $charge; 
    	}else{
    		$data_charge[] 	= $charge;
    	}


    	$data_session = array(
    		'vsi'	=> $data_charge
    		);
    	$this->session->set_userdata($data_session);
    	
    }


    function result(){
    	$session = $this->session->userdata();
    	

    	if (isset($session['vsi'])) {
    		$data = $session['vsi'];
    		print_r('<pre>');
	    	print_r($data);
	    	print_r('</pre>');
    	}
    	
    }




}