<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

	var $nasabah_id;
	var $jenis_rekening;

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

		if($this->session->userdata('level') != 3){
			$data['title'] = "Data Master Rekening Anggota";

			$this->rekening_mod->status_rekening = "ACTIVE";
			$data['nasabah_rek'] = $this->rekening_mod->get_nasabah_rekening();
			$this->load->view('rekening/list', $data);
		} else
			$this->load->view('404');
	}

	function rekening_non_member(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Data Master Rekening non Member";

			$data['nasabah_rek'] = $this->rekening_mod->get_nasabah_rekening_non_member();
			$this->load->view('rekening/list_non_member', $data);
		} else
			$this->load->view('404');
	}

	function rekening_deposito(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Data Master Rekening Deposito";

			$data['nasabah_rek'] = $this->rekening_mod->get_nasabah_rekening_deposito();
			$this->load->view('rekening/list_deposito', $data);
		} else
			$this->load->view('404');
	}

	function rekening_pinjaman(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Data Master Rekening Pinjaman";

			$data['nasabah_rek'] = $this->rekening_mod->get_nasabah_rekening_pinjaman();
			$this->load->view('rekening/list_pinjaman', $data);
		} else
			$this->load->view('404');
	}

	function rekening_kredit_cicilan(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Data Master Kredit Cicilan";

			$data['nasabah_rek'] = $this->rekening_mod->get_nasabah_rekening_kredit_cicilan();
			$this->load->view('rekening/list_kredit_cicilan', $data);
		} else
			$this->load->view('404');
	}

	function tarik_tunai(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Penarikan Tunai Nasabah";
			$this->load->view('rekening/tarik_tunai', $data);
		} else
			$this->load->view('404');
	}

	function ubah_status(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Penarikan Tunai Nasabah";
			$this->load->view('rekening/blokir_tutup', $data);
		} else
			$this->load->view('404');
	}

	function tarik_tunai_info(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Info Penarikan Tunai Nasabah";
			$this->load->view('rekening/tarik_tunai_info', $data);
		} else
			$this->load->view('404');
	}

	function register(){
		if($this->session->userdata('level') != 3){
			$data = array(
				'title' => "Register Rekening Anggota",
	            'sumber_penghasilan' => $this->rekening_mod->get_sumber_penghasilan(),
	            'pemasukan_per_bulan' => $this->rekening_mod->get_pemasukan_per_bulan(),
	            'frek_pemasukan_per_bulan' => $this->rekening_mod->get_frek_pemasukan_per_bulan(),
	            'pengeluaran_per_bulan' => $this->rekening_mod->get_pengeluaran_per_bulan(),
	            'frek_pengeluaran_per_bulan' => $this->rekening_mod->get_frek_pengeluaran_per_bulan(),
	            'sumber_dana_setoran' => $this->rekening_mod->get_sumber_dana_setoran(),
	            'agama' => $this->rekening_mod->get_agama(),
	            'jenis_identitas' => $this->rekening_mod->get_jenis_identitas(),
	            'provinsi' => $this->rekening_mod->get_provinsi(),
	            'pekerjaan' => $this->rekening_mod->get_pekerjaan(),
	            'pendidikan' => $this->rekening_mod->get_pendidikan(),
	            'sumber_penghasilan' => $this->rekening_mod->get_sumber_penghasilan(),
	            'pemasukan_per_bulan' => $this->rekening_mod->get_pemasukan_per_bulan(),
	            'frek_pemasukan_per_bulan' => $this->rekening_mod->get_frek_pemasukan_per_bulan(),
	            'pengeluaran_per_bulan' => $this->rekening_mod->get_pengeluaran_per_bulan(),
	            'frek_pengeluaran_per_bulan' => $this->rekening_mod->get_frek_pengeluaran_per_bulan(),
	            'sumber_dana_setoran' => $this->rekening_mod->get_sumber_dana_setoran(),
	            'negara' => $this->rekening_mod->get_negara(),
	            'gol_debitur' => $this->rekening_mod->get_gol_debitur(),
	            'pekerjaan_debitur' => $this->rekening_mod->get_pekerjaan_debitur(),
	            'bidang_usaha_debitur' => $this->rekening_mod->get_bidang_usaha_debitur(),
	            'hubungan_bank_debitur' => $this->rekening_mod->get_hubungan_bank_debitur(),
	            'jenis_debitur' => $this->rekening_mod->get_jenis_debitur(),
	            'status_gelar' => $this->rekening_mod->get_status_gelar()
			);
			$this->load->view('rekening/register', $data);
		} else
			$this->load->view('404');
	}

	function register_non_member(){
		if($this->session->userdata('level') != 3){
			$data = array(
				'title' => "Register Non Member"
			);
			$this->load->view('rekening/register_non_member', $data);
		} else
			$this->load->view('404');
	}

	function register_rekening_deposito(){
		if($this->session->userdata('level') != 3){
			$data = array(
				'title' => "Register Rekening Deposito"
			);
			$this->load->view('rekening/register_rekening_deposito', $data);
		} else
			$this->load->view('404');
	}

	function register_rekening_deposito_info(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Info Registrasi Rekening Deposito";
			$this->load->view('rekening/register_rekening_deposito_info', $data);
		} else
			$this->load->view('404');
	}

	function register_rekening_pinjaman(){
		if($this->session->userdata('level') != 3){
			$data = array(
				'title' => "Register Rekening Pinjaman"
			);
			$this->load->view('rekening/register_rekening_pinjaman', $data);
		} else
			$this->load->view('404');
	}

	function register_rekening_pinjaman_info(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Info Registrasi Rekening Pinjaman";
			$this->load->view('rekening/register_rekening_pinjaman_info', $data);
		} else
			$this->load->view('404');
	}

	function pembayaran_angsuran_info(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Info Pembayaran Angsuran Pinjaman";
			$this->load->view('rekening/pembayaran_angsuran_info', $data);
		} else
			$this->load->view('404');
	}

	function pembayaran_angsuran(){
		if($this->session->userdata('level') != 3){
			$data = array(
				'title' => "Pembayaran Angsuran"
			);
			$this->load->view('rekening/pembayaran_angsuran', $data);
		} else
			$this->load->view('404');
	}

	function pembayaran_angsuran_kredit_cicilan_info(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Info Pembayaran Angsuran Pinjaman";
			$this->load->view('rekening/pembayaran_kredit_cicilan_info', $data);
		} else
			$this->load->view('404');
	}

	function pembayaran_angsuran_kredit_cicilan(){
		if($this->session->userdata('level') != 3){
			$data = array(
				'title' => "Pembayaran Kredit Cicilan"
			);
			$this->load->view('rekening/pembayaran_kredit_cicilan', $data);
		} else
			$this->load->view('404');
	}

	function register_rekening_kredit_cicilan(){
		if($this->session->userdata('level') != 3){
			$data = array(
				'title' => "Register Rekening Kredit Cicilan"
			);
			$this->load->view('rekening/register_rekening_kredit_cicilan', $data);
		} else
			$this->load->view('404');
	}

	function register_rekening_kredit_cicilan_info(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Info Registrasi Rekening Kredit Cicilan";
			$this->load->view('rekening/register_rekening_kredit_cicilan_info', $data);
		} else
			$this->load->view('404');
	}

	function transfer_saldo(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Transfer Saldo Anggota";
			$this->load->view('rekening/transfer_saldo', $data);
		} else {
			if(!$this->session->userdata('pin')){
				$data['title'] = "Informasi Rekening Nasabah";
				$this->load->view('rekening/verify_pin', $data);
			} else {
				$data['title'] = "Transfer Saldo Anggota";
				$this->rekening_mod->id_user = $this->session->userdata('id_user');
				$var_ct = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
				switch ($var_ct) {
					case 'tabungan_virtual':
						$this->rekening_mod->jenis_rekening = "VIRTUAL";
						break;
					case 'virtual_tabungan':
						$this->rekening_mod->jenis_rekening = "TABUNGAN";
						break;
					default:
						break;
				}
				$data['rekening_fav'] = $this->rekening_mod->get_rekening_favorit();
				$this->load->view('rekening/transfer_saldo', $data);
			}
		}
	}

	function setor_tunai(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Setor Tunai Nasabah";
			$this->load->view('rekening/setor_tunai', $data);
		} else
			$this->load->view('404');
	}

	function setor_tunai_info(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Info Setor Tunai Nasabah";
			$this->load->view('rekening/setor_tunai_info', $data);
		} else
			$this->load->view('404');
	}

	function cek_saldo(){
		if($this->session->userdata('level') != 3){
			$data['title'] = "Pengecekan Saldo";
			$this->load->view('rekening/cek_saldo', $data);
		} else
			$this->load->view('404');
	}

	function rekening_favorit(){
		if($this->session->userdata('level') == 3){
			$data['title'] = "Daftar Rekening Favorit";
			$this->rekening_mod->id_user = $this->session->userdata('id_user');
			$data['rekening_fav'] = $this->rekening_mod->get_rekening_favorit();
			$this->load->view('rekening/rekening_favorit', $data);
		} else
			$this->load->view('404');
	}

	function profit_sharing(){
		if($this->session->userdata('level') == 1){
			$data['title'] = "Kelola Profit Sharing";

			$data['koperasi_res'] = $this->rekening_mod->get_koperasi_profit_sharing();
			$this->load->view('rekening/profit_sharing', $data);
		} else if($this->session->userdata('level') == 2){
			$data['title'] = "Kelola Profit Sharing";

			$profit_rekening = $this->rekening_mod->get_non_member_profit();
			foreach ($profit_rekening->result() as $pr_temp) {
				switch ($pr_temp->group) {
					case 'KOPERASI':
						$data['profit_koperasi'] = $pr_temp->share;
						break;
					case 'KETUA':
						$data['profit_ketua'] = $pr_temp->share;
						break;
					case 'ANGGOTA':
						$data['profit_anggota'] = $pr_temp->share;
						break;
				}
			}

			$data['profit_rekening'] = $profit_rekening;

			$this->rekening_mod->tipe_rekening = "OKNUM";
			$data['shareholder'] = $this->rekening_mod->get_nasabah_rekening_non_member();
			$this->load->view('rekening/kelola_profit_sharing', $data);
		} else
			$this->load->view('404');
	}

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
	function detail(){
		if($this->session->userdata('level') != 3){
			$nasabah_id = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
			if($nasabah_id) {
				$this->rekening_mod->id_user = $nasabah_id;
				$this->rekening_mod->status_rekening = "ACTIVE";

				$data = array(
					'title' => "Informasi Rekening Nasabah",
					'nasabah_info' => $this->rekening_mod->get_nasabah_info(),
					'rekening_tabungan' => $this->rekening_mod->get_nasabah_rekening_tabungan(),
					'rekening_virtual' => $this->rekening_mod->get_nasabah_rekening_virtual(),
					'rekening_loyalti' => $this->rekening_mod->get_nasabah_rekening_loyalti_summary()
				);

				$this->load->view('rekening/informasi_nasabah', $data);
			} else {
				redirect('');
			}
		} else {
			if(!$this->session->userdata('pin')){
				$data['title'] = "Informasi Rekening Nasabah";
				$this->load->view('rekening/verify_pin', $data);
			} else {
				$nasabah_id = $this->session->userdata('id_user');
				$this->rekening_mod->id_user = $nasabah_id;
				$this->rekening_mod->status_rekening = "ACTIVE";

				$data = array(
					'title' => "Informasi Rekening Nasabah",
					'nasabah_info' => $this->rekening_mod->get_nasabah_info(),
					'rekening_tabungan' => $this->rekening_mod->get_nasabah_rekening_tabungan(),
					'rekening_virtual' => $this->rekening_mod->get_nasabah_rekening_virtual(),
					'rekening_loyalti' => $this->rekening_mod->get_nasabah_rekening_loyalti_summary()
				);

				$this->load->view('rekening/informasi_nasabah', $data);
			}
		}
	}

	function ajax_get_city(){
		header('Content-Type: application/json');
        $info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $verify_rules = array(
            array(
                'field' => 'province_id',
                'label' => 'province ID',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($verify_rules);

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $province_id = $this->input->post('province_id', true);
            $this->rekening_mod->id_prov = $province_id;

            $locations = array();
            $location_res = $this->rekening_mod->get_kota();
            if($location_res->num_rows() > 0){
                foreach ($location_res->result() as $location_temp) {
                    array_push($locations, array(
                        'id' => $location_temp->id_kabupaten,
                        'name' => $location_temp->nama
                    ));
                }
                $info->data = $locations;
            }
        } else {
            $info->msg = "Invalid form input";
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_load_profit_koperasi(){
    	header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id_koperasi',
                'label' => 'ID koperasi',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'jenis_akun',
                'label' => 'jenis akun',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'sumber_dana',
                'label' => 'sumber dana',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'date_to',
                'label' => 'dari tanggal',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'date_from',
                'label' => 'hingga tanggal',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'offset',
                'label' => 'offset',
                'rules' => 'trim|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$this->rekening_mod->id_koperasi = $this->input->post('id_koperasi') ? $this->input->post('id_koperasi', true) : null;
        	$this->rekening_mod->jenis_akun = $this->input->post('jenis_akun') ? $this->input->post('jenis_akun', true) : null;
        	$this->rekening_mod->sumber_dana = $this->input->post('sumber_dana') ? $this->input->post('sumber_dana', true) : null;
        	$this->rekening_mod->date_to = $this->input->post('date_to') ? $this->input->post('date_to', true) : null;
        	$this->rekening_mod->date_from = $this->input->post('date_from') ? $this->input->post('date_from', true) : null;
        	$this->rekening_mod->offset = $this->input->post('offset') ? $this->input->post('offset', true) : null;
	        $log_res = $this->rekening_mod->get_log_profit_koperasi();

	        $logs = array();
	        foreach ($log_res->result() as $log_temp) {
	        	array_push($logs, array(
	        		'tanggal_transaksi' => $log_temp->tanggal_transaksi,
	        		'jenis_akun' => $log_temp->account,
	        		'no_transaksi' => $log_temp->no_transaksi,
	        		'sumber_dana' => $log_temp->sumber_dana,
	        		'nilai' => $log_temp->nilai,
	        		'nilai_caption' => "Rp. " . number_format($log_temp->nilai,2,".",",")
	        	));
	        }

	        $info->data = $logs;
        } else {
            $info->msg = "Invalid form input";
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_load_profit_smidumay(){
    	header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'jenis_akun',
                'label' => 'jenis akun',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'sumber_dana',
                'label' => 'sumber dana',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'date_to',
                'label' => 'dari tanggal',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'date_from',
                'label' => 'hingga tanggal',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'offset',
                'label' => 'offset',
                'rules' => 'trim|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$this->rekening_mod->jenis_akun = $this->input->post('jenis_akun') ? $this->input->post('jenis_akun', true) : 'SMIDUMAY';
        	$this->rekening_mod->sumber_dana = $this->input->post('sumber_dana') ? $this->input->post('sumber_dana', true) : null;
        	$this->rekening_mod->date_to = $this->input->post('date_to') ? $this->input->post('date_to', true) : null;
        	$this->rekening_mod->date_from = $this->input->post('date_from') ? $this->input->post('date_from', true) : null;
        	$this->rekening_mod->offset = $this->input->post('offset') ? $this->input->post('offset', true) : null;
	        $log_res = $this->rekening_mod->get_log_profit_smidumay();

	        $logs = array();
	        foreach ($log_res->result() as $log_temp) {
	        	array_push($logs, array(
	        		'tanggal_transaksi' => $log_temp->tanggal_transaksi,
	        		'jenis_akun' => $log_temp->account,
	        		'no_transaksi' => $log_temp->no_transaksi,
	        		'sumber_dana' => $log_temp->sumber_dana,
	        		'nilai' => $log_temp->nilai,
	        		'nilai_caption' => "Rp. " . number_format($log_temp->nilai,2,".",",")
	        	));
	        }

	        $info->data = $logs;
        } else {
            $info->msg = "Invalid form input";
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

	function ajax_info_transaksi(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'no_transaksi',
                'label' => 'kode transaksi',
                'rules' => 'trim|xss_clean|required'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $no_transaksi = $this->input->post('no_transaksi', true) ? $this->input->post('no_transaksi', true) : null;

            $this->rekening_mod->no_transaksi = $no_transaksi;
			$transaction_res = $this->rekening_mod->get_detail_transaction_log();
			if($transaction_res->num_rows() > 0){
				$transaction_temp = $transaction_res->row();

				switch ($transaction_temp->jenis_transaksi) {
					case 'SETORAN AWAL':

						break;
					case 'TRANSFER SALDO':
						if($transaction_temp->jenis_account == "TABUNGAN"){
							$this->rekening_mod->no_rekening = $transaction_temp->no_rekening_secondary;
							$detail_res = $this->rekening_mod->get_nasabah_rekening_tabungan();
							if($detail_res->num_rows() > 0){
								$detail_temp = $detail_res->row();
								$data_secondary = array(
				            		'no_rekening' => $detail_temp->no_rekening,
									'nama_nasabah' => $detail_temp->nama_lengkap,
									'jenis_rekening' => 'TABUNGAN',
									'koperasi' => $detail_temp->nama_koperasi,
								);
							}
						} else if($transaction_temp->jenis_account == "VIRTUAL"){
							$this->rekening_mod->no_rekening = $transaction_temp->no_rekening_secondary;
							$detail_res = $this->rekening_mod->get_nasabah_rekening_virtual();
							if($detail_res->num_rows() > 0){
								$detail_temp = $detail_res->row();
								$data_secondary = array(
				            		'no_rekening' => $detail_temp->no_rekening_virtual,
									'nama_nasabah' => $detail_temp->nama_lengkap,
									'jenis_rekening' => 'VIRTUAL',
									'koperasi' => $detail_temp->nama_koperasi,
								);
							}
						} else if($transaction_temp->jenis_account == "LOYALTI"){
							$this->rekening_mod->no_rekening = $transaction_temp->no_rekening_secondary;
							$detail_res = $this->rekening_mod->get_nasabah_rekening_loyalti();
							if($detail_res->num_rows() > 0){
								$detail_temp = $detail_res->row();
								$data_secondary = array(
				            		'no_rekening' => $detail_temp->no_rekening_loyalti,
									'nama_nasabah' => $detail_temp->nama_lengkap,
									'jenis_rekening' => 'LOYALTI' . $detail_temp->jenis_rekening,
									'koperasi' => $detail_temp->nama_koperasi,
								);
							}
						}
						break;
					case 'TERIMA SALDO':
						if($transaction_temp->sumber_dana == "TABUNGAN"){
							$this->rekening_mod->no_rekening = $transaction_temp->no_rekening_secondary;
							$detail_res = $this->rekening_mod->get_nasabah_rekening_tabungan();
							if($detail_res->num_rows() > 0){
								$detail_temp = $detail_res->row();
								$data_secondary = array(
				            		'no_rekening' => $detail_temp->no_rekening,
									'nama_nasabah' => $detail_temp->nama_lengkap,
									'jenis_rekening' => 'TABUNGAN',
									'koperasi' => $detail_temp->nama_koperasi,
								);
							}
						} else if($transaction_temp->sumber_dana == "VIRTUAL"){
							$this->rekening_mod->no_rekening = $transaction_temp->no_rekening_secondary;
							$detail_res = $this->rekening_mod->get_nasabah_rekening_virtual();
							if($detail_res->num_rows() > 0){
								$detail_temp = $detail_res->row();
								$data_secondary = array(
				            		'no_rekening' => $detail_temp->no_rekening_virtual,
									'nama_nasabah' => $detail_temp->nama_lengkap,
									'jenis_rekening' => 'VIRTUAL',
									'koperasi' => $detail_temp->nama_koperasi,
								);
							}
						} else if($transaction_temp->sumber_dana == "LOYALTI"){
							$this->rekening_mod->no_rekening = $transaction_temp->no_rekening_secondary;
							$detail_res = $this->rekening_mod->get_nasabah_rekening_loyalti();
							if($detail_res->num_rows() > 0){
								$detail_temp = $detail_res->row();
								$data_secondary = array(
				            		'no_rekening' => $detail_temp->no_rekening_loyalti,
									'nama_nasabah' => $detail_temp->nama_lengkap,
									'jenis_rekening' => 'LOYALTI' . $detail_temp->jenis_rekening,
									'koperasi' => $detail_temp->nama_koperasi,
								);
							}
						} else if($transaction_temp->sumber_dana == "TUNAI"){
							$this->rekening_mod->no_transaksi = $transaction_temp->no_transaksi;
							$detail_res = $this->rekening_mod->get_detail_rekening_transaction();
							if($detail_res->num_rows() > 0){
								$detail_temp = $detail_res->row();
								$data_secondary = array(
				            		'nama' => $detail_temp->nama,
				            		'no_ktp' => $detail_temp->no_ktp,
				            		'no_telepon' => $detail_temp->no_telepon,
				            		'jumlah_dana' => "Rp. " . number_format($detail_temp->jumlah_dana, 2,".",","),
				            		'berita_acara' => $detail_temp->berita_acara,
				            		'keterangan' => $detail_temp->keterangan,
				            		'alamat' => $detail_temp->alamat,
				            		'email' => $detail_temp->email
								);
							}
						}
						break;
				}

				$data_transaction = array(
					'no_transaksi' => $transaction_temp->no_transaksi,
					'kode_transaksi' => $transaction_temp->kode_transaksi,
					'tipe_transaksi' => $transaction_temp->tipe_transaksi,
					'id_user' => $transaction_temp->id_user,
					'no_rekening_primary' => $transaction_temp->no_rekening_primary,
					'no_rekening_secondary' => $transaction_temp->no_rekening_secondary,
					'waktu_transaksi' => $transaction_temp->service_time,
					'nilai_transaksi' => "Rp. " . number_format($transaction_temp->nilai_transaksi, 2,".",","),
					'saldo_awal' => "Rp. " . number_format($transaction_temp->saldo_awal, 2,".",","),
					'saldo_akhir' => "Rp. " . number_format($transaction_temp->saldo_akhir, 2,".",","),
					'jenis_transaksi' => $transaction_temp->jenis_transaksi,
					'jenis_account' => $transaction_temp->jenis_account,
					'sumber_dana' => $transaction_temp->sumber_dana,
					'nama_operator' => $transaction_temp->nama_operator,
					'pihak_kedua' => isset($data_secondary) ? $data_secondary : null
				);

				$info->data = $data_transaction;
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
					'saldo' => "Rp. " . number_format($nasabah_temp->saldo, 2, ".", ","),
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
		$rekening_res = $this->rekening_mod->get_nasabah_rekening_loyalti_summary();
		if(!$no_rekening){
			$no_rekening = array();
			foreach ($rekening_res->result() as $rek_temp) {
				array_push($no_rekening, $rek_temp->no_rekening_loyalti);
			}
		}
		$this->rekening_mod->no_rekening = $no_rekening;
		$log_rekening = $this->rekening_mod->get_log_rekening();
		$data = array(
			'title' => "Informasi Rekening Loyalti",
			'rekening' => $rekening_res,
			'log_rekening' => $log_rekening
		);

		$this->load->view('rekening/log_loyalti', $data);
	}

	function log_pinjaman(){
		if($this->session->userdata('level') == 3){
			$nasabah_id = $this->session->userdata('id_user');
		} else
			$nasabah_id = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
		$no_rekening = $this->uri->segment(4) ? $this->uri->segment(4, true) : null;
		$this->rekening_mod->id_user = $nasabah_id;
		$this->rekening_mod->no_rekening = $no_rekening;
		$data = array(
			'title' => "Informasi Rekening Pinjaman",
			'rekening' => $this->rekening_mod->get_nasabah_rekening_pinjaman(),
			'log_rekening' => $this->rekening_mod->get_angsuran()
		);

		$this->load->view('rekening/log_pinjaman', $data);
	}

	function log_kredit_cicilan(){
		if($this->session->userdata('level') == 3){
			$nasabah_id = $this->session->userdata('id_user');
		} else
			$nasabah_id = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
		$no_rekening = $this->uri->segment(4) ? $this->uri->segment(4, true) : null;
		$this->rekening_mod->id_user = $nasabah_id;
		$this->rekening_mod->no_rekening = $no_rekening;
		$data = array(
			'title' => "Informasi Rekening Kredit Cicilan",
			'rekening' => $this->rekening_mod->get_nasabah_rekening_kredit_cicilan(),
			'log_rekening' => $this->rekening_mod->get_kredit_cicilan(),
			'jaminan' => $this->rekening_mod->get_jaminan_kredit()
		);

		$this->load->view('rekening/log_kredit_cicilan', $data);
	}

	function profit_koperasi(){
		if($this->session->userdata('level') != 3){
			$this->load->model('koperasi_mod');
			$id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2, true) : null;
			if($this->session->userdata('level') == 2){
				if($id_koperasi && $this->session->userdata('parent_koperasi') == 0)
					$this->rekening_mod->id_koperasi = $id_koperasi;
				else
					$this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');
			} else
				$this->rekening_mod->id_koperasi = $id_koperasi;
			$koperasi_res = $this->koperasi_mod->get_koperasi_by_id($this->rekening_mod->id_koperasi);
	        if($koperasi_res->num_rows() > 0){
				$data = array(
					'koperasi' => $koperasi_res->row(),
					'title' => "Informasi Profit Koperasi",
					'profit_koperasi' => $this->rekening_mod->get_profit_koperasi(),
					'log_profit' => $this->rekening_mod->get_log_profit_koperasi()
				);

				$this->load->view('rekening/log_profit', $data);
			} else
				$this->load->view('404');
		} else
			$this->load->view('404');
	}

	function profit_smidumay(){
		if($this->session->userdata('level') == 1){
			$data = array(
				'title' => "Informasi Profit Smidumay",
				'profit_smidumay' => $this->rekening_mod->get_profit_smidumay(),
				'log_profit' => $this->rekening_mod->get_log_profit_smidumay()
			);

			$this->load->view('rekening/log_profit_smidumay', $data);
		} else
			$this->load->view('404');
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
            ),

            // recently added
            array(
                'field' => 'nama_nasabah',
                'label' => 'nama nasabah',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'nama_alias',
                'label' => 'nama alias',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kode_agama',
                'label' => 'agama',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'jenis_kelamin',
                'label' => 'jenis kelamin',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tempat_lahir',
                'label' => 'tempat lahir',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'tgl_lahir',
                'label' => 'tanggal lahir',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'jenis_id',
                'label' => 'jenis identitas',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'no_id',
                'label' => 'nomor identitas',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'masa_berlaku_ktp',
                'label' => 'masa berlaku ID',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'nama_ibu_kandung',
                'label' => 'nama ibu kandung',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'alamat',
                'label' => 'alamat',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'desa',
                'label' => 'desa',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kecamatan',
                'label' => 'kecamatan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kota_kab',
                'label' => 'kota kabupaten',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'provinsi',
                'label' => 'propinsi',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'lokasi_usaha',
                'label' => 'lokasi usaha',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kodepos',
                'label' => 'kodepos',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kode_area',
                'label' => 'kode area',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'telpon',
                'label' => 'nomor telepon',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'hp',
                'label' => 'nomor handphone',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kode_group1',
                'label' => 'pekerjaan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kode_group2',
                'label' => 'pendidikan terakhir',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'kode_group3',
                'label' => 'status keanggotaan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'photo',
                'label' => 'foto',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'image_ktp',
                'label' => 'foto KTP',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'verifikasi',
                'label' => 'status verifikasi',
                'rules' => 'trim|xss_clean'
            ),
            //halaman 2
            array(
                'field' => 'waris_nama',
                'label' => 'nama pewaris pertama',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_jenis_kelamin',
                'label' => 'jenis kelamin pewaris pertama',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_tgl_lahir',
                'label' => 'tanggal lahir pewaris pertama',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_hub',
                'label' => 'hubungan dengan pewaris pertama',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_alamat',
                'label' => 'alamat pewaris pertama',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_nama2',
                'label' => 'nama pewaris kedua',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_jenis_kelamin2',
                'label' => 'jenis kelamin pewaris kedua',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_tgl_lahir2',
                'label' => 'tanggal lahir pewaris kedua',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_hub2',
                'label' => 'hubungan dengan pewaris kedua',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_alamat2',
                'label' => 'alamat pewaris kedua',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_nama3',
                'label' => 'nama pewaris ketiga',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_jenis_kelamin3',
                'label' => 'jenis kelamin pewaris ketiga',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_tgl_lahir3',
                'label' => 'tanggal lahir pewaris ketiga',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_hub3',
                'label' => 'hubungan dengan pewaris ketiga',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'waris_alamat3',
                'label' => 'alamat pewaris ketiga',
                'rules' => 'trim|xss_clean'
            ),
            //halaman 3
            array(
                'field' => 'alamat_ktp',
                'label' => 'alamat berdasarkan KTP',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'alamat_surat',
                'label' => 'alamat surat',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'alamat_kantor',
                'label' => 'alamat kantor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'nama_kantor',
                'label' => 'nama kantor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'nama_instansi',
                'label' => 'nama instansi',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'telp_kantor',
                'label' => 'telepon kantor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'keterangan',
                'label' => 'keterangan data nasabah',
                'rules' => 'trim|xss_clean'
            ),
            //halaman 4
            array(
                'field' => 'din',
                'label' => 'DIN',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'negara_domisili',
                'label' => 'domisili negara',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'gol_debitur',
                'label' => 'golongan debitur',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'sandi_pekerjaan',
                'label' => 'sandi pekerjaan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'tempat_bekerja',
                'label' => 'tempat bekerja',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'bidang_usaha',
                'label' => 'bidang usaha',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'hub_dgn_bank',
                'label' => 'hubungan dengan bank',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'langgar_bmpk',
                'label' => 'melanggar BMPK',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'lampaui_bmpk',
                'label' => 'melampaui BMPK',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'jenis_debitur',
                'label' => 'jenis debitur',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'no_paspor',
                'label' => 'nomor paspor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'ket_status',
                'label' => 'keterangan status identitas',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'npwp',
                'label' => 'NPWP',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'status_gelar',
                'label' => 'status gelar',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'tempat_badan_usaha',
                'label' => 'tempat badan usaha',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'tgl_akte_awal',
                'label' => 'tanggal akte awal',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'no_akte_awal',
                'label' => 'nomor akte awal',
                'rules' => 'trim|xss_clean'
            ),
            //halaman 5
            array(
                'field' => 'tandatangan',
                'label' => 'tanda tangan',
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

			            $data_profil_nasabah = array(
	            			'id_user' => $nasabah_id,
	            			'no_rekening' => $transaction_id,
		            		'tgl_register' => $tgl_register,
			                'nama_nasabah' => $this->input->post('nama_nasabah', true) ? $this->input->post('nama_nasabah', true) : null,
			                'nama_alias' => $this->input->post('nama_alias', true) ? $this->input->post('nama_alias', true) : null,
			                'jenis_kelamin' => $this->input->post('jenis_kelamin', true) ? $this->input->post('jenis_kelamin', true) : null,
			                'tempat_lahir' => $this->input->post('tempat_lahir', true) ? $this->input->post('tempat_lahir', true) : null,
			                'tgl_lahir' => $this->input->post('tgl_lahir', true) ? $this->input->post('tgl_lahir', true) : null,
			                'jenis_identitas' => $this->input->post('jenis_id', true) ? $this->input->post('jenis_id', true) : null,
			                'no_identitas' => $this->input->post('no_id', true) ? $this->input->post('no_id', true) : null,
			                'masa_berlaku_identitas' => $this->input->post('masa_berlaku_ktp', true) ? $this->input->post('masa_berlaku_ktp', true) : null,
			                'agama' => $this->input->post('kode_agama', true) ? $this->input->post('kode_agama', true) : null,
			                'nama_ibu_kandung' => $this->input->post('nama_ibu_kandung', true) ? $this->input->post('nama_ibu_kandung', true) : null,
			                'alamat' => $this->input->post('alamat', true) ? $this->input->post('alamat', true) : null,
			                'kelurahan' => $this->input->post('desa', true) ? $this->input->post('desa', true) : null,
			                'kota_kab' => $this->input->post('kota_kab', true) ? $this->input->post('kota_kab', true) : null,
			                'kecamatan' => $this->input->post('kecamatan', true) ? $this->input->post('kecamatan', true) : null,
			                'propinsi' => $this->input->post('provinsi', true) ? $this->input->post('provinsi', true) : null,
			                'kodepos' => $this->input->post('kodepos', true) ? $this->input->post('kodepos', true) : null,
			                'telpon' => $this->input->post('telpon', true) ? $this->input->post('telpon', true) : null,
			                'hp' => $this->input->post('hp', true) ? $this->input->post('hp', true) : null,
			                'pekerjaan' => $this->input->post('kode_group1', true) ? $this->input->post('kode_group1', true) : null,
			                'pendidikan' => $this->input->post('kode_group2', true) ? $this->input->post('kode_group2', true) : null,
			                'kebangsaan' => $this->input->post('kebangsaan', true) ? $this->input->post('kebangsaan', true) : null,
			                //halaman 2
			                'waris_nama' => $this->input->post('waris_nama', true) ? $this->input->post('waris_nama', true) : null,
			                'waris_jenis_kelamin' => $this->input->post('waris_jenis_kelamin', true) ? $this->input->post('waris_jenis_kelamin', true) : null,
			                'waris_tgl_lahir' => $this->input->post('waris_tgl_lahir', true) ? $this->input->post('waris_tgl_lahir', true) : null,
			                'waris_hub' => $this->input->post('waris_hub', true) ? $this->input->post('waris_hub', true) : null,
			                'waris2_nama' => $this->input->post('waris_nama2', true) ? $this->input->post('waris_nama2', true) : null,
			                'waris2_jenis_kelamin' => $this->input->post('waris_jenis_kelamin2', true) ? $this->input->post('waris_jenis_kelamin2', true) : null,
			                'waris2_tgl_lahir' => $this->input->post('waris_tgl_lahir2', true) ? $this->input->post('waris_tgl_lahir2', true) : null,
			                'waris2_hub' => $this->input->post('waris_hub2', true) ? $this->input->post('waris_hub2', true) : null,
			                'waris3_nama' => $this->input->post('waris_nama3', true) ? $this->input->post('waris_nama3', true) : null,
			                'waris3_jenis_kelamin' => $this->input->post('waris_jenis_kelamin3', true) ? $this->input->post('waris_jenis_kelamin3', true) : null,
			                'waris3_tgl_lahir' => $this->input->post('waris_tgl_lahir3', true) ? $this->input->post('waris_tgl_lahir3', true) : null,
			                'waris3_hub' => $this->input->post('waris_hub3', true) ? $this->input->post('waris_hub3', true) : null,
			                //halaman 3
			                'kontak_alamat_ktp' => $this->input->post('alamat_ktp', true) ? $this->input->post('alamat_ktp', true) : null,
			                'kontak_alamat_surat' => $this->input->post('alamat_surat', true) ? $this->input->post('alamat_surat', true) : null,
			                'kontak_alamat_kantor' => $this->input->post('alamat_kantor', true) ? $this->input->post('alamat_kantor', true) : null,
			                'kontak_nama_kantor' => $this->input->post('nama_kantor', true) ? $this->input->post('nama_kantor', true) : null,
			                'kontak_nama_instansi' => $this->input->post('nama_instansi', true) ? $this->input->post('nama_instansi', true) : null,
			                'kontak_telpon_kantor' => $this->input->post('telp_kantor', true) ? $this->input->post('telp_kantor', true) : null,
			                'kontak_email' => $this->input->post('email', true) ? $this->input->post('email', true) : null,
			                'kontak_keterangan' => $this->input->post('keterangan', true) ? $this->input->post('keterangan', true) : null,
			                'keu_tujuan_pembukaan_rekening' => $this->input->post('tujuan_pembukaan_rekening_tab', true) ? $this->input->post('tujuan_pembukaan_rekening_tab', true) : null,
			                'keu_penghasilan_utama' => $this->input->post('penghasilan_utama', true) ? $this->input->post('penghasilan_utama', true) : null,
			                'keu_sumber_penghasilan' => $this->input->post('kode_sumber_penghasilan', true) ? $this->input->post('kode_sumber_penghasilan', true) : null,
			                'keu_pemasukan_bulanan' => $this->input->post('kode_pemasukan_per_bulan', true) ? $this->input->post('kode_pemasukan_per_bulan', true) : null,
			                'keu_frek_pemasukan_bulanan' => $this->input->post('kode_frek_pemasukan_per_bulan', true) ? $this->input->post('kode_frek_pemasukan_per_bulan', true) : null,
			                'keu_pengeluaran_bulanan' => $this->input->post('kode_pengeluaran_per_bulan', true) ? $this->input->post('kode_pengeluaran_per_bulan', true) : null,
			                'keu_frek_pengeluaran_bulanan' => $this->input->post('kode_frek_pengeluaran_per_bulan', true) ? $this->input->post('kode_frek_pengeluaran_per_bulan', true) : null,
			                'keu_sumber_dana_setoran' => $this->input->post('kode_sumber_dana_untuk_setoran', true) ? $this->input->post('kode_sumber_dana_untuk_setoran', true) : null,
			                'keu_tujuan_penggunaan_dana' => $this->input->post('tujuan_penggunaan_dana', true) ? $this->input->post('tujuan_penggunaan_dana', true) : null,
			                'keu_rekening_alternatif' => $this->input->post('keu_rekening_alternatif', true) ? $this->input->post('keu_rekening_alternatif', true) : null,
			                //halaman 4
			                'din' => $this->input->post('din', true) ? $this->input->post('din', true) : null,
			                'din_negara_domisili' => $this->input->post('negara_domisili', true) ? $this->input->post('negara_domisili', true) : null,
			                'din_golongan' => $this->input->post('gol_debitur', true) ? $this->input->post('gol_debitur', true) : null,
			                'din_pekerjaan' => $this->input->post('sandi_pekerjaan', true) ? $this->input->post('sandi_pekerjaan', true) : null,
			                'din_perusahaan' => $this->input->post('tempat_bekerja', true) ? $this->input->post('tempat_bekerja', true) : null,
			                'din_bidang_usaha' => $this->input->post('bidang_usaha', true) ? $this->input->post('bidang_usaha', true) : null,
			                'din_hubungan_bank' => $this->input->post('hub_dgn_bank', true) ? $this->input->post('hub_dgn_bank', true) : null,
			                'din_melanggar_bmpk' => $this->input->post('langgar_bmpk', true) ? $this->input->post('langgar_bmpk', true) : null,
			                'din_melampaui_bmpk' => $this->input->post('lampaui_bmpk', true) ? $this->input->post('lampaui_bmpk', true) : null,
			                'din_jenis_debitur' => $this->input->post('jenis_debitur', true) ? $this->input->post('jenis_debitur', true) : null,
			                'din_no_paspor' => $this->input->post('no_paspor', true) ? $this->input->post('no_paspor', true) : null,
			                'din_keterangan' => $this->input->post('ket_status', true) ? $this->input->post('ket_status', true) : null,
			                'din_npwp' => $this->input->post('npwp', true) ? $this->input->post('npwp', true) : null,
			                'din_status_debitur' => $this->input->post('status_gelar', true) ? $this->input->post('status_gelar', true) : null,
			                'din_kota_pendirian_usaha' => $this->input->post('tempat_badan_usaha', true) ? $this->input->post('tempat_badan_usaha', true) : null,
			                'din_tgl_akte_awal_usaha' => $this->input->post('tgl_akte_awal', true) ? $this->input->post('tgl_akte_awal', true) : null,
			                'din_no_akte_awal_usaha' => $this->input->post('no_akte_awal', true) ? $this->input->post('no_akte_awal', true) : null,
			                // 'verifikasi' => $this->input->post('verifikasi', true) ? $this->input->post('verifikasi', true) : null
		            	);

		            	if($this->rekening_mod->record_transaction($data_transaction_rec_tabungan) && $this->rekening_mod->register_info_keuangan($data_keuangan) && $this->rekening_mod->register_nasabah($data_profil_nasabah)){
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

	function ajax_register_non_member(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id_koperasi',
                'label' => 'koperasi',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'tipe_rekening',
                'label' => 'tipe kepemilikan',
                'rules' => 'trim|xss_clean|callback_cek_rek_kepemilikan'
            ),
            array(
                'field' => 'nama',
                'label' => 'atas nama pemilik',
                'rules' => 'trim|xss_clean|required|callback_cek_rekening_non_member_utama'
            ),
            array(
                'field' => 'saldo',
                'label' => 'saldo awal',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'keterangan',
                'label' => 'keterangan',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $id_koperasi = $this->input->post('id_koperasi', true) ? $this->input->post('id_koperasi', true) : null;
            $nama = $this->input->post('nama', true) ? $this->input->post('nama', true) : null;
            $saldo = $this->input->post('saldo', true) ? str_replace(',', '', $this->input->post('saldo', true)) : 0;
            $keterangan = $this->input->post('keterangan', true) ? $this->input->post('keterangan', true) : null;

            if($this->session->userdata('level') == 1){
            	$tipe_rekening = "KOPERASI";
            	$no_rekening = $id_koperasi . '.010.' . sprintf("%06d", 0);
            } else if($this->session->userdata('level') == 2) {
            	$id_koperasi = $this->session->userdata('id_koperasi');
            	$no_rekening = $id_koperasi . '.010.' . time();
            	switch ($this->input->post('tipe_rekening', true)) {
            		case 'KOPERASI':
		            	$tipe_rekening = "KOPERASI";
		            	$no_rekening = $id_koperasi . '.010.' . sprintf("%06d", 0);
            			break;
            		case 'KETUA':
		            	$tipe_rekening = "KETUA";
            			break;
            		case 'OKNUM':
		            	$tipe_rekening = "OKNUM";
            			break;
            		default:
            			$tipe_rekening = NULL;
            			break;
            	}
            }

            $data = array(
            	'id_koperasi' => $id_koperasi,
            	'no_rekening' => $no_rekening,
            	'nama' => $nama,
            	'saldo' => $saldo,
            	'keterangan' => $keterangan,
            	'tipe_rekening' => $tipe_rekening,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'INSERT',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->register_rekening_non_member($data)){
            	$info->msg = "Pembuatan rekening non member telah dibuat";
            	$this->session->set_flashdata('rekening_non_member_stat', $data);
            } else {
            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_register_deposito(){
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
                'field' => 'jumlah_deposito',
                'label' => 'nominal jumlah deposito',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal'
            ),
            array(
                'field' => 'jangka_waktu',
                'label' => 'jangka waktu',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tanggal_register',
                'label' => 'tanggal register',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tanggal_jatuh_tempo',
                'label' => 'tanggal jatuh tempo',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'no_bilyet',
                'label' => 'nomor bilyet',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'margin_rupiah',
                'label' => 'margin rupiah',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'margin_persen',
                'label' => 'margin persen',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'perlakuan_jatuh_tempo',
                'label' => 'perlakuan jatuh tempo',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'perlakuan_margin_perbulan',
                'label' => 'perlakuan margin perbulan',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'keterangan',
                'label' => 'keterangan',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
            $jumlah_deposito = $this->input->post('jumlah_deposito', true) ? str_replace(',', '', $this->input->post('jumlah_deposito', true)) : 0;
            $jangka_waktu = $this->input->post('jangka_waktu') ? $this->input->post('jangka_waktu', true) : null;
            $tanggal_register = $this->input->post('tanggal_register') ? $this->input->post('tanggal_register', true) : null;
            $tanggal_jatuh_tempo = $this->input->post('tanggal_jatuh_tempo') ? $this->input->post('tanggal_jatuh_tempo', true) : null;
            $no_bilyet = $this->input->post('no_bilyet') ? $this->input->post('no_bilyet', true) : null;
            $margin_rupiah = $this->input->post('margin_rupiah', true) ? str_replace(',', '', $this->input->post('margin_rupiah', true)) : 0;
            $margin_persen = $this->input->post('margin_persen') ? $this->input->post('margin_persen', true) : null;
            $perlakuan_jatuh_tempo = $this->input->post('perlakuan_jatuh_tempo') ? $this->input->post('perlakuan_jatuh_tempo', true) : null;
            $perlakuan_margin_perbulan = $this->input->post('perlakuan_margin_perbulan') ? $this->input->post('perlakuan_margin_perbulan', true) : null;
            $keterangan = $this->input->post('keterangan') ? $this->input->post('keterangan', true) : null;

            $this->rekening_mod->no_rekening = $nasabah_id;
            $rek_tabungan = $this->rekening_mod->get_nasabah_rekening_tabungan();
            if($rek_tabungan->num_rows() > 0){
            	$id_koperasi = $rek_tabungan->row()->koperasi;
            	$id_user = $rek_tabungan->row()->id_user;
            	$nama_lengkap = $rek_tabungan->row()->nama_lengkap;
            	$nama_koperasi = $rek_tabungan->row()->nama_koperasi;

            	$this->rekening_mod->id_koperasi = $id_koperasi;
            	$this->rekening_mod->last = TRUE;
            	$rek_deposito = $this->rekening_mod->get_nasabah_rekening_deposito();
            	$no_urut = 1;
            	if($rek_deposito->num_rows() > 0){
            		$last_no_rek = $rek_deposito->row()->no_rekening_deposito;
            		$no_urut = (int)substr($last_no_rek, strrpos($last_no_rek, '.') + 1);
            		$no_urut++;
            	}

	            $running = false;

	        	while (!$running) {
	            	$mask_no_urut = sprintf("%06d", $no_urut);
	            	// create rekening tabungan
		            $data = array(
		            	'id_user' => $id_user,
		            	'no_rekening_deposito' => $id_koperasi . '.013.' . $mask_no_urut,
		            	'no_rekening_user' => $nasabah_id,
		            	'jumlah_deposito' => $jumlah_deposito,
		            	'jangka_waktu' => $jangka_waktu,
		            	'tanggal_register' => $tanggal_register,
		            	'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo,
		            	'no_bilyet' => $no_bilyet,
		            	'margin_rupiah' => $margin_rupiah,
		            	'margin_persen' => $margin_persen,
		            	'perlakuan_jatuh_tempo' => $perlakuan_jatuh_tempo,
		            	'perlakuan_margin_perbulan' => $perlakuan_margin_perbulan,
		            	'keterangan' => $keterangan
		            );

		            if($this->rekening_mod->register_rekening_deposito($data))
		            	$running = TRUE;
		            $no_urut++;
		        }
		        if ($running) {
		        	$data['nama_lengkap'] = $nama_lengkap;
		        	$data['nama_koperasi'] = $nama_koperasi;
	            	$info->msg = "Pembuatan rekening deposito telah dibuat";
	            	$this->session->set_flashdata('rekening_deposito_stat', $data);
		        } else {
	            	$info->errorcode = 2;
	            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
	            }
            } else {
            	$info->errorcode = 2;
				$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_register_pinjaman(){
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
                'field' => 'jumlah_pinjaman',
                'label' => 'nominal jumlah pinjaman',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal'
            ),
            array(
                'field' => 'tanggal_pencairan',
                'label' => 'tanggal pencairan',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'jumlah_angsuran',
                'label' => 'jumlah angsuran',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tanggal_tagihan',
                'label' => 'tanggal tagihan',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tanggal_jatuh_tempo',
                'label' => 'tanggal jatuh tempo',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'periode_jumlah',
                'label' => 'periode jumlah',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'periode_waktu',
                'label' => 'periode waktu',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'grace_period',
                'label' => 'lama penangguhan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'margin_rupiah',
                'label' => 'margin rupiah',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'margin_persen',
                'label' => 'margin persen',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? $this->input->post('nasabah_id', true) : null;
            $jumlah_pinjaman = $this->input->post('jumlah_pinjaman', true) ? str_replace(',', '', $this->input->post('jumlah_pinjaman', true)) : 0;
            $tanggal_pencairan = $this->input->post('tanggal_pencairan') ? $this->input->post('tanggal_pencairan', true) : null;
            $jumlah_angsuran = $this->input->post('jumlah_angsuran') ? $this->input->post('jumlah_angsuran', true) : null;
            $tanggal_tagihan = $this->input->post('tanggal_tagihan') ? $this->input->post('tanggal_tagihan', true) : null;
            $tanggal_jatuh_tempo = $this->input->post('tanggal_jatuh_tempo') ? $this->input->post('tanggal_jatuh_tempo', true) : null;
            $periode_jumlah = $this->input->post('periode_jumlah') ? $this->input->post('periode_jumlah', true) : null;
            $periode_waktu = $this->input->post('periode_waktu') ? $this->input->post('periode_waktu', true) : null;
            $grace_period = $this->input->post('grace_period') ? $this->input->post('grace_period', true) : null;
            $margin_rupiah = $this->input->post('margin_rupiah', true) ? str_replace(',', '', $this->input->post('margin_rupiah', true)) : 0;
            $margin_persen = $this->input->post('margin_persen') ? $this->input->post('margin_persen', true) : null;
            $potongan_notaris = $this->input->post('potongan_notaris', true) ? str_replace(',', '', $this->input->post('potongan_notaris', true)) : 0;
            $potongan_tab_wajib = $this->input->post('potongan_tab_wajib', true) ? str_replace(',', '', $this->input->post('potongan_tab_wajib', true)) : 0;
            $potongan_cr = $this->input->post('potongan_cr', true) ? str_replace(',', '', $this->input->post('potongan_cr', true)) : 0;
            $potongan_adm = $this->input->post('potongan_adm', true) ? str_replace(',', '', $this->input->post('potongan_adm', true)) : 0;
            $potongan_materai = $this->input->post('potongan_materai', true) ? str_replace(',', '', $this->input->post('potongan_materai', true)) : 0;
            $potongan_premi = $this->input->post('potongan_premi', true) ? str_replace(',', '', $this->input->post('potongan_premi', true)) : 0;

           	$this->rekening_mod->id_user = $nasabah_id;
            $retrieve_user_info = $this->rekening_mod->get_user_info();
            if($retrieve_user_info->num_rows() > 0){
            	$id_koperasi = $retrieve_user_info->row()->koperasi;
            	$this->rekening_mod->id_koperasi = $id_koperasi;
            	$id_user = $nasabah_id;
            	$nama_lengkap = $retrieve_user_info->row()->nama_lengkap;

            	$this->rekening_mod->last = TRUE;
            	$rek_pinjaman = $this->rekening_mod->get_nasabah_rekening_pinjaman();
            	$no_urut = 1;
            	if($rek_pinjaman->num_rows() > 0){
            		$last_no_rek = $rek_pinjaman->row()->no_rekening_pinjaman;
            		$no_urut = (int)substr($last_no_rek, strrpos($last_no_rek, '.') + 1);
            		$no_urut++;
            	}

	            $running = false;

	        	while (!$running) {
	            	$mask_no_urut = sprintf("%06d", $no_urut);
	            	// create rekening tabungan
		            $data = array(
		            	'id_user' => $id_user,
		            	'no_rekening_pinjaman' => $id_koperasi . '.014.' . $mask_no_urut,
		            	'jumlah_pinjaman' => $jumlah_pinjaman,
		            	'tanggal_pencairan' => $tanggal_pencairan,
		            	'jumlah_angsuran' => $jumlah_angsuran,
		            	'tanggal_tagihan' => $tanggal_tagihan,
		            	'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo,
		            	'periode_jumlah' => $periode_jumlah,
		            	'periode_waktu' => $periode_waktu,
		            	'grace_period' => $grace_period,
		            	'margin_rupiah' => $margin_rupiah,
		            	'margin_persen' => $margin_persen,
		            	'potongan_premi' => $potongan_premi,
		            	'potongan_materai' => $potongan_materai,
		            	'potongan_adm' => $potongan_adm,
		            	'potongan_cr' => $potongan_cr,
		            	'potongan_notaris' => $potongan_notaris,
		            	'potongan_tab_wajib' => $potongan_tab_wajib,
		            	'status_lancar' => 'L',
		            	'sisa_angsuran_pokok' => $jumlah_pinjaman,
		            	'sisa_angsuran' => $jumlah_angsuran
		            );

		            if($this->rekening_mod->register_rekening_pinjaman($data))
		            	$running = TRUE;
		            $no_urut++;
		        }
		        if ($running) {
		        	$data['nama_lengkap'] = $nama_lengkap;
	            	$info->msg = "Pembuatan rekening pinjaman telah dibuat";
	            	$this->session->set_flashdata('rekening_pinjaman_stat', $data);
		        } else {
	            	$info->errorcode = 2;
	            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
	            }
            } else {
            	$info->errorcode = 2;
				$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_bayar_angsuran(){
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
                'field' => 'jumlah_setoran',
                'label' => 'nominal jumlah setoran',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal'
            ),
            array(
                'field' => 'tanggal_bayar',
                'label' => 'tanggal pembayaran',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'get_charge',
                'label' => 'kenai denda',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'pelunasan',
                'label' => 'status pelunasan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'jumlah_denda',
                'label' => 'jumlah denda',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'diskon',
                'label' => 'diskon',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'keterangan',
                'label' => 'keterangan',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
            $jumlah_setoran = $this->input->post('jumlah_setoran', true) ? str_replace(',', '', $this->input->post('jumlah_setoran', true)) : 0;
            $tanggal_bayar = $this->input->post('tanggal_bayar') ? $this->input->post('tanggal_bayar', true) : null;
            $get_charge = $this->input->post('get_charge') ? $this->input->post('get_charge', true) : null;
            $pelunasan = $this->input->post('pelunasan') ? $this->input->post('pelunasan', true) : null;
            $jumlah_denda = $this->input->post('jumlah_denda') ? str_replace(',', '', $this->input->post('jumlah_denda', true)) : 0;
            $diskon = $this->input->post('diskon', true) ? str_replace(',', '', $this->input->post('diskon', true)) : 0;
            $keterangan = $this->input->post('keterangan') ? $this->input->post('keterangan', true) : null;

            $this->rekening_mod->no_rekening = $nasabah_id;
            $rek_pinjaman = $this->rekening_mod->get_nasabah_rekening_pinjaman();
            if($rek_pinjaman->num_rows() > 0){
            	$rek_temp = $rek_pinjaman->row();
            	$sisa_angsuran_awal = $rek_temp->sisa_angsuran_pokok;
            	$sisa_angsuran_akhir = $sisa_angsuran_awal - $jumlah_setoran;

	            $data_angsuran = array(
	            	'no_rekening_pinjaman' => $nasabah_id,
	            	'angsuran_ke' => (int)$rek_temp->count_angsuran + 1,
	            	'jumlah_setoran' => $jumlah_setoran,
	            	'tanggal_bayar' => $tanggal_bayar,
	            	'jumlah_bunga' => 0,
	            	'jumlah_denda' => $get_charge ? $jumlah_denda : 0,
	            	'keterangan' => $keterangan,
	            	'diskon' => $pelunasan ? $diskon : 0,
	            	'pelunasan' => $pelunasan ? 'Y' : ($sisa_angsuran_akhir <= 0 ? "Y" : "N"),
	            	'sisa_pinjaman_akhir' => $sisa_angsuran_akhir,
	            	'sisa_pinjaman_awal' => $sisa_angsuran_awal
	            );

	            if ($this->rekening_mod->register_angsuran($data_angsuran)) {
	            	$data_pinjaman = array(
	            		'sisa_angsuran' => $rek_temp->jumlah_angsuran - $data_angsuran['angsuran_ke'],
	            		'sisa_angsuran_pokok' => $sisa_angsuran_akhir,
	            		'tanggal_lunas' => $sisa_angsuran_akhir <= 0 ? date('Y-m-d') : null
	            	);

	            	if($this->rekening_mod->update_rekening_pinjaman($nasabah_id, $data_pinjaman)){
		            	$info->msg = "Pembayaran angsuran telah dilakukan";
		            	$data_angsuran['sisa_angsuran'] = $data_pinjaman['sisa_angsuran_pokok'];
		            	$data_angsuran['nama_lengkap'] = $rek_temp->nama_lengkap;
		            	$this->session->set_flashdata('angsuran_stat', $data_angsuran);
	            	} else{
	            		$info->errorcode = 2;
	            		$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
	            	}
	            } else{
            		$info->errorcode = 2;
            		$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
            	}
            } else{
        		$info->errorcode = 2;
        		$info->msg = "Nomor rekening pinjaman tidak ditemukan";
        	}
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_bayar_kredit_cicilan(){
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
                'field' => 'jumlah_setoran',
                'label' => 'nominal jumlah setoran',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal'
            ),
            array(
                'field' => 'tanggal_bayar',
                'label' => 'tanggal pembayaran',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'get_charge',
                'label' => 'kenai denda',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'pelunasan',
                'label' => 'status pelunasan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'jumlah_denda',
                'label' => 'jumlah denda',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'diskon',
                'label' => 'diskon',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'keterangan',
                'label' => 'keterangan',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
            $jumlah_setoran = $this->input->post('jumlah_setoran', true) ? str_replace(',', '', $this->input->post('jumlah_setoran', true)) : 0;
            $tanggal_bayar = $this->input->post('tanggal_bayar') ? $this->input->post('tanggal_bayar', true) : null;
            $get_charge = $this->input->post('get_charge') ? $this->input->post('get_charge', true) : null;
            $pelunasan = $this->input->post('pelunasan') ? $this->input->post('pelunasan', true) : null;
            $jumlah_denda = $this->input->post('jumlah_denda') ? str_replace(',', '', $this->input->post('jumlah_denda', true)) : 0;
            $diskon = $this->input->post('diskon', true) ? str_replace(',', '', $this->input->post('diskon', true)) : 0;
            $keterangan = $this->input->post('keterangan') ? $this->input->post('keterangan', true) : null;

            $this->rekening_mod->no_rekening = $nasabah_id;
            $rek_kredit_cicilan = $this->rekening_mod->get_nasabah_rekening_kredit_cicilan();
            if($rek_kredit_cicilan->num_rows() > 0){
            	$rek_temp = $rek_kredit_cicilan->row();
            	$sisa_angsuran_awal = $rek_temp->sisa_angsuran_pokok;
            	$sisa_angsuran_akhir = $sisa_angsuran_awal - $jumlah_setoran;

	            $data_angsuran = array(
	            	'no_rekening_kredit' => $nasabah_id,
	            	'angsuran_ke' => (int)$rek_temp->count_angsuran + 1,
	            	'jumlah_setoran' => $jumlah_setoran,
	            	'tanggal_bayar' => $tanggal_bayar,
	            	'jumlah_bunga' => 0,
	            	'jumlah_denda' => $get_charge ? $jumlah_denda : 0,
	            	'keterangan' => $keterangan,
	            	'diskon' => $pelunasan ? $diskon : 0,
	            	'pelunasan' => $pelunasan ? 'Y' : ($sisa_angsuran_akhir <= 0 ? "Y" : "N"),
	            	'sisa_kredit_akhir' => $sisa_angsuran_akhir,
	            	'sisa_kredit_awal' => $sisa_angsuran_awal
	            );

	            if ($this->rekening_mod->register_kredit_cicilan($data_angsuran)) {
	            	$data_kredit_cicilan = array(
	            		'sisa_angsuran' => $rek_temp->jumlah_angsuran - $data_angsuran['angsuran_ke'],
	            		'sisa_angsuran_pokok' => $sisa_angsuran_akhir,
	            		'tanggal_lunas' => $sisa_angsuran_akhir <= 0 ? date('Y-m-d') : null
	            	);

	            	if($this->rekening_mod->update_rekening_kredit_cicilan($nasabah_id, $data_kredit_cicilan)){
		            	$info->msg = "Pembayaran angsuran telah dilakukan";
		            	$data_angsuran['sisa_angsuran'] = $data_kredit_cicilan['sisa_angsuran_pokok'];
		            	$data_angsuran['nama_lengkap'] = $rek_temp->nama_lengkap;
		            	$this->session->set_flashdata('angsuran_stat', $data_angsuran);
	            	} else{
	            		$info->errorcode = 2;
	            		$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
	            	}
	            } else{
            		$info->errorcode = 2;
            		$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
            	}
            } else{
        		$info->errorcode = 2;
        		$info->msg = "Nomor rekening kredit cicilan tidak ditemukan";
        	}
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_register_kredit_cicilan(){
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
                'field' => 'jumlah_kredit_cicilan',
                'label' => 'nominal jumlah kredit',
                'rules' => 'trim|xss_clean|required|callback_cek_isi_nominal'
            ),
            array(
                'field' => 'tanggal_kredit',
                'label' => 'tanggal kredit',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ket_kredit',
                'label' => 'keterangan kredit',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'jumlah_angsuran',
                'label' => 'jumlah angsuran',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tanggal_tagihan',
                'label' => 'tanggal tagihan',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'tanggal_jatuh_tempo',
                'label' => 'tanggal jatuh tempo',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'periode_jumlah',
                'label' => 'periode jumlah',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'periode_waktu',
                'label' => 'periode waktu',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'grace_period',
                'label' => 'lama penangguhan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'margin_rupiah',
                'label' => 'margin rupiah',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'margin_persen',
                'label' => 'margin persen',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? $this->input->post('nasabah_id', true) : null;
            $jumlah_kredit = $this->input->post('jumlah_kredit_cicilan', true) ? str_replace(',', '', $this->input->post('jumlah_kredit_cicilan', true)) : 0;
            $tanggal_kredit = $this->input->post('tanggal_kredit') ? $this->input->post('tanggal_kredit', true) : null;
            $ket_kredit = $this->input->post('ket_kredit') ? $this->input->post('ket_kredit', true) : null;
            $jumlah_angsuran = $this->input->post('jumlah_angsuran') ? $this->input->post('jumlah_angsuran', true) : null;
            $tanggal_tagihan = $this->input->post('tanggal_tagihan') ? $this->input->post('tanggal_tagihan', true) : null;
            $tanggal_jatuh_tempo = $this->input->post('tanggal_jatuh_tempo') ? $this->input->post('tanggal_jatuh_tempo', true) : null;
            $periode_jumlah = $this->input->post('periode_jumlah') ? $this->input->post('periode_jumlah', true) : null;
            $periode_waktu = $this->input->post('periode_waktu') ? $this->input->post('periode_waktu', true) : null;
            $grace_period = $this->input->post('grace_period') ? $this->input->post('grace_period', true) : null;
            $margin_rupiah = $this->input->post('margin_rupiah', true) ? str_replace(',', '', $this->input->post('margin_rupiah', true)) : 0;
            $margin_persen = $this->input->post('margin_persen') ? $this->input->post('margin_persen', true) : null;
            $foto_jaminan = $this->input->post('foto_jaminan') ? $this->input->post('foto_jaminan') : null;
            $desk_jaminan = $this->input->post('desk_jaminan') ? $this->input->post('desk_jaminan') : null;

           	$this->rekening_mod->id_user = $nasabah_id;
            $retrieve_user_info = $this->rekening_mod->get_user_info();
            if($retrieve_user_info->num_rows() > 0){
            	$id_koperasi = $retrieve_user_info->row()->koperasi;
            	$this->rekening_mod->id_koperasi = $id_koperasi;
            	$id_user = $nasabah_id;
            	$nama_lengkap = $retrieve_user_info->row()->nama_lengkap;

            	$this->rekening_mod->last = TRUE;
            	$rek_kredit_cicilan = $this->rekening_mod->get_nasabah_rekening_kredit_cicilan();
            	$no_urut = 1;
            	if($rek_kredit_cicilan->num_rows() > 0){
            		$last_no_rek = $rek_kredit_cicilan->row()->no_rekening_kredit;
            		$no_urut = (int)substr($last_no_rek, strrpos($last_no_rek, '.') + 1);
            		$no_urut++;
            	}

	            $running = false;

	        	while (!$running) {
	            	$mask_no_urut = sprintf("%06d", $no_urut);
	            	// create rekening tabungan
		            $data = array(
		            	'id_user' => $id_user,
		            	'no_rekening_kredit' => $id_koperasi . '.015.' . $mask_no_urut,
		            	'jumlah_kredit' => $jumlah_kredit,
		            	'tanggal_kredit' => $tanggal_kredit,
		            	'ket_kredit' => $ket_kredit,
		            	'jumlah_angsuran' => $jumlah_angsuran,
		            	'tanggal_tagihan' => $tanggal_tagihan,
		            	'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo,
		            	'periode_jumlah' => $periode_jumlah,
		            	'periode_waktu' => $periode_waktu,
		            	'grace_period' => $grace_period,
		            	'margin_rupiah' => $margin_rupiah,
		            	'margin_persen' => $margin_persen,
		            	'status_lancar' => 'L',
		            	'sisa_angsuran_pokok' => $jumlah_kredit,
		            	'sisa_angsuran' => $jumlah_angsuran
		            );

		            if($this->rekening_mod->register_rekening_kredit_cicilan($data))
		            	$running = TRUE;
		            if($running){
		            	if(count($foto_jaminan) > 0){
		            		if($foto_jaminan[0]){
		            			$jaminan = array();
		            			foreach ($foto_jaminan as $key => $foto) {
		            				array_push($jaminan, array(
		            					'deskripsi' => $desk_jaminan[$key] ? $desk_jaminan[$key] : null,
		            					'foto' => $foto,
		            					'no_rekening_kredit' => $data['no_rekening_kredit']
		            				));
		            			}

		            			if(count($jaminan) > 0){
		            				$this->rekening_mod->register_jaminan_kredit($jaminan);
		            			}
		            		}
		            	}
		            }
		            $no_urut++;
		        }
		        if ($running) {
		        	$data['nama_lengkap'] = $nama_lengkap;
	            	$info->msg = "Pembuatan rekening kredit cicilan telah dibuat";
	            	$this->session->set_flashdata('rekening_kredit_cicilan_stat', $data);
		        } else {
	            	$info->errorcode = 2;
	            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
	            }
            } else {
            	$info->errorcode = 2;
				$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_set_profit_sharing_rule(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id_koperasi',
                'label' => 'koperasi',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'share_koperasi',
                'label' => 'tipe kepemilikan',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'share_smidumay',
                'label' => 'atas nama pemilik',
                'rules' => 'trim|xss_clean|callback_cek_share_profit_rule'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $id_koperasi = $this->input->post('id_koperasi', true) ? $this->input->post('id_koperasi', true) : null;
            $share_koperasi = $this->input->post('share_koperasi', true) ? $this->input->post('share_koperasi', true) : null;
            $share_smidumay = $this->input->post('share_smidumay', true) ? $this->input->post('share_smidumay', true) : null;

            $data = array(
            	'id_koperasi' => $id_koperasi,
            	'share_koperasi' => $share_koperasi,
            	'share_smidumay' => $share_smidumay
            );

            if($this->rekening_mod->save_profit_sharing_rule($data)){
            	$info->msg = "Penyimpanan sharing profit telah disimpan";
            	$this->session->set_flashdata('rekening_non_member_stat', $data);
            } else {
            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
				$info->errorcode = 2;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_setting_profit(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'profit_koperasi',
                'label' => 'profit koperasi',
                'rules' => 'trim|xss_clean|callback_cek_validate_profit|callback_cek_koperasi_registered'
            ),
            array(
                'field' => 'profit_ketua',
                'label' => 'profit ketua',
                'rules' => 'trim|xss_clean|callback_cek_ketua_registered'
            ),
            array(
                'field' => 'profit_anggota',
                'label' => 'profit anggota',
                'rules' => 'trim|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$profit_koperasi = $this->input->post('profit_koperasi') ? $this->input->post('profit_koperasi', true) : 0;
			$profit_ketua = $this->input->post('profit_ketua') ? $this->input->post('profit_ketua', true) : 0;
			$profit_anggota = $this->input->post('profit_anggota') ? $this->input->post('profit_anggota', true) : 0;

			$count = $profit_koperasi + $profit_ketua + $profit_anggota;
			$shareholders = $this->input->post('shareholder');
			$profit_shareholders = $this->input->post('profit_shareholder');

			$no_rekening_koperasi = null;
			$this->rekening_mod->tipe_rekening = "KOPERASI";
			$koperasi_res = $this->rekening_mod->get_nasabah_rekening_non_member();

			if($koperasi_res->num_rows() > 0){
				$no_rekening_koperasi = $koperasi_res->row()->no_rekening;
			}

			$no_rekening_ketua = null;
			$this->rekening_mod->tipe_rekening = "KETUA";
			$ketua_res = $this->rekening_mod->get_nasabah_rekening_non_member();

			if($ketua_res->num_rows() > 0){
				$no_rekening_ketua = $ketua_res->row()->no_rekening;
			}

			$profit_data = array(
				array(
					'id_koperasi' => $this->session->userdata('id_koperasi'),
					'no_rekening' => $no_rekening_koperasi,
					'group' => 'KOPERASI',
					'share' => $profit_koperasi
				),
				array(
					'id_koperasi' => $this->session->userdata('id_koperasi'),
					'no_rekening' => $no_rekening_ketua,
					'group' => 'KETUA',
					'share' => $profit_ketua
				),
				array(
					'id_koperasi' => $this->session->userdata('id_koperasi'),
					'no_rekening' => NULL,
					'group' => 'ANGGOTA',
					'share' => $profit_anggota
				)
			);

			if(count($shareholders) > 0){
				if($shareholders[0]){
					foreach ($shareholders as $key => $value) {
						array_push($profit_data, array(
							'id_koperasi' => $this->session->userdata('id_koperasi'),
							'no_rekening' => $value,
							'group' => 'OKNUM',
							'share' => $profit_shareholders[$key]
						));
					}
				}
			}

			if($this->rekening_mod->setting_profit_koperasi($this->session->userdata('id_koperasi'), $profit_data)){
				$this->session->set_flashdata('setting_profit_stat', 'SUCCESS');
			} else {
				$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
				$info->errorcode = 2;
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

    function ajax_add_rekening_fav(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nasabah_id',
                'label' => 'pemilihan nasabah',
                'rules' => 'trim|xss_clean|required|callback_cek_rekening_fav'
            ),
            array(
                'field' => 'nama_penerima',
                'label' => 'nama nasabah',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'keterangan',
                'label' => 'nama nasabah',
                'rules' => 'trim|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
			$jenis_rekening_nasabah = substr($this->input->post('nasabah_id', true), -1);
            $nama_penerima = $this->input->post('nama_penerima', true) ? $this->input->post('nama_penerima', true) : null;
            $keterangan = $this->input->post('keterangan', true) ? $this->input->post('keterangan', true) : null;

            switch ($jenis_rekening_nasabah) {
            	case '1':
            		$jenis_account = "TABUNGAN";
            		break;
            	case '2':
            		$jenis_account = "VIRTUAL";
            		break;
            	case '3':
            		$jenis_account = "LOYALTI";
            		break;
            	default:
            		$jenis_account = "TABUNGAN";
            		break;
            }

            $data_rek_fav = array(
            	'id_user' => $this->session->userdata('id_user'),
            	'jenis_account' => $jenis_account,
            	'no_rekening' => $nasabah_id,
            	'nama_penerima' => $nama_penerima,
            	'keterangan' => $keterangan
            );

            if(!$this->rekening_mod->register_rekening_fav($data_rek_fav)){
            	$info->msg = "Maaf, terjadi gangguan pada server. Silahkan ulangi permintaan transaksi";
            	$info->errorcode = 2;
            } else {
            	$info->data = $data_rek_fav;
            }
    	} else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_remove_rekening_fav(){
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
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$nasabah_id = $this->input->post('nasabah_id', true) ? $this->input->post('nasabah_id', true) : null;
        	$this->rekening_mod->id_user = $this->session->userdata('id_user');
            if(!$this->rekening_mod->remove_rekening_fav($nasabah_id)){
            	$info->msg = "Maaf, terjadi gangguan pada server. Silahkan ulangi permintaan transaksi";
            	$info->errorcode = 2;
            }
    	} else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_verify_pin(){
    	header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
				'field' => 'pin',
                'label' => 'kode pin',
                'rules' => 'trim|xss_clean|required|callback_cek_pin'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
        	$this->session->set_userdata('pin', true);
        } else {
            $info->msg = "Maaf pin yang Anda masukan tidak valid";
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
                'rules' => 'trim|xss_clean|callback_cek_nasabah_pengirim'
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
        	if($this->session->userdata('level') == 3){
        		$nasabah_id = $this->nasabah_id;
        		$jenis_rekening_nasabah = $this->jenis_rekening;
        	} else {
	            $nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
				$jenis_rekening_nasabah = substr($this->input->post('nasabah_id', true), -1);
        	}
            $tujuan_id = $this->input->post('tujuan_id', true) ? substr($this->input->post('tujuan_id', true),0,-1) : null;
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
            		$this->rekening_mod->id_user = null;
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
            		$this->rekening_mod->id_user = null;
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
            		$this->rekening_mod->id_user = null;
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
            		$this->rekening_mod->id_user = null;
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
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');
			            $member_res = $this->rekening_mod->cari_nasabah_tabungan();
            			break;
            		case 'pinjaman':
            			if($this->session->userdata('level') == 2 && $is_koperasi == true)
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');
			            $member_res = $this->rekening_mod->cari_nasabah_pinjaman();
            			break;
            		case 'kredit':
            			if($this->session->userdata('level') == 2 && $is_koperasi == true)
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');
			            $member_res = $this->rekening_mod->cari_nasabah_kredit();
            			break;
					case 'virtual':
						if($this->session->userdata('level') == 2 && $is_koperasi == true)
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');
			            $member_res = $this->rekening_mod->cari_nasabah_virtual();
            			break;
        			case 'from':
        				if($this->session->userdata('level') == 2 && $is_koperasi == true)
				            $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');
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
	            	if($member_temp->jenis_rekening == "TABUNGAN"){
	            		$id_jenis_rekening = 1;
	            	} else if($member_temp->jenis_rekening == "PINJAMAN"){
	            		$id_jenis_rekening = 3;
	            	} else if($member_temp->jenis_rekening == "KREDIT"){
	            		$id_jenis_rekening = 4;
	            	} else {
	            		$id_jenis_rekening = 2;
	            	}
	            	array_push($member_list, array(
	            		'id_user' => $member_temp->id_user,
	            		'username' => $member_temp->username,
	            		'fullname' => strtoupper(trim($member_temp->nama_depan . ' ' . $member_temp->nama_belakang)),
	            		'no_rekening' => $member_temp->no_rekening,
	            		'jenis_rekening' => $member_temp->jenis_rekening,
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

	function cari_koperasi(){
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

            $this->rekening_mod->keyword = $keyword;
			$koperasi_res = $this->rekening_mod->cari_koperasi();
			$koperasi_list = array();
            foreach ($koperasi_res->result() as $koperasi_temp) {
            	array_push($koperasi_list, array(
            		'id_koperasi' => $koperasi_temp->id_koperasi,
            		'nama' => $koperasi_temp->nama
            	));
            }
            $info->data = $koperasi_list;
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
	            		case 'VIRTUAL':
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
	            		'fullname' => trim($member_temp->nama_depan . ' ' . $member_temp->nama_belakang),
	            		'alias' => trim($member_temp->nama_depan)
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

	function ajax_info_anggota(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id_user',
                'label' => 'ID anggota',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $id_user = $this->input->post('id_user', true) ? $this->input->post('id_user', true) : null;
            $member_list = array();
            if($id_user) {
	            $member_res = $this->rekening_mod->get_info_anggota($id_user);
	            if ($member_res->num_rows() > 0) {
	            	$member_temp = $member_res->row();
	            	switch ($member_temp->jenis_id) {
	            		case "KTP":
	            			$jenis_id = 1;
	            			break;
	            		case "PASSPORT":
	            			$jenis_id = 7;
	            			break;
	            		case "SIM":
	            			$jenis_id = 2;
	            			break;
	            		default:
	            			$jenis_id = 1;
	            			break;
	            	}
		           	$member = array(
	            		'id_user' => $member_temp->id_user,
	            		'fullname' => trim($member_temp->nama_depan . ' ' . $member_temp->nama_belakang),
	            		'alias' => trim($member_temp->nama_depan),
	            		'gender' => strtolower($member_temp->jenis_kelamin),
	            		'religion' => $member_temp->agama,
	            		'birth_place' => $member_temp->tempat_lahir,
	            		'date_of_birth' => $member_temp->tgl_lahir,
	            		'id_type' => $jenis_id,
	            		'id_number' => $member_temp->no_ktp,
	            		'province' => $member_temp->provinsi,
	            		'city' => $member_temp->kabupaten,
	            		'postal_code' => $member_temp->kode_pos,
	            		'address' => $member_temp->alamat,
	            		'phone_number1' => $member_temp->telp,
	            		'phone_number2' => $member_temp->telp2,
	            		'phone_number3' => $member_temp->telp3,
	            		'last_education' => $member_temp->pendidikan_terakhir
	            	);
		            $info->data = $member;
	            }
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

	function cek_koperasi_registered($str){
		$this->rekening_mod->tipe_rekening = "KOPERASI";
		$koperasi_res = $this->rekening_mod->get_nasabah_rekening_non_member();

		if($koperasi_res->num_rows() == 0){
			$this->form_validation->set_message('cek_koperasi_registered', 'Maaf, nomor rekening koperasi belum dibuat');
			return FALSE;
		}

		return TRUE;
	}

	function cek_ketua_registered($str){
		$this->rekening_mod->tipe_rekening = "KETUA";
		$koperasi_res = $this->rekening_mod->get_nasabah_rekening_non_member();

		if($koperasi_res->num_rows() == 0){
			$this->form_validation->set_message('cek_ketua_registered', 'Maaf, nomor rekening ketua belum dibuat');
			return FALSE;
		}

		return TRUE;
	}

	function cek_validate_profit($validate) {
		$profit_koperasi = $this->input->post('profit_koperasi') ? $this->input->post('profit_koperasi', true) : 0;
		$profit_ketua = $this->input->post('profit_ketua') ? $this->input->post('profit_ketua', true) : 0;
		$profit_anggota = $this->input->post('profit_anggota') ? $this->input->post('profit_anggota', true) : 0;

		$count = $profit_koperasi + $profit_ketua + $profit_anggota;
		$profit_shareholders = $this->input->post('profit_shareholder');
		foreach ($profit_shareholders as $ps_temp) {
			$count += $ps_temp;
		}
		if($count > 100){
			$this->form_validation->set_message('cek_validate_profit', 'Maaf, jumlah persentase profit melebihi 100%');
			return FALSE;
		} else if($count < 100) {
			$this->form_validation->set_message('cek_validate_profit', 'Maaf, jumlah persentase profit kurang dari 100%');
			return FALSE;
		}

		return TRUE;
	}

	function cek_rekening_fav($nasabah_id) {
		$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
		$jenis_rekening = substr($this->input->post('nasabah_id', true), -1);
		$this->rekening_mod->id_user = $this->session->userdata('id_user');
		switch ($jenis_rekening) {
        	case '1':
        		$this->rekening_mod->tipe_transaksi  = "TABUNGAN";
        		break;
        	case '2':
        		$this->rekening_mod->tipe_transaksi = "VIRTUAL";
        		break;
        	case '3':
        		$this->rekening_mod->tipe_transaksi = "LOYALTI";
        		break;
        	default:
        		$this->rekening_mod->tipe_transaksi = "TABUNGAN";
        		break;
        }
        if($nasabah_id && $jenis_rekening){
        	$this->rekening_mod->no_rekening = $nasabah_id;
        	if($this->rekening_mod->cek_rekening_favorit() > 0){
				$this->form_validation->set_message('cek_rekening_fav', 'Maaf, nomor rekening ini sudah ada di daftar rekening favorit');
				return FALSE;
			} else
				return TRUE;
        } else {
        	$this->form_validation->set_message('cek_rekening_fav', 'Maaf, nomor rekening yang Anda masukan tidak valid');
				return FALSE;
        }
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

	function cek_nasabah_pengirim($nasabah_id){
		if($this->session->userdata('level') != 3){
			$nasabah_id = $this->input->post('nasabah_id', true) ? $this->input->post('nasabah_id', true) : null;
			if(!$nasabah_id){
				$this->form_validation->set_message('cek_nasabah_pengirim', 'Input nasabah pengirim harus diisi');
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
        } else
        	return TRUE;
	}

	function cek_rek_kepemilikan($tipe_rekening){
        $tipe_rekening = $this->input->post('tipe_rekening', true) ? $this->input->post('tipe_rekening', true) : null;

        if(!$tipe_rekening && $this->session->userdata('level') == 2) {
        	$this->form_validation->set_message('cek_rek_kepemilikan', 'Maaf, tipe kepemilikan harus dipilih');
			return FALSE;
        } else
        	return TRUE;
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

	function cek_share_profit_rule(){
		$share_smidumay = $this->input->post('share_smidumay') ? $this->input->post('share_smidumay', true) : 0;
		$share_koperasi = $this->input->post('share_koperasi') ? $this->input->post('share_koperasi', true) : 0;

		if($share_smidumay+$share_koperasi!=100){
			$this->form_validation->set_message('cek_share_profit_rule', 'Perhitungan sharing profit tidak valid');
			return FALSE;
		}
		return TRUE;
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
				if($this->rekening_mod->cek_pin($pin) > 0){
					if($this->rekening_mod->cek_status_rekening() > 0)
						return TRUE;
					else{
						$this->form_validation->set_message('cek_pin', 'Maaf, rekening Anda telah diblokir atau ditutup');
						return FALSE;
					}
				} else{
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
		if($this->session->userdata('level') == 3){
    		$this->rekening_mod->jenis_rekening = "TABUNGAN";
    		$var_ct = $this->uri->segment(3) ? $this->uri->segment(3, true) : null;
			$this->rekening_mod->id_user = $this->session->userdata('id_user');
    		switch ($var_ct) {
				case 'virtual_tabungan':
					$this->rekening_mod->jenis_rekening = "VIRTUAL";
					$this->jenis_rekening = $jenis_rekening = "2";
	        		$nasabah_res = $this->rekening_mod->cek_saldo_virtual();
					break;
				case 'tabungan_virtual':
					$this->rekening_mod->jenis_rekening = "TABUNGAN";
					$this->jenis_rekening = $jenis_rekening = "1";
	        		$nasabah_res = $this->rekening_mod->cek_saldo_tabungan();
					break;
				default:
					$this->rekening_mod->jenis_rekening = "TABUNGAN";
					$this->jenis_rekening = $jenis_rekening = "1";
	        		$nasabah_res = $this->rekening_mod->cek_saldo_tabungan();
					break;
			}
			if($nasabah_res->num_rows() > 0){
				if($jenis_rekening == "1")
					$this->nasabah_id = $nasabah_id = $nasabah_res->row()->no_rekening;
				else
					$this->nasabah_id = $nasabah_id = $nasabah_res->row()->no_rekening_virtual;
			} else {
				$this->form_validation->set_message('cek_saldo_pengirim', 'Maaf, nomor rekening tidak diketahui');
				return FALSE;
			}
    	} else {
			$nasabah_id = $this->input->post('nasabah_id', true) ? substr($this->input->post('nasabah_id', true),0,-1) : null;
			$jenis_rekening = substr($this->input->post('nasabah_id', true), -1);
		}
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

	function cek_rekening_non_member_utama($id_koperasi){
		if($this->session->userdata('level') == 1) {
            $id_koperasi = $this->input->post('id_koperasi', true) ? $this->input->post('id_koperasi', true) : null;
			if(!$id_koperasi){
				$this->form_validation->set_message('cek_rekening_non_member_utama', 'Pemilihan koperasi tidak valid');
				return FALSE;
			} else {
				$this->rekening_mod->id_koperasi = $id_koperasi;
				if($this->rekening_mod->cek_rekening_non_member("KOPERASI") > 0){
					$this->form_validation->set_message('cek_rekening_non_member_utama', 'Suatu Koperasi hanya diperbolehkan memiliki satu rekening');
					return FALSE;
				} else{
					return TRUE;
				}
			}
		} else if($this->session->userdata('level') == 2) {
        	$id_koperasi = $this->session->userdata('id_koperasi');
			if(!$id_koperasi){
				$this->form_validation->set_message('cek_rekening_non_member_utama', 'Pemilihan koperasi tidak valid');
				return FALSE;
			} else {
				if(in_array($this->input->post('tipe_rekening'), array('KOPERASI', 'KETUA'))){
					$this->rekening_mod->id_koperasi = $id_koperasi;
					if($this->rekening_mod->cek_rekening_non_member($this->input->post('tipe_rekening',true)) > 0){
						$this->form_validation->set_message('cek_rekening_non_member_utama', 'Maaf, tipe rekening ini hanya diperbolehkan memiliki satu rekening');
						return FALSE;
					} else{
						return TRUE;
					}
				}
			}
			return TRUE;
		}

		return TRUE;
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

    public function ajax_upload_jaminan() {
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
            $upload_path_folder = FCPATH . 'server/images/warranty/';
            $upload_url_folder = 'server/images/warranty/';
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
            $info->msg = "Jaminan harus diunggah";
        }

        echo json_encode($info);
    }

}
