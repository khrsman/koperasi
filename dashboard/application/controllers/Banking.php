<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banking extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata('id_user'))) {
            redirect(SMIDUMAY , 'refresh');
        }
        if($this->session->userdata('level') != "3"){
            redirect(base_url().'home','refresh');
        }
        $this->load->model('rekening_virtual_mod');
        $this->load->model('rekening_tabungan_mod');
        $this->load->model('rekening_loyalty_mod');
                $this->load->model('produk_mod');
    }

    function index(){
    	$data['page_name']          = 'Mini Core Banking';
        $data['page_sub_name']      = '';
        //cek rekening virtual
            if ($this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota())
            {   
                if($this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array()['saldo'] != NULL AND $this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array()['saldo'] != "" AND !empty($this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array()['saldo'])){
                    $data['saldo_virtual'] = $this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array();
                }
                else {
                    $data['saldo_virtual']['saldo'] = "0";
                }
            }
            else
            {
                $data['saldo_virtual']['saldo'] = "0";
            }

            //cek rekening tabungan
            if ($this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota())
            {
                if($this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array()['saldo'] != NULL AND $this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array()['saldo'] != "" AND !empty($this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array()['saldo'])){
                    $data['saldo_tabungan'] = $this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array();
                }
                else {
                    $data['saldo_tabungan']['saldo'] = "0";
                }
            }
            else
            {
                $data['saldo_tabungan']['saldo'] = "0";
            }

            //cek rekening loyalty
            if ($this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota())
            {
                if($this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result() != NULL AND $this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result() != "" AND !empty($this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result())){
                    $data['saldo_loyalti'] = $this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result();
                }
                else{
                    $data['saldo_loyalti'] = array(
                                                  (object) array("jenis_rekening" => "CASH", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "INSURANCE", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "ROYALTY", "saldo"=> "0.00"),
                                              );
                }
            }
            else
            {
                $data['saldo_loyalti'] = array(
                                                  (object) array("jenis_rekening" => "CASH", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "INSURANCE", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "ROYALTY", "saldo"=> "0.00"),
                                              );
            }

            $data['produk'] = $this->produk_mod->get_all_produk_milik_mem()->num_rows();
        $data['page']               = 'new_banking_view';
        $this->load->view('main_view',$data);
    }

}