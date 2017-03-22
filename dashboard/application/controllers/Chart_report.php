<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//Do your magic here

		$this->load->model('chart_mod');
        $this->load->model('alamat_mod');

	}

	function jumlah_transaksi(){
			$data['title'] = "Chart Pembelian";
			$this->load->view('chart/jumlah_pembelian', $data);
	}

	function total_transaksi(){

		$this->load->library('pagination');
		
		$config['base_url'] = site_url('chart/total_transaksi');
		$config['total_rows'] = $this->chart_mod->count_provinsi();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;

		$config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
		
		$this->pagination->initialize($config);
		
		$data['title'] = "Tabel Total Pembelian";
		$data['pagination']  = $this->pagination->create_links();

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


		$data['transaksi'] = $this->chart_mod->get_total_pembelian($config['per_page'], $page);
		$data['title'] = "Total Transaksi";
		$this->load->view('chart/total_transaksi', $data);
	}


	function product_table(){
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('report/product_sell');
		$config['total_rows'] = $this->chart_mod->count_product();
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;

		$config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
		
		$this->pagination->initialize($config);
		
		$data['title'] = "Tabel Produk";
		$data['pagination']  = $this->pagination->create_links();

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['produk'] = $this->chart_mod->produk_data($config['per_page'], $page);

		$this->load->view('chart/produk', $data);
	}




	function get_kabupaten(){
		$this->session->set_userdata('id_kabupaten', $this->uri->rsegment(3));
		redirect(base_url().'total_transaksi_kabupaten','refresh');
	}

	function get_anggota_kabupaten(){
		$this->session->set_userdata('id_kabupaten', $this->uri->rsegment(3));
		redirect(base_url().'anggota_kabupaten','refresh');
	}


	function total_transaksi_kabupaten(){
		$this->load->library('pagination');
		
		$config['base_url'] = site_url().'total_transaksi_kabupaten';
		$config['total_rows'] = $this->chart_mod->count_kabupaten($this->session->userdata('id_kabupaten'));
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;



		$config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
		
		$this->pagination->initialize($config);
		
		$data['title'] = "Tabel Total Transaksi";
		$data['pagination']  = $this->pagination->create_links();

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['transaksi'] = $this->chart_mod->get_total_pembelian_kabupaten($config['per_page'], $page, $this->session->userdata('id_kabupaten'));



		$this->load->view('chart/total_transaksi_kabupaten', $data);
	}



	function chart_anggota(){
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('chart/anggota');
		$config['total_rows'] = $this->chart_mod->count_provinsi();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;


		$config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
		
		$this->pagination->initialize($config);
		
		$data['title'] = "Tabel Total Transaksi";
		$data['pagination']  = $this->pagination->create_links();

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($this->session->userdata('level') == "1"){
			$data['koperasi'] = $this->chart_mod->get_anggota_provinsi($config['per_page'], $page); 
		}
		else if($this->session->userdata('level') == "2"){
			$data['koperasi'] = $this->chart_mod->get_anggota_provinsi_koperasi($config['per_page'], $page); 
		}

		$this->load->view('chart/anggota_koperasi', $data);
	}


	function anggota_kabupaten(){
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('anggota_kabupaten');
		$config['total_rows'] = $this->chart_mod->count_kabupaten($this->session->userdata('id_kabupaten'));
		$config['per_page'] = 10;
		$config['uri_segment'] = 2;
		$config['num_links'] = 3;


		$config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
		
		$this->pagination->initialize($config);
		
		$data['title'] = "Tabel Total Transaksi";
		$data['pagination']  = $this->pagination->create_links();

		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		if($this->session->userdata('level') == "1"){
			$data['koperasi'] = $this->chart_mod->get_anggota_kabupaten($config['per_page'], $page, $this->session->userdata('id_kabupaten')); 
		}
		else if($this->session->userdata('level') == "2"){
			$data['koperasi'] = $this->chart_mod->get_anggota_kabupaten_koperasi($config['per_page'], $page, $this->session->userdata('id_kabupaten')); 
		}

		$this->load->view('chart/anggota_koperasi_kabupaten', $data);
	}
}

/* End of file Chart_report.php */
/* Location: ./application/controllers/Chart_report.php */