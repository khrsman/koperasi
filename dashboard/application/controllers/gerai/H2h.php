<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class H2h extends CI_Controller {

	var $kode_vendor, $kode_operator, $kode_kategori_produk;

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
	}

	public function vendor(){
		$data['title'] = "Vendor Gerai";

		$vendor = $this->rekening_mod->get_vendor();
		$data['vendor'] = $vendor;
		$this->load->view('rekening/vendor', $data);
	}

	public function operator(){
		$data['title'] = "Operator Gerai";

		$operator = $this->rekening_mod->get_operator();
		$data['operator'] = $operator;
		$this->load->view('rekening/operator', $data);
	}

	public function produk(){
		$data['title'] = "Kategori Produk Gerai";

		$kategori_produk = $this->rekening_mod->get_kategori_produk();
		$data['kategori_produk'] = $kategori_produk;
		$this->load->view('rekening/kategori_produk', $data);
	}

	public function vendor_produk(){
		$data['title'] = "Produk Vendor Gerai";

		$vendor_produk = $this->rekening_mod->get_vendor_produk();
		$kategori_produk = $this->rekening_mod->get_kategori_produk();
		$operator = $this->rekening_mod->get_operator();
		$vendor = $this->rekening_mod->get_vendor();
		
		$data['vendor_produk'] = $vendor_produk;
		$data['kategori_produk'] = $kategori_produk;
		$data['operator'] = $operator;
		$data['vendor'] = $vendor;
		$this->load->view('rekening/vendor_produk', $data);
	}

	public function ajax_create_vendor(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_vendor',
                'label' => 'kode vendor',
                'rules' => 'trim|xss_clean|required|callback_cek_kode_vendor'
            ),
            array(
                'field' => 'nama_vendor',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_vendor = $this->input->post('kode_vendor', true) ? $this->input->post('kode_vendor', true) : null;
            $nama_vendor = $this->input->post('nama_vendor', true) ? $this->input->post('nama_vendor', true) : null;

            $data = array(
            	'kode_vendor' => $kode_vendor,
            	'nama_vendor' => $nama_vendor,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'INSERT',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->create_vendor($data)){
            	$info->msg = "Vendor telah disimpan";
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

	public function ajax_edit_vendor(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_vendor_origin',
                'label' => 'kode vendor origin',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ekode_vendor',
                'label' => 'kode vendor',
                'rules' => 'trim|xss_clean|required|callback_cek_kode_vendor'
            ),
            array(
                'field' => 'enama_vendor',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_vendor_origin = $this->input->post('kode_vendor_origin', true) ? $this->input->post('kode_vendor_origin', true) : null;
            $kode_vendor = $this->input->post('ekode_vendor', true) ? $this->input->post('ekode_vendor', true) : null;
            $nama_vendor = $this->input->post('enama_vendor', true) ? $this->input->post('enama_vendor', true) : null;

            $data = array(
            	'kode_vendor' => $kode_vendor,
            	'nama_vendor' => $nama_vendor,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'UPDATE',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->update_vendor($kode_vendor_origin, $data)){
            	$info->msg = "Perubahan data pada vendor telah disimpan";
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

	public function ajax_delete_vendor(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_vendor',
                'label' => 'kode vendor',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_vendor = $this->input->post('kode_vendor', true) ? $this->input->post('kode_vendor', true) : null;

            if($this->rekening_mod->delete_vendor($kode_vendor)){
            	$info->msg = "Vendor telah dihapus";
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

	function cek_kode_vendor($str){
		$kode_vendor_origin = $this->input->post('kode_vendor_origin', true) ? $this->input->post('kode_vendor_origin', true) : null;
        $kode_vendor = $this->input->post('ekode_vendor', true) ? $this->input->post('ekode_vendor', true) : null;

        if($kode_vendor_origin == $kode_vendor){
        	return TRUE;
        } else {
        	$this->kode_vendor = $kode_vendor;
        	if($this->rekening_mod->get_vendor()->num_rows() > 0){
				$this->form_validation->set_message('cek_kode_vendor', 'Maaf, kode vendor sudah digunakan');
				return FALSE;
			}
        }

		return TRUE;
	}

	public function ajax_create_operator(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_operator',
                'label' => 'kode operator',
                'rules' => 'trim|xss_clean|required|callback_cek_kode_operator'
            ),
            array(
                'field' => 'nama_operator',
                'label' => 'nama operator',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_operator = $this->input->post('kode_operator', true) ? $this->input->post('kode_operator', true) : null;
            $nama_operator = $this->input->post('nama_operator', true) ? $this->input->post('nama_operator', true) : null;

            $data = array(
            	'kode_operator' => $kode_operator,
            	'nama_operator' => $nama_operator,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'INSERT',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->create_operator($data)){
            	$info->msg = "operator telah disimpan";
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

	public function ajax_edit_operator(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_operator_origin',
                'label' => 'kode operator origin',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ekode_operator',
                'label' => 'kode operator',
                'rules' => 'trim|xss_clean|required|callback_cek_kode_operator'
            ),
            array(
                'field' => 'enama_operator',
                'label' => 'nama operator',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_operator_origin = $this->input->post('kode_operator_origin', true) ? $this->input->post('kode_operator_origin', true) : null;
            $kode_operator = $this->input->post('ekode_operator', true) ? $this->input->post('ekode_operator', true) : null;
            $nama_operator = $this->input->post('enama_operator', true) ? $this->input->post('enama_operator', true) : null;

            $data = array(
            	'kode_operator' => $kode_operator,
            	'nama_operator' => $nama_operator,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'UPDATE',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->update_operator($kode_operator_origin, $data)){
            	$info->msg = "Perubahan data pada operator telah disimpan";
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

	public function ajax_delete_operator(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_operator',
                'label' => 'kode operator',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_operator = $this->input->post('kode_operator', true) ? $this->input->post('kode_operator', true) : null;

            if($this->rekening_mod->delete_operator($kode_operator)){
            	$info->msg = "Operator telah dihapus";
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

	function cek_kode_operator($str){
		$kode_operator_origin = $this->input->post('kode_operator_origin', true) ? $this->input->post('kode_operator_origin', true) : null;
        $kode_operator = $this->input->post('ekode_operator', true) ? $this->input->post('ekode_operator', true) : null;

        if($kode_operator_origin == $kode_operator){
        	return TRUE;
        } else {
        	$this->kode_operator = $kode_operator;
        	if($this->rekening_mod->get_operator()->num_rows() > 0){
				$this->form_validation->set_message('cek_kode_operator', 'Maaf, kode operator sudah digunakan');
				return FALSE;
			}
        }

		return TRUE;
	}

	public function ajax_create_kategori_produk(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_kategori_produk',
                'label' => 'kode kategori_produk',
                'rules' => 'trim|xss_clean|required|callback_cek_kode_kategori_produk'
            ),
            array(
                'field' => 'nama_kategori_produk',
                'label' => 'nama kategori_produk',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_kategori_produk = $this->input->post('kode_kategori_produk', true) ? $this->input->post('kode_kategori_produk', true) : null;
            $nama_kategori_produk = $this->input->post('nama_kategori_produk', true) ? $this->input->post('nama_kategori_produk', true) : null;

            $data = array(
            	'kode_kategori_produk' => $kode_kategori_produk,
            	'nama_kategori_produk' => $nama_kategori_produk,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'INSERT',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->create_kategori_produk($data)){
            	$info->msg = "Vendor telah disimpan";
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

	public function ajax_edit_kategori_produk(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_kategori_produk_origin',
                'label' => 'kode kategori_produk origin',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ekode_kategori_produk',
                'label' => 'kode kategori_produk',
                'rules' => 'trim|xss_clean|required|callback_cek_kode_kategori_produk'
            ),
            array(
                'field' => 'enama_kategori_produk',
                'label' => 'nama kategori_produk',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_kategori_produk_origin = $this->input->post('kode_kategori_produk_origin', true) ? $this->input->post('kode_kategori_produk_origin', true) : null;
            $kode_kategori_produk = $this->input->post('ekode_kategori_produk', true) ? $this->input->post('ekode_kategori_produk', true) : null;
            $nama_kategori_produk = $this->input->post('enama_kategori_produk', true) ? $this->input->post('enama_kategori_produk', true) : null;

            $data = array(
            	'kode_kategori_produk' => $kode_kategori_produk,
            	'nama_kategori_produk' => $nama_kategori_produk,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'UPDATE',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->update_kategori_produk($kode_kategori_produk_origin, $data)){
            	$info->msg = "Perubahan data pada kategori produk telah disimpan";
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

	public function ajax_delete_kategori_produk(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_kategori_produk',
                'label' => 'kode kategori_produk',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_kategori_produk = $this->input->post('kode_kategori_produk', true) ? $this->input->post('kode_kategori_produk', true) : null;

            if($this->rekening_mod->delete_kategori_produk($kode_kategori_produk)){
            	$info->msg = "Vendor telah dihapus";
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

	function cek_kode_kategori_produk($str){
		$kategori_produk_origin = $this->input->post('kategori_produk_origin', true) ? $this->input->post('kategori_produk_origin', true) : null;
        $kategori_produk = $this->input->post('ekategori_produk', true) ? $this->input->post('ekategori_produk', true) : null;

        if($kategori_produk_origin == $kategori_produk){
        	return TRUE;
        } else {
        	$this->kategori_produk = $kategori_produk;
        	if($this->rekening_mod->get_kategori_produk()->num_rows() > 0){
				$this->form_validation->set_message('cek_kode_kategori_produk', 'Maaf, kode kategori produk sudah digunakan');
				return FALSE;
			}
        }

		return TRUE;
	}

	public function ajax_create_vendor_produk(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
        	array(
                'field' => 'kode_vendor',
                'label' => 'kode vendor',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'kode_operator',
                'label' => 'kode operator',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'kode_kategori_produk',
                'label' => 'kode kategori produk',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'jenis_transaksi',
                'label' => 'jenis transaksi',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'kode_produk',
                'label' => 'kode vendor produk',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'nama_produk',
                'label' => 'nama produk vendor',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'nominal_produk',
                'label' => 'nominal produk',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'harga_vendor',
                'label' => 'harga vendor',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'harga_gerai',
                'label' => 'harga gerai',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_vendor = $this->input->post('kode_vendor', true) ? $this->input->post('kode_vendor', true) : null;
            $kode_operator = $this->input->post('kode_operator', true) ? $this->input->post('kode_operator', true) : null;
            $kode_kategori_produk = $this->input->post('kode_kategori_produk', true) ? $this->input->post('kode_kategori_produk', true) : null;
            $jenis_transaksi = $this->input->post('jenis_transaksi', true) ? $this->input->post('jenis_transaksi', true) : null;
            $kode_produk = $this->input->post('kode_produk', true) ? $this->input->post('kode_produk', true) : null;
            $nama_produk = $this->input->post('nama_produk', true) ? $this->input->post('nama_produk', true) : null;

            $nominal_produk = $this->input->post('nominal_produk', true) ? str_replace(',', '', $this->input->post('nominal_produk', true)) : 0;
            $harga_vendor = $this->input->post('harga_vendor', true) ? str_replace(',', '', $this->input->post('harga_vendor', true)) : 0;
            $harga_gerai = $this->input->post('harga_gerai', true) ? str_replace(',', '', $this->input->post('harga_gerai', true)) : 0;

            $data = array(
            	'kode_vendor' => $kode_vendor,
            	'kode_operator' => $kode_operator,
            	'kode_kategori_produk' => $kode_kategori_produk,
            	'jenis_transaksi' => $jenis_transaksi,
            	'kode_produk' => $kode_produk,
            	'nama_produk' => $nama_produk,
            	'nominal_produk' => $nominal_produk,
            	'harga_vendor' => $harga_vendor,
            	'harga_gerai' => $harga_gerai,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'INSERT',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->create_vendor_produk($data)){
            	$info->msg = "Produk vendor telah disimpan";
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

	public function ajax_edit_vendor_produk(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
        	array(
                'field' => 'ekode_vendor',
                'label' => 'kode vendor',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ekode_operator',
                'label' => 'kode operator',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ekode_kategori_produk',
                'label' => 'kode kategori produk',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ejenis_transaksi',
                'label' => 'jenis transaksi',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'ekode_produk',
                'label' => 'kode vendor produk',
                'rules' => 'trim|xss_clean|required|callback_cek_kode_produk'
            ),
            array(
                'field' => 'enama_produk',
                'label' => 'nama produk vendor',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'enominal_produk',
                'label' => 'nominal produk',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'eharga_vendor',
                'label' => 'harga vendor',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'eharga_gerai',
                'label' => 'harga gerai',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_produk_origin = $this->input->post('kode_produk_origin', true) ? $this->input->post('kode_produk_origin', true) : null;
            $kode_produk = $this->input->post('ekode_produk', true) ? $this->input->post('ekode_produk', true) : null;
            $nama_produk = $this->input->post('enama_produk', true) ? $this->input->post('enama_produk', true) : null;
            $kode_vendor = $this->input->post('ekode_vendor', true) ? $this->input->post('ekode_vendor', true) : null;
            $kode_operator = $this->input->post('ekode_operator', true) ? $this->input->post('ekode_operator', true) : null;
            $kode_kategori_produk = $this->input->post('ekode_kategori_produk', true) ? $this->input->post('ekode_kategori_produk', true) : null;
            $jenis_transaksi = $this->input->post('ejenis_transaksi', true) ? $this->input->post('ejenis_transaksi', true) : null;

            $nominal_produk = $this->input->post('enominal_produk', true) ? str_replace(',', '', $this->input->post('enominal_produk', true)) : 0;
            $harga_vendor = $this->input->post('eharga_vendor', true) ? str_replace(',', '', $this->input->post('eharga_vendor', true)) : 0;
            $harga_gerai = $this->input->post('eharga_gerai', true) ? str_replace(',', '', $this->input->post('eharga_gerai', true)) : 0;

            $data = array(
            	'kode_vendor' => $kode_vendor,
            	'kode_operator' => $kode_operator,
            	'kode_kategori_produk' => $kode_kategori_produk,
            	'jenis_transaksi' => $jenis_transaksi,
            	'kode_produk' => $kode_produk,
            	'nama_produk' => $nama_produk,
            	'nominal_produk' => $nominal_produk,
            	'harga_vendor' => $harga_vendor,
            	'harga_gerai' => $harga_gerai,
            	'service_time' => date('Y-m-d H:i:s'),
            	'service_action' => 'UPDATE',
            	'service_user' => $this->session->userdata('id_user')
            );

            if($this->rekening_mod->update_vendor_produk($kode_produk_origin, $data)){
            	$info->msg = "Perubahan data pada produk vendor telah disimpan";
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

	public function ajax_delete_vendor_produk(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_produk',
                'label' => 'kode produk',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_produk = $this->input->post('kode_produk', true) ? $this->input->post('kode_produk', true) : null;

            if($this->rekening_mod->delete_vendor_produk($kode_produk)){
            	$info->msg = "Produk vendor telah dihapus";
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

	function cek_kode_produk($str){
		$kode_produk_origin = $this->input->post('kode_produk_origin', true) ? $this->input->post('kode_produk_origin', true) : null;
        $kode_produk = $this->input->post('ekode_produk', true) ? $this->input->post('ekode_produk', true) : null;

        if($kode_produk_origin == $kode_produk){
        	return TRUE;
        } else {
        	$this->kode_produk = $kode_produk;
        	if($this->rekening_mod->get_vendor_produk()->num_rows() > 0){
				$this->form_validation->set_message('cek_kode_produk', 'Maaf, kode vendor produk sudah digunakan');
				return FALSE;
			}
        }

		return TRUE;
	}

	function ajax_view_vendor_produk(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'kode_produk',
                'label' => 'kode produk',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $kode_produk = $this->input->post('kode_produk', true) ? $this->input->post('kode_produk', true) : null;

            $this->rekening_mod->kode_produk = $kode_produk;
            $produk_vendor = $this->rekening_mod->get_vendor_produk();

            if($produk_vendor->num_rows() > 0){
            	$produk_vendor_temp = $produk_vendor->row();

            	$info->data = array(
            		'kode_vendor' => $produk_vendor_temp->kode_vendor,
            		'kode_kategori_produk' => $produk_vendor_temp->kode_kategori_produk,
            		'kode_operator' => $produk_vendor_temp->kode_operator,
            		'nama_vendor' => $produk_vendor_temp->nama_vendor,
            		'nama_kategori_produk' => $produk_vendor_temp->nama_kategori_produk,
            		'nama_operator' => $produk_vendor_temp->nama_operator,
            		'jenis_transaksi' => $produk_vendor_temp->jenis_transaksi,
            		'kode_produk' => $produk_vendor_temp->kode_produk,
            		'nama_produk' => $produk_vendor_temp->nama_produk,
            		'nominal_produk' => $produk_vendor_temp->nominal_produk,
            		'harga_vendor' => $produk_vendor_temp->harga_vendor,
            		'harga_gerai' => $produk_vendor_temp->harga_gerai,
            		'nominal_produk_caption' => "Rp. " .number_format($produk_vendor_temp->nominal_produk, 2, "." ,","),
            		'harga_vendor_caption' => "Rp. " .number_format($produk_vendor_temp->harga_vendor, 2, "." ,","),
            		'harga_gerai_caption' => "Rp. " .number_format($produk_vendor_temp->harga_gerai, 2, "." ,","),
            	);
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

}