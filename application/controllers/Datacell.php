<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



// RESTRICTED AREA

class Datacell extends CI_Controller {

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }

    
    function call(){
        $this->load->library('datacell_api');
        $data = array(
            'service_user'  => '4455332',
            'oprcode'       => 'testoprcode',
            'msisdn'        => '085624137383',
            'ref_trxid'     => '141234567',
            );
        $request_charge = $this->datacell_api->charge($data);

        if ($request_charge==FALSE) {

            echo "gagal kirim";

        }else{

            echo "berhasil kirim<br>";

            print_r($request_charge);

        }

    }


    function test_charge(){
        $this->load->library('datacell_api_test');
        $data = array(
            'oprcode'       => 'IR.10',
            'msisdn'        => '085624137383',
            'ref_trxid'     => '12345',
            'service_user'  => '54312',
            );
        $charge = $this->datacell_api_test->charge($data);
        print_r($charge);
    }

    function my_server(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://ipecho.net/plain' );
        $result = curl_exec($ch); 
    }


    function retrieve_refund(){

        // Ex : http://localhost/koperasi_compro/datacell/retrieve_refund?resultcode=1001&msisdn=62816888999&message=Refund&trxid=7552974&ref_trxid=54321

        $get_refund = $this->input->get();



        $this->load->library('datacell_api');

        $refund = $this->datacell_api->retrieve_refund($get_refund);

        

        print_r($refund);
        echo "URL Datacell Refund";


    }



    function retrieve_notif(){

        $get_xml = trim(file_get_contents('php://input'));



        $this->load->library('datacell_api');

        $report = $this->datacell_api->retrieve_report($get_xml);



        print_r($report);
        echo "URL Datacell Notif/SN";
    }





}