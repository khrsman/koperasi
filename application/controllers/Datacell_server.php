<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Datacell_server extends CI_Controller {



    public function __construct(){

        parent::__construct(); //inherit dari parent



    }

    

    

    function send_response(){

        $get_xml = '<?xml version="1.0" ?>

                    <datacell>

                    <resultcode>999</resultcode>

                    <message>Gagal! IR.10. SN:146933008. No: 081397382353</message>

                    <trxid>146933008</trxid>

                    <ref_trxid>81459746476</ref_trxid>

                    </datacell>';



        echo trim($get_xml);

    }





    function send_report(){

        $get_xml = '<?xml version="1.0"?>

                    <datacell>

                    <perintah>REPORT</perintah>

                    <trxid>101626484</trxid>

                    <oprcode>TEL.10</oprcode>

                    <msisdn>081397382353</msisdn>

                    <msg>TEL.10 No: 081397382353 SUKSES SN Operator: 879746082. SN Kami : 101626484. (Pesan Tambahan</msg>

                    <ref_trxid>161459745652</ref_trxid>

                    </datacell>';



        $url = site_url('datacellcom/notif');

        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, $url );

        curl_setopt( $ch, CURLOPT_POST, true );

        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $ch, CURLOPT_POSTFIELDS, $get_xml );

        $result = curl_exec($ch);

        curl_close($ch);



        print_r($result);



    }



    function send_refund(){

        $url = site_url('datacellcom/refund');

        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, $url );

        curl_setopt( $ch, CURLOPT_POST, true );

        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/html'));

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $result = curl_exec($ch);

        curl_close($ch);



        print_r($result);

    }



}