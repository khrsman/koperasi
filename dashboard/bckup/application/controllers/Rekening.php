<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		
		$this->load->library('form_validation');
        $this->load->model('rekening_mod');

		if($this->session->userdata('level') == 2){
			$this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');
		}
		// $this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  // 		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}

	function index(){
		$data['title'] = "Data Master Rekening Anggota";
		$data['nasabah_rek_tabungan'] = $this->rekening_mod->get_nasabah_rekening_tabungan();
		$data['nasabah_rek_virtual'] = $this->rekening_mod->get_nasabah_rekening_virtual();
		$data['nasabah_rek_loyalti'] = $this->rekening_mod->get_nasabah_rekening_loyalti();
		// $this->load->view('rekening/list', $data);
		$this->load->view('rekening/list_ngakal', $data);
	}

	function tarik_tunai(){
		$data['title'] = "Penarikan Tunai Nasabah";
		$this->load->view('rekening/tarik_tunai', $data);
	}

	function ubah_status(){
		$data['title'] = "Penarikan Tunai Nasabah";
		$this->load->view('rekening/blokir_tutup', $data);
	}

	function tarik_tunai_info(){
		$data['title'] = "Info Penarikan Tunai Nasabah";
		$this->load->view('rekening/tarik_tunai_info', $data);
	}

	function register(){
		$data = array(
			'title' => "Register Rekening Anggota",
            'sumber_penghasilan' => $this->rekening_mod->get_sumber_penghasilan(),
            'pemasukan_per_bulan' => $this->rekening_mod->get_pemasukan_per_bulan(),
            'frek_pemasukan_per_bulan' => $this->rekening_mod->get_frek_pemasukan_per_bulan(),
            'pengeluaran_per_bulan' => $this->rekening_mod->get_pengeluaran_per_bulan(),
            'frek_pengeluaran_per_bulan' => $this->rekening_mod->get_frek_pengeluaran_per_bulan(),
            'sumber_dana_setoran' => $this->rekening_mod->get_sumber_dana_setoran()
		);
		$this->load->view('rekening/register', $data);
	}

	function transfer_saldo(){
		$data['title'] = "Transfer Saldo Anggota";
		$this->load->view('rekening/transfer_saldo', $data);
	}

	function setor_tunai(){
		$data['title'] = "Setor Tunai Nasabah";
		$this->load->view('rekening/setor_tunai', $data);
	}

	function setor_tunai_info(){
		$data['title'] = "Info Setor Tunai Nasabah";
		$this->load->view('rekening/setor_tunai_info', $data);
	}

	function cek_saldo(){
		$data['title'] = "Pengecekan Saldo";
		$this->load->view('rekening/cek_saldo', $data);
	}

	function detail(){
		if($this->session->userdata('level') == 3){
			$nasabah_id = $this->session->userdata('id_user');
		} else
			$nasabah_id = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
		if($nasabah_id) {
			$this->rekening_mod->id_user = $nasabah_id;
			
			// $nasabah_res = $this->rekening_mod->get_nasabah_rekening_tabungan();
			// if($nasabah_res->num_rows() > 0){
			// 	$nasabah_temp = $nasabah_res->row();
			// 	$rekening_tabungan = array(
			// 		'no_rekening' => $nasabah_temp->no_rekening,
			// 		'nama_nasabah' => $nasabah_temp->nama_lengkap,
			// 		'jenis_rekening' => 'TABUNGAN',
			// 		'saldo' => $nasabah_temp->saldo,
			// 		'tanggal_transaksi_terakhir' => $nasabah_temp->tanggal_transaksi_terakhir
			// 	);
			// }
			
			// $nasabah_res = $this->rekening_mod->get_nasabah_rekening_virtual();
			// if($nasabah_res->num_rows() > 0){
			// 	$nasabah_temp = $nasabah_res->row();
			// 	$rekening_virtual = array(
			// 		'no_rekening' => $nasabah_temp->no_rekening_virtual,
			// 		'nama_nasabah' => $nasabah_temp->nama_lengkap,
			// 		'jenis_rekening' => 'VIRTUAL',
			// 		'saldo' => $nasabah_temp->saldo,
			// 		'tanggal_transaksi_terakhir' => $nasabah_temp->tanggal_transaksi_terakhir
			// 	);
			// }
			
			// $nasabah_res = $this->rekening_mod->get_nasabah_rekening_loyalti();
			// if($nasabah_res->num_rows() > 0){
			// 	$rekening_loyalti = array();
			// 	foreach ($nasabah_res->result() as $nasabah_temp) {
			// 		array_push($rekening_loyalti, array(
			// 			'no_rekening' => $nasabah_temp->no_rekening_loyalti,
			// 			'nama_nasabah' => $nasabah_temp->nama_lengkap,
			// 			'jenis_rekening' => 'LOYALTI ' . $nasabah_temp->jenis_rekening,
			// 			'saldo' => $nasabah_temp->saldo,
			// 			'tanggal_transaksi_terakhir' => $nasabah_temp->tanggal_transaksi_terakhir
			// 		));
			// 	}
			// }

			$data = array(
				'title' => "Informasi Rekening Nasabah",
				'nasabah_info' => $this->rekening_mod->get_nasabah_info(),
				'rekening_tabungan' => $this->rekening_mod->get_nasabah_rekening_tabungan(),
				'rekening_virtual' => $this->rekening_mod->get_nasabah_rekening_virtual(),
				'rekening_loyalti' => $this->rekening_mod->get_nasabah_rekening_loyalti()
			);

			$data['title'] = "Informasi Rekening Nasabah";
			// $this->load->view('rekening/informasi_nasabah', $data);
			$this->load->view('rekening/informasi_nasabah_2', $data);
		} else {
			redirect('');
		}
	}

	function ajax_info_nasabah(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nasabah_id',
                'label' => 'nasabah',
                'rules' => 'trim|xss_clean|required'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
			$jenis_rekening_nasabah = substr($this->input->post('nasabah_id', true), -1);

			$this->rekening_mod->no_rekening = $nasabah_id;

			$nasabah_res = $this->rekening_mod->get_nasabah_rekening_tabungan();
			if($nasabah_res->num_rows() > 0){
				$nasabah_temp = $nasabah_res->row();
				$status_rekening = "";
				switch ($nasabah_temp->status_rekening) {
					case 'ACTIVE':
						$status_rekening = "Aktif";
						break;
					case 'BLOCKED':
						$status_rekening = "Rekening Diblokir";
						break;
					case 'CLOSED':
						$status_rekening = "Rekening Ditutup";
						break;
					default:
						$status_rekening = "Aktif";
						break;
				}
				$rekening_tabungan = array(
					'nasabah_id' => $nasabah_temp->id_user,
					'no_rekening' => $nasabah_temp->no_rekening,
					'nama_nasabah' => $nasabah_temp->nama_lengkap,
					'jenis_rekening' => 'TABUNGAN',
					'saldo' => "Rp. " . number_format($nasabah_temp->saldo, 0, ".", ","),
					'koperasi' => $nasabah_temp->nama_koperasi,
					'tanggal_transaksi_terakhir' => $nasabah_temp->tanggal_transaksi_terakhir,
					'status_rekening' => $status_rekening
				);

				$info->data = $rekening_tabungan;
			} else {
				$info->msg = "Maaf, nomor rekening yang Anda masukan tidak valid. Silahkan ulangi pemilihan nasabah";
	            $info->errorcode = 2;
			}
		} else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 2;
        }

        echo json_encode($info);
	}

	function log_tabungan(){
		if($this->session->userdata('level') == 3){
			$nasabah_id = $this->session->userdata('id_user');
		} else
			$nasabah_id = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
		$no_rekening = $this->uri->segment(4) ? $this->uri->segment(4, true) : null;
		$this->rekening_mod->id_user = $nasabah_id;
		$this->rekening_mod->no_rekening = $no_rekening;
		$data = array(
			'title' => "Informasi Rekening Tabungan",
			'rekening' => $this->rekening_mod->get_nasabah_rekening_tabungan(),
			'log_rekening' => $this->rekening_mod->get_log_rekening()
		);

		$this->load->view('rekening/log_tabungan', $data);
	}

	function log_virtual(){
		if($this->session->userdata('level') == 3){
			$nasabah_id = $this->session->userdata('id_user');
		} else
			$nasabah_id = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
		$no_rekening = $this->uri->segment(4) ? $this->uri->segment(4, true) : null;
		$this->rekening_mod->id_user = $nasabah_id;
		$this->rekening_mod->no_rekening = $no_rekening;
		$data = array(
			'title' => "Informasi Rekening Virtual",
			'rekening' => $this->rekening_mod->get_nasabah_rekening_virtual(),
			'log_rekening' => $this->rekening_mod->get_log_rekening()
		);

		$this->load->view('rekening/log_virtual', $data);
	}

	function log_loyalti(){
		if($this->session->userdata('level') == 3){
			$nasabah_id = $this->session->userdata('id_user');
		} else
			$nasabah_id = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
		$no_rekening = $this->uri->segment(4) ? $this->uri->segment(4, true) : null;
		$this->rekening_mod->id_user = $nasabah_id;
		$this->rekening_mod->no_rekening = $no_rekening;
		$data = array(
			'title' => "Informasi Rekening Loyalti",
			'rekening' => $this->rekening_mod->get_nasabah_rekening_loyalti(),
			'log_rekening' => $this->rekening_mod->get_log_rekening()
		);

		$this->load->view('rekening/log_loyalti', $data);
	}

	function ajax_register(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nasabah_id',
                'label' => 'anggota',
                'rules' => 'trim|xss_clean|required|callback_cek_anggota_terdaftar'
            ),
            array(
                'field' => 'tgl_register',
                'label' => 'tanggal pendaftaran',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'saldo_min',
                'label' => 'saldo minimum',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal'
            ),
            array(
                'field' => 'setoran_min',
                'label' => 'setoran awal',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal|callback_cek_jumlah_setoran'
            ),
            array(
                'field' => 'setoran_pokok',
                'label' => 'setoran pokok',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'setoran_wajib',
                'label' => 'setoran wajib per bulan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'setoran_virtual',
                'label' => 'setoran virtual',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'tujuan_pembukaan_rekening_tab',
                'label' => 'tujuan pembukaan rekening bank',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'penghasilan_utama',
                'label' => 'penghasilan utama',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'sumber_penghasilan',
                'label' => 'sumber penghasilan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'pemasukan_per_bulan',
                'label' => 'pemasukan perbulan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'frek_pemasukan_per_bulan',
                'label' => 'frekuensi pemasukan perbulan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'pengeluaran_per_bulan',
                'label' => 'pengeluaran perbulan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'frek_pengeluaran_per_bulan',
                'label' => 'frekuensi pengeluaran perbulan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'umber_dana_untuk_setoran',
                'label' => 'sumber dana setoran',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'tujuan_penggunaan_dana',
                'label' => 'tujuan penggunaan dana',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'scan_ktp',
                'label' => 'upload scan identitas',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $nasabah_id = $this->input->post('nasabah_id', true) ? $this->input->post('nasabah_id', true) : null;
            $tgl_register = $this->input->post('tgl_register', true) ? $this->input->post('tgl_register', true) : null;
            $scan_ktp = $this->input->post('scan_ktp', true) ? $this->input->post('scan_ktp', true) : null;
            $saldo_min = $this->input->post('saldo_min', true) ? str_replace(',', '', $this->input->post('saldo_min', true)) : 0;
            $setoran_min = $this->input->post('setoran_min', true) ? str_replace(',', '', $this->input->post('setoran_min', true)) : 0;
            $setoran_pokok = $this->input->post('setoran_pokok', true) ? str_replace(',', '', $this->input->post('setoran_pokok', true)) : 0;
            $setoran_wajib = $this->input->post('setoran_wajib', true) ? str_replace(',', '', $this->input->post('setoran_wajib', true)) : 0;
            // $persen_bunga = $this->input->post('persen_bunga', true) ? $this->input->post('persen_bunga', true) : 0;
            // $persen_pajak = $this->input->post('persen_pajak', true) ? $this->input->post('persen_pajak', true) : 0;
            $setoran_virtual = $this->input->post('setoran_virtual', true) ? str_replace(',', '', $this->input->post('setoran_virtual', true)) : 0;

            $this->rekening_mod->id_user = $nasabah_id;
            $retrieve_user_info = $this->rekening_mod->get_user_info();
            if($retrieve_user_info->num_rows() > 0){
            	$id_koperasi = $retrieve_user_info->row()->koperasi;
            	$this->rekening_mod->id_koperasi = $id_koperasi;
            	$no_urut = $this->rekening_mod->count_rekening_member();
            	if($no_urut == 0)
            		$no_urut = 1;
            	else
            		$no_urut = $no_urut + 1;
            	$running = false;
            	while (!$running) {
	            	$mask_no_urut = sprintf("%06d", $no_urut);
	            	// create rekening tabungan
		            $data_rek_tabungan = array(
		            	'no_rekening' => $id_koperasi . '.011.' . $mask_no_urut,
		            	'id_user' => $nasabah_id,
		            	'saldo' => ($setoran_min - $setoran_virtual),
		            	'saldo_minimum' => $saldo_min,
		            	'tanggal_registrasi' => $tgl_register,
		            	'setoran_minimum' => $setoran_min,
		            	'setoran_pokok' => $setoran_pokok,
		            	'setoran_wajib' => $setoran_wajib,
		            	// 'bunga' => $persen_bunga,
		            	// 'pajak' => $persen_pajak,
		            	'tanggal_transaksi_terakhir' => date('Y-m-d'),
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
		            );
		            if($this->rekening_mod->register_rekening($data_rek_tabungan)){
		            	if($scan_ktp){
		            		$this->rekening_mod->update_user_identity($scan_ktp);
		            	}
		            	// create transaction record
		            	$transaction_id = strtoupper(uniqid(rand().time()));
		            	$data_transaction_rec_tabungan = array(
		            		'no_transaksi' => $transaction_id,
		            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
		            		'nilai_transaksi' => $setoran_min,
		            		'saldo_awal' => 0,
		            		'kode_transaksi' => 'REKENING',
		            		'tipe_transaksi' => 'KREDIT',
		            		'saldo_akhir' => $setoran_min,
		            		'jenis_transaksi' => 'SETORAN AWAL',
		            		'jenis_account' => 'TABUNGAN',
		            		'sumber_dana' => 'TUNAI',
		            		'no_rekening_primary' => $data_rek_tabungan['no_rekening'],
		            		'id_user' => $nasabah_id,
			            	'service_time' => date('Y-m-d H:i:s'),
			            	'service_action' => 'INSERT',
			            	'service_user' => $this->session->userdata('id_user')
		            	);

	            		$data_keuangan = array(
	            			'no_rekening' => $transaction_id,
	            			'id_user' => $nasabah_id,
				            'tujuan_pembukaan_rekening' => $this->input->post('tujuan_pembukaan_rekening_tab', true) ? $this->input->post('tujuan_pembukaan_rekening_tab', true) : null,
			                'penghasilan_utama' => $this->input->post('penghasilan_utama', true) ? $this->input->post('penghasilan_utama', true) : null,
			                'kode_sumber_penghasilan' => $this->input->post('kode_sumber_penghasilan', true) ? $this->input->post('kode_sumber_penghasilan', true) : null,
			                'kode_pemasukan_per_bulan' => $this->input->post('kode_pemasukan_per_bulan', true) ? $this->input->post('kode_pemasukan_per_bulan', true) : null,
			                'kode_frek_pemasukan_per_bulan' => $this->input->post('kode_frek_pemasukan_per_bulan', true) ? $this->input->post('kode_frek_pemasukan_per_bulan', true) : null,
			                'kode_pengeluaran_per_bulan' => $this->input->post('kode_pengeluaran_per_bulan', true) ? $this->input->post('kode_pengeluaran_per_bulan', true) : null,
			                'kode_frek_pengeluaran_per_bulan' => $this->input->post('kode_frek_pengeluaran_per_bulan', true) ? $this->input->post('kode_frek_pengeluaran_per_bulan', true) : null,
			                'kode_sumber_dana_untuk_setoran' => $this->input->post('kode_sumber_dana_untuk_setoran', true) ? $this->input->post('kode_sumber_dana_untuk_setoran', true) : null,
			                'tujuan_penggunaan_dana' => $this->input->post('tujuan_penggunaan_dana', true) ? $this->input->post('tujuan_penggunaan_dana', true) : null,
			            	'service_time' => date('Y-m-d H:i:s'),
			            	'service_action' => 'INSERT',
			            	'service_user' => $this->session->userdata('id_user')
			            );

		            	if($this->rekening_mod->record_transaction($data_transaction_rec_tabungan) && $this->rekening_mod->register_info_keuangan($data_keuangan)){
			            	// create rekening virtual
			            	$data_rek_transaksi = array(
			            		'no_rekening_virtual' => $id_koperasi . '.012.' . $mask_no_urut,
				            	'id_user' => $nasabah_id,
				            	'saldo' => $setoran_virtual,
				            	'tanggal_transaksi_terakhir' => date('Y-m-d'),
				            	'service_time' => date('Y-m-d H:i:s'),
				            	'service_action' => 'INSERT',
				            	'service_user' => $this->session->userdata('id_user')
			            	);
			            	if($this->rekening_mod->register_rekening_virtual($data_rek_transaksi)){
			            		if($setoran_virtual > 0){
					            	$transaction_id = strtoupper(uniqid(rand().time()));
			            			$data_transaction_rec_virtual1 = array(
					            		'no_transaksi' => $transaction_id,
					            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
					            		'nilai_transaksi' => $setoran_virtual,
					            		'saldo_awal' => $setoran_min,
					            		'saldo_akhir' => $setoran_min - $setoran_virtual,
					            		'jenis_transaksi' => 'TRANSFER SALDO',
					            		'jenis_account' => 'VIRTUAL',
					            		'kode_transaksi' => 'REKENING',
					            		'tipe_transaksi' => 'DEBET',
					            		'sumber_dana' => 'TABUNGAN',
					            		'no_rekening_primary' => $data_rek_tabungan['no_rekening'],
					            		'no_rekening_secondary' => $data_rek_transaksi['no_rekening_virtual'],
					            		'id_user' => $nasabah_id,
						            	'service_time' => date('Y-m-d H:i:s'),
						            	'service_action' => 'INSERT',
						            	'service_user' => $this->session->userdata('id_user')
					            	);

					            	$this->rekening_mod->record_transaction($data_transaction_rec_virtual1);

					            	$transaction_id = strtoupper(uniqid(rand().time()));
			            			$data_transaction_rec_virtual2 = array(
					            		'no_transaksi' => $transaction_id,
					            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
					            		'nilai_transaksi' => $setoran_virtual,
					            		'saldo_awal' => 0,
					            		'saldo_akhir' => $setoran_virtual,
					            		'jenis_transaksi' => 'TERIMA SALDO',
					            		'jenis_account' => 'VIRTUAL',
					            		'kode_transaksi' => 'REKENING',
					            		'tipe_transaksi' => 'KREDIT',
					            		'sumber_dana' => 'TABUNGAN',
					            		'no_rekening_primary' => $data_rek_transaksi['no_rekening_virtual'],
					            		'no_rekening_secondary' => $data_rek_tabungan['no_rekening'],
					            		'id_user' => $nasabah_id,
						            	'service_time' => date('Y-m-d H:i:s'),
						            	'service_action' => 'INSERT',
						            	'service_user' => $this->session->userdata('id_user')
					            	);

					            	$this->rekening_mod->record_transaction($data_transaction_rec_virtual2);
			            		}
			            		// create rekening loyalti
			            		$kode_loyalti = array(
			            			array(
			            				'name' => 'CASH',
			            				'value' => '031'
			            			),array(
			            				'name' => 'INSURANCE',
			            				'value' => '032'
			            			),array(
			            				'name' => 'REWARDS',
			            				'value' => '033'
			            			)
		            			);
			            		$data_rek_loyalti = array();
			            		foreach ($kode_loyalti as $kode_temp) {
					            	array_push($data_rek_loyalti, array(
					            		'no_rekening_loyalti' => $id_koperasi . '.' . $kode_temp['value'] . '.'. $mask_no_urut,
						            	'id_user' => $nasabah_id,
						            	'saldo' => 0,
						            	'jenis_rekening' => $kode_temp['name'],
						            	'tanggal_transaksi_terakhir' => null,
						            	'service_time' => date('Y-m-d H:i:s'),
						            	'service_action' => 'INSERT',
						            	'service_user' => $this->session->userdata('id_user')
					            	));
			            		}
			            		if(count($data_rek_loyalti) > 0){
			            			if($this->rekening_mod->register_rekening_loyalti($data_rek_loyalti)) {
						            	$running = TRUE;
				            			$this->session->set_flashdata('register_rek_stat', 'SUCCESS');
				            			$info->data = array(
				            				'id_user' => $nasabah_id
				            			);
			            			} else{
			            				$this->rekening_mod->clear_rekening_virtual($data_rek_transaksi['no_rekening_virtual']);	
			            				$this->rekening_mod->clear_rekening_tabungan($data_rek_tabungan['no_rekening']);	
			            				$this->rekening_mod->clear_log_transaction($data_transaction_rec_tabungan['no_transaksi']);
			            				if($setoran_virtual > 0){
				            				$this->rekening_mod->clear_log_transaction($data_transaction_rec_virtual1['no_transaksi']);
				            				$this->rekening_mod->clear_log_transaction($data_transaction_rec_virtual2['no_transaksi']);
			            				}
			            			}
			            		} else {
			            			$this->rekening_mod->clear_rekening_virtual($data_rek_transaksi['no_rekening_virtual']);	
		            				$this->rekening_mod->clear_rekening_tabungan($data_rek_tabungan['no_rekening']);
		            				$this->rekening_mod->clear_log_transaction($data_transaction_rec_tabungan['no_transaksi']);	
		            				if($setoran_virtual > 0){
			            				$this->rekening_mod->clear_log_transaction($data_transaction_rec_virtual1['no_transaksi']);
			            				$this->rekening_mod->clear_log_transaction($data_transaction_rec_virtual2['no_transaksi']);
		            				}
			            		}
			            	} else {
			            		$this->rekening_mod->clear_rekening_tabungan($data_rek_tabungan['no_rekening']);
	            				$this->rekening_mod->clear_log_transaction($data_transaction_rec_tabungan['no_transaksi']);	
			            	}
		            	} else {
		            		$this->rekening_mod->clear_rekening_tabungan($data_rek_tabungan['no_rekening']);
		            	}
		            }

		            $no_urut++;
            	}
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_setor_tunai(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'tujuan_id',
                'label' => 'nasabah tujuan',
                'rules' => 'trim|xss_clean|required|callback_cek_tujuan_pengiriman'
            ),
            array(
                'field' => 'nominal_transfer',
                'label' => 'besar transfer nominal',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal|callback_cek_simpanan_wajib'
            ),
            array(
                'field' => 'is_simpanan_wajib',
                'label' => 'simpanan wajib',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'nama',
                'label' => 'atas nama pengirim',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'no_ktp',
                'label' => 'ID KTP Pengirim',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'berita_acara',
                'label' => 'atas nama pengirim',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'alamat',
                'label' => 'alamat',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'alamat',
                'rules' => 'trim|xss_clean|valid_email'
            ),
            array(
                'field' => 'no_telepon',
                'label' => 'no_telepon',
                'rules' => 'trim|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('valid_email', 'Format email yang Anda masukan tidak benar');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$tujuan_id = $this->input->post('tujuan_id', true) ? substr($this->input->post('tujuan_id', true),0,-1) : null;
			$jenis_rekening_tujuan = substr($this->input->post('tujuan_id', true), -1);
            $nominal_transfer = $this->input->post('nominal_transfer', true) ? (float)str_replace(',', '', $this->input->post('nominal_transfer', true)) : null;
            $nama = $this->input->post('nama') ? $this->input->post('nama', true) : null;
            $berita_acara = $this->input->post('berita_acara') ? $this->input->post('berita_acara', true) : null;
            $alamat = $this->input->post('alamat') ? $this->input->post('alamat', true) : null;
            $keterangan = $this->input->post('keterangan') ? $this->input->post('keterangan', true) : null;
            $no_ktp = $this->input->post('no_ktp') ? $this->input->post('no_ktp', true) : null;
            $no_telepon = $this->input->post('no_telepon') ? $this->input->post('no_telepon', true) : null;
            $email = $this->input->post('email') ? $this->input->post('email', true) : null;
            $is_simpanan_wajib = $this->input->post('is_simpanan_wajib') ? $this->input->post('is_simpanan_wajib', true) : null;

            if($jenis_rekening_tujuan == "1"){
				// record transaksi
        		$this->rekening_mod->no_rekening = $tujuan_id;
				$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
				$saldo_tabungan = 0;
				if($saldo_res->num_rows() > 0){
					$saldo_temp = $saldo_res->row();
					$saldo_awal = $saldo_temp->saldo;
					$saldo_akhir = $saldo_awal + $nominal_transfer;
					$id_user = $saldo_temp->id_user;
				} 
				$transaction_id = strtoupper(uniqid(rand().time()));
				$data_transaction_rec = array(
            		'no_transaksi' => $transaction_id,
            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
            		'nilai_transaksi' => $nominal_transfer,
            		'saldo_awal' => $saldo_awal,
            		'saldo_akhir' => $saldo_akhir,
            		'jenis_transaksi' => $is_simpanan_wajib == "Y" ? "SIMPANAN WAJIB" : "TERIMA SALDO",
            		'jenis_account' => 'TABUNGAN',
            		'kode_transaksi' => 'REKENING',
            		'tipe_transaksi' => 'KREDIT',
            		'sumber_dana' => 'TUNAI',
            		'no_rekening_primary' => $tujuan_id,
            		'no_rekening_secondary' => null,
            		'id_user' => $id_user,
	            	'service_time' => date('Y-m-d H:i:s'),
	            	'service_action' => 'INSERT',
	            	'service_user' => $this->session->userdata('id_user')
            	);

            	$this->rekening_mod->record_transaction($data_transaction_rec);
            	$this->rekening_mod->inc_rekening_tabungan($tujuan_id, $nominal_transfer);

            	$data_trasanction_rec2 = array(
            		'no_transaksi_rekening' => $transaction_id,
            		'jenis_transaksi' => 'SETORAN',
            		'sumber_dana' => 'TUNAI',
            		'tujuan_dana' => 'TABUNGAN',
            		'no_rekening_tujuan' => $tujuan_id,
            		'jumlah_dana' => $nominal_transfer,
            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
            		'berita_acara' => $berita_acara,
            		'keterangan' => $keterangan,
            		'id_user' => $id_user,
            		'nama' => $nama,
            		'no_ktp' => $no_ktp,
            		'no_telepon' => $no_telepon,
            		'alamat' => $alamat,
            		'email' => $email,
            		'service_time' => date('Y-m-d H:i:s'),
            		'service_action' => 'INSERT',
            		'service_user' => $this->session->userdata('id_user')
            	);

            	if($this->rekening_mod->record_transaction2($data_trasanction_rec2)){
	            	$info->msg = "Penyetoran saldo ke rekening yang dituju berhasil";
	            	$this->session->set_flashdata('setor_tunai_stat', $data_trasanction_rec2);
            	} else {
            		$info->msg = "Terjadi kesalahan pada server. Silahkan ulangi kembali";
	            	$info->errorcode = 2;
            	}
            } else {
            	$info->msg = "Parameter yang dimasukan tidak benar";
            	$info->errorcode = 2;
            }
    	} else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_tarik_tunai(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nasabah_id',
                'label' => 'nasabah tujuan',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'nominal_transfer',
                'label' => 'besar transfer nominal',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal|callback_cek_penarikan_tunai'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('valid_email', 'Format email yang Anda masukan tidak benar');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
			$jenis_rekening_nasabah = substr($this->input->post('nasabah_id', true), -1);
            $nominal_transfer = $this->input->post('nominal_transfer', true) ? (float)str_replace(',', '', $this->input->post('nominal_transfer', true)) : null;

            if($jenis_rekening_nasabah == "1"){
				// record transaksi
        		$this->rekening_mod->no_rekening = $nasabah_id;
				$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
				$saldo_tabungan = 0;
				if($saldo_res->num_rows() > 0){
					$saldo_temp = $saldo_res->row();
					$saldo_awal = $saldo_temp->saldo;
					$saldo_akhir = $saldo_awal - $nominal_transfer;
					$id_user = $saldo_temp->id_user;

					$transaction_id = strtoupper(uniqid(rand().time()));
					$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => "PENARIKAN SALDO",
	            		'jenis_account' => 'TUNAI',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'DEBET',
	            		'sumber_dana' => 'TABUNGAN',
	            		'no_rekening_primary' => $nasabah_id,
	            		'no_rekening_secondary' => null,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	if($this->rekening_mod->record_transaction($data_transaction_rec)){
		            	$info->msg = "Penarikan saldo rekening nasabah berhasil dilakukan";
		            	$this->rekening_mod->dec_rekening_tabungan($nasabah_id, $nominal_transfer);
		            	$this->session->set_flashdata('tarik_tunai_stat', $data_transaction_rec);
	            	} else {
	            		$info->msg = "Terjadi kesalahan pada server. Silahkan ulangi kembali";
		            	$info->errorcode = 2;
	            	}
				}
            } else {
            	$info->msg = "Parameter yang dimasukan tidak benar";
            	$info->errorcode = 2;
            }
    	} else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_ubah_status(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nasabah_id',
                'label' => 'pemilihan nasabah',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'status_rekening',
                'label' => 'pemilihan status rekening',
                'rules' => 'trim|xss_clean|required'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
			$jenis_rekening_nasabah = substr($this->input->post('nasabah_id', true), -1);
            $status_rekening = $this->input->post('status_rekening', true) ? $this->input->post('status_rekening', true) : null;

            if($jenis_rekening_nasabah == "1"){
				// record transaksi
        		$this->rekening_mod->no_rekening = $nasabah_id;
				$rekening_res = $this->rekening_mod->get_nasabah_rekening_tabungan();
				if($rekening_res->num_rows() > 0){
					$rekening_temp = $rekening_res->row();
					$this->rekening_mod->id_user = $rekening_temp->id_user;
					if($this->rekening_mod->update_status_rekening($status_rekening)){
						$info->data = "Perubahan status rekening nasabah telah disimpan";
					} else {
						$info->msg = "Terjadi kesalahan pada server. Silahkan ulangi kembali transaksi Anda";
		            	$info->errorcode = 2;
					}
				}
            } else {
            	$info->msg = "Parameter yang dimasukan tidak benar";
            	$info->errorcode = 2;
            }
    	} else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

	function ajax_transfer_saldo(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nasabah_id',
                'label' => 'nasabah pengirim',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tujuan_id',
                'label' => 'nasabah tujuan',
                'rules' => 'trim|xss_clean|required|callback_cek_tujuan_pengiriman'
            ),
            array(
                'field' => 'nominal_transfer',
                'label' => 'besar transfer nominal',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal|callback_cek_saldo_pengirim'
            )
        );
        if($this->session->userdata('level') == 3){
        	array_push($rules, array(
                'field' => 'pin',
                'label' => 'kode pin',
                'rules' => 'trim|xss_clean|required|callback_cek_pin'
        	));

        }

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
            $tujuan_id = $this->input->post('tujuan_id', true) ? substr($this->input->post('tujuan_id', true),0,-1) : null;
			$jenis_rekening_nasabah = substr($this->input->post('nasabah_id', true), -1);
			$jenis_rekening_tujuan = substr($this->input->post('tujuan_id', true), -1);
            $nominal_transfer = $this->input->post('nominal_transfer', true) ? (float)str_replace(',', '', $this->input->post('nominal_transfer', true)) : null;

            if($jenis_rekening_nasabah == "1"){
        		if($jenis_rekening_tujuan == "1"){
    				// record transaksi
            		$this->rekening_mod->no_rekening = $nasabah_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal - $nominal_transfer;
						$id_user = $saldo_temp->id_user;
						$sisa_saldo = $saldo_tabungan - $nominal_transfer;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TRANSFER SALDO',
	            		'jenis_account' => 'TABUNGAN',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'DEBET',
	            		'sumber_dana' => 'TABUNGAN',
	            		'no_rekening_primary' => $nasabah_id,
	            		'no_rekening_secondary' => $tujuan_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
    				// record transaksi
            		$this->rekening_mod->no_rekening = $tujuan_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal + $nominal_transfer;
						$id_user = $saldo_temp->id_user;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TERIMA SALDO',
	            		'jenis_account' => 'TABUNGAN',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'KREDIT',
	            		'sumber_dana' => 'TABUNGAN',
	            		'no_rekening_primary' => $tujuan_id,
	            		'no_rekening_secondary' => $nasabah_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
	            	$this->rekening_mod->dec_rekening_tabungan($nasabah_id, $nominal_transfer);
	            	$this->rekening_mod->inc_rekening_tabungan($tujuan_id, $nominal_transfer);
	            	$this->session->set_flashdata('transfer_saldo_stat', 'SUCCESS');
        		} else if($jenis_rekening_tujuan == "2") {
    				// record transaksi
            		$this->rekening_mod->no_rekening = $nasabah_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal - $nominal_transfer;
						$id_user = $saldo_temp->id_user;
						$sisa_saldo = $saldo_tabungan - $nominal_transfer;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TRANSFER SALDO',
	            		'jenis_account' => 'VIRTUAL',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'DEBET',
	            		'sumber_dana' => 'TABUNGAN',
	            		'no_rekening_primary' => $nasabah_id,
	            		'no_rekening_secondary' => $tujuan_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
    				// record transaksi
            		$this->rekening_mod->no_rekening = $tujuan_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_virtual();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal + $nominal_transfer;
						$id_user = $saldo_temp->id_user;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TERIMA SALDO',
	            		'jenis_account' => 'VIRTUAL',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'KREDIT',
	            		'sumber_dana' => 'TABUNGAN',
	            		'no_rekening_primary' => $tujuan_id,
	            		'no_rekening_secondary' => $nasabah_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
	            	$this->rekening_mod->dec_rekening_tabungan($nasabah_id, $nominal_transfer);
	            	$this->rekening_mod->inc_rekening_virtual($tujuan_id, $nominal_transfer);
	            	$this->session->set_flashdata('transfer_saldo_stat', 'SUCCESS');
            	}
            } else if($jenis_rekening_nasabah == "2"){
        		if($jenis_rekening_tujuan == "1"){
    				// record transaksi
            		$this->rekening_mod->no_rekening = $nasabah_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_virtual();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal - $nominal_transfer;
						$id_user = $saldo_temp->id_user;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TRANSFER SALDO',
	            		'jenis_account' => 'TABUNGAN',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'DEBET',
	            		'sumber_dana' => 'VIRTUAL',
	            		'no_rekening_primary' => $nasabah_id,
	            		'no_rekening_secondary' => $tujuan_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
    				// record transaksi
            		$this->rekening_mod->no_rekening = $tujuan_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal + $nominal_transfer;
						$id_user = $saldo_temp->id_user;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TERIMA SALDO',
	            		'jenis_account' => 'TABUNGAN',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'KREDIT',
	            		'sumber_dana' => 'VIRTUAL',
	            		'no_rekening_primary' => $tujuan_id,
	            		'no_rekening_secondary' => $nasabah_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
	            	$this->rekening_mod->inc_rekening_tabungan($tujuan_id, $nominal_transfer);
	            	$this->rekening_mod->dec_rekening_virtual($nasabah_id, $nominal_transfer);
	            	$this->session->set_flashdata('transfer_saldo_stat', 'SUCCESS');
        		} else if($jenis_rekening_tujuan == "2") {
    				// record transaksi
            		$this->rekening_mod->no_rekening = $nasabah_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_virtual();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal - $nominal_transfer;
						$id_user = $saldo_temp->id_user;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TRANSFER SALDO',
	            		'jenis_account' => 'VIRTUAL',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'DEBET',
	            		'sumber_dana' => 'VIRTUAL',
	            		'no_rekening_primary' => $nasabah_id,
	            		'no_rekening_secondary' => $tujuan_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
    				// record transaksi
            		$this->rekening_mod->no_rekening = $tujuan_id;
    				$saldo_res = $this->rekening_mod->cek_saldo_virtual();
					$saldo_tabungan = 0;
					if($saldo_res->num_rows() > 0){
						$saldo_temp = $saldo_res->row();
						$saldo_awal = $saldo_temp->saldo;
						$saldo_akhir = $saldo_awal + $nominal_transfer;
						$id_user = $saldo_temp->id_user;
					} 
    				$transaction_id = strtoupper(uniqid(rand().time()));
    				$data_transaction_rec = array(
	            		'no_transaksi' => $transaction_id,
	            		'tanggal_transaksi' => date('Y-m-d H:i:s'),
	            		'nilai_transaksi' => $nominal_transfer,
	            		'saldo_awal' => $saldo_awal,
	            		'saldo_akhir' => $saldo_akhir,
	            		'jenis_transaksi' => 'TERIMA SALDO',
	            		'jenis_account' => 'VIRTUAL',
	            		'kode_transaksi' => 'REKENING',
	            		'tipe_transaksi' => 'KREDIT',
	            		'sumber_dana' => 'VIRTUAL',
	            		'no_rekening_primary' => $tujuan_id,
	            		'no_rekening_secondary' => $nasabah_id,
	            		'id_user' => $id_user,
		            	'service_time' => date('Y-m-d H:i:s'),
		            	'service_action' => 'INSERT',
		            	'service_user' => $this->session->userdata('id_user')
	            	);

	            	$this->rekening_mod->record_transaction($data_transaction_rec);
	            	$this->rekening_mod->inc_rekening_virtual($tujuan_id, $nominal_transfer);
	            	$this->rekening_mod->dec_rekening_virtual($nasabah_id, $nominal_transfer);
	            	$this->session->set_flashdata('transfer_saldo_stat', 'SUCCESS');
    			}
            } else {
            	$info->msg = "Invalid request";
            	$info->errorcode = 2;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function cari_nasabah(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'keyword',
                'label' => 'keyword',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$mod = $this->input->get('mod') ? $this->input->get('mod', true) : null;
        	$is_koperasi = $this->input->get('is_koperasi') ? $this->input->get('is_koperasi', true) : null;
        	$status = $this->input->get('status') ? $this->input->get('status', true) : null;
            $keyword = $this->input->post('keyword', true) ? $this->input->post('keyword', true) : null; 
            $this->rekening_mod->id_koperasi = null;
            if($status)
	            $this->rekening_mod->status_rekening = strtoupper($status);
            $member_list = array();
            if($keyword) {
            	$this->rekening_mod->keyword = $keyword;
            	switch ($mod) {
            		case 'tabungan':
            			if($this->session->userdata('level') == 2 && $is_koperasi == true)
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');;
			            $member_res = $this->rekening_mod->cari_nasabah_tabungan();
            			break;
					case 'virtual':
						if($this->session->userdata('level') == 2 && $is_koperasi == true)
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');;
			            $member_res = $this->rekening_mod->cari_nasabah_virtual();
            			break;
        			case 'from':
        				if($this->session->userdata('level') == 2 && $is_koperasi == true)
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');;
			            $member_res = $this->rekening_mod->cari_nasabah();
            			break;
					case 'to':
			            $member_res = $this->rekening_mod->cari_nasabah();
            			break;
            		default:
            			$member_res = $this->rekening_mod->cari_nasabah();
            			break;
            	}

	            foreach ($member_res->result() as $member_temp) {
	            	$no_rekening = $member_temp->no_rekening;
	            	array_push($member_list, array(
	            		'id_user' => $member_temp->id_user,
	            		'username' => $member_temp->username,
	            		'fullname' => strtoupper(trim($member_temp->nama_depan . ' ' . $member_temp->nama_belakang)),
	            		'no_rekening' => $member_temp->no_rekening,
	            		'jenis_rekening' => $member_temp->jenis_rekening,
	            		'id_jenis_rekening' => $member_temp->jenis_rekening == "TABUNGAN" ? 1 : 2
	            	));
	            }
	            $info->data = $member_list;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_cek_saldo(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nasabah_id',
                'label' => 'anggota',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
			$jenis_rekening = substr($this->input->post('nasabah_id', true), -1);
			$this->rekening_mod->no_rekening = $nasabah_id;
			switch ($jenis_rekening) {
				case '1':
					$nasabah_res = $this->rekening_mod->get_nasabah_rekening_tabungan();
					if($nasabah_res->num_rows() > 0){
						$nasabah_temp = $nasabah_res->row();
						$info->data = array(
							'no_rekening' => $nasabah_id,
							'id_nasabah' => $nasabah_temp->id_user,
							'nama_nasabah' => $nasabah_temp->nama_lengkap,
							'nama_koperasi' => $nasabah_temp->nama_koperasi,
							'jenis_rekening' => 'TABUNGAN',
							'nasabah_link' => base_url() . 'nasabah/' . $nasabah_temp->id_user,
							'rekening_link' => base_url() . 'nasabah/' . $nasabah_temp->id_user .'/tabungan/' . $nasabah_id,
							'saldo' => number_format($nasabah_temp->saldo, 2, ".", ","),
							'tanggal_transaksi_terakhir' => $nasabah_temp->tanggal_transaksi_terakhir
						);
					}
					break;
				case '2':
					$nasabah_res = $this->rekening_mod->get_nasabah_rekening_virtual();
					if($nasabah_res->num_rows() > 0){
						$nasabah_temp = $nasabah_res->row();
						$info->data = array(
							'no_rekening' => $nasabah_id,
							'id_nasabah' => $nasabah_temp->id_user,
							'nama_nasabah' => $nasabah_temp->nama_lengkap,
							'nama_koperasi' => $nasabah_temp->nama_koperasi,
							'jenis_rekening' => 'VIRTUAL',
							'nasabah_link' => base_url() . 'nasabah/' . $nasabah_temp->id_user,
							'rekening_link' => base_url() . 'nasabah/' . $nasabah_temp->id_user .'/virtual/' . $nasabah_id,
							'saldo' => number_format($nasabah_temp->saldo, 2, ".", ","),
							'tanggal_transaksi_terakhir' => $nasabah_temp->tanggal_transaksi_terakhir
						);
					}
					break;
				case '3':
					$nasabah_res = $this->rekening_mod->get_nasabah_rekening_loyalti();
					if($nasabah_res->num_rows() > 0){
						$nasabah_temp = $nasabah_res->row();
						$info->data = array(
							'no_rekening' => $nasabah_id,
							'id_nasabah' => $nasabah_temp->id_user,
							'nama_nasabah' => $nasabah_temp->nama_lengkap,
							'nama_koperasi' => $nasabah_temp->nama_koperasi,
							'jenis_rekening' => 'LOYALTI ' . $nasabah_temp->jenis_rekening,
							'nasabah_link' => base_url() . 'nasabah/' . $nasabah_temp->id_user,
							'rekening_link' => base_url() . 'nasabah/' . $nasabah_temp->id_user .'/loyalti/' . $nasabah_id,
							'saldo' => number_format($nasabah_temp->saldo, 2, ".", ","),
							'tanggal_transaksi_terakhir' => $nasabah_temp->tanggal_transaksi_terakhir
						);
					}
					break;
				default:
					$info->msg = "Invalid request";
					$info->errorcode = 2;
					break;
			}
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }
        
	function cari_nasabah_all_rek(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'keyword',
                'label' => 'keyword',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $keyword = $this->input->post('keyword', true) ? $this->input->post('keyword', true) : null; 
            $member_list = array();
            if($keyword) {
            	$this->rekening_mod->keyword = $keyword;
	            $member_res = $this->rekening_mod->cari_nasabah_all_rek();
	            foreach ($member_res->result() as $member_temp) {
	            	$no_rekening = $member_temp->no_rekening;
	            	$jenis_rekening = null;
	            	$id_jenis_rekening = null;
	            	switch ($member_temp->jenis_rekening) {
	            		case 'TABUNGAN':
	            			$jenis_rekening = $member_temp->jenis_rekening;
			            	$id_jenis_rekening = 1;
	            			break;
	            		case 'TABUNGAN':
	            			$jenis_rekening = $member_temp->jenis_rekening;
			            	$id_jenis_rekening = 2;
	            			break;
	            		case 'CASH':
	            			$jenis_rekening = "LOYALTI " . $member_temp->jenis_rekening;
			            	$id_jenis_rekening = 3;
	            			break;
	            		case 'INSURANCE':
	            			$jenis_rekening = "LOYALTI " . $member_temp->jenis_rekening;
			            	$id_jenis_rekening = 3;
	            			break;
	            		case 'REWARDS':
	            			$jenis_rekening = "LOYALTI POINT " . $member_temp->jenis_rekening;
			            	$id_jenis_rekening = 3;
	            			break;
	            		default:
	            			$jenis_rekening = "TIDAK DIKETAHUI";
	            			break;
	            	}
	            	array_push($member_list, array(
	            		'id_user' => $member_temp->id_user,
	            		'username' => $member_temp->username,
	            		'fullname' => strtoupper(trim($member_temp->nama_depan . ' ' . $member_temp->nama_belakang)),
	            		'no_rekening' => $member_temp->no_rekening,
	            		'jenis_rekening' => $jenis_rekening,
	            		'id_jenis_rekening' => $id_jenis_rekening
	            	));
	            }
	            $info->data = $member_list;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function cari_anggota(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'keyword',
                'label' => 'keyword',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $keyword = $this->input->post('keyword', true) ? $this->input->post('keyword', true) : null; 
            $member_list = array();
            if($keyword) {
            	$this->rekening_mod->keyword = $keyword;
	            $member_res = $this->rekening_mod->cari_anggota();
	            foreach ($member_res->result() as $member_temp) {
	            	array_push($member_list, array(
	            		'id_user' => $member_temp->id_user,
	            		'username' => $member_temp->username,
	            		'fullname' => trim($member_temp->nama_depan . ' ' . $member_temp->nama_belakang)
	            	));
	            }
	            $info->data = $member_list;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function cek_anggota_terdaftar($id_user) {
		$this->rekening_mod->id_user = $id_user;
		if($this->rekening_mod->cek_avail_nasabah()){
			$this->form_validation->set_message('cek_anggota_terdaftar', 'Maaf, anggota tidak dapat membuat rekening tabungan lebih dari satu');
			return FALSE;
		} else
			return TRUE;
	}

	function cek_jumlah_setoran($setoran_min) {
		$saldo_min = $this->input->post('saldo_min', true) ? str_replace(',', '', $this->input->post('saldo_min', true)) : null;
        $setoran_min = $this->input->post('setoran_min', true) ? str_replace(',', '', $this->input->post('setoran_min', true)) : null;
        $setoran_pokok = $this->input->post('setoran_pokok', true) ? str_replace(',', '', $this->input->post('setoran_pokok', true)) : null;
        $setoran_wajib = $this->input->post('setoran_wajib', true) ? str_replace(',', '', $this->input->post('setoran_wajib', true)) : null;
        $setoran_virtual = $this->input->post('setoran_virtual', true) ? str_replace(',', '', $this->input->post('setoran_virtual', true)) : null;
		$sisa_saldo = ($setoran_min - $setoran_pokok) - $setoran_virtual;
		if ($setoran_pokok > $setoran_min) {
			$this->form_validation->set_message('cek_jumlah_setoran', 'Maaf, jumlah setoran minimum tidak mencukupi setoran pokok nasabah');
			return FALSE;
		} else if ($setoran_min >= $setoran_pokok) { 
			if($sisa_saldo >= $saldo_min) {
				return TRUE;
			} else {
				$this->form_validation->set_message('cek_jumlah_setoran', 'Maaf, sisa saldo yang diajukan tidak mencukupi untuk melakukan transaksi');
				return FALSE;
			}
		} else {
			return TRUE;
		}
	}

	function cek_simpanan_wajib($nominal){
        $tujuan_id = $this->input->post('tujuan_id', true) ? substr($this->input->post('tujuan_id', true),0,-1) : null;
		$jenis_rekening_tujuan = substr($this->input->post('tujuan_id', true), -1);
		$nominal_transfer = $this->input->post('nominal_transfer', true) ? str_replace(',', '', $this->input->post('nominal_transfer', true)) : null;
        $is_simpanan_wajib = $this->input->post('is_simpanan_wajib', true) ? $this->input->post('is_simpanan_wajib', true) : null;
        if($is_simpanan_wajib == "Y"){
        	$this->rekening_mod->no_rekening = $tujuan_id;
			if($jenis_rekening_tujuan == "1"){
				$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
				if($saldo_res->num_rows() > 0){
					$saldo_tabungan = $saldo_res->row();
					if($saldo_tabungan->setoran_wajib == 0){
						$this->form_validation->set_message('cek_simpanan_wajib', 'Maaf, nasabah bersangkutan tidak memiliki kewajiban membayar simpanan wajib');
						return FALSE;
					} else if($saldo_tabungan->setoran_wajib > 0 && $nominal_transfer < $saldo_tabungan->setoran_wajib){
						$this->form_validation->set_message('cek_simpanan_wajib', 'Maaf, jumlah setor tunai tidak mencukupi untuk membayar simpanan wajib');
						return FALSE;
					}
				} else {
					$this->form_validation->set_message('cek_simpanan_wajib', 'Maaf, saldo Anda tidak mencukupi untuk melakukan transaksi');
					return FALSE;
				}
			} else {
				$this->form_validation->set_message('cek_simpanan_wajib', 'Maaf, nomor rekening tidak diketahui');
				return FALSE;
			}
		}

    	return TRUE;
	}

	function cek_tujuan_pengiriman($nasabah_id){
		$nasabah_id = $this->input->post('nasabah_id', true) ? $this->input->post('nasabah_id', true) : null;
        $tujuan_id = $this->input->post('tujuan_id', true) ? $this->input->post('tujuan_id', true) : null;

        if($nasabah_id == $tujuan_id) {
        	$this->form_validation->set_message('cek_tujuan_pengiriman', 'Maaf, rekening pengirim dan tujuan tidak boleh sama');
			return FALSE;
        } else {
        	return TRUE;
        }
	}

	function cek_isi_nominal($nominal){
		$nominal = $nominal ? (float)str_replace(',', '', $nominal) : null;
		if($nominal <= 0){
			$this->form_validation->set_message('cek_isi_nominal', 'Input %s harus diisi');
			return FALSE;
		} else {
        	return TRUE;
		}
	}

	function cek_pin($pin){
		if($pin){
			$id_user = $this->session->userdata('id_user');
			if(!$id_user){
				$this->form_validation->set_message('cek_pin', 'PIN yang Anda masukan salah');
				return FALSE;
			} else {
				$this->rekening_mod->id_user = $id_user;
				$pin = sha1(md5(strrev($pin)));
				if($this->rekening_mod->cek_pin($pin) > 0)
					return TRUE;
				else{
					$this->form_validation->set_message('cek_pin', 'PIN yang Anda masukan salah');
					return FALSE;
				}
			}
		} else {
			$this->form_validation->set_message('cek_pin', 'PIN yang Anda masukan salah');
        	return FALSE;
		}
	}

	function cek_saldo_pengirim($nasabah_id){
		$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
		$jenis_rekening = substr($this->input->post('nasabah_id', true), -1);
		$nominal_transfer = $this->input->post('nominal_transfer', true) ? str_replace(',', '', $this->input->post('nominal_transfer', true)) : null;
		$this->rekening_mod->no_rekening = $nasabah_id;
		if($jenis_rekening == "1"){
			$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
			$saldo_tabungan = 0;
			if($saldo_res->num_rows() > 0){
				$saldo_tabungan = $saldo_res->row()->saldo;
				$saldo_min = $saldo_res->row()->saldo_minimum;
				$sisa_saldo = $saldo_tabungan - $nominal_transfer;
			} else {
				$this->form_validation->set_message('cek_saldo_pengirim', 'Maaf, saldo Anda tidak mencukupi untuk melakukan transaksi');
				return FALSE;
			}

			if($sisa_saldo < $saldo_min){
	        	$this->form_validation->set_message('cek_saldo_pengirim', 'Maaf, saldo Anda tidak mencukupi untuk melakukan transaksi');
				return FALSE;
			}
			return TRUE;
		} else if($jenis_rekening == "2"){
			$saldo_res = $this->rekening_mod->cek_saldo_virtual();
			$saldo_virtual = 0;
			if($saldo_res->num_rows() > 0){
				$saldo_virtual = $saldo_res->row()->saldo;
				$sisa_saldo = $saldo_virtual - $nominal_transfer;
			} else {
				$this->form_validation->set_message('cek_saldo_pengirim', 'Maaf, saldo Anda tidak mencukupi untuk melakukan transaksi');
				return FALSE;
			}

			if($sisa_saldo < 0){
	        	$this->form_validation->set_message('cek_saldo_pengirim', 'Maaf, saldo Anda tidak mencukupi untuk melakukan transaksi');
				return FALSE;
			}
			return TRUE;
		} else {
        	$this->form_validation->set_message('cek_saldo_pengirim', 'Maaf, nomor rekening tidak diketahui');
			return FALSE;
		}
	}

	function cek_penarikan_tunai($nasabah_id){
		$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
		$jenis_rekening = substr($this->input->post('nasabah_id', true), -1);
		$nominal_transfer = $this->input->post('nominal_transfer', true) ? str_replace(',', '', $this->input->post('nominal_transfer', true)) : null;
		$this->rekening_mod->no_rekening = $nasabah_id;
		if($jenis_rekening == "1"){
			$saldo_res = $this->rekening_mod->cek_saldo_tabungan();
			$saldo_tabungan = 0;
			if($saldo_res->num_rows() > 0){
				$saldo_tabungan = $saldo_res->row()->saldo;
				$saldo_min = $saldo_res->row()->saldo_minimum;
				$sisa_saldo = $saldo_tabungan - $nominal_transfer;
			} else {
				$this->form_validation->set_message('cek_penarikan_tunai', 'Maaf, saldo Anda tidak mencukupi untuk melakukan transaksi');
				return FALSE;
			}

			if($sisa_saldo < $saldo_min){
	        	$this->form_validation->set_message('cek_penarikan_tunai', 'Maaf, saldo Anda tidak mencukupi untuk melakukan transaksi');
				return FALSE;
			}
			return TRUE;
		} else {
        	$this->form_validation->set_message('cek_penarikan_tunai', 'Maaf, nomor rekening tidak diketahui');
			return FALSE;
		}
	}

	function cron_calculate_bunga(){
		if($this->input->is_cli_request()){

		}
	}

	public function ajax_upload_ktp() {
		header('Content-Type: application/json');
        $info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        if (array_key_exists('user_photo', $_FILES)) {
            //Format the name
            $name = md5(date('Y-m-d H-i-s') . rand(0, 9999999999));
            $name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

            // replace characters other than letters, numbers and . by _
            $name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);

            //Your upload directory, see CI user guide
            $upload_path_folder = FCPATH . 'server/images/identity/';
            $upload_url_folder = 'server/images/identity/';
            $config2['upload_path'] = $upload_path_folder;

            $config2['allowed_types'] = 'gif|jpg|png|jpeg|JPG|GIF|PNG';
            $config2['max_size'] = '2000';
            $config2['file_name'] = $name;

            //Load the upload library
            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);

            if ($this->upload->do_upload('user_photo')) {
                $data = $this->upload->data();
                $upload_file_name = $this->upload->file_name;
                $dimension = $this->upload->image_width > $this->upload->image_height ? $this->upload->image_height : $this->upload->image_width;
                $location = $upload_path_folder.$this->upload->file_name;

                $info->data = array(
                    'url' => base_url() . $upload_url_folder . $this->upload->file_name,
                    'name' => $this->upload->file_name
                );
            } else {
                $info->msg = $this->upload->display_errors('', '');
                $info->errorcode = 2;
            }
        } else {
            $info->errorcode = 2;
            $info->msg = "Ktp harus diunggah";
        }

        echo json_encode($info);
    }

}