<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Vsi_api_test {

    protected $CI;


    var $endpoint_primary_1;
    var $endpoint_primary_2;
    var $endpoint_backup_1;
    var $endpoint_backup_2;
    var $userid;
    var $pin;

    public function __construct()

    {

        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->config();

        // $this->CI->load->model('datacell_model');
    }



    private function config()

    {   
         // API CONFIG 
        $this->endpoint_primary_1 = 'http://103.23.20.158:1025/trx.xml';
        // $this->endpoint_primary_1 = 'http://103.28.15.3/~admin/dashboard/vsi_server/send_response';
        // $this->endpoint_primary_1 = 'http://www.google.com';
        $this->endpoint_primary_2 = 'http://103.43.45.110:1025/trx.xml';

        $this->endpoint_backup_1 = 'http://103.23.20.158:1026/trx.xml';
        $this->endpoint_backup_2 = 'http://103.43.45.110:1026/trx.xml';
        
        $this->userid   = 'P0288';
        $this->pin 		= '0288smi3';
    }




    // Main API Loader
    /*
		1. userid = kode / id reseller yang di dapatkan setelah terdaftar
		2. pwd = password / pin transaksi
		3. memberreff = kode transaksi / id referensi dari sisi mitra
		4. produk = kode produk yang ingin di transaksikan
		5. tujuan = nomor tujuan pengisian / pembelian
    */
    private function call($produk,$tujuan,$memberreff,$service_user,$enable_log=TRUE){

        
        if (empty($produk) || empty($tujuan) || empty($memberreff)  || empty($service_user) ) {
            return FALSE;
        }


        $userid     = $this->userid;
        $pin   		= $this->pin;

        // Array untuk dikirim ke DATACELL
        $vsi_array = array(
            'userid'  		=> $this->userid,
            'pwd'   		=> $this->pin,
            'memberreff'    => $memberreff,
            'produk'		=> $produk,
            'tujuan'    	=> $tujuan,
            );



        $vsi_query = http_build_query($vsi_array);
        $url = $this->endpoint_primary_1;

        $url_query = $url.'?'.$vsi_query;
        // $url_query = $url;
        print_r($url_query);
        $ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url_query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); 

		$result = curl_exec ($ch);
		print_r('<pre>');
        print_r(curl_getinfo($ch));
		print_r($result);
        print_r('</pre>');
		curl_close ($ch);

		// further processing ....
		if (empty($result)) {
            return FALSE;
        }


        $response = $this->xml_to_array($result);
        if ($response==FALSE) {
            return FALSE;
        }else{
            /*
                Struktur Response
                <respon>
					<tanggal>[TANGGAL TRANSAKSI]</tanggal>
					<idagen>[ID AGEN / ID MEMBER]</idagen>
					<refid>[KODE REFERENSI]</refid>
					<produk>[KODE PRODUK]</produk>
					<tujuan>[ID PELANGGAN / NO HP]</tujuan>
					<data>[DATA TRANSAKSI]</data>
					<trxid>[ID TRANSAKSI]</trxid>
					<rc>[KODE RESPON]</rc>
					<response_code>[KODE RESPON]</response_code>
					<response_message>[TEKS RESPON]</response_message>
					<token>[TOKEN PLN]<token/>
					<pesan>[PESAN / KETERANGAN]</pesan>
				</respon>
            */

            return $response;

        }





    }



    private function xml_to_array($xml){

        if (!isset($xml) || empty($xml)) {
            return FALSE;
        }

        $parser = xml_parser_create();
        if (!$parser) {
            return FALSE;
        }

        xml_parse_into_struct($parser, $xml, $vals, $index);
        xml_parser_free($parser);

        foreach ($vals as $k => $v) {

            if ($v['level'] == 2) {
                if (!isset($v['value'])) {
                    $response[strtolower($v['tag'])] = NULL;
                }else{
                    $response[strtolower($v['tag'])] = $v['value'];    
                }
                
            }

        }

        return $response;
    }



  

    function charge($data){

        if (!isset($data['produk']) || !isset($data['tujuan']) || !isset($data['memberreff'])  || !isset($data['service_user'])) {
            return FALSE;
        }else{
            $produk    		= $data['produk'];
            $tujuan     	= $data['tujuan'];
            $memberreff  	= $data['memberreff'];
            $service_user	= $data['service_user'];

            $call = $this->call($produk,$tujuan,$memberreff,$service_user);
            if ($call==FALSE) {
                return FALSE;
            }else{
                return $call;
            }    
        }
        

    }







}