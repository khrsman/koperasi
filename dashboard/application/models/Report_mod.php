<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_mod extends CI_Model {

		function data_produk($limit = NULL, $offset = NULL, $search = NULL){
			$this->db->select('produk_kategori.nama as nama_kategori,
							   produk.nama AS nama_produk,
							   koperasi.nama AS nama_koperasi,
							   ref_provinsi.nama as nama_provinsi,
							   ref_kabupaten.nama as nama_kabupaten,
							   produk.price_n as harga_pasar,
							   produk.price_s as harga_member,
							   produk.qty as stok,
							   produk.terjual as terjual'); 

			$this->db->from('produk');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori_relation.id_kategori = produk_kategori.id_kategori');
			$this->db->join('koperasi', 'produk.user = koperasi.id_user');
			$this->db->join('koperasi_alamat', 'koperasi.id_koperasi = koperasi_alamat.id_koperasi');
			$this->db->join('ref_provinsi', 'koperasi_alamat.provinsi = ref_provinsi.id_provinsi');
			$this->db->join('ref_kabupaten', 'koperasi_alamat.kabupaten = ref_kabupaten.id_kabupaten');
			$this->db->where('produk.owner', "2");

			if($this->session->userdata('level') == "2"){
				$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			}


			if($search != NULL){
				$this->db->where("(produk_kategori.nama LIKE '%$search%' OR produk.nama LIKE '%$search%' OR koperasi.nama LIKE '%$search%' OR ref_provinsi.nama LIKE '%$search%' OR ref_kabupaten.nama LIKE '%$search%')");
			}

			$this->db->limit($limit, $offset);
			$this->db->order_by('nama_produk','ASC');
			return $this->db->get();
		}


		function data_produk_admin($limit = NULL, $offset = NULL, $search = NULL){
			$this->db->select('produk.owner,
						   produk.id_produk as id_produk,
						   produk_kategori.nama as nama_kategori,
						   produk.nama AS nama_produk,
						   user_detail.nama_lengkap AS nama_lengkap,
						   ref_provinsi.nama as nama_provinsi,
						   ref_kabupaten.nama as nama_kabupaten,
						   produk.price_n as harga_pasar,
						   produk.price_s as harga_member,
						   produk.qty as stok,
						   produk.terjual as terjual'); 

			$this->db->from('produk');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori_relation.id_kategori = produk_kategori.id_kategori');
			$this->db->join('user_detail', 'produk.user = user_detail.id_user');
			$this->db->join('user_alamat', 'user_detail.id_user = user_alamat.id_user');
			$this->db->join('ref_provinsi', 'user_alamat.pengirim_provinsi = ref_provinsi.id_provinsi');
			$this->db->join('ref_kabupaten', 'user_alamat.pengirim_kabupaten = ref_kabupaten.id_kabupaten');
			$this->db->where('produk.owner', "1");


			if($search != NULL){
				$this->db->where("(produk_kategori.nama LIKE '%$search%' OR produk.nama LIKE '%$search%' OR user_detail.nama_lengkap LIKE '%$search%' OR ref_provinsi.nama LIKE '%$search%' OR ref_kabupaten.nama LIKE '%$search%')");
			}

			$this->db->limit($limit, $offset);
			$this->db->order_by('nama_produk','ASC');
			return $this->db->get();
		}

		function data_produk_anggota($limit = NULL, $offset = NULL, $search = NULL){
			$this->db->select('produk.owner,
							   produk.id_produk as id_produk,
							   produk_kategori.nama as nama_kategori,
							   produk.nama AS nama_produk,
							   user_detail.nama_lengkap AS nama_lengkap,
							   ref_provinsi.nama as nama_provinsi,
							   ref_kabupaten.nama as nama_kabupaten,
							   produk.price_n as harga_pasar,
							   produk.price_s as harga_member,
							   produk.qty as stok, produk.terjual as terjual'); 

			$this->db->from('produk');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori_relation.id_kategori = produk_kategori.id_kategori');
			$this->db->join('user_detail', 'produk.user = user_detail.id_user');
			$this->db->join('user_info', 'produk.user = user_info.id_user');
			$this->db->join('user_alamat', 'user_detail.id_user = user_alamat.id_user');
			$this->db->join('ref_provinsi', 'user_alamat.pengirim_provinsi = ref_provinsi.id_provinsi');
			$this->db->join('ref_kabupaten', 'user_alamat.pengirim_kabupaten = ref_kabupaten.id_kabupaten');

			$this->db->where('produk.owner', "3");

			if($this->session->userdata('level') == "2"){
					$this->db->where('user_info.koperasi', $this->session->userdata('koperasi'));
			}

			if($search != NULL){
				$this->db->where("(`produk_kategori`.`nama` LIKE '%$search%' OR `produk`.`nama` LIKE '%$search%' OR `user_detail`.`nama_lengkap` LIKE '%$search%' OR `ref_provinsi`.`nama` LIKE '%$search%' OR `ref_kabupaten`.`nama` LIKE '%$search%')");
			}

			$this->db->order_by('nama_produk', 'asc');
			$this->db->limit($limit, $offset);
			return $this->db->get();
		}



		function penjualan_pln($limit = NULL, $offset = NULL, $search = NULL, $tanggal_transaksi = NULL){
			$this->db->select('gerai_transaksi.kode_kategori_produk,
						   gerai_transaksi.nama_produk,
						   gerai_transaksi.nominal_produk,
						   gerai_operator.nama_operator as nama_operator,
						   gerai_transaksi.harga_gerai, 
						   gerai_transaksi.tanggal_transaksi, 
						   user_detail.nama_lengkap as nama_pembeli '); 

			$this->db->from('gerai_transaksi');
			$this->db->join('gerai_operator', 'gerai_transaksi.kode_operator = gerai_operator.kode_operator ');
			$this->db->join('user_detail', 'gerai_transaksi.id_user = user_detail.id_user ');

			$this->db->where('gerai_transaksi.kode_kategori_produk', "LISTRIK");

			if($search != NULL){
				$this->db->where("(gerai_transaksi.kode_kategori_produk LIKE '%$search%' OR gerai_transaksi.nama_produk LIKE '%$search%' OR gerai_operator.nama_operator LIKE '%$search%' OR gerai_transaksi.tanggal_transaksi LIKE '%$search%' OR user_detail.nama_lengkap LIKE '%$search%')");
			}

			if($tanggal_transaksi != NULL){
				$tanggal = explode(" - ", $this->input->post('tanggal'));
				$awal = $tanggal[0];
				$akhir = $tanggal[1];


				$date_awal = new DateTime($awal);
				$tanggal_awal = $date_awal->format('Y-m-d');
				$date_akhir = new DateTime($akhir);
				$tanggal_akhir = $date_akhir->format('Y-m-d');

				$this->db->where('tanggal_transaksi >=', $tanggal_awal);
				$this->db->where('tanggal_transaksi <=', $tanggal_akhir);
			}


			$this->db->limit($limit, $offset);
			$this->db->order_by('gerai_transaksi.kode_kategori_produk','ASC');

			return $this->db->get();

		}

		function penjualan_pulsa($limit = NULL, $offset = NULL, $search = NULL, $tanggal_transaksi = NULL){
			$this->db->select('gerai_transaksi.kode_kategori_produk,
						   gerai_transaksi.nama_produk,
						   gerai_transaksi.nominal_produk,
						   gerai_operator.nama_operator as nama_operator,
						   gerai_transaksi.harga_gerai, 
						   gerai_transaksi.tanggal_transaksi, 
						   user_detail.nama_lengkap as nama_pembeli '); 

			$this->db->from('gerai_transaksi');
			$this->db->join('gerai_operator', 'gerai_transaksi.kode_operator = gerai_operator.kode_operator ');
			$this->db->join('user_detail', 'gerai_transaksi.id_user = user_detail.id_user ');

			$this->db->where('gerai_transaksi.kode_kategori_produk', "PULSA");

			if($search != NULL){
				$this->db->where("(gerai_transaksi.kode_kategori_produk LIKE '%$search%' OR gerai_transaksi.nama_produk LIKE '%$search%' OR gerai_operator.nama_operator LIKE '%$search%' OR user_detail.nama_lengkap LIKE '%$search%')");
			}

			if($tanggal_transaksi != NULL){
				$tanggal = explode(" - ", $this->input->post('tanggal'));
				$awal = $tanggal[0];
				$akhir = $tanggal[1];


				$date_awal = new DateTime($awal);
				$tanggal_awal = $date_awal->format('Y-m-d');
				$date_akhir = new DateTime($akhir);
				$tanggal_akhir = $date_akhir->format('Y-m-d');

				$this->db->where('tanggal_transaksi >=', $tanggal_awal);
				$this->db->where('tanggal_transaksi <=', $tanggal_akhir);
			}


			$this->db->limit($limit, $offset);
			$this->db->order_by('gerai_transaksi.kode_kategori_produk','ASC');

			return $this->db->get();

		}



		function penjualan_koperasi($limit = NULL, $offset = NULL, $search = NULL, $tanggal_transaksi = NULL){
			$this->db->select('produk_kategori.nama as nama_kategori,
						   b.nama as nama_produk,
						   koperasi.nama as nama_koperasi,
						   b.price_n as harga_pasar, 
						   b.price_s as harga_member,
						   (SELECT COUNT(no_transaksi) FROM detail_transaksi WHERE no_transaksi = a.no_transaksi AND detail_transaksi.id_produk = b.id_produk ) as jumlah_beli,
						   a.total_harga as total_pembelian,
						   a.tanggal_transaksi,
						   user_detail.nama_lengkap as nama_pembeli'); 

			$this->db->from('transaksi a');
			$this->db->join('detail_transaksi', 'a.no_transaksi = detail_transaksi.no_transaksi');
			$this->db->join('produk b', 'b.id_produk = detail_transaksi.id_produk');
			$this->db->join('produk_kategori_relation', 'b.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('koperasi', 'b.user = koperasi.id_user');
			$this->db->join('user_detail', 'a.id_user = user_detail.id_user');
			$this->db->join('user_info', 'a.id_user = user_info.id_user');

			if($this->session->userdata('level') == "2"){
				$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			}

			if($tanggal_transaksi != NULL){
				$tanggal = explode(" - ", $this->input->post('tanggal'));
				$awal = $tanggal[0];
				$akhir = $tanggal[1];


				$date_awal = new DateTime($awal);
				$tanggal_awal = $date_awal->format('Y-m-d');
				$date_akhir = new DateTime($akhir);
				$tanggal_akhir = $date_akhir->format('Y-m-d');

				$this->db->where('tanggal_transaksi >=', $tanggal_awal);
				$this->db->where('tanggal_transaksi <=', $tanggal_akhir);
			}

			$this->db->where('b.owner', "2");

			if($search != NULL){
				$this->db->where("(produk_kategori.nama LIKE '%$search%' OR koperasi.nama LIKE '%$search%' OR b.nama LIKE '%$search%' OR user_detail.nama_lengkap LIKE '%$search%')");
			}


			$this->db->limit($limit, $offset);
			$this->db->order_by('tanggal_transaksi','ASC');

			return $this->db->get();
		}

		function penjualan_admin($limit = NULL, $offset = NULL, $search = NULL, $tanggal_transaksi = NULL){
			$this->db->select('produk_kategori.nama as nama_kategori,
						   b.nama as nama_produk,
						   penjual.nama_lengkap as nama_penjual,
						   b.price_n as harga_pasar,
						   b.price_s as harga_member,
						   (SELECT COUNT(no_transaksi) FROM detail_transaksi WHERE no_transaksi = a.no_transaksi AND detail_transaksi.id_produk = b.id_produk ) as jumlah_beli,
						   a.total_harga as total_pembelian,
						   a.tanggal_transaksi,
						   pembeli.nama_lengkap as nama_pembeli'); 

			$this->db->from('transaksi a');
			$this->db->join('detail_transaksi', 'a.no_transaksi = detail_transaksi.no_transaksi');
			$this->db->join('produk b', 'b.id_produk = detail_transaksi.id_produk');
			$this->db->join('produk_kategori_relation', 'b.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('user_detail penjual', 'b.user = penjual.id_user');
			$this->db->join('user_detail pembeli', 'a.id_user = pembeli.id_user');


			$this->db->where('b.owner', "1");

			if($search != NULL){
				$this->db->where("(produk_kategori.nama LIKE '%$search%' OR penjual.nama_lengkap LIKE '%$search%' OR b.nama LIKE '%$search%' OR pembeli.nama_lengkap LIKE '%$search%')");
			}
			if($tanggal_transaksi != NULL){
				$tanggal = explode(" - ", $this->input->post('tanggal'));
				$awal = $tanggal[0];
				$akhir = $tanggal[1];


				$date_awal = new DateTime($awal);
				$tanggal_awal = $date_awal->format('Y-m-d');
				$date_akhir = new DateTime($akhir);
				$tanggal_akhir = $date_akhir->format('Y-m-d');

				$this->db->where('tanggal_transaksi >=', $tanggal_awal);
				$this->db->where('tanggal_transaksi <=', $tanggal_akhir);
			}


			$this->db->limit($limit, $offset);
			$this->db->order_by('tanggal_transaksi','ASC');

			return $this->db->get();
		}


		function penjualan_anggota($limit = NULL, $offset = NULL, $search = NULL, $tanggal_transaksi = NULL){
			$this->db->select('produk_kategori.nama as nama_kategori,
						   b.nama as nama_produk,
						   penjual.nama_lengkap as nama_penjual,
						   b.price_n as harga_pasar,
						   b.price_s as harga_member,
						   (SELECT COUNT(no_transaksi) FROM detail_transaksi WHERE no_transaksi = a.no_transaksi AND detail_transaksi.id_produk = b.id_produk ) as jumlah_beli,
						   a.total_harga as total_pembelian,
						   a.tanggal_transaksi,
						   pembeli.nama_lengkap as nama_pembeli'); 

			$this->db->from('transaksi a');
			$this->db->join('detail_transaksi', 'a.no_transaksi = detail_transaksi.no_transaksi');
			$this->db->join('produk b', 'b.id_produk = detail_transaksi.id_produk');
			$this->db->join('produk_kategori_relation', 'b.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('user_detail penjual', 'b.user = penjual.id_user');
			$this->db->join('user_detail pembeli', 'a.id_user = pembeli.id_user');


			$this->db->where('b.owner', "3");


			if($this->session->userdata('level') == "2"){
				$this->db->where('user_info.koperasi', $this->session->userdata('koperasi'));
			}

			if($this->session->userdata('level') == "3"){
				$this->db->where('b.user', $this->session->userdata('id_user'));
			}

			if($search != NULL){
				$this->db->where("(produk_kategori.nama LIKE '%$search%' OR penjual.nama_lengkap LIKE '%$search%' OR b.nama LIKE '%$search%' OR pembeli.nama_lengkap LIKE '%$search%')");
			}
			if($tanggal_transaksi != NULL){
				$tanggal = explode(" - ", $this->input->post('tanggal'));
				$awal = $tanggal[0];
				$akhir = $tanggal[1];


				$date_awal = new DateTime($awal);
				$tanggal_awal = $date_awal->format('Y-m-d');
				$date_akhir = new DateTime($akhir);
				$tanggal_akhir = $date_akhir->format('Y-m-d');

				$this->db->where('tanggal_transaksi >=', $tanggal_awal);
				$this->db->where('tanggal_transaksi <=', $tanggal_akhir);
			}


			$this->db->limit($limit, $offset);
			$this->db->order_by('tanggal_transaksi','ASC');

			return $this->db->get();
		}


		function pendapatan_gerai($limit = NULL, $offset = NULL, $search = NULL, $tanggal_transaksi = NULL){
			$this->db->select("gerai_kategori_produk.nama_kategori_produk as kategori_produk,
							  a.kode_produk as kode_produk,
							  a.nama_produk as nama_produk,
							  gerai_operator.nama_operator as nama_operator,
							  a.harga_gerai as harga,
							  COUNT(a.kode_produk) as jumlah,
							  SUM(a.harga_gerai) as total,
							  a.tanggal_transaksi"); 
			$this->db->from('gerai_transaksi a');
			$this->db->join('gerai_operator', 'a.kode_operator = gerai_operator.kode_operator');
			$this->db->join('gerai_kategori_produk', 'a.kode_kategori_produk = gerai_kategori_produk.kode_kategori_produk');
			$this->db->where('a.status', "SUKSES");
			$this->db->group_by('a.tanggal_transaksi, a.kode_produk');


			if($tanggal_transaksi != NULL){
				$tanggal = explode(" - ", $this->input->post('tanggal'));
				$awal = $tanggal[0];
				$akhir = $tanggal[1];


				$date_awal = new DateTime($awal);
				$tanggal_awal = $date_awal->format('Y-m-d');
				$date_akhir = new DateTime($akhir);
				$tanggal_akhir = $date_akhir->format('Y-m-d');

				$this->db->where('tanggal_transaksi >=', $tanggal_awal);
				$this->db->where('tanggal_transaksi <=', $tanggal_akhir);
			}


			if($search != NULL){
			$this->db->where("(gerai_kategori_produk.nama_kategori_produk LIKE '%$search%' OR a.kode_produk LIKE '%$search%' OR a.nama_produk LIKE '%$search%' OR gerai_operator.nama_operator LIKE '%$search%')");
			}

			$this->db->group_by('a.tanggal_transaksi, a.kode_produk');
			$this->db->order_by('a.tanggal_transaksi','ASC');

			$this->db->limit($limit, $offset);


			return $this->db->get();
		}



		function pendapatan_produk($limit = NULL, $offset = NULL, $search = NULL, $tanggal_transaksi = NULL){
			$this->db->select("produk_kategori.nama as kategori,
						   produk.nama as nama_produk,
						   koperasi.nama as nama_koperasi,
						   detail_transaksi.harga harga_barang,
						   count(detail_transaksi.id_produk) as jumlah,
						   SUM(transaksi.total_harga) as total,
						   transaksi.tanggal_transaksi"); 

			$this->db->from('transaksi');
			$this->db->join('detail_transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi');
			$this->db->join('produk', 'detail_transaksi.id_produk = produk.id_produk ');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk ');
			$this->db->join('produk_kategori ', ' produk_kategori_relation.id_kategori = produk_kategori.id_kategori');
			$this->db->join('koperasi', 'produk.user = koperasi.id_user');

			

			if($search != NULL){	
				$this->db->where("(produk_kategori.nama LIKE '%$search%' OR produk.nama LIKE '%$search%' OR koperasi.nama LIKE '%$search%')");
			}

			if($tanggal_transaksi != NULL){
				$tanggal = explode(" - ", $this->input->post('tanggal'));
				$awal = $tanggal[0];
				$akhir = $tanggal[1];


				$date_awal = new DateTime($awal);
				$tanggal_awal = $date_awal->format('Y-m-d');
				$date_akhir = new DateTime($akhir);
				$tanggal_akhir = $date_akhir->format('Y-m-d');

				$this->db->where('tanggal_transaksi >=', $tanggal_awal);
				$this->db->where('tanggal_transaksi <=', $tanggal_akhir);
			}
			
			if($this->session->userdata('level') == "2"){
				$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			}
			$this->db->group_by('transaksi.tanggal_transaksi, detail_transaksi.id_produk');
			$this->db->limit($limit, $offset);
			$this->db->order_by('nama_produk','ASC');

			return $this->db->get();
		}

		function pengiriman_produk($limit = NULL, $offset = NULL, $search = NULL){
			$this->db->select("koperasi.nama as nama_koperasi,
						   	   user_detail.nama_lengkap as nama_pembeli,
						       produk.nama as nama_barang,
						       detail_transaksi.status_terkirim "); 

			$this->db->from('detail_transaksi');
			$this->db->join('transaksi', 'detail_transaksi.no_transaksi = transaksi.no_transaksi');
			$this->db->join('produk', 'detail_transaksi.id_produk = produk.id_produk');
			$this->db->join('user_detail', ' transaksi.id_user = user_detail.id_user');
			$this->db->join('koperasi', 'produk.user = koperasi.id_user');
			

			if($search != NULL){
				
				$this->db->where("(user_detail.nama_lengkap LIKE '%$search%' OR produk.nama LIKE '%$search%' OR koperasi.nama LIKE '%$search%')");
			}

				if($this->session->userdata('level') == "2"){
				$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			}

			$this->db->limit($limit, $offset);
			$this->db->order_by('nama_koperasi','ASC');

			return $this->db->get();
		}


		function data_koperasi($limit = NULL, $offset = NULL, $search = NULL){
			$this->db->select("koperasi.nama,
						   koperasi.telp,
						   user_info.username,
						   ref_provinsi.nama as nama_provinsi,
						   ref_kabupaten.nama as nama_kabupaten"); 

			$this->db->from('koperasi');
			$this->db->join('user_info', 'koperasi.id_user = user_info.id_user');
			$this->db->join('koperasi_alamat', 'koperasi_alamat.id_koperasi = koperasi.id_koperasi');
			$this->db->join('ref_provinsi', 'koperasi_alamat.provinsi = ref_provinsi.id_provinsi');
			$this->db->join('ref_kabupaten', 'koperasi_alamat.kabupaten = ref_kabupaten.id_kabupaten');

			$this->db->where('koperasi.status_active', "1");

			if($search != NULL){
				
				$this->db->where("(koperasi.nama LIKE '%$search%' OR user_info.username LIKE '%$search%' OR ref_provinsi.nama LIKE '%$search%' OR ref_kabupaten.nama LIKE '%$search%')");
			}
			
			$this->db->limit($limit, $offset);
			$this->db->order_by('koperasi.nama','ASC');
			return $this->db->get();
		}


		function data_komunitas($limit = NULL, $offset = NULL, $search = NULL){
			$this->db->select("komunitas.nama,
						   komunitas.telp,
						   komunitas.alamat,
						   user_info.username"); 

			$this->db->from('komunitas');
			$this->db->join('user_info', 'komunitas.id_user = user_info.id_user');
			$this->db->where('komunitas.status_active', "1");

			$this->db->where('komunitas.status_active', "1");

			if($search != NULL){	
				$this->db->where("(komunitas.nama LIKE '%$search%' OR user_info.username LIKE '%$search%')");
			}
			
			$this->db->limit($limit, $offset);
			$this->db->order_by('nama','ASC');

			return $this->db->get();
		}


}

/* End of file Mreport.php */
/* Location: ./application/models/Mreport.php */	