<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compro_model extends CI_Model {

	var $id_koperasi, $news_id, $event_id, $agenda_id, $last;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	function get_logo_cover(){

		if($this->session->userdata('level')==3 OR $this->session->userdata('level')==2){
			$this->db->select('user_info.foto, koperasi.cover_foto');
			$this->db->from('user_info');
			$this->db->join('koperasi', 'koperasi.id_user = user_info.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			$return = $this->db->get();

			if($return->num_rows() > 0){
				return $return;
			}
			else {
				return FALSE;
			}
		}

		else if($this->session->userdata('level')==5 OR $this->session->userdata('level')==4){
			$this->db->select('user_info.foto, komunitas.cover_foto');
			$this->db->from('user_info');
			$this->db->join('komunitas', 'komunitas.id_user = user_info.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas_ID'));
			$return = $this->db->get();

			if($return->num_rows() > 0){
				return $return;
			}
			else {
				return FALSE;
			}
		}

		else {
			return false;
		}
	}

	function aboutus(){
		if($this->session->userdata('level')=="2" or $this->session->userdata('level') == "3"){
			$this->db->select('*');
			$this->db->from('koperasi');
			$this->db->where('id_koperasi', $this->session->userdata('koperasi'));

			return $this->db->get();
		}

		else if($this->session->userdata('level')=="4" or $this->session->userdata('level') == "5"){
			$this->db->select('*');
			$this->db->from('komunitas');
			$this->db->where('id_komunitas', $this->session->userdata('komunitas_ID'));

			return $this->db->get();
		}
	}

	function get_berita(){

		if ($this->session->userdata('id_user') == NULL or $this->session->userdata('id_user') == ""){
			$this->db->select('konten_berita.*');
			$this->db->join('user_info', 'user_info.id_user = konten_berita.id_user');
			$this->db->where('user_info.level', '1');
			return $this->db->get('konten_berita', '3');
		}
		else if($this->session->userdata('level')=="2" or $this->session->userdata('level') == "3"){
			$this->db->select('konten_berita.*');
			$this->db->join('user_info', 'user_info.id_user = konten_berita.id_user');
			$this->db->join('koperasi', 'user_info.id_user = koperasi.id_user');
			$this->db->where('level_akses', "2");
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get('konten_berita', '3');
		}

		else if($this->session->userdata('level')=="4" or $this->session->userdata('level') == "5"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_berita.id_user');
			$this->db->join('komunitas', 'user_info.id_user = komunitas.id_user');
			$this->db->where('level_akses', "4");
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas_ID'));

			return $this->db->get('konten_berita', '3');
		}
		else{
			$this->db->select('konten_berita.*');
			$this->db->join('user_info', 'user_info.id_user = konten_berita.id_user');
			$this->db->where('user_info.level', '1');
			return $this->db->get('konten_berita', '3');	
		}
	}

	function get_berita_by_id($id){
		$this->db->select('*');
		$this->db->where('id_berita', $id);
		$this->db->join('user_info', 'user_info.id_user = konten_berita.id_user');
		return $this->db->get('konten_berita');
	}


	function get_event(){

		if ($this->session->userdata('id_user') == NULL or $this->session->userdata('id_user') == ""){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_event.id_user');
			$this->db->where('user_info.level', '1');
			return $this->db->get('konten_event', '3');

		}

		else if($this->session->userdata('level')=="2" or $this->session->userdata('level') == "3"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_event.id_user');
			$this->db->join('koperasi', 'user_info.id_user = koperasi.id_user');
			$this->db->where('level_akses', "2");
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get('konten_event', '3');
		}

		else if($this->session->userdata('level')=="4" or $this->session->userdata('level') == "5"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_event.id_user');
			$this->db->join('komunitas', 'user_info.id_user = komunitas.id_user');
			$this->db->where('level_akses', "4");
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas_ID'));

			return $this->db->get('konten_event', '3');
		}
		else{
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_event.id_user');
			$this->db->where('user_info.level', '1');
			return $this->db->get('konten_event', '3');			
		}
	}

	function get_event_by_id($id){
		$this->db->select('*');
		$this->db->where('id_event', $id);
		$this->db->join('user_info', 'user_info.id_user = konten_event.id_user');
		return $this->db->get('konten_event');
	}


	function get_agenda(){

		if ($this->session->userdata('id_user') == NULL or $this->session->userdata('id_user') == "" or $this->session->userdata('id_user') == "1"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_agenda.id_user');
			$this->db->where('user_info.level', '1');
			return $this->db->get('konten_agenda');
		}
		else if($this->session->userdata('level')=="2" or $this->session->userdata('level') == "3"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_agenda.id_user');
			$this->db->join('koperasi', 'user_info.id_user = koperasi.id_user');
			$this->db->where('level_akses', "2");
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get('konten_agenda');
		}

		else if($this->session->userdata('level')=="4" or $this->session->userdata('level') == "5"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_agenda.id_user');
			$this->db->join('komunitas', 'user_info.id_user = komunitas.id_user');
			$this->db->where('level_akses', "4");
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas_ID'));

			return $this->db->get('konten_agenda');
		}
		else{
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = konten_agenda.id_user');
			$this->db->where('user_info.level', '1');
			return $this->db->get('konten_agenda');	
		}
	}

	function get_agenda_by_id($id){
		$this->db->select('*');
		$this->db->where('id_agenda', $id);
		$this->db->join('user_info', 'user_info.id_user = konten_agenda.id_user');
		return $this->db->get('konten_agenda');
	}

	function get_emag(){
		if($this->session->userdata('level')=="2" or $this->session->userdata('level') == "3"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = majalah.id_user');
			$this->db->join('koperasi', 'user_info.id_user = koperasi.id_user');
			$this->db->where('koperasi.id_koperasi', $this->session->userdata('koperasi'));
			return $this->db->get('majalah', '3');
		}

		else if($this->session->userdata('level')=="4" or $this->session->userdata('level') == "5"){
			$this->db->select('*');
			$this->db->join('user_info', 'user_info.id_user = majalah.id_user');
			$this->db->join('komunitas', 'user_info.id_user = komunitas.id_user');
			$this->db->where('komunitas.id_komunitas', $this->session->userdata('komunitas_ID'));

			return $this->db->get('majalah', '3');
		}
	}

	function get_emag_by_id($id){
		$this->db->select('*');
		$this->db->where('id_majalah', $id);
		$this->db->join('user_info', 'user_info.id_user = majalah.id_user');
		return $this->db->get('majalah');
	}



	function get_all_komunitas(){
		$this->db->select('komunitas.ketua_komunitas,user_info.foto as foto,komunitas.keterangan_komunitas,komunitas.tgl_berdiri, komunitas.alamat, komunitas.telp, komunitas.nama, komunitas.id_komunitas, komunitas.ketua_komunitas');
		$this->db->from('komunitas');
		$this->db->where('komunitas.status_active', "1");
		$this->db->join('user_info', 'user_info.id_user = komunitas.id_user');
		return $this->db->get();
	}

	function get_all_koperasi(){
		$this->db->select('koperasi.ketua_koperasi,user_info.foto, koperasi.alamat, koperasi.telp, koperasi.nama, koperasi.id_koperasi, koperasi.parent_koperasi');
		$this->db->from('koperasi');
		$this->db->where('koperasi.status_active', "1");
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
		return $this->db->get();
	}

	function get_koperasi_profile(){
		$this->db->select('koperasi.cover_foto,koperasi.ketua_koperasi,user_info.foto, koperasi.keterangan_koperasi, koperasi.alamat, koperasi.telp, koperasi.nama, koperasi.id_koperasi, koperasi.tgl_berdiri, koperasi.legal, koperasi.ketua_koperasi, koperasi.ketua_koperasi_telp, koperasi.parent_koperasi, koperasi.email');
		$this->db->from('koperasi');
		$this->db->where('koperasi.status_active', "1");
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
		if($this->id_koperasi)
			$this->db->where('koperasi.id_koperasi', $this->id_koperasi);

		return $this->db->get();
	}

	function get_news(){
		$this->db->select('kb.*');
		$this->db->from('konten_berita kb');
		$this->db->join('user_info ui', 'ui.id_user = kb.id_user');
		$this->db->join('koperasi kp', 'kp.id_user = ui.id_user');
		if($this->news_id)
			$this->db->where('kb.id_berita', $this->news_id);
		if($this->id_koperasi)
			$this->db->where('kp.id_koperasi', $this->id_koperasi);
		if($this->last)
			$this->db->where('kb.tanggal_dibuat < ', $this->last);
		$this->db->order_by('kb.tanggal_dibuat', 'desc');
		$this->db->limit(2);

		return $this->db->get();
	}

	function get_agendas(){
		$this->db->select('ka.*');
		$this->db->from('konten_agenda ka');
		$this->db->join('user_info ui', 'ui.id_user = ka.id_user');
		$this->db->join('koperasi kp', 'kp.id_user = ui.id_user');
		if($this->id_koperasi)
			$this->db->where('kp.id_koperasi', $this->id_koperasi);
		if($this->last)
			$this->db->where('ka.tanggal_dibuat < ', $this->last);
		$this->db->order_by('ka.tanggal_dibuat', 'desc');
		$this->db->limit(2);

		return $this->db->get();
	}

	function get_events(){
		$this->db->select('ke.*');
		$this->db->from('konten_event ke');
		$this->db->join('user_info ui', 'ui.id_user = ke.id_user');
		$this->db->join('koperasi kp', 'kp.id_user = ui.id_user');
		if($this->id_koperasi)
			$this->db->where('kp.id_koperasi', $this->id_koperasi);
		if($this->last)
			$this->db->where('ke.tanggal_dibuat < ', $this->last);
		$this->db->order_by('ke.tanggal_dibuat', 'desc');
		$this->db->limit(2);

		return $this->db->get();
	}

	function get_all_koperasi_group($id_jenis){
		$this->db->select('koperasi.ketua_koperasi,user_info.foto, koperasi.alamat, koperasi.telp, koperasi.nama, koperasi.id_koperasi, koperasi.parent_koperasi');
		$this->db->from('koperasi');
		$this->db->where('koperasi.status_active', "1");
		$this->db->where('koperasi.jenis_koperasi', $id_jenis);
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
		return $this->db->get();
	}

	function get_all_jenis_koperasi(){
		$this->db->select('koperasi_jenis.*');
		$this->db->from('koperasi_jenis');
		return $this->db->get();
	}

	function get_all_koperasi_detail($id_jenis){
		$this->db->select('koperasi.ketua_koperasi,user_info.foto, koperasi.alamat, koperasi.telp, koperasi.nama, koperasi.id_koperasi, koperasi.parent_koperasi,koperasi.keterangan_koperasi');
		$this->db->from('koperasi');
		$this->db->where('koperasi.status_active', "1");
		$this->db->where('koperasi.id_koperasi', $id_jenis);
		$this->db->join('user_info', 'user_info.id_user = koperasi.id_user');
		return $this->db->get();
	}

}

/* End of file compro.php */
/* Location: ./application/models/compro.php */