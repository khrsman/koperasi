<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_mod extends CI_Model {

	var $keyword, $id_user, $id_koperasi, $no_rekening, $tipe_transaksi, $kode_transaksi, $jenis_rekening, $no_transaksi, $status_rekening = "ANY", $tipe_rekening, $kode_vendor, $kode_operator, $kode_kategori_produk, $kode_produk, $last = FALSE, $date_to, $date_from, $sumber_dana, $jenis_akun, $offset;

	public function __construct()
	{
		parent::__construct();
	}

	function cek_rekening_non_member($tipe){
		$this->db->from('mcb_rekening_non_member rnm');
		if($this->id_koperasi)
			$this->db->where('rnm.id_koperasi', $this->id_koperasi);
		if($tipe)
			$this->db->where('rnm.tipe_rekening', $tipe);

		return $this->db->count_all_results();
	}

	function cek_pin($pin){
		$this->db->from('user_detail ud');
		$this->db->join('mcb_rekening_tabungan rt', 'rt.id_user = ud.id_user AND rt.status_rekening = "ACTIVE"');
		if($this->id_user)
			$this->db->where('ud.id_user', $this->id_user);
		$this->db->where('ud.user_ver', $pin);

		return $this->db->count_all_results();
	}

	function cek_status_rekening(){
		$this->db->from('mcb_rekening_tabungan rt');
		if($this->id_user)
			$this->db->where('rt.id_user', $this->id_user);
		$this->db->where('rt.status_rekening', 'ACTIVE');

		return $this->db->count_all_results();
	}

	function cek_saldo_tabungan(){
		$this->db->from('mcb_rekening_tabungan rt');
		if($this->no_rekening)
			$this->db->where('rt.no_rekening', $this->no_rekening);
		if($this->id_user)
			$this->db->where('rt.id_user', $this->id_user);

		return $this->db->get();
	}

	function cek_saldo_virtual(){
		$this->db->from('mcb_rekening_virtual rv');
		if($this->no_rekening)
			$this->db->where('rv.no_rekening_virtual', $this->no_rekening);
		if($this->id_user)
			$this->db->where('rv.id_user', $this->id_user);

		return $this->db->get();
	}

	function get_koperasi_profit_sharing(){
		$this->db->select('*, kp.id_koperasi');
		$this->db->from('(SELECT * FROM koperasi WHERE status_active = 1) kp');
		$this->db->join('profit_rule_sharing prs', 'prs.id_koperasi = kp.id_koperasi', 'left');

		return $this->db->get();
	}

	function get_rekening_favorit(){
		$this->db->select('dtu.*');
		$this->db->from('mcb_daftar_transfer_user dtu');
		if($this->no_rekening)
			$this->db->where('dtu.no_rekening', $this->no_rekening);
		if($this->id_user)
			$this->db->where('dtu.id_user', $this->id_user);
		if($this->jenis_rekening)
			$this->db->where('dtu.jenis_account', $this->jenis_rekening);

		return $this->db->get();
	}

	function get_detail_transaction_log(){
		$this->db->select('log.*, ui.username as nama_operator');
		if($this->no_transaksi)
			$this->db->where('log.no_transaksi', $this->no_transaksi);
		$this->db->from('mcb_log_transaksi log');
		$this->db->join('user_info ui', 'ui.id_user = log.service_user');

		return $this->db->get();
	}

	function get_detail_rekening_transaction(){
		$this->db->select('tr.*');
		if($this->no_transaksi)
			$this->db->where('tr.no_transaksi_rekening', $this->no_transaksi);
		$this->db->from('mcb_transaksi_rekening tr');

		return $this->db->get();
	}

	function cek_profit_sharing_rule($id_koperasi){
		$this->db->from('profit_rule_sharing');
		$this->db->where('id_koperasi', $id_koperasi);

		return $this->db->count_all_results();
	}

	function save_profit_sharing_rule($data){
		if($this->cek_profit_sharing_rule($data['id_koperasi']) > 0){
			$this->db->where('id_koperasi', $data['id_koperasi']);
			if($this->db->update('profit_rule_sharing', $data))
				return TRUE;
			return FALSE;
		} else {
			if($this->db->insert('profit_rule_sharing', $data))
				return TRUE;
			return FALSE;
		}
	}

	function cek_rekening_favorit(){
		$this->db->from('mcb_daftar_transfer_user dtu');
		if($this->no_rekening)
			$this->db->where('dtu.no_rekening', $this->no_rekening);
		if($this->id_user)
			$this->db->where('dtu.id_user', $this->id_user);

		return $this->db->count_all_results();
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

	function get_nasabah_rekening_non_member(){
		$this->db->select('
			rnb.*, kp.nama as nama_koperasi');
		$this->db->from('mcb_rekening_non_member rnb');
		$this->db->join('koperasi kp', 'kp.id_koperasi = rnb.id_koperasi');
		if($this->tipe_rekening)
			$this->db->where('rnb.tipe_rekening', $this->tipe_rekening);
		if($this->id_koperasi)
			$this->db->where('rnb.id_koperasi', $this->id_koperasi);

		return $this->db->get();
	}

	function get_nasabah_rekening_deposito(){
		$this->db->select('
			dp.*, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi');
		$this->db->from('mcb_deposito dp');
		$this->db->join('mcb_rekening_tabungan rt', 'rt.no_rekening = dp.no_rekening_user');
		$this->db->join('user_detail ud', 'rt.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = rt.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		if($this->last){
			$this->db->order_by('dp.no_rekening_deposito', 'desc');
			$this->db->limit(1);
		}
		if($this->id_koperasi)
			$this->db->where('kp.id_koperasi', $this->id_koperasi);

		return $this->db->get();
	}

	function get_nasabah_rekening_pinjaman(){
		$this->db->select('
			pnj.*, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi, (SELECT COUNT(id_angsuran) FROM mcb_angsuran WHERE no_rekening_pinjaman = pnj.no_rekening_pinjaman) as count_angsuran');
		$this->db->from('mcb_pinjaman pnj');
		$this->db->join('user_detail ud', 'pnj.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = pnj.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		if($this->last){
			$this->db->order_by('pnj.no_rekening_pinjaman', 'desc');
			$this->db->limit(1);
		}
		if($this->id_koperasi)
			$this->db->where('kp.id_koperasi', $this->id_koperasi);
		if($this->no_rekening)
			$this->db->where('pnj.no_rekening_pinjaman', $this->no_rekening);

		return $this->db->get();
	}

	function get_angsuran(){
		$this->db->from('mcb_angsuran ang');
		if ($this->no_rekening)
			$this->db->where('ang.no_rekening_pinjaman', $this->no_rekening);
		$this->db->order_by('ang.tanggal_bayar DESC, ang.angsuran_ke DESC');

		return $this->db->get();
	}

	function get_kredit_cicilan(){
		$this->db->from('mcb_kredit_cicilan kcl');
		if ($this->no_rekening)
			$this->db->where('kcl.no_rekening_kredit', $this->no_rekening);
		$this->db->order_by('kcl.tanggal_bayar DESC, kcl.angsuran_ke DESC');

		return $this->db->get();
	}

	function get_jaminan_kredit(){
		$this->db->from('mcb_kredit_jaminan kjm');
		if ($this->no_rekening)
			$this->db->where('kjm.no_rekening_kredit', $this->no_rekening);

		return $this->db->get();
	}

	function get_nasabah_rekening_kredit_cicilan(){
		$this->db->select('
			krd.*, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi, (SELECT COUNT(id_angsuran) FROM mcb_kredit_cicilan WHERE no_rekening_kredit = krd.no_rekening_kredit) as count_angsuran');
		$this->db->from('mcb_kredit krd');
		$this->db->join('user_detail ud', 'krd.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = krd.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		if($this->last){
			$this->db->order_by('krd.no_rekening_kredit', 'desc');
			$this->db->limit(1);
		}
		if($this->id_koperasi)
			$this->db->where('kp.id_koperasi', $this->id_koperasi);
		if($this->no_rekening)
			$this->db->where('krd.no_rekening_kredit', $this->no_rekening);

		return $this->db->get();
	}

	function register_rekening_deposito($data){
		if ($this->db->insert('mcb_deposito', $data))
			return TRUE;
		return FALSE;
	}

	function register_rekening_pinjaman($data){
		if ($this->db->insert('mcb_pinjaman', $data))
			return TRUE;
		return FALSE;
	}

	function update_rekening_pinjaman($no_rekening_pinjaman, $data){
		$this->db->where('no_rekening_pinjaman', $no_rekening_pinjaman);
		if ($this->db->update('mcb_pinjaman', $data)) 
			return TRUE;
		return FALSE;
	}

	function register_rekening_kredit_cicilan($data){
		if ($this->db->insert('mcb_kredit', $data))
			return TRUE;
		return FALSE;
	}

	function register_jaminan_kredit($data){
		if ($this->db->insert_batch('mcb_kredit_jaminan', $data))
			return TRUE;
		return FALSE;
	}

	function update_rekening_kredit_cicilan($no_rekening_kredit, $data){
		$this->db->where('no_rekening_kredit', $no_rekening_kredit);
		if ($this->db->update('mcb_kredit', $data)) 
			return TRUE;
		return FALSE;
	}

	function register_angsuran($data){
		if ($this->db->insert('mcb_angsuran', $data))
			return TRUE;
		return FALSE;
	}

	function register_kredit_cicilan($data){
		if ($this->db->insert('mcb_kredit_cicilan', $data))
			return TRUE;
		return FALSE;
	}

	function get_non_member_profit(){
		$this->db->from('profit_rule_koperasi prk');
		if($this->id_koperasi)
			$this->db->where('prk.id_koperasi', $this->id_koperasi);

		return $this->db->get();
	}

	function get_nasabah_rekening(){
		$this->db->select('
			rt.id_user, rt.saldo as saldo_tabungan, rt.tanggal_registrasi, rt.tanggal_transaksi_terakhir, rv.saldo as saldo_virtual, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi, (SELECT SUM(saldo) as saldo_loyalti FROM mcb_rekening_loyalti WHERE id_user = rt.id_user AND status_rekening = rt.status_rekening) as saldo_loyalti');
		$this->db->from('mcb_rekening_tabungan rt');
		$this->db->join('user_detail ud', 'rt.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = rt.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		$this->db->join('mcb_rekening_virtual rv', 'rv.id_user = rt.id_user AND rt.status_rekening = rv.status_rekening');
		if($this->id_koperasi)
			$this->db->where('ui.koperasi', $this->id_koperasi);
		if($this->status_rekening != "ANY")
			$this->db->where('rt.status_rekening', $this->status_rekening);
		if($this->id_user)
			$this->db->where('rt.id_user', $this->id_user);

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
		if($this->status_rekening != "ANY")
			$this->db->where('rt.status_rekening', $this->status_rekening);
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
		if($this->status_rekening != "ANY")
			$this->db->where('rv.status_rekening', $this->status_rekening);
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
		if($this->status_rekening != "ANY")
			$this->db->where('rl.status_rekening', $this->status_rekening);
		if($this->no_rekening)
			$this->db->where('rl.no_rekening_loyalti', $this->no_rekening);

		return $this->db->get();
	}

	function get_nasabah_rekening_loyalti_summary(){
		$this->db->select('SUM(rl.saldo) as saldo_loyalti, rl.*, ud.nama_lengkap, ui.koperasi, kp.nama as nama_koperasi');
		$this->db->from('mcb_rekening_loyalti rl');
		$this->db->join('user_detail ud', 'rl.id_user = ud.id_user');
		$this->db->join('user_info ui', 'ui.id_user = rl.id_user');
		$this->db->join('koperasi kp', 'kp.id_koperasi = ui.koperasi');
		if($this->id_koperasi)
			$this->db->where('ui.koperasi', $this->id_koperasi);
		if($this->status_rekening != "ANY")
			$this->db->where('rl.status_rekening', $this->status_rekening);
		if($this->id_user)
			$this->db->where('rl.id_user', $this->id_user);
		$this->db->group_by('rl.id_user');

		return $this->db->get();
	}

	function get_log_rekening(){
		$this->db->select('log.*');
		$this->db->from('mcb_log_transaksi log');
		if($this->id_user)
			$this->db->where('log.id_user', $this->id_user);
		if($this->no_rekening){
			if(is_array($this->no_rekening))
				$this->db->where_in('log.no_rekening_primary', $this->no_rekening);
			else
				$this->db->where('log.no_rekening_primary', $this->no_rekening);
		}
		if($this->kode_transaksi)
			$this->db->where('log.kode_transaksi', $this->no_rekening);
		if($this->tipe_transaksi)
			$this->db->where('log.tipe_transaksi', $this->tipe_transaksi);
		$this->db->order_by('log.service_time desc, log.jenis_transaksi desc', '');

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

	function get_info_anggota($id){
		$this->db->select('ud.id_user, ud.nama_depan, ud.nama_belakang, ud.jenis_kelamin, ud.agama, ud.tempat_lahir, ud.tgl_lahir, ud.jenis_id, ud.no_ktp, ud.provinsi, ud.kabupaten, ud.kode_pos, ud.alamat, ud.telp, ud.telp2, ud.telp3, ud.pendidikan_terakhir');
		$this->db->from('user_detail ud');
		if ($id)
			$this->db->where('ud.id_user', $id);

		return $this->db->get();
	}

	function cari_koperasi(){
		$this->db->from('(SELECT * FROM koperasi WHERE status_active = 1) kp');
		if($this->keyword){
			$this->db->like('kp.nama', $this->keyword);
			$this->db->or_like('kp.id_koperasi', $this->keyword);
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

		return $this->db->query("select * from ($subQuery1 UNION $subQuery2) as unionTable limit 10");
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

	function cari_nasabah_pinjaman(){
		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, pnj.no_rekening_pinjaman as no_rekening, "PINJAMAN" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		$this->db->join('mcb_pinjaman pnj', 'pnj.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('pnj.no_rekening_pinjaman', $this->keyword);
		}

		return $this->db->get();
	}

	function cari_nasabah_kredit(){
		$this->db->select('ui.id_user as id_user, ui.username as username, ud.nama_depan as nama_depan, ud.nama_belakang as nama_belakang, krd.no_rekening_kredit as no_rekening, "KREDIT" as jenis_rekening');
		if($this->id_koperasi)
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND koperasi = "'.$this->id_koperasi.'" AND status_active = 1) ui');
		else
			$this->db->from('(SELECT * FROM user_info WHERE level = 3 AND status_active = 1) ui');
		$this->db->join('user_detail ud', 'ui.id_user = ud.id_user');
		$this->db->join('mcb_kredit krd', 'krd.id_user = ui.id_user');
		if($this->keyword){
			$this->db->like('ui.username', $this->keyword);
			$this->db->or_like('ud.nama_depan', $this->keyword);
			$this->db->or_like('ud.nama_belakang', $this->keyword);
			$this->db->or_like('krd.no_rekening_kredit', $this->keyword);
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
		$subQuery3 = $this->db->get_compiled_select();

		$this->db->_reset_select();

		return $this->db->query("select * from ($subQuery1 UNION $subQuery2 UNION $subQuery3) as unionTable limit 10");
	}

	function get_user_info(){
		$this->db->select('ui.*, ud.nama_lengkap');
		$this->db->from('user_info ui');
		$this->db->join('user_detail ud', 'ud.id_user = ui.id_user');
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

	function setting_profit_koperasi($id_koperasi, $data){
		$this->db->where('id_koperasi', $id_koperasi);
		$this->db->delete('profit_rule_koperasi');

		if($this->db->insert_batch('profit_rule_koperasi', $data))
			return TRUE;
		return FALSE;
	}

	function register_rekening($data){
		if($this->db->insert('mcb_rekening_tabungan', $data))
			return TRUE;
		return FALSE;
	}

	function register_rekening_non_member($data){
		if($this->db->insert('mcb_rekening_non_member', $data))
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

	function register_rekening_fav($data){
		if($this->db->insert('mcb_daftar_transfer_user', $data))
			return TRUE;
		return FALSE;
	}

	function remove_rekening_fav($no_rekening){
		$this->db->where('mcb_daftar_transfer_user.id_user', $this->id_user);
		$this->db->where('mcb_daftar_transfer_user.no_rekening', $no_rekening);
		if($this->db->delete('mcb_daftar_transfer_user'))
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
		$this->db->set('user_detail.scan_ktp', $photo);
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

		return TRUE;
	}


	// FROM MCB MODEL

	function get_member_detail(){
    	$this->db->select('
    		m.*,
    		ktr.NAMA as nama_kantor,
    		jk.deskripsi as nama_jenis_kelamin,
    		agm.deskripsi as nama_agama,
    		jnsid.deskripsi as nama_jenis_id,
    		prov.nama as nama_provinsi,
    		kab.nama as nama_kota_kab,
    		prov2.nama as nama_provinsi2,
    		kerjans.deskripsi as nama_pekerjaan,
    		pendns.deskripsi as nama_pendidikan,
    		keangns.deskripsi as nama_keanggotaan,
    		sumhasil.deskripsi as nama_sumber_hasil,
    		masukbl.deskripsi as pemasukan_per_bulan,
    		frekmasukbl.deskripsi as frek_pemasukan_per_bulan,
    		luarbl.deskripsi as pengeluaran_per_bulan,
    		frekluarbl.deskripsi as frek_pengeluaran_per_bulan,
    		sumdana.deskripsi as sumber_dana_setoran,
    		jk1.deskripsi as nama_waris_jenis_kelamin1,
    		jk2.deskripsi as nama_waris_jenis_kelamin2,
    		jk3.deskripsi as nama_waris_jenis_kelamin3,
    		negara.deskripsi as nama_negara,
    		goldeb.deskripsi as nama_gol_debitur,
    		krjdeb.deskripsi as nama_kerja_debitur,
    		bidush.deskripsi as nama_bidang_usaha,
    		hubdeb.deskripsi as nama_hub_bank_debitur,
    		jnsdeb.deskripsi as nama_jenis_debitur,
    		statgel.deskripsi as nama_status_gelar
    		');
    	$this->db->from('mcb_nasabah m');
    	$this->db->join('mcb_ref_kantor ktr', 'm.kode_kantor = ktr.ID_KANTOR', 'left');
    	$this->db->join('mcb_ref_jenis_kelamin jk', 'm.jenis_kelamin = jk.id_jenis_kelamin', 'left');
    	$this->db->join('mcb_ref_agama agm', 'm.kode_agama = agm.id_agama', 'left');
    	$this->db->join('mcb_ref_jenis_identitas jnsid', 'm.jenis_id = jnsid.id_jenis_identitas', 'left');
    	$this->db->join('ref_provinsi prov', 'm.provinsi = prov.id_provinsi', 'left');
    	$this->db->join('ref_kabupaten kab', 'm.kota_kab = kab.id_kabupaten AND prov.id_provinsi = kab.id_provinsi', 'left');
    	$this->db->join('ref_provinsi prov2', 'm.lokasi_usaha = prov2.id_provinsi', 'left');
    	$this->db->join('mcb_ref_pekerjaan_nasabah kerjans', 'm.kode_group1 = kerjans.id_pekerjaan_nasabah', 'left');
    	$this->db->join('mcb_ref_pendidikan pendns', 'm.kode_group2 = pendns.kode_pendidikan', 'left');
    	$this->db->join('mcb_ref_keanggotaan keangns', 'm.kode_group3 = keangns.id_keanggotaan', 'left');
    	$this->db->join('mcb_ref_sumber_penghasilan sumhasil', 'm.kode_sumber_penghasilan = sumhasil.id_sumber_penghasilan', 'left');
    	$this->db->join('mcb_ref_pemasukan_per_bulan masukbl', 'm.kode_pemasukan_per_bulan = masukbl.id_pemasukan_per_bulan', 'left');
    	$this->db->join('mcb_ref_frek_pemasukan_per_bulan frekmasukbl', 'm.kode_frek_pemasukan_per_bulan = frekmasukbl.id_frek_pemasukan', 'left');
    	$this->db->join('mcb_ref_pengeluaran_per_bulan luarbl', 'm.kode_pengeluaran_per_bulan = luarbl.id_pengeluaran_per_bulan', 'left');
    	$this->db->join('mcb_ref_frek_pengeluaran_per_bulan frekluarbl', 'm.kode_frek_pengeluaran_per_bulan = frekluarbl.id_frek_pengeluaran', 'left');
    	$this->db->join('mcb_ref_sumber_dana_untuk_setoran sumdana', 'm.kode_sumber_dana_untuk_setoran = sumdana.id_sumber_dana_untuk_setoran', 'left');
    	$this->db->join('mcb_ref_jenis_kelamin jk1', 'm.waris_jenis_kelamin = jk1.id_jenis_kelamin', 'left');
    	$this->db->join('mcb_ref_jenis_kelamin jk2', 'm.waris_jenis_kelamin2 = jk2.id_jenis_kelamin', 'left');
    	$this->db->join('mcb_ref_jenis_kelamin jk3', 'm.waris_jenis_kelamin2 = jk3.id_jenis_kelamin', 'left');
    	$this->db->join('mcb_ref_negara negara', 'm.negara_domisili = negara.id_negara', 'left');
    	$this->db->join('mcb_ref_gol_debitur goldeb', 'm.gol_debitur = goldeb.id_gol_debitur', 'left');
    	$this->db->join('mcb_ref_pekerjaan_debitur krjdeb', 'm.sandi_pekerjaan = krjdeb.id_pekerjaan_debitur', 'left');
    	$this->db->join('mcb_ref_sektor_ekonomi bidush', 'm.bidang_usaha = bidush.id_sektor_ekonomi', 'left');
    	$this->db->join('mcb_ref_hubungan_bank_debitur hubdeb', 'm.hub_dgn_bank = hubdeb.id_hub_bank_debitur', 'left');
    	$this->db->join('mcb_ref_jenis_debitur jnsdeb', 'm.jenis_debitur = jnsdeb.id_jenis_debitur', 'left');
    	$this->db->join('mcb_ref_status_gelar statgel', 'm.status_gelar = statgel.id_status_gelar', 'left');

        if($this->nasabah_id)
            $this->db->where('m.nasabah_id', $this->nasabah_id);
        $this->db->limit(1);
        if($this->rumus->db['ofs'])
            $this->db->where('m.nasabah_id < ', $this->rumus->db['ofs']);
        $this->db->order_by('m.nasabah_id', 'DESC');

    	return $this->db->get();
    }

    function get_kantor(){
    	$this->db->from('mcb_ref_kantor');

    	return $this->db->get();
    }

    function get_jenis_kelamin(){
    	$this->db->from('mcb_ref_jenis_kelamin');

    	return $this->db->get();
    }

    function get_agama(){
    	$this->db->from('ref_agama');

    	return $this->db->get();
    }

    function get_jenis_identitas(){
    	$this->db->from('mcb_ref_jenis_identitas');

    	return $this->db->get();
    }

    function get_provinsi(){
    	$this->db->from('ref_provinsi');
    	$this->db->order_by('ref_provinsi.nama', 'ASC');

    	return $this->db->get();
    }

    function get_kota(){
    	$this->db->from('ref_kabupaten');
    	if($this->id_prov)
    		$this->db->where('ref_kabupaten.id_provinsi', $this->id_prov);
    	$this->db->order_by('ref_kabupaten.nama', 'ASC');

    	return $this->db->get();
    }

    function get_pekerjaan(){
    	$this->db->from('ref_pekerjaan_nasabah');

    	return $this->db->get();
    }

    function get_pendidikan(){
    	$this->db->from('ref_pendidikan');

    	return $this->db->get();
    }

    function get_keanggotaan(){
    	$this->db->from('mcb_ref_keanggotaan');

    	return $this->db->get();
    }

    // function get_sumber_penghasilan(){
    // 	$this->db->from('mcb_ref_sumber_penghasilan');

    // 	return $this->db->get();
    // }

    // function get_pemasukan_per_bulan(){
    // 	$this->db->from('mcb_ref_pemasukan_per_bulan');

    // 	return $this->db->get();
    // }

    // function get_frek_pemasukan_per_bulan(){
    // 	$this->db->from('mcb_ref_frek_pemasukan_per_bulan');

    // 	return $this->db->get();
    // }

    // function get_pengeluaran_per_bulan(){
    // 	$this->db->from('mcb_ref_pengeluaran_per_bulan');

    // 	return $this->db->get();
    // }

    // function get_frek_pengeluaran_per_bulan(){
    // 	$this->db->from('mcb_ref_frek_pengeluaran_per_bulan');

    // 	return $this->db->get();
    // }

    // function get_sumber_dana_setoran(){
    // 	$this->db->from('mcb_ref_sumber_dana_untuk_setoran');

    // 	return $this->db->get();
    // }

    function get_negara(){
    	$this->db->from('ref_negara');

    	return $this->db->get();
    }

    function get_gol_debitur(){
    	$this->db->from('ref_gol_debitur');

    	return $this->db->get();
    }

    function get_pekerjaan_debitur(){
    	$this->db->from('ref_pekerjaan_debitur');

    	return $this->db->get();
    }

    function get_bidang_usaha_debitur(){
    	$this->db->from('mcb_ref_sektor_ekonomi');

    	return $this->db->get();
    }

    function get_hubungan_bank_debitur(){
    	$this->db->from('ref_hubungan_bank');

    	return $this->db->get();
    }

    function get_jenis_debitur(){
    	$this->db->from('mcb_ref_jenis_debitur');

    	return $this->db->get();
    }

    function get_status_gelar(){
    	$this->db->from('mcb_ref_status_gelar');

    	return $this->db->get();
    }

    function register_nasabah($data){
    	if(!$this->db->insert('mcb_nasabah', $data))
			return FALSE;
		return TRUE;
    }

    function delete_nasabah($member_id){
    	$this->db->where('mcb_nasabah.nasabah_id', $member_id);
    	if(!$this->db->delete('mcb_nasabah'))
			return FALSE;
		return TRUE;
    }



    // VENDORS

    function get_vendor(){
    	$this->db->from('gerai_vendor');
    	if($this->kode_vendor)
    		$this->db->where('kode_vendor', $this->kode_vendor);

    	return $this->db->get();
    }

    function create_vendor($data){
    	if ($this->db->insert('gerai_vendor', $data))
    		return TRUE;
    	return FALSE;
    }

    function update_vendor($id, $data){
    	$this->db->where('gv.kode_vendor', $id);
    	if ($this->db->update('gerai_vendor gv', $data))
    		return TRUE;
    	return FALSE;
    }

    function delete_vendor($id){
    	$this->db->where('kode_vendor', $id);
    	if ($this->db->delete('gerai_vendor'))
    		return TRUE;
    	return FALSE;
    }

    function get_operator(){
    	$this->db->from('gerai_operator');
    	if($this->kode_operator)
    		$this->db->where('kode_operator', $this->kode_operator);

    	return $this->db->get();
    }

    function create_operator($data){
    	if ($this->db->insert('gerai_operator', $data))
    		return TRUE;
    	return FALSE;
    }

    function update_operator($id, $data){
    	$this->db->where('gv.kode_operator', $id);
    	if ($this->db->update('gerai_operator gv', $data))
    		return TRUE;
    	return FALSE;
    }

    function delete_operator($id){
    	$this->db->where('kode_operator', $id);
    	if ($this->db->delete('gerai_operator'))
    		return TRUE;
    	return FALSE;
    }

    function get_kategori_produk(){
    	$this->db->from('gerai_kategori_produk');
    	if($this->kode_kategori_produk)
    		$this->db->where('kode_kategori_produk', $this->kode_kategori_produk);

    	return $this->db->get();
    }

    function create_kategori_produk($data){
    	if ($this->db->insert('gerai_kategori_produk', $data))
    		return TRUE;
    	return FALSE;
    }

    function update_kategori_produk($id, $data){
    	$this->db->where('gv.kode_kategori_produk', $id);
    	if ($this->db->update('gerai_kategori_produk gv', $data))
    		return TRUE;
    	return FALSE;
    }

    function delete_kategori_produk($id){
    	$this->db->where('kode_kategori_produk', $id);
    	if ($this->db->delete('gerai_kategori_produk'))
    		return TRUE;
    	return FALSE;
    }

    function get_vendor_produk(){
    	$this->db->from('gerai_vendor_produk gvp');
    	$this->db->join('gerai_operator go', 'go.kode_operator = gvp.kode_operator');
    	$this->db->join('gerai_vendor gv', 'gv.kode_vendor = gvp.kode_vendor');
    	$this->db->join('gerai_kategori_produk gkp', 'gkp.kode_kategori_produk = gvp.kode_kategori_produk');
    	if($this->kode_produk)
    		$this->db->where('gvp.kode_produk', $this->kode_produk);

    	return $this->db->get();
    }

    function create_vendor_produk($data){
    	if ($this->db->insert('gerai_vendor_produk', $data))
    		return TRUE;
    	return FALSE;
    }

    function update_vendor_produk($id, $data){
    	$this->db->where('gv.kode_produk', $id);
    	if ($this->db->update('gerai_vendor_produk gv', $data))
    		return TRUE;
    	return FALSE;
    }

    function delete_vendor_produk($id){
    	$this->db->where('kode_produk', $id);
    	if ($this->db->delete('gerai_vendor_produk'))
    		return TRUE;
    	return FALSE;
    }

    function get_shu_stats_pinjaman(){
    	$this->db->select('SUM(jumlah_pinjaman) as jumlah_pinjaman, SUM(potongan_adm) as potongan_adm, SUM(potongan_cr) as potongan_cr,SUM(potongan_materai) as potongan_materai,SUM(potongan_notaris) as potongan_notaris,SUM(potongan_adm) as potongan_tab_wajib,SUM(potongan_premi) as potongan_premi');
    	$this->db->from('mcb_pinjaman pnj'); 
    	$this->db->join('user_info ui', 'ui.id_user = pnj.id_user');
    	if($this->id_koperasi)
	    	$this->db->where('ui.koperasi', $this->id_koperasi);

    	return $this->db->get();
    }

    function get_shu_stats_angsuran(){
    	$this->db->select('SUM(jumlah_setoran) as jumlah_setoran, SUM(jumlah_denda) as jumlah_denda');
    	$this->db->from('mcb_angsuran ang');
    	$this->db->join('mcb_pinjaman pnj', 'pnj.no_rekening_pinjaman = ang.no_rekening_pinjaman');
    	$this->db->join('user_info ui', 'ui.id_user = pnj.id_user');
    	if($this->id_koperasi)
	    	$this->db->where('ui.koperasi', $this->id_koperasi);

	    return $this->db->get();
    }

    function get_shu_stats_deposito(){
    	$this->db->select('SUM(jumlah_deposito) as jumlah_deposito');
    	$this->db->from('mcb_deposito dp');
    	$this->db->join('user_info ui', 'ui.id_user = dp.id_user');
    	if($this->id_koperasi)
	    	$this->db->where('ui.koperasi', $this->id_koperasi);

	    return $this->db->get();
    }

    function get_shu_stats_pendapatan(){
    	$this->db->select('kop.nama nama_koperasi, log.sumber_dana, sum(nilai_transaksi) nilai, log.jenis_account koperasi');
    	$this->db->from('transaksi trx');
    	$this->db->join('mcb_log_transaksi_non_member log', 'no_ref_transaksi = trx.no_transaksi', 'right');
    	$this->db->join('mcb_rekening_non_member rek', 'rek.no_rekening = log.no_rekening_non_member', 'left');
    	$this->db->join('koperasi kop', 'rek.id_koperasi = kop.id_koperasi', 'left');
    	if($this->id_koperasi)
	    	$this->db->where('kop.id_koperasi', $this->id_koperasi);
	    $this->db->where('log.jenis_account != ', 'KETUA');
    	$this->db->having('koperasi <> "SMIDUMAY"');
    	$this->db->group_by('log.jenis_account, log.sumber_dana');

    	return $this->db->get();
    }

    function get_shu_stats_pengeluaran(){
    	$this->db->select('kop.nama nama_koperasi, kop.sumber_dana jenis_biaya,  sum(prod.price_n) biaya, kop.id_koperasi');
    	$this->db->from('transaksi trx');
    	$this->db->join('detail_transaksi dtl', 'dtl.no_transaksi = trx.no_transaksi');
    	$this->db->join('produk prod', 'dtl.id_produk = prod.id_produk');
    	$this->db->join('(SELECT kop.nama, sum(nilai_transaksi) pendapatan, log.jenis_account, log.sumber_dana, kop.id_koperasi,log.no_ref_transaksi no_transaksi
	     FROM transaksi trx
		join mcb_log_transaksi_non_member log on no_ref_transaksi = trx.no_transaksi	 
		left join mcb_rekening_non_member rek on rek.no_rekening = log.no_rekening_non_member
		left join koperasi kop on rek.id_koperasi = kop.id_koperasi
		where kop.nama is not null
  GROUP BY log.no_ref_transaksi) kop', 'kop.no_transaksi = trx.no_transaksi');
    	if($this->id_koperasi)
	    	$this->db->where('kop.id_koperasi', $this->id_koperasi);
    	$this->db->group_by('kop.nama');

    	return $this->db->get();
    }

    function get_profit_koperasi(){
    	$this->db->select('kop.nama nama_koperasi, log.sumber_dana, sum(nilai_transaksi) nilai, log.jenis_account account');
    	$this->db->from('transaksi trx');
    	$this->db->join('mcb_log_transaksi_non_member log', 'no_ref_transaksi = trx.no_transaksi','right');
    	$this->db->join('mcb_rekening_non_member rek', 'rek.no_rekening = log.no_rekening_non_member', 'left');
    	$this->db->join('koperasi kop', 'rek.id_koperasi = kop.id_koperasi', 'left');
    	$this->db->where('log.jenis_account != ', 'ANGGOTA');
    	// $this->db->where('kop.id_koperasi', 0);
    	if($this->id_koperasi)
	    	$this->db->where('kop.id_koperasi', $this->id_koperasi);
	    $this->db->group_by('log.jenis_account, log.sumber_dana');

    	return $this->db->get();
    }

    function get_profit_smidumay(){
    	$this->db->select('kop.nama nama_koperasi, log.sumber_dana, sum(nilai_transaksi) nilai, log.jenis_account account');
    	$this->db->from('transaksi trx');
    	$this->db->join('mcb_log_transaksi_non_member log', 'no_ref_transaksi = trx.no_transaksi', 'right');
    	$this->db->join('mcb_rekening_non_member rek', 'rek.no_rekening = log.no_rekening_non_member', 'left');
    	$this->db->join('koperasi kop', 'rek.id_koperasi = kop.id_koperasi', 'left');
    	$this->db->where('log.jenis_account', 'SMIDUMAY');
	    $this->db->group_by('log.jenis_account, log.sumber_dana');

    	return $this->db->get();
    }

    function get_log_profit_koperasi(){
    	$this->db->select('kop.nama nama_koperasi, log.no_transaksi, log.tanggal_transaksi, log.sumber_dana, nilai_transaksi nilai, log.jenis_account account');
    	$this->db->from('transaksi trx');
    	$this->db->join('mcb_log_transaksi_non_member log', 'no_ref_transaksi = trx.no_transaksi', 'right');
    	$this->db->join('mcb_rekening_non_member rek', 'rek.no_rekening = log.no_rekening_non_member', 'left');
    	$this->db->join('koperasi kop', 'rek.id_koperasi = kop.id_koperasi', 'left');
    	$this->db->where('log.jenis_account != ', 'ANGGOTA');
    	// $this->db->where('kop.id_koperasi', 0);
    	if($this->id_koperasi)
	    	$this->db->where('kop.id_koperasi', $this->id_koperasi);
	    if($this->sumber_dana)
	    	$this->db->where('log.sumber_dana', $this->sumber_dana);
	    if($this->jenis_akun)
	    	$this->db->where('log.jenis_account', $this->jenis_akun);
	    if($this->date_from)
	    	$this->db->where('DATE(log.tanggal_transaksi) >= ', $this->date_from);
	    if($this->offset)
	    	$this->db->where('log.tanggal_transaksi < ', $this->offset);
	    else if($this->date_to)
	    	$this->db->where('DATE(log.tanggal_transaksi) <= ', $this->date_to);
	    $this->db->order_by('log.tanggal_transaksi', 'desc');
	    $this->db->limit(10);

    	return $this->db->get();
    }

    function get_log_profit_smidumay(){
    	$this->db->select('kop.nama nama_koperasi, log.no_transaksi, log.tanggal_transaksi, log.sumber_dana, nilai_transaksi nilai, log.jenis_account account');
    	$this->db->from('transaksi trx');
    	$this->db->join('mcb_log_transaksi_non_member log', 'no_ref_transaksi = trx.no_transaksi','right');
    	$this->db->join('mcb_rekening_non_member rek', 'rek.no_rekening = log.no_rekening_non_member', 'left');
    	$this->db->join('koperasi kop', 'rek.id_koperasi = kop.id_koperasi', 'left');
    	$this->db->where('log.jenis_account', 'SMIDUMAY');
    	if($this->sumber_dana)
	    	$this->db->where('log.sumber_dana', $this->sumber_dana);
	    if($this->jenis_akun)
	    	$this->db->where('log.jenis_account', $this->jenis_akun);
	    if($this->date_from)
	    	$this->db->where('DATE(log.tanggal_transaksi) >= ', $this->date_from);
	    if($this->offset)
	    	$this->db->where('log.tanggal_transaksi < ', $this->offset);
	    else if($this->date_to)
	    	$this->db->where('DATE(log.tanggal_transaksi) <= ', $this->date_to);
	    $this->db->order_by('log.tanggal_transaksi', 'desc');
	    $this->db->limit(10);

    	return $this->db->get();
    }

}