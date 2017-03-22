<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_mod extends CI_Model {

	function get_anggota_by_provinsi(){
		$this->db->select('nama, (SELECT COUNT(id_user) FROM user_alamat WHERE pengirim_provinsi = id_provinsi) as jumlah');
		$this->db->from('ref_provinsi');
		$this->db->order_by('id_provinsi', 'asc');

		return $this->db->get();
	}

	function get_anggota_provinsi($limit, $start){
		$this->db->select('ref_provinsi.id_provinsi as id, nama, (SELECT COUNT(id_user) FROM user_alamat WHERE pengirim_provinsi = id) as jumlah');
		$this->db->from('ref_provinsi');
		$this->db->order_by('id', 'asc');

		$this->db->limit($limit, $start);
		$query = $this->db->get();


			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	}



	function get_anggota_provinsi_koperasi($limit, $start){

		$koperasi = $this->session->userdata('koperasi');
		$this->db->select("ref_provinsi.id_provinsi as id, ref_provinsi.nama, (SELECT COUNT(user_alamat.id_user) FROM user_alamat JOIN user_info ON user_info.id_user = user_alamat.id_user WHERE pengirim_provinsi = id AND user_info.koperasi  = '$koperasi') as jumlah");

		$this->db->from('ref_provinsi');
		$this->db->order_by('id', 'asc');

		$this->db->limit($limit, $start);
		$query = $this->db->get();


			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	}







	function get_anggota_kabupaten($limit, $start, $id){
		$this->db->select('ref_kabupaten.id_kabupaten as id, nama, (SELECT COUNT(id_user) FROM user_alamat WHERE pengirim_kabupaten = id) as jumlah');
		$this->db->from('ref_kabupaten');
		$this->db->order_by('id', 'asc');
		$this->db->where('ref_kabupaten.id_provinsi', $id);
		$this->db->limit($limit, $start);
		$query = $this->db->get();


			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	}



	function get_anggota_kabupaten_koperasi($limit, $start, $id){

		$koperasi = $this->session->userdata('koperasi');
		$this->db->select("ref_kabupaten.id_kabupaten as id, ref_kabupaten.nama, (SELECT COUNT(user_alamat.id_user) FROM user_alamat JOIN user_info ON user_info.id_user = user_alamat.id_user WHERE pengirim_kabupaten = id AND user_info.koperasi  = '$koperasi') as jumlah");

		$this->db->from('ref_kabupaten');
		$this->db->order_by('id', 'asc');
		$this->db->where('ref_kabupaten.id_provinsi', $id);
		$this->db->limit($limit, $start);
		$query = $this->db->get();


			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	}
	

	function get_total_pembelian($limit, $start){
		$this->db->select('ref_provinsi.nama, ref_provinsi.id_provinsi as id, (SELECT SUM(transaksi.total_harga) as total from transaksi JOIN user_alamat ON user_alamat.id_user = transaksi.id_user JOIN ref_provinsi ON user_alamat.pengirim_provinsi = ref_provinsi.id_provinsi WHERE ref_provinsi.id_provinsi = id ) as total ');
		$this->db->from('ref_provinsi');
		$this->db->order_by('total', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();


			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	}


	function get_total_pembelian_kabupaten($limit, $start, $id_provinsi){
		$this->db->select('ref_kabupaten.nama, ref_kabupaten.id_kabupaten as id, (SELECT SUM(transaksi.total_harga) as total from transaksi JOIN user_alamat ON user_alamat.id_user = transaksi.id_user JOIN ref_kabupaten ON user_alamat.pengirim_kabupaten = ref_kabupaten.id_kabupaten WHERE ref_kabupaten.id_kabupaten = id ) as total ');
		$this->db->from('ref_kabupaten');
		$this->db->where('ref_kabupaten.id_provinsi', $id_provinsi);
		$this->db->order_by('total', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();


			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	}


	function produk_data($limit, $start){
		$this->db->select('produk.id_produk as produk_id, produk.nama, (SELECT COUNT(id_produk) FROM detail_transaksi WHERE detail_transaksi.id_produk = produk_id) as total_penjualan');
		$this->db->from('produk');
		$this->db->order_by('total_penjualan', 'desc');
		$this->db->limit($limit, $start);

		$query = $this->db->get();


			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	   }




	function anggota_koperasi_data($limit, $start){
		$this->db->select('koperasi.nama, koperasi.id_koperasi as koperasi_id, (SELECT COUNT(id_user) FROM user_info WHERE user_info.koperasi = koperasi_id) as total_user');
		$this->db->from('koperasi');
		$this->db->order_by('total_user', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();


		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}


	function count_product(){
		$this->db->select('id_produk');
		$this->db->from('produk');

		$query = $this->db->get();


		return $query->num_rows();
	}

	function count_koperasi(){
		$this->db->select('id_koperasi');
		$this->db->from('koperasi');

		$query = $this->db->get();

		return $query->num_rows();
	}
	
	function count_provinsi(){
		$this->db->select('id_provinsi');
		$this->db->from('ref_provinsi');

		$query = $this->db->get();


		return $query->num_rows();
	}

	function count_kabupaten($provinsi){
		$this->db->select('id_kabupaten');
		$this->db->from('ref_kabupaten');

		$this->db->where('id_provinsi', $provinsi);

		$query =  $this->db->get();

		return $query->num_rows();
	}

}

/* End of file Chart_mod.php */
/* Location: ./application/models/Chart_mod.php */