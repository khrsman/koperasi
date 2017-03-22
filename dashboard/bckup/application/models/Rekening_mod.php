<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_mod extends CI_Model {

	var $keyword, $id_user, $id_koperasi, $no_rekening, $tipe_transaksi, $kode_transaksi, $status_rekening = "ANY";

	public function __construct()
	{
		parent::__construct();
	}

	function cek_pin($pin){
		$this->db->from('user_detail ud');
		if($this->id_user)
			$this->db->where('ud.id_user', $this->id_user);
		$this->db->where('ud.user_ver', $pin);

		return $this->db->count_all_results();
	}

	function cek_saldo_tabungan(){
		$this->db->from('mcb_rekening_tabungan rt');
		if($this->no_rekening)
			$this->db->where('rt.no_rekening', $this->no_rekening);

		return $this->db->get();
	}

	function cek_saldo_virtual(){
		$this->db->from('mcb_rekening_virtual rv');
		if($this->no_rekening)
			$this->db->where('rv.no_rekening_virtual', $this->no_rekening);

		return $this->db->get();
	}

	function get_nasabah_info(){
		$this->db->select('*, 
    		sumhasil.deskripsi as sumber_penghasilan,
    		masukbl.deskripsi as pemasukan_per_bulan,
    		frekmasukbl.deskripsi as frek_pemasukan_per_bulan,
    		luarbl.deskripsi as pengeluaran_per_bulan,
    		frekluarbl.deskripsi as frek_pengeluaran_per_bulan,
    		sumdana.deskripsi as sumber_dana_setoran,');
		$this->db->from('user_data_keuangan dk');
		$this->db->join('mcb_ref_sumber_penghasilan sumhasil', 'dk.kode_sumber_penghasilan = sumhasil.id_sumber_penghasilan', 'left');
    	$this->db->join('mcb_ref_pemasukan_per_bulan masukbl', 'dk.kode_pemasukan_per_bulan = masukbl.id_pemasukan_per_bulan', 'left');
    	$this->db->join('mcb_ref_frek_pemasukan_per_bulan frekmasukbl', 'dk.kode_frek_pemasukan_per_bulan = frekmasukbl.id_frek_pemasukan', 'left');
    	$this->db->join('mcb_ref_pengeluaran_per_bulan luarbl', 'dk.kode_pengeluaran_per_bulan = luarbl.id_pengeluaran_per_bulan', 'left');
    	$this->db->join('mcb_ref_frek_pengeluaran_per_bulan frekluarbl', 'dk.kode_frek_pengeluaran_per_bulan = frekluarbl.id_frek_pengeluaran', 'left');
    	$this->db->join('mcb_ref_sumber_dana_untuk_setoran sumdana', 'dk.kode_sumber_dana_untuk_setoran = sumdana.id_sumber_dana_untuk_setoran', 'left');
		if($this->id_user)
			$this->db->where('dk.id_user', $this->id_user);
		if($this->no_rekening)
			$this->db->where('dk.no_rekening', $this->no_rekening);

		return $this->db->get();
	}

	function get_nasabah_rekening_tabungan(){
		$this->db->select('rt.*, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi');
		$this->db->from('mcb_rekening_tabungan rt');
		$this->db->join('user_detail ud', 'rt.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = rt.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		if($this->id_koperasi)
			$this->db->where('ui.koperasi', $this->id_koperasi);
		if($this->id_user)
			$this->db->where('rt.id_user', $this->id_user);
		if($this->no_rekening)
			$this->db->where('rt.no_rekening', $this->no_rekening);

		return $this->db->get();
	}

	function get_nasabah_rekening_virtual(){
		$this->db->select('rv.*, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi');
		$this->db->from('mcb_rekening_virtual rv');
		$this->db->join('user_detail ud', 'rv.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = rv.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		if($this->id_koperasi)
			$this->db->where('ui.koperasi', $this->id_koperasi);
		if($this->id_user)
			$this->db->where('rv.id_user', $this->id_user);
		if($this->no_rekening)
			$this->db->where('rv.no_rekening_virtual', $this->no_rekening);

		return $this->db->get();
	}

	function get_nasabah_rekening_loyalti(){
		$this->db->select('rl.*, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi');
		$this->db->from('mcb_rekening_loyalti rl');
		$this->db->join('user_detail ud', 'rl.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = rl.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		if($this->id_koperasi)
			$this->db->where('ui.koperasi', $this->id_koperasi);
		if($this->id_user)
			$this->db->where('rl.id_user', $this->id_user);
		if($this->no_rekening)
			$this->db->where('rl.no_rekening_loyalti', $this->no_rekening);

		return $this->db->get();
	}

	

	function get_log_rekening(){
		$this->db->select('log.*');
		$this->db->from('mcb_log_transaksi log');
		if($this->id_user)
			$this->db->where('log.id_user', $this->id_user);
		if($this->no_rekening){
			$this->db->where('log.no_rekening_primary', $this->no_rekening);
		}
		if($this->kode_transaksi)
			$this->db->where('log.kode_transaksi', $this->no_rekening);
		if($this->tipe_transaksi)
			$this->db->where('log.tipe_transaksi', $this->no_rekening);

		return $this->db->get();
	}

	function get_sumber_penghasilan(){
    	$this->db->from('mcb_ref_sumber_penghasilan');

    	return $this->db->get();
    }

    function get_pemasukan_per_bulan(){
    	$this->db->from('mcb_ref_pemasukan_per_bulan');

    	return $this->db->get();
    }

    function get_frek_pemasukan_per_bulan(){
    	$this->db->from('mcb_ref_frek_pemasukan_per_bulan');

    	return $this->db->get();
    }

    function get_pengeluaran_per_bulan(){
    	$this->db->from('mcb_ref_pengeluaran_per_bulan');

    	return $this->db->get();
    }

    function get_frek_pengeluaran_per_bulan(){
    	$this->db->from('mcb_ref_frek_pengeluaran_per_bulan');

    	return $this->db->get();
    }

    function get_sumber_dana_setoran(){
    	$this->db->from('mcb_ref_sumber_dana_untuk_setoran');

    	return $this->db->get();
    }

	function cek_avail_nasabah(){
		$this->db->from('mcb_rekening_tabungan rt');
		$this->db->where('rt.id_user', $this->id_user);
		$this->db->where('rt.status_rekening !=', 'CLOSED');
		$this->db->limit(1);

		return $this->db->count_all_results() > 0 ? TRUE : FALSE;
	}

	function cari_anggota(){
		$this->db->select('ui.id_user, ui.username, ud.nama_depan, ud.nama_belakang');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ui.id_user', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
		}
		$this->db->limit(10);

		return $this->db->get();
	}

	function cari_nasabah(){
		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, rt.no_rekening as no_rekening, "TABUNGAN" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		$this->db->join('mcb_rekening_tabungan rt', 'rt.id_user = ui.id_user');
		if($this->status_rekening == "ANY")
			$this->db->join('mcb_rekening_tabungan rt', 'rt.id_user = ui.id_user');
		else
			$this->db->join('(SELECT * FROM mcb_rekening_tabungan WHERE status_rekening = "'.$this->status_rekening.'") rt', 'rt.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('rt.no_rekening', $this->keyword);
		}
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->_reset_select();

		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, rv.no_rekening_virtual as no_rekening, "VIRTUAL" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		$this->db->join('mcb_rekening_virtual rv', 'rv.id_user = ui.id_user');
		if($this->status_rekening == "ANY")
			$this->db->join('mcb_rekening_virtual rv', 'rv.id_user = ui.id_user');
		else
			$this->db->join('(SELECT * FROM mcb_rekening_virtual WHERE status_rekening = "'.$this->status_rekening.'") rv', 'rv.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('rv.no_rekening_virtual', $this->keyword);
		}
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->_reset_select();

		return $this->db->query("select * from ($subQuery1 UNION $subQuery2) as unionTable");
	}

	function cari_nasabah_tabungan(){
		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, rt.no_rekening as no_rekening, "TABUNGAN" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		if($this->status_rekening == "ANY")
			$this->db->join('mcb_rekening_tabungan rt', 'rt.id_user = ui.id_user');
		else
			$this->db->join('(SELECT * FROM mcb_rekening_tabungan WHERE status_rekening = "'.$this->status_rekening.'") rt', 'rt.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('rt.no_rekening', $this->keyword);
		}

		return $this->db->get();
	}

	function cari_nasabah_virtual(){
		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, rv.no_rekening_virtual as no_rekening, "VIRTUAL" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		if($this->status_rekening == "ANY")
			$this->db->join('mcb_rekening_virtual rv', 'rv.id_user = ui.id_user');
		else
			$this->db->join('(SELECT * FROM mcb_rekening_virtual WHERE status_rekening = "'.$this->status_rekening.'") rv', 'rv.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('rv.no_rekening_virtual', $this->keyword);
		}

		return $this->db->get();
	}

	function cari_nasabah_all_rek(){
		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, rt.no_rekening as no_rekening, "TABUNGAN" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		$this->db->join('mcb_rekening_tabungan rt', 'rt.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('rt.no_rekening', $this->keyword);
		}
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->_reset_select();

		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, rv.no_rekening_virtual as no_rekening, "VIRTUAL" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		$this->db->join('mcb_rekening_virtual rv', 'rv.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('rv.no_rekening_virtual', $this->keyword);
		}
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->_reset_select();

		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, rl.no_rekening_loyalti as no_rekening, rl.jenis_rekening as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		$this->db->join('mcb_rekening_loyalti rl', 'rl.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('rl.no_rekening_loyalti', $this->keyword);
		}
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->_reset_select();

		return $this->db->query("select * from ($subQuery1 UNION $subQuery2) as unionTable");
	}

	function get_user_info(){
		$this->db->from('user_info ui');
		if($this->id_user)
			$this->db->where('ui.id_user', $this->id_user);
		else
			$this->db->where('ui.id_user', 0);
		$this->db->limit(1);

		return $this->db->get();
	}

	function count_rekening_member(){
		$this->db->from('mcb_rekening_tabungan rt');
		$this->db->join('user_info ui', 'ui.id_user = rt.id_user');
		$this->db->where('ui.koperasi', $this->id_koperasi);

		return $this->db->count_all_results();
	}

	function register_rekening($data){
		if($this->db->insert('mcb_rekening_tabungan', $data))
			return TRUE;
		return FALSE;
	}

	function register_info_keuangan($data){
		if($this->db->insert('user_data_keuangan', $data))
			return TRUE;
		return FALSE;
	}

	function register_rekening_virtual($data){
		if($this->db->insert('mcb_rekening_virtual', $data))
			return TRUE;
		return FALSE;
	}

	function register_rekening_loyalti($data){
		if($this->db->insert_batch('mcb_rekening_loyalti', $data))
			return TRUE;
		return FALSE;
	}

	function record_transaction($data){
		if($this->db->insert('mcb_log_transaksi', $data))
			return TRUE;
		return FALSE;
	}

	function record_transaction2($data){
		if($this->db->insert('mcb_transaksi_rekening', $data))
			return TRUE;
		return FALSE;
	}

	function dec_rekening_tabungan($no_rekening, $nominal){
		$this->db->set('mcb_rekening_tabungan.saldo', 'mcb_rekening_tabungan.saldo - ' . $nominal, false);
		$this->db->where('mcb_rekening_tabungan.no_rekening', $no_rekening);
		if($this->db->update('mcb_rekening_tabungan'))
			return TRUE;
		return FALSE;
	}

	function inc_rekening_tabungan($no_rekening, $nominal){
		$this->db->set('mcb_rekening_tabungan.saldo', 'mcb_rekening_tabungan.saldo + '. $nominal, false);
		$this->db->where('mcb_rekening_tabungan.no_rekening', $no_rekening);
		if($this->db->update('mcb_rekening_tabungan'))
			return TRUE;
		return FALSE;
	}

	function dec_rekening_virtual($no_rekening, $nominal){
		$this->db->set('mcb_rekening_virtual.saldo', 'mcb_rekening_virtual.saldo - '. $nominal, false);
		$this->db->where('mcb_rekening_virtual.no_rekening_virtual', $no_rekening);
		if($this->db->update('mcb_rekening_virtual'))
			return TRUE;
		return FALSE;
	}

	function inc_rekening_virtual($no_rekening, $nominal){
		$this->db->set('mcb_rekening_virtual.saldo', 'mcb_rekening_virtual.saldo + '. $nominal, false);
		$this->db->where('mcb_rekening_virtual.no_rekening_virtual', $no_rekening);
		if($this->db->update('mcb_rekening_virtual'))
			return TRUE;
		return FALSE;
	}

	function clear_rekening_tabungan($no_rek){
		$this->db->where('no_rekening', $no_rek);
		$this->db->delete('mcb_rekening_tabungan');
	}

	function clear_rekening_virtual($no_rek){
		$this->db->where('no_rekening_virtual', $no_rek);
		$this->db->delete('mcb_rekening_virtual');
	}

	function clear_log_transaction($no_transaction){
		$this->db->where('no_transaksi', $no_transaction);
		$this->db->delete('mcb_log_transaksi');
	}

	function update_user_identity($photo){
		$this->db->where('user_detail.scan_ktp', $photo);
		$this->db->where('user_detail.id_user', $this->id_user);
		if($this->db->update('user_detail'))
			return TRUE;
		return FALSE;
	}
	
	function all_transaksi(){
		if($this->session->userdata('level')=='1') {
			$this->db->select('*');
			$this->db->where('id_user', $this->session->userdata('id'));
			$this->db->order_by('tanggal_transaksi', 'asc');
			return $this->db->get('mcb_log_transaksi');
		}
		else {
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = mcb_log_transaksi.id_user');
			$this->db->where('id_user', $this->session->userdata('id'));
			$this->db->where('koperasi', $this->session->userdata('koperasi'));
			$this->db->order_by('tanggal_transaksi', 'asc');
			return $this->db->get('mcb_log_transaksi');
		}
	}

	function update_status_rekening($status){
		$this->db->set('mcb_rekening_tabungan.status_rekening', $status);
		$this->db->where('mcb_rekening_tabungan.id_user', $this->id_user);
		$this->db->update('mcb_rekening_tabungan');

		$this->db->set('mcb_rekening_loyalti.status_rekening', $status);
		$this->db->where('mcb_rekening_loyalti.id_user', $this->id_user);
		$this->db->update('mcb_rekening_loyalti');

		$this->db->set('mcb_rekening_virtual.status_rekening', $status);
		$this->db->where('mcb_rekening_virtual.id_user', $this->id_user);
		$this->db->update('mcb_rekening_virtual');
	}


}