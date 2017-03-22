<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_mod extends CI_Model {

	function get_all_produk(){
		if($this->session->userdata('owner') == 1){
			$this->db->select('user_detail.nama_lengkap as nama, produk.id_produk, produk.nama as nama_produk, produk_kategori.nama as nama_kategori,produk.price_n,produk.price_s,produk.qty');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('user_detail', 'user_detail.id_user = produk.user');
			$this->db->where('produk.owner', 1);
		}
		else if($this->session->userdata('owner') == 2){
			$this->db->select('koperasi.nama, produk.id_produk, produk.nama as nama_produk, produk_kategori.nama as nama_kategori,produk.price_n,produk.price_s,produk.qty');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('koperasi', 'koperasi.id_user = produk.user');
			$this->db->where('produk.owner', 2);
		}
		else if($this->session->userdata('owner') == 3){
			$this->db->select('user_detail.nama_lengkap  as nama, produk.id_produk, produk.nama as nama_produk, produk_kategori.nama as nama_kategori,produk.price_n,produk.price_s,produk.qty');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('user_detail', 'user_detail.id_user = produk.user');
			$this->db->where('produk.owner', 3);
		}

		$this->db->where('produk.status', 1);
		return $this->db->get('produk');
	}

	function get_all_produk_milik_kop(){
			$this->db->select('koperasi.nama, produk.id_produk, produk.nama as nama_produk, produk_kategori.nama as nama_kategori,produk.price_n,produk.price_s,produk.qty');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('koperasi', 'koperasi.id_user = produk.user');
			$this->db->where('produk.user', $this->session->userdata('id_user'));
			$this->db->where('produk.owner', 2);
			$this->db->where('produk.status', 1);
			return $this->db->get('produk');


	}
	function get_all_produk_milik_mem(){
			$this->db->select('produk.id_produk, produk.nama as nama_produk, produk_kategori.nama as nama_kategori,produk.price_n,produk.price_s,produk.qty, user_detail.nama_lengkap as nama');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
			$this->db->join('user_info', 'user_info.id_user = produk.user');
			$this->db->join('user_detail', 'user_info.id_user = user_detail.id_user');
			$this->db->where('produk.user', $this->session->userdata('id_user'));
			$this->db->where('produk.owner', 3);
			$this->db->where('produk.status', 1);
			return $this->db->get('produk');


	}


	function get_produk_by_id(){
		$this->db->select('produk.*, produk_kategori.id_kategori as id_kategori, user_detail.nama_lengkap as user_nama');
		$this->db->where('produk.id_produk', $this->session->userdata('id'));
		$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
		$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
		$this->db->join('user_detail', 'produk.user = user_detail.id_user');
		return $this->db->get('produk');
	}

	function get_produk_by_id_kop(){
		$this->db->select('produk.*, produk_kategori.id_kategori as id_kategori, koperasi.nama as user_nama');
		$this->db->where('produk.id_produk', $this->session->userdata('id'));
		$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
		$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
		$this->db->join('koperasi', 'produk.user = koperasi.id_user');
		return $this->db->get('produk');
	}

	function get_produk_history_by_id(){
		$this->db->select('produk_history.ket,produk_history.service_time, produk_history.service_action, produk_history.service_user, 
			produk_kategori.nama as nama_kategori, user_detail.nama_lengkap as nama_user,produk.nama,produk_history.price_n,produk_history.price_s,produk_history.qty');
		$this->db->join('produk ', 'produk_history.id_produk = produk.id_produk');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
		
		$this->db->join('user_detail', 'produk.user = user_detail.id_user');
		$this->db->where('produk_history.id_produk', $this->session->userdata('id'));
		return $this->db->get('produk_history');
	}

	function get_produk_history_by_id_kop(){
		$this->db->select('produk_history.ket,produk_history.service_time, produk_history.service_action, produk_history.service_user, 
			produk_kategori.nama as nama_kategori, koperasi.nama  as nama_user,produk.nama,produk_history.price_n,produk_history.price_s,produk_history.qty');
		$this->db->join('produk ', 'produk_history.id_produk = produk.id_produk');
			$this->db->join('produk_kategori_relation', 'produk.id_produk = produk_kategori_relation.id_produk');
			$this->db->join('produk_kategori', 'produk_kategori.id_kategori = produk_kategori_relation.id_kategori');
		
		$this->db->join('koperasi', 'produk.user = koperasi.id_user');
		$this->db->where('produk_history.id_produk', $this->session->userdata('id'));
		return $this->db->get('produk_history');
	}

	function get_produk_foto(){
		$this->db->where('id_produk', $this->session->userdata('id'));
		return $this->db->get('produk_foto');
	}

	
	function get_all_produk_kategori(){
		return $this->db->get('produk_kategori');
	}

	function get_produk_kategori_by_id(){
		$this->db->where('id_kategori', $this->session->userdata('id'));
		return $this->db->get('produk_kategori');
	}



	function add_produk(){
		$id_produk = "2".date('dmYHis');

		$produk = array('id_produk' => $id_produk,
						'nama' => $this->input->post('nama'),
						'desk' => $this->input->post('deskripsi'),
						'warna' => $this->input->post('warna'),
						'tipe' => $this->input->post('tipe'),
						'berat' => $this->input->post('berat'),
						'price_n' => $this->input->post('price_n'),
						'price_s' => $this->input->post('price_s'),
						'qty'=> $this->input->post('qty'),
						'terjual' => $this->input->post('terjual'),
						'user' => $this->session->userdata('id_user'),
						'status' => 1,
						'service_time' => date("Y-m-d H:i:s"),
						'service_action' => 'insert',
						'owner' => $this->session->userdata('level'),
						'service_user' => $this->session->userdata('id_user'));

		$produk_kategori_relation = array('id_produk' => $id_produk,
										  'id_kategori' => $this->input->post('kategori'));

		$produk_history = array('id_produk' => $id_produk,
								'price_n' => $this->input->post('price_n'),
								'price_s' => $this->input->post('price_s'),
								'warna' => $this->input->post('warna'),
								'tipe' => $this->input->post('tipe'),
								'berat' => $this->input->post('berat'),
								'service_time' => date("Y-m-d H:i:s"),
								'service_action' => 'insert',
								'qty'=> $this->input->post('qty'),
								'ket' => 'Management Produk',
								'service_user' => $this->session->userdata('nama'));

		$this->db->insert('produk', $produk);
		$this->db->insert('produk_kategori_relation', $produk_kategori_relation);
		$this->db->insert('produk_history', $produk_history);

	}


	function update_produk(){
		$id_produk = $this->session->userdata('id');

		$produk = array(
						'nama' => $this->input->post('nama'),
						'desk' => $this->input->post('deskripsi'),
						'warna' => $this->input->post('warna'),
						'tipe' => $this->input->post('tipe'),
						'berat' => $this->input->post('berat'),
						'price_n' => $this->input->post('price_n'),
						'price_s' => $this->input->post('price_s'),
						'qty'=> $this->input->post('qty'),
						'terjual' => $this->input->post('terjual'),
						// 'user' => $this->session->userdata('id_user'),
						'service_time' => date("Y-m-d H:i:s"),
						'service_action' => 'update',
						'service_user' => $this->session->userdata('id_user'));

		$produk_kategori_relation = array(
										  'id_kategori' => $this->input->post('kategori'));

		$produk_history = array('id_produk' => $id_produk,
								'price_n' => $this->input->post('price_n'),
								'price_s' => $this->input->post('price_s'),
								'warna' => $this->input->post('warna'),
								'tipe' => $this->input->post('tipe'),
								'berat' => $this->input->post('berat'),
								'qty'=> $this->input->post('qty'),
								'service_time' => date("Y-m-d H:i:s"),
								'service_action' => 'update',
								'ket' => 'Management Produk',
								'service_user' => $this->session->userdata('nama'));

		$this->db->where('id_produk', $id_produk);
		$this->db->update('produk', $produk);

		$this->db->where('id_produk', $id_produk);
		$this->db->update('produk_kategori_relation', $produk_kategori_relation);


		$this->db->insert('produk_history', $produk_history);
	}

	function delete_produk(){
		// $this->db->where('id_produk', $this->session->userdata('id'));
		// $this->db->delete('produk');


		$produk = array(
					'status' => 0,
					'service_time' => date("Y-m-d H:i:s"),
					'service_action' => 'delete',
					'service_user' => $this->session->userdata('id_user'));

		$this->db->where('id_produk', $this->session->userdata('id'));
		$this->db->update('produk', $produk);


		$history = array('id_produk' => $this->session->userdata('id'),
						 'service_time' => date("Y-m-d H:i:s"),
						 'service_action' => 'delete',
						 'ket' => 'Management Produk',
						 'service_user' => $this->session->userdata('nama'));


		$this->db->insert('produk_history', $history);

	}

	function add_produk_foto($photo){
		$id_foto = "3".date('dmYHis');
		$data = array('id_foto' =>$id_foto,
					  'id_produk' => $this->session->userdata('id'),
					  'foto_path' => $photo,
					  'service_time' => date("Y-m-d H:i:s"),
					  'service_action' => "insert",
					  'service_user' => $this->session->userdata('id_user'));

		$this->db->insert('produk_foto', $data);
	}

	function delete_produk_foto (){
		$this->db->where('id_produk', $this->session->userdata('id_foto'));
		$foto_path =  $this->db->get('produk_foto');

		if($foto_path->num_rows() > 0){
			$foto_path =  $this->db->get('produk_foto')->row()->foto_path;
			$hapus=unlink($foto_path);
		}

		$this->db->where('id_foto', $this->session->userdata('id_foto'));
		$this->db->delete('produk_foto');
	}

	function add_produk_kategori(){
		$object = array(
						'nama' => $this->input->post('nama'),
						'service_time' => date("Y-m-d H:i:s"),
					 	'service_action' => "insert",
					  	'service_user' => $this->session->userdata('id_user') );
		$this->db->insert('produk_kategori', $object);
	}

	function update_produk_kategori(){
		$id_kategori = $this->session->userdata('id');


		$object = array('nama' => $this->input->post('nama'),
						'service_time' => date("Y-m-d H:i:s"),
					 	'service_action' => "update",
					  	'service_user' => $this->session->userdata('id_user') );

		$this->db->where('id_kategori', $id_kategori);
		$this->db->update('produk_kategori', $object);
	}
	

	function delete_produk_kategori(){
		$id_kategori = $this->session->userdata('id');
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('produk_kategori');
	}
	
}

/* End of file produk_mod.php */
/* Location: ./application/models/produk_mod.php */