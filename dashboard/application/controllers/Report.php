<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('report_mod');
	}


	function data_produk(){
		$this->load->view('report/data_produk', NULL);
	}
	function data_produk_admin(){
		$this->load->view('report/data_produk_admin', NULL);
	}
	function data_produk_anggota(){
		$this->load->view('report/data_produk_anggota', NULL);
	}
	function data_transaksi_pln(){
		$this->load->view('report/data_transaksi_pln', NULL);
	}
	function data_transaksi_pulsa(){
		$this->load->view('report/data_transaksi_pulsa', NULL);
	}

	function data_penjualan_koperasi(){
		$this->load->view('report/data_penjualan_koperasi', NULL);
	}
	function data_penjualan_admin(){
		$this->load->view('report/data_penjualan_admin', NULL);
	}
	function data_penjualan_anggota(){
		$this->load->view('report/data_penjualan_anggota', NULL);
	}
	function data_pendapatan_gerai(){
		$this->load->view('report/data_pendapatan_gerai', NULL);
	}
	function data_pendapatan_dari_produk(){
		$this->load->view('report/data_pendapatan_produk', NULL);
	}
	function data_pengiriman_produk(){
		$this->load->view('report/data_pengiriman_produk', NULL);
	}
	function data_koperasi(){
		$this->load->view('report/data_koperasi', NULL);
	}
	function data_komunitas(){
		$this->load->view('report/data_komunitas', NULL);
	}


	function list_data_produk(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $_REQUEST['search']["value"];


		$total=$this->report_mod->data_produk()->num_rows();

		
		$output = array();


		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();


		$query=$this->report_mod->data_produk($length, $start, $search);

		if($search != ""){
			$jum=$this->report_mod->data_produk(NULL, NULL, $search);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama_kategori'],
									$r['nama_produk'],
									$r['nama_koperasi'],
									$r['nama_kabupaten'].", ".$r['nama_provinsi'],
									$r['harga_pasar'],
									$r['harga_member'],
									$r['stok'],
									$r['terjual']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	function list_data_produk_admin(){
		
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $_REQUEST['search']["value"];


		$total=$this->report_mod->data_produk_admin()->num_rows();

		
		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();


		$query = $this->report_mod->data_produk_admin($length, $start, $search);

		if($search != ""){
			$jum = $this->report_mod->data_produk_admin(NULL, NULL, $search);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama_kategori'],
									$r['nama_produk'],
									$r['nama_lengkap'],
									$r['nama_kabupaten'].", ".$r['nama_provinsi'],
									$r['harga_pasar'],
									$r['harga_member'],
									$r['stok'],
									$r['terjual']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	function list_data_produk_anggota(){

		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $_REQUEST['search']['value'];

		

		$total=$this->report_mod->data_produk_anggota()->num_rows();
		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;


		$output['data']=array();


		$query = $this->report_mod->data_produk_anggota($length, $start, $search);


		if($search != ""){
			$jum = $this->report_mod->data_produk_anggota(NULL, NULL, $search);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama_kategori'],
									$r['nama_produk'],
									$r['nama_lengkap'],
									$r['nama_kabupaten'].", ".$r['nama_provinsi'],
									$r['harga_pasar'],
									$r['harga_member'],
									$r['stok'],
									$r['terjual']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}
	

	function list_penjualan_pln(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');

		$total=$this->report_mod->penjualan_pln()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		
		$tanggal_transaksi = $this->input->post('tanggal');
		
		$query = $this->report_mod->penjualan_pln($length, $start, $search, $tanggal_transaksi);


		if($search != ""){
			$jum=$this->report_mod->penjualan_pln(NULL, NULL, $search, NULL);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if(!empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_pln(NULL, NULL, NULL, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if($search != "" AND !empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_pln(NULL, NULL, $search, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['kode_kategori_produk'],
									$r['nama_operator'],
									$r['nama_produk'],
									$r['nominal_produk'],
									$r['harga_gerai'],
									date("d M Y H:i:s", strtotime($r['tanggal_transaksi'])),
									$r['nama_pembeli']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	function list_penjualan_pulsa(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');

		$total=$this->report_mod->penjualan_pln()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();

		$tanggal_transaksi = $this->input->post('tanggal');
		
		$query = $this->report_mod->penjualan_pulsa($length, $start, $search, $tanggal_transaksi);

		if($search != ""){
			$jum=$this->report_mod->penjualan_pulsa(NULL, NULL, $search, NULL);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if(!empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_pulsa(NULL, NULL, NULL, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if($search != "" AND !empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_pulsa(NULL, NULL, $search, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['kode_kategori_produk'],
									$r['nama_operator'],
									$r['nama_produk'],
									$r['nominal_produk'],
									$r['harga_gerai'],
									date("d M Y H:i:s", strtotime($r['tanggal_transaksi'])),
									$r['nama_pembeli']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}


	function list_penjualan_koperasi(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');


		$total=$this->report_mod->penjualan_koperasi()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();

		$tanggal_transaksi = $this->input->post('tanggal');
		
		$query = $this->report_mod->penjualan_koperasi($length, $start, $search, $tanggal_transaksi);

		if($search != ""){
			$jum=$this->report_mod->penjualan_koperasi(NULL, NULL, $search, NULL);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if(!empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_koperasi(NULL, NULL, NULL, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if($search != "" AND !empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_koperasi(NULL, NULL, $search, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama_kategori'],
									$r['nama_produk'],
									$r['nama_koperasi'],
									$r['harga_pasar'],
									$r['harga_member'],
									$r['jumlah_beli'],
									$r['total_pembelian'],
									date("d M Y H:i:s", strtotime($r['tanggal_transaksi'])),
									$r['nama_pembeli']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}


	function list_penjualan_admin(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');


		$total=$this->report_mod->penjualan_admin()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		
		$tanggal_transaksi = $this->input->post('tanggal');
		
		$query=$this->report_mod->penjualan_admin($length, $start, $search, $tanggal_transaksi);

		if($search != ""){
			$jum=$this->report_mod->penjualan_admin(NULL, NULL, $search, NULL);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if(!empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_admin(NULL, NULL, NULL, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if($search != "" AND !empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_admin(NULL, NULL, $search, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama_kategori'],
									$r['nama_produk'],
									$r['nama_penjual'],
									$r['harga_pasar'],
									$r['harga_member'],
									$r['jumlah_beli'],
									$r['total_pembelian'],
									date("d M Y H:i:s", strtotime($r['tanggal_transaksi'])),
									$r['nama_pembeli']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	function list_penjualan_anggota(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');


		$total=$this->report_mod->penjualan_anggota()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		
		$tanggal_transaksi = $this->input->post('tanggal');
		
		$query=$this->report_mod->penjualan_anggota($length, $start, $search, $tanggal_transaksi);

		if($search != ""){
			$jum=$this->report_mod->penjualan_anggota(NULL, NULL, $search, NULL);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if(!empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_anggota(NULL, NULL, NULL, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if($search != "" AND !empty($tanggal_transaksi)){
			$jum=$this->report_mod->penjualan_anggota(NULL, NULL, $search, $tanggal_transaksi);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama_kategori'],
									$r['nama_produk'],
									$r['nama_penjual'],
									$r['harga_pasar'],
									$r['harga_member'],
									$r['jumlah_beli'],
									$r['total_pembelian'],
									date("d M Y H:i:s", strtotime($r['tanggal_transaksi'])),
									$r['nama_pembeli']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}


	function list_pendapatan_gerai(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');

		$total = $this->report_mod->pendapatan_gerai()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();

		$query=$this->report_mod->pendapatan_gerai($length, $start, $search, $this->input->post('tanggal'));


		if($search != ""){
			$jum=$this->report_mod->pendapatan_gerai(NULL, NULL, $search, NULL);
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if(!empty($this->input->post('tanggal'))){
			$jum=$this->report_mod->pendapatan_gerai(NULL, NULL, NULL, $this->input->post('tanggal'));
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}
		if($search != "" AND !empty($this->input->post('tanggal'))){
			$jum=$this->report_mod->pendapatan_gerai(NULL, NULL, $search, $this->input->post('tanggal'));
			$output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
		}

		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['kategori_produk'],
									$r['nama_operator'],
									$r['nama_produk'],
									$r['harga'],
									$r['jumlah'],
									$r['total'],
									date("d M Y H:i:s", strtotime($r['tanggal_transaksi'])));
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	function list_pendapatan_produk(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');
		  

		$total=$this->report_mod->pendapatan_produk()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		$tanggal_transaksi = $this->input->post('tanggal');

		$query=$this->report_mod->pendapatan_produk($length, $start, $search, $tanggal_transaksi);

		if($search != ""){
			$jum = $query;
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['kategori'],
									$r['nama_produk'],
									$r['nama_koperasi'],
									$r['harga_barang'],
									$r['jumlah'],
									$r['total'],
									date("d M Y H:i:s", strtotime($r['tanggal_transaksi'])));
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	function list_pengiriman_produk(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');
		 
		$total=$this->report_mod->pengiriman_produk()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		

		$query=$this->report_mod->pengiriman_produk($length, $start, $search);

		if($search != ""){
			$jum = $this->report_mod->pengiriman_produk(NULL, NULL, $search);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){

			if ($r['status_terkirim'] == "Y"):
				$terkirim = "Terkirim";
			else:
				$terkirim = "Belum Terkirim";
			endif;


			$output['data'][]=array($nomor_urut,
									$r['nama_koperasi'],
									$r['nama_pembeli'],
									$r['nama_barang'],
									$terkirim);
			$nomor_urut++;
		}

		echo json_encode($output);
	}


	function list_data_koperasi(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');
		 

		$total=$this->report_mod->data_koperasi()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		
		$query = $this->report_mod->data_koperasi($length, $start, $search);

		if($search != ""){
			$jum = $this->report_mod->data_koperasi(NULL, NULL, $search);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama'],
									$r['username'],
									$r['nama_kabupaten'].','.$r['nama_provinsi'],
									$r['telp']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}




	function list_data_komunitas(){
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');
		
		$total=$this->report_mod->data_komunitas()->num_rows();

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		

		$query = $this->report_mod->data_komunitas($length, $start, $search);

		if($search != ""){
			$jum = $this->report_mod->data_komunitas(NULL, NULL, $search);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama'],
									$r['username'],
									$r['alamat'],
									$r['telp']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}
}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */