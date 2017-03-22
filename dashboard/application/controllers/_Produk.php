<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  if (empty($this->session->userdata('id_user'))) {
            redirect(SMIDUMAY, 'refresh');
        }
		$this->load->model('produk_mod');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}


	function index(){
		echo "<pre>";
		var_dump($this->session->all_userdata());
		echo "</pre>";

	}



	function produk_corridor(){
		if($this->session->userdata('level') == 1){
			$owner_segment =$this->session->userdata('owner');
			switch ($owner_segment) {
				case '1':
					$this->session->set_userdata('owner','1');
					redirect('produk_owner');
					break;
				case '2':
					$this->session->set_userdata('owner','2');
					redirect('produk_koperasi');
					break;
				case '3':
					$this->session->set_userdata('owner','3');
					redirect('produk_anggota');
					break;
				default:
					$this->session->set_userdata('owner','');
					break;
			}
		}
		else if($this->session->userdata('level') == 2){
			redirect('mykopproduk');
		}
		else{
			redirect('not_found');
		}



	}


	function produk_data(){

		if($this->session->userdata('level') == '1'){
			$owner_segment = $this->uri->segment(1);
			switch ($owner_segment) {
				case 'produk_owner':
					$this->session->set_userdata('owner','1');
					$title = "Data Produk Admin";
					break;
				case 'produk_koperasi':
					$this->session->set_userdata('owner','2');
					$title = "Data Produk Koperasi";
					break;
				case 'produk_anggota':
					$this->session->set_userdata('owner','3');
					$title = "Data Produk Anggota Koperasi";
					break;
				default:
					$this->session->set_userdata('owner','');
					break;
			}
			
		}

		$data['produk'] = $this->produk_mod->get_all_produk()->result();
		$data['no'] = "1";
		$data['title'] = $title;
		$this->load->view('produk/produk_data', $data);
	}

	function produk_data_kop(){
		$title = "Data Produk Commerce";
		$this->session->set_userdata('owner','2');
		$data['produk'] = $this->produk_mod->get_all_produk_milik_kop()->result();

		$data['no'] = "1";
		$data['title'] = $title;
		$this->load->view('produk/produk_data', $data);
	}


	function produk_data_mem(){
		$title = "Data Produk Commerce";
		$this->session->set_userdata('owner','3');
		$data['produk'] = $this->produk_mod->get_all_produk_milik_mem()->result();


		$data['no'] = "1";
		$data['title'] = $title;
		$this->load->view('produk/produk_data', $data);
	}


	function add_produk(){

		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|xss_clean');
		// $this->form_validation->set_rules('warna', 'Warna', 'required|xss_clean');
		// $this->form_validation->set_rules('tipe', 'Tipe', 'required|xss_clean');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|xss_clean');
		$this->form_validation->set_rules('berat', 'Berat', 'required|xss_clean');
		$this->form_validation->set_rules('price_n', 'Harga Normal', 'required|xss_clean');
		$this->form_validation->set_rules('price_n', 'Harga Normal', 'required|xss_clean');
		$this->form_validation->set_rules('qty', 'Jumlah Stok', 'required|xss_clean');
		// $this->form_validation->set_rules('terjual', 'Terjual', 'required|xss_clean');


		if ($this->form_validation->run() == FALSE) {
			$data['kategori'] = $this->produk_mod->get_all_produk_kategori()->result();
			$data['title'] = "Tambah Data Produk";
			$this->load->view('produk/add_produk', $data);
		} 
		else {
				$this->produk_mod->add_produk();
				$this->session->set_flashdata('msg','Data Produk berhasil ditambahkan');
				if($this->session->userdata('level') == "2"){
					redirect(base_url().'mykopproduk','refresh');
				}
				else if($this->session->userdata('level') == "3"){
					redirect(base_url().'mymemproduk','refresh');
				}
				else{
					redirect(base_url().'produk_owner','refresh');
				}
				
		}
	}


	function tambah_peruntukan(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'peruntukan','refresh');
	}

	function detail_produk(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'produk_detail','refresh');
	}

	function delete_produk(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'produk_delete','refresh');
	}


	function peruntukan(){
		$data_produk = $this->produk_mod->get_produk_by_id();

		if($data_produk->num_rows() > 0){

			$max = $this->produk_mod->get_stock()['qty'];

			$this->form_validation->set_rules('koperasi', 'Koperasi', 'required|xss_clean');
			$this->form_validation->set_rules('price_n', 'Harga Normal', 'numeric|xss_clean');
			$this->form_validation->set_rules('price_s', 'Harga Diskon', 'numeric|xss_clean');
			$this->form_validation->set_rules('qty', 'Stock', 'numeric|xss_clean|less_than_equal_to['.$max.']');

			if ($this->form_validation->run() == FALSE) {
				$data['produk'] = $this->produk_mod->get_produk_by_id()->row_array();
				$data['peruntukan'] = $this->produk_mod->get_peruntukan_produk($this->session->userdata('id'));				
				$data['no'] = "1";
				$data['title'] = "Tambah Peruntukan Produk";
				$this->load->view('produk/peruntukan', $data);
			} 
			else {
				$this->produk_mod->add_peruntukan();
				$this->session->set_flashdata('msg', 'Peruntukan Berhasil Ditambahkan');
				redirect(base_url().'peruntukan','refresh');
			}	
		}
		else{
			redirect(base_url().'not_found','refresh');
		} 
	}


	function edit_peruntukan(){


		$this->form_validation->set_rules('price_n', 'Harga Normal', 'numeric|xss_clean');
		$this->form_validation->set_rules('price_s', 'Harga Diskon', 'numeric|xss_clean');
		$this->form_validation->set_rules('qty', 'Stock', 'numeric|xss_clean|callback_cek_quantity');
		$this->form_validation->set_rules('qty_hidden', 'Stock', 'numeric|xss_clean');



		if ($this->form_validation->run() == FALSE) {
			$data['produk_peruntukan'] = $this->produk_mod->get_peruntukan_produk_by_id($this->session->userdata('id'), $this->uri->rsegment(3))->row_array();
			$this->load->view('produk/update_peruntukan', $data);

		} else {
			$this->produk_mod->update_produk_peruntukan($this->session->userdata('id'), $this->uri->rsegment(3));
			$this->session->set_flashdata('msg', 'Data Berhasil Diubah');
			redirect(base_url().'peruntukan','refresh');
		}
	}


	function cek_quantity(){
		$stok_admin = $this->produk_mod->get_stock()['qty']; // =0

		$input_baru = $this->input->post('qty');
		$stok_koperasi = $this->input->post('qty_hidden');

		$selisih = $input_baru - $stok_koperasi;

		if($selisih > $stok_admin){
			$this->form_validation->set_message('cek_quantity', 'Data tidak boleh melebihi stok admin '.$stok_admin);
			return FALSE;
		}
		else{
			return TRUE;
		}
	}



	function update_produk(){
	
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|xss_clean');
		// $this->form_validation->set_rules('warna', 'Warna', 'required|xss_clean');
		// $this->form_validation->set_rules('tipe', 'Tipe', 'required|xss_clean');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|xss_clean');
		$this->form_validation->set_rules('berat', 'Berat', 'required|xss_clean');
		$this->form_validation->set_rules('price_n', 'Harga Normal', 'required|xss_clean');
		$this->form_validation->set_rules('price_n', 'Harga Normal', 'required|xss_clean');
		$this->form_validation->set_rules('qty', 'Jumlah Stok', 'required|xss_clean');
		// $this->form_validation->set_rules('terjual', 'Terjual', 'required|xss_clean');


		if ($this->form_validation->run() == FALSE) {
			$data['produk'] = $this->produk_mod->get_produk_by_id()->row_array();		
			$data['photo'] = $this->produk_mod->get_produk_foto()->result();
			$data['no'] = "1";
			$data['title'] = "Edit Data Produk";
			$data['kategori'] = $this->produk_mod->get_produk_kategori()->result();
			$this->load->view('produk/detail_produk', $data);
		} 
		else {
				$this->produk_mod->update_produk();
				$this->session->set_flashdata('msg','Data Produk '.$this->input->post('nama').' berhasil diperbaharui');
				redirect(base_url().'produk_owner','refresh');
		}
	}

	function produk_detail(){
		$owner_segment =$this->session->userdata('owner');

		if($owner_segment == '2'){
			// echo "koperasi";

			$data['produk'] = $this->produk_mod->get_produk_by_id_kop();
		}
		else{
			// echo "bukan koperasi";
			$data['produk'] = $this->produk_mod->get_produk_by_id();	
		}

		



		if($data['produk']->num_rows() > 0){
			$data['photo'] = $this->produk_mod->get_produk_foto()->result();
			$data['produk'] = $data['produk']->row_array();
			$data['kategori'] = $this->produk_mod->get_all_produk_kategori()->result();
			$data['no'] = "1";
			$data['title'] = "Edit Data Produk";
			$this->load->view('produk/detail_produk', $data);
		}
		else{
			redirect('not_found');
		}

		

	}


	function upload_produk_foto(){
		$config['upload_path'] = 'assets/images/produk';
		$config['allowed_types'] = 'jpg|png';
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config);
		
		if ( !$this->upload->do_upload('photo')){
			$this->session->set_userdata('error', $this->upload->display_errors());
			redirect(base_url().'detail_produk/'.$this->session->userdata('id'),'refresh');
		}
		else{
			$this->session->set_userdata('error', "");
			$this->produk_mod->add_produk_foto($this->upload->data('file_name'));
			redirect(base_url().'detail_produk/'.$this->session->userdata('id'),'refresh');
		}
	}





	function produk_delete(){
		$this->produk_mod->delete_produk();
		redirect(base_url().'produk','refresh');

	}

	function delete_produk_foto(){
		$this->session->set_userdata('id_foto', $this->uri->rsegment(3));
		redirect(base_url().'produk_foto_delete','refresh');
	}

	function produk_foto_delete(){
		$this->produk_mod->delete_produk_foto();
		redirect(base_url().'detail_produk/'.$this->session->userdata('id'),'refresh');
	}



	function produk_kategori_data(){
			$data['kategori'] = $this->produk_mod->get_all_produk_kategori()->result();
			$data['no'] = "1";
			$data['title'] = 'Data Kategori Produk';
			$this->load->view('produk/produk_kategori_data', $data);

	}


	function add_produk_kategori(){

		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');


		if ($this->form_validation->run() == False) {
			$data['title'] = "Tambah Data Kategori Produk";
			$this->load->view('produk/add_produk_kategori',$data);
		} else {
			$this->produk_mod->add_produk_kategori();
			$this->session->set_flashdata('msg','Data Kategori Produk berhasil ditambahkan');
			redirect(base_url().'produk_kategori','refresh');
		}
		
	}

	function update_produk_kategori(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'produk_kategori_update','refresh');
	}

	function produk_kategori_update(){
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');


		if ($this->form_validation->run() == False) {
			$data['kategori'] = $this->produk_mod->get_produk_kategori_by_id()->row_array();
			$this->load->view('produk/edit_produk_kategori', $data);
		} else {
			$this->produk_mod->update_produk_kategori();
			$nama_kategori = $this->produk_mod->get_produk_kategori_by_id()->row()->nama;
			$this->session->set_flashdata('msg','Data Kategori '.$nama_kategori.' Produk berhasil diperbaharui');
			redirect(base_url().'produk_kategori','refresh');
		}
	}

	function delete_produk_kategori(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));

		redirect(base_url().'produk_kategori_delete','refresh');
	}

	function produk_kategori_delete(){
		$nama_kategori = $this->produk_mod->get_produk_kategori_by_id();
		if($nama_kategori->num_rows() > 0){
			$nama_kategori = $nama_kategori->row()->nama;
			$this->produk_mod->delete_produk_kategori();
			$this->session->set_flashdata('msg','Data Kategori '.$nama_kategori.' Produk berhasil dihapus');
			redirect(base_url().'produk_kategori','refresh');
		}
		else{
			redirect('not_found');
		}


			
	}


	function history_produk(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'catatan_produk','refresh');

	}

	function catatan_produk(){
		$owner_segment =$this->session->userdata('owner');
		if($owner_segment == '2'){
			$data['produk'] = $this->produk_mod->get_produk_history_by_id_kop();
		}
		else{
			$data['produk'] = $this->produk_mod->get_produk_history_by_id();	
		}


		if($data['produk']->num_rows() > 0){
			$data['produk'] = $data['produk']->result();


			$data['no'] = "1";
			$data['title'] = "History Management Data Produk";
			$this->load->view('produk/catatan_produk', $data);
		}
		else{
			redirect('not_found');
		}

		
	}
}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */