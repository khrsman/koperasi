<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koperasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->library('form_validation');
		$this->load->helper('query_string_helper');
		$this->load->helper('form');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		// $this->session->set_userdata('level', "1");
		$this->load->model('koperasi_mod');
        $this->load->model('alamat_mod');
        $this->load->model('koperasi_jenis_mod');
	}

	function koperasi_data(){
		$this->session->set_userdata('url_kop', 'koperasi');
		$data['no'] = 1;
		$data['title'] = "Data Koperasi Induk";
		$data['page_name']          = 'Data Koperasi';
        $data['page_sub_name']      = '';

        $keyword = $this->input->get('q');
        
        $data['keyword'] = NULL;
        if ($keyword) {
            $data['keyword'] = $keyword;
        }

        ///// START Setting Filter /////
        // STEP. 1 : Array nama alias dan syntax db
        $keyword_by = array(
            array(
                'alias'=>'semua',
                'parameter'=> array
                        (   
                            'koperasi.nama'      => $keyword,
                            'user_info.username' => $keyword,
                        ),
                ),
      
            array(
                'alias'     =>'Nama',
                'parameter' =>'koperasi.nama',
                ),
        );


        $sort = array(
            array(
                'alias'     =>'nama',
                'parameter' =>'koperasi.nama',
                ),
             array(
                'alias'     =>'username',
                'parameter' =>'user_info.username',
                ),
            );


        $sort_order = array(
            array(
                'alias'     =>'z-a',
                'parameter' =>'desc',
                ),
            array(
                'alias'     =>'a-z',
                'parameter' =>'asc',
                ),
        );

        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        
        // Filter


        // STEP. 3 : Proses Parsing array Alias dan parameter        

        $def_param_keyword_by = $keyword_by[0]['parameter'];
        $param_keyword_by   = strtolower($this->input->get('keyword_by'));
        $data['param_keyword_by'] = 'semua';
        if (isset($param_keyword_by)) {
            $data['param_keyword_by'] = $param_keyword_by;
            $key = array_search($param_keyword_by, array_column($keyword_by,'alias'));
            if ($key) {
                $param_keyword_by = $keyword_by[$key]['parameter'];
                $data['param_keyword_by'] = $keyword_by[$key]['alias'];
            } else{
                $param_keyword_by = $def_param_keyword_by;
            }
        }else{
            $param_keyword_by = $def_param_keyword_by;
        }
        

        $def_param_sort = 'koperasi.nama';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'nama';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }


        $def_param_sort_order = 'desc';
        $param_sort_order   = strtolower($this->input->get('sort_order'));
        $data['param_sort_order'] = 'z-a';
        if (isset($param_sort_order)) {
            $data['param_sort_order'] = $param_sort_order;
            $key = array_search($param_sort_order,array_column($sort_order,'alias'));
            if ($key) {
                $param_sort_order = $sort_order[$key]['parameter'];
                $data['param_sort_order'] = $sort_order[$key]['alias'];
            } else{
                $param_sort_order = $def_param_sort_order;
            }
        }else{
            $param_sort_order = $def_param_sort_order;
        }

        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // print_r($param_query);
        
        ///// END Setting Filter /////
 





        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('koperasi');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        
        $config['per_page']     = 50; 
        $config['num_links']    = 10;
        $config['uri_segment']  = 2;

        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $limit = $config['per_page'];
        $offset = $this->uri->segment(2);

        //Load Data from Database
        $datadb = $this->koperasi_mod->get_all_koperasi_induk($keyword,$limit,$offset,$param_query);

        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
            
        }

        
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['title']          = 'Koperasi Induk';
        $data['is_content_header']  = TRUE;
        $data ['no'] = $offset+1;

		$this->load->view('koperasi/koperasi_induk_data', $data);
		
		

	}

	function cabang_koperasi_data_()
	{
		$this->session->set_userdata('url_kop', 'cabang_koperasi');
		$data['koperasi'] = $this->koperasi_mod->get_all_cabang_koperasi()->result();
		$data['no'] = 1;
		$data['title'] = "Data Koperasi";
		$this->load->view('koperasi/koperasi_data', $data);
	}

	function cabang_koperasi_data(){
		$this->session->set_userdata('url_kop', 'cabang_koperasi');
		$data['no'] = 1;
		$data['title'] = "Data Koperasi Cabang";
		$data['page_name']          = 'Data Koperasi';
        $data['page_sub_name']      = '';

        $keyword = $this->input->get('q');
        

        $data['keyword'] = NULL;
        if ($keyword) {
            $data['keyword'] = $keyword;
        }

        ///// START Setting Filter /////
        // STEP. 1 : Array nama alias dan syntax db
        $keyword_by = array(
            array(
                'alias'=>'semua',
                'parameter'=> array
                        (   
                            'koperasi.nama'      => $keyword,
                            'user_info.username' => $keyword,
                        ),
                ),
      
            array(
                'alias'     =>'Nama',
                'parameter' =>'koperasi.nama',
                ),
        );


        $sort = array(
            array(
                'alias'     =>'nama',
                'parameter' =>'koperasi.nama',
                ),
             array(
                'alias'     =>'username',
                'parameter' =>'user_info.username',
                ),
            );


        $sort_order = array(
            array(
                'alias'     =>'z-a',
                'parameter' =>'desc',
                ),
            array(
                'alias'     =>'a-z',
                'parameter' =>'asc',
                ),
        );

        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        
        // Filter


        // STEP. 3 : Proses Parsing array Alias dan parameter        

        $def_param_keyword_by = $keyword_by[0]['parameter'];
        $param_keyword_by   = strtolower($this->input->get('keyword_by'));
        $data['param_keyword_by'] = 'semua';
        if (isset($param_keyword_by)) {
            $data['param_keyword_by'] = $param_keyword_by;
            $key = array_search($param_keyword_by, array_column($keyword_by,'alias'));
            if ($key) {
                $param_keyword_by = $keyword_by[$key]['parameter'];
                $data['param_keyword_by'] = $keyword_by[$key]['alias'];
            } else{
                $param_keyword_by = $def_param_keyword_by;
            }
        }else{
            $param_keyword_by = $def_param_keyword_by;
        }
        

        $def_param_sort = 'koperasi.nama';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'nama';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }


        $def_param_sort_order = 'desc';
        $param_sort_order   = strtolower($this->input->get('sort_order'));
        $data['param_sort_order'] = 'z-a';
        if (isset($param_sort_order)) {
            $data['param_sort_order'] = $param_sort_order;
            $key = array_search($param_sort_order,array_column($sort_order,'alias'));
            if ($key) {
                $param_sort_order = $sort_order[$key]['parameter'];
                $data['param_sort_order'] = $sort_order[$key]['alias'];
            } else{
                $param_sort_order = $def_param_sort_order;
            }
        }else{
            $param_sort_order = $def_param_sort_order;
        }

        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // print_r($param_query);
        
        ///// END Setting Filter /////
 





        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('koperasi_cabang');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        
        $config['per_page']     = 50; 
        $config['num_links']    = 10;
        $config['uri_segment']  = 2;

        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $limit = $config['per_page'];
        $offset = $this->uri->segment(2);

        //Load Data from Database
        $datadb = $this->koperasi_mod->get_all_koperasi_cabang($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        $data ['no'] = $offset+1;
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['title']          = 'Koperasi Cabang';
        $data['is_content_header']  = TRUE;

		$this->load->view('koperasi/koperasi_cabang_data', $data);
	}

	function add_koperasi(){
			$result = $this->koperasi_mod->select_max();

			if(!$result){
				$id = "0001";
			}
			else {
				$id_from_db = $this->koperasi_mod->select_max()->row_array();
				$id_to_int = (int)$id_from_db['id_koperasi'];

				$id_plus_one = $id_to_int + 1;

					if(strlen($id_plus_one) == 1){
						$id = "000".$id_plus_one;
					}
					else if(strlen($id_plus_one) == 2){
						$id = "00".$id_plus_one;
					}
					else if(strlen($id_plus_one) == 3){
						$id = "0".$id_plus_one;
					}
					else {
						$id = $id_plus_one;
					}
			}
		

		$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('berdiri', 'Tanggal Berdiri', 'required|xss_clean');
		$this->form_validation->set_rules('legal', 'Legal', 'xss_clean');
		$this->form_validation->set_rules('ketua', 'Ketua Koperasi', 'required|xss_clean');
        $this->form_validation->set_rules('polis', 'Polis', 'required|xss_clean');
		$this->form_validation->set_rules('ketua_telp', 'No Telepon Ketua Koperasi', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean|callback_cek_email');


		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|alpha_numeric|callback_cek_username');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Password', 'required|xss_clean|matches[password]');

        $this->form_validation->set_rules('prop', 'Provinsi', 'required|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota / Kabupaten', 'required|xss_clean');
        $this->form_validation->set_rules('kec', 'Kecamatan', 'required|xss_clean');
        $this->form_validation->set_rules('kel', 'Kelurahan', 'required|xss_clean');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'xss_clean|numeric');

		if ($this->form_validation->run() == FALSE) {
            $data['provinsi'] = $this->alamat_mod->get_provinsi();
            $data['jenis_koperasi'] = $this->koperasi_jenis_mod->get_all_koperasi_jenis();
			$data['title'] = "Tambah Koperasi";
			$data['data_kop'] = $this->koperasi_mod->get_id_nama()->result();
			$this->load->view('koperasi/add_koperasi', $data);
		} 
		else {
				$this->session->set_flashdata('msg','Data Koperasi berhasil ditambahkan');

			$this->koperasi_mod->add_koperasi($id);
			if($this->session->userdata('url_kop') == "cabang_koperasi"){ 
				redirect(base_url().'cabang_koperasi','refresh');
			}
			else {
				redirect(base_url().'koperasi','refresh');

			}
	
		}
	}

	function edit_koperasi(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		redirect(base_url().'koperasiupdate','refresh');
	}
	

	function update_koperasi(){

			if($this->koperasi_mod->get_koperasi_by_id($this->session->userdata('id'))->num_rows() > 0){
				$data['koperasi'] = $this->koperasi_mod->get_koperasi_by_id($this->session->userdata('id'))->row_array();
                $data['alamat_koperasi'] = $this->koperasi_mod->get_alamat_koperasi($this->session->userdata('id'));
                $data['provinsi'] = $this->alamat_mod->get_provinsi();
                $data['jenis_koperasi'] = $this->koperasi_jenis_mod->get_all_koperasi_jenis();
				$data['title'] = "Edit Koperasi";
				$data['data_kop'] = $this->koperasi_mod->get_id_nama()->result();
				$this->load->view('koperasi/edit_koperasi', $data);
			}
			else {
				redirect(base_url().'not_found','refresh');
			} 
		
		}




		function update_basic_profile(){
				$this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
                // $this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
                $this->form_validation->set_rules('berdiri', 'Tanggal Berdiri', 'required|xss_clean');
                $this->form_validation->set_rules('legal', 'Legal', 'xss_clean');
                $this->form_validation->set_rules('ketua', 'Ketua Koperasi', 'required|xss_clean');
                $this->form_validation->set_rules('ketua_telp', 'No Telepon Ketua Koperasi', 'numeric|required|xss_clean');
                $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    redirect(base_url() . 'koperasiupdate', 'refresh');
                }
                else
                {
                    $this->koperasi_mod->update_basic($this->session->userdata('id'));
                    $this->session->set_flashdata('msg', 'Profil berhasil diubah');
                    $this->session->set_userdata('nama', $this->input->post('nama'));
                    redirect(base_url() . 'koperasiupdate', 'refresh');
                }
		}

        function update_alamat(){
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
            $this->form_validation->set_rules('prop', 'Provinsi', 'required|xss_clean');
            $this->form_validation->set_rules('kota', 'Kota / Kabupaten', 'required|xss_clean');
            $this->form_validation->set_rules('kec', 'Kecamatan', 'required|xss_clean');
            $this->form_validation->set_rules('kel', 'Kelurahan', 'required|xss_clean');
            $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'xss_clean');

            if ($this->form_validation->run() == FALSE) {
                 $this->session->set_flashdata('validation_errors', validation_errors());
                 redirect(base_url() . 'koperasiupdate', 'refresh');
            } else {
                 $this->koperasi_mod->update_alamat($this->session->userdata('id'));
                 $this->session->set_flashdata('msg', 'Alamat berhasil diubah');
                 redirect(base_url() . 'koperasiupdate', 'refresh');
            }

        }

        function update_password(){
                $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[5]');
                $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|min_length[5]|matches[new_password]');

                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    redirect(base_url() . 'koperasiupdate', 'refresh');
                }
                else
                {
                    $this->koperasi_mod->update_password($this->session->userdata('id'));
                    $this->session->set_flashdata('msg', 'Password berhasil diubah');
                    redirect(base_url() . 'koperasiupdate', 'refresh');
                }
        }

		function update_contact(){
				$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
				$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');


				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('validation_errors', validation_errors());
					redirect(base_url().'koperasiupdate','refresh');
				} else {
					$this->koperasi_mod->update_contact($this->session->userdata('id'));
						$this->session->set_flashdata('msg','Data berhasil diubah');

						if($this->session->userdata('url_kop') == "koperasi"){
							redirect(base_url().'koperasi','refresh');
							$this->session->set_flashdata('msg','Data Koperasi berhasil diubah');
						}
						else {
							redirect(base_url().'cabang_koperasi','refresh');
						}
				}
		}



	function delete_koperasi(){
		$this->session->set_userdata('id', $this->uri->rsegment(3));
		// echo $this->uri->rsegment(3);
		redirect(base_url().'koperasi_delete','refresh');
	}

	function koperasi_delete(){
		if($this->koperasi_mod->get_koperasi_by_id($this->session->userdata('id'))->num_rows() > 0){
			$this->koperasi_mod->delete_koperasi();
			$this->session->set_flashdata('msg','Data Koperasi berhasil dihapus');
			if($this->session->userdata('url_kop') == "koperasi"){
				redirect(base_url().'koperasi','refresh');
			}
				else {
				redirect(base_url().'cabang_koperasi','refresh');

				}
		}
		else {
				redirect(base_url().'not_found','refresh');
			}
	}

	public function cek_username($username){

		$username = $this->input->post('username');

		$result = $this->koperasi_mod->cek_username($username);


		if(!$result){
			$this->form_validation->set_message('cek_username', 'Username sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}

	function cek_email($email){

		$email = $this->input->post('email');

		$result = $this->koperasi_mod->cek_email($email);


		if(!$result){
			$this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}


    function get_koperasi(){
      $search = strip_tags(trim($this->input->get('q')));
      $query = $this->koperasi_mod->get_id_and_nama($search);

      if($query->num_rows() > 0){
        foreach ($query->result() as $r) {
        $data[] = array('id' => $r->id_koperasi,
                          'text' =>$r->nama,
                          'logo' =>$r->foto );   
        }
      }
      else {
        $data[] = array('id' => '-1',
                      'text'=>'Koperasi Tidak Ditemukan',
                      'logo'=> 'default.jpg' );
      }
      echo json_encode($data);
    }

    function share_induk(){
        $this->session->set_userdata('url_share', 'share_profit_induk');
        $data['no'] = 1;
        $data['title'] = "Data Koperasi Induk";
        $data['page_name']          = 'Data Koperasi';
        $data['page_sub_name']      = '';

        $keyword = $this->input->get('q');
        

        $data['keyword'] = NULL;
        if ($keyword) {
            $data['keyword'] = $keyword;
        }

        ///// START Setting Filter /////
        // STEP. 1 : Array nama alias dan syntax db
        $keyword_by = array(
            array(
                'alias'=>'semua',
                'parameter'=> array
                        (   
                            'koperasi.nama'      => $keyword,
                            'user_info.username' => $keyword,
                        ),
                ),
      
            array(
                'alias'     =>'Nama',
                'parameter' =>'koperasi.nama',
                ),
        );


        $sort = array(
            array(
                'alias'     =>'nama',
                'parameter' =>'koperasi.nama',
                ),
             array(
                'alias'     =>'username',
                'parameter' =>'user_info.username',
                ),
            );


        $sort_order = array(
            array(
                'alias'     =>'z-a',
                'parameter' =>'desc',
                ),
            array(
                'alias'     =>'a-z',
                'parameter' =>'asc',
                ),
        );

        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        
        // Filter


        // STEP. 3 : Proses Parsing array Alias dan parameter        

        $def_param_keyword_by = $keyword_by[0]['parameter'];
        $param_keyword_by   = strtolower($this->input->get('keyword_by'));
        $data['param_keyword_by'] = 'semua';
        if (isset($param_keyword_by)) {
            $data['param_keyword_by'] = $param_keyword_by;
            $key = array_search($param_keyword_by, array_column($keyword_by,'alias'));
            if ($key) {
                $param_keyword_by = $keyword_by[$key]['parameter'];
                $data['param_keyword_by'] = $keyword_by[$key]['alias'];
            } else{
                $param_keyword_by = $def_param_keyword_by;
            }
        }else{
            $param_keyword_by = $def_param_keyword_by;
        }
        

        $def_param_sort = 'koperasi.nama';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'nama';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }


        $def_param_sort_order = 'desc';
        $param_sort_order   = strtolower($this->input->get('sort_order'));
        $data['param_sort_order'] = 'z-a';
        if (isset($param_sort_order)) {
            $data['param_sort_order'] = $param_sort_order;
            $key = array_search($param_sort_order,array_column($sort_order,'alias'));
            if ($key) {
                $param_sort_order = $sort_order[$key]['parameter'];
                $data['param_sort_order'] = $sort_order[$key]['alias'];
            } else{
                $param_sort_order = $def_param_sort_order;
            }
        }else{
            $param_sort_order = $def_param_sort_order;
        }

        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // print_r($param_query);
        
        ///// END Setting Filter /////
 





        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('koperasi');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        
        $config['per_page']     = 50; 
        $config['num_links']    = 10;
        $config['uri_segment']  = 3;

        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $limit = $config['per_page'];
        $offset = $this->uri->segment(3);

        //Load Data from Database
        $datadb = $this->koperasi_mod->get_all_koperasi_induk($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['title']          = 'Koperasi Induk';
        $data['is_content_header']  = TRUE;

        $this->load->view('koperasi/koperasi_share_profit', $data);

    }



    function share_cabang(){
        $this->session->set_userdata('url_share', 'share_profit');
        $data['no'] = 1;
        $data['title'] = "Data Koperasi Cabang";
        $data['page_name']          = 'Data Koperasi';
        $data['page_sub_name']      = '';

        $keyword = $this->input->get('q');
        

        $data['keyword'] = NULL;
        if ($keyword) {
            $data['keyword'] = $keyword;
        }

        ///// START Setting Filter /////
        // STEP. 1 : Array nama alias dan syntax db
        $keyword_by = array(
            array(
                'alias'=>'semua',
                'parameter'=> array
                        (   
                            'koperasi.nama'      => $keyword,
                            'user_info.username' => $keyword,
                        ),
                ),
      
            array(
                'alias'     =>'Nama',
                'parameter' =>'koperasi.nama',
                ),
        );


        $sort = array(
            array(
                'alias'     =>'nama',
                'parameter' =>'koperasi.nama',
                ),
             array(
                'alias'     =>'username',
                'parameter' =>'user_info.username',
                ),
            );


        $sort_order = array(
            array(
                'alias'     =>'z-a',
                'parameter' =>'desc',
                ),
            array(
                'alias'     =>'a-z',
                'parameter' =>'asc',
                ),
        );

        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        
        // Filter


        // STEP. 3 : Proses Parsing array Alias dan parameter        

        $def_param_keyword_by = $keyword_by[0]['parameter'];
        $param_keyword_by   = strtolower($this->input->get('keyword_by'));
        $data['param_keyword_by'] = 'semua';
        if (isset($param_keyword_by)) {
            $data['param_keyword_by'] = $param_keyword_by;
            $key = array_search($param_keyword_by, array_column($keyword_by,'alias'));
            if ($key) {
                $param_keyword_by = $keyword_by[$key]['parameter'];
                $data['param_keyword_by'] = $keyword_by[$key]['alias'];
            } else{
                $param_keyword_by = $def_param_keyword_by;
            }
        }else{
            $param_keyword_by = $def_param_keyword_by;
        }
        

        $def_param_sort = 'koperasi.nama';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'nama';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }


        $def_param_sort_order = 'desc';
        $param_sort_order   = strtolower($this->input->get('sort_order'));
        $data['param_sort_order'] = 'z-a';
        if (isset($param_sort_order)) {
            $data['param_sort_order'] = $param_sort_order;
            $key = array_search($param_sort_order,array_column($sort_order,'alias'));
            if ($key) {
                $param_sort_order = $sort_order[$key]['parameter'];
                $data['param_sort_order'] = $sort_order[$key]['alias'];
            } else{
                $param_sort_order = $def_param_sort_order;
            }
        }else{
            $param_sort_order = $def_param_sort_order;
        }

        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // print_r($param_query);
        
        ///// END Setting Filter /////
 





        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('koperasi_cabang');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        
        $config['per_page']     = 50; 
        $config['num_links']    = 10;
        $config['uri_segment']  = 3;

        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $limit = $config['per_page'];
        $offset = $this->uri->segment(3);

        //Load Data from Database
        $datadb = $this->koperasi_mod->get_all_koperasi_cabang($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['title']          = 'Koperasi Cabang';
        $data['is_content_header']  = TRUE;

        $this->load->view('koperasi/koperasi_share_profit', $data);
    }


    function edit_profit(){
        $this->session->set_userdata('id', $this->uri->rsegment(3));
        redirect(base_url().'update_profit','refresh');
    }

    function update_profit(){
        $profit = $this->koperasi_mod->get_share_cabang($this->session->userdata('id'));

        if($profit){
            $this->form_validation->set_rules('profit', 'Profit', 'required|numeric|xss_clean');

            if ($this->form_validation->run() == FAlSE) {
                $data['profit'] = $profit->row_array();
                $this->load->view('koperasi/edit_share_profit', $data);
            } else {
                $this->koperasi_mod->update_share_profit($this->session->userdata('id'));
                $this->session->set_flashdata('msg', 'Profit berhasil diperbaharui');
                redirect(base_url().$this->session->userdata('url_share'),'refresh');
            }
        }
    }


    function shu(){
        if($this->session->userdata('level') != 3){
            $this->load->model('rekening_mod');
            $data['title'] = "Data SHU Koperasi";

            $this->rekening_mod->id_koperasi = $this->uri->segment(3) ? $this->uri->segment(3, true) : null;

            $koperasi_res = $this->koperasi_mod->get_koperasi_by_id($this->rekening_mod->id_koperasi);
            if($koperasi_res->num_rows() > 0){
                $shu_pinjaman = $this->rekening_mod->get_shu_stats_pinjaman();
                $shu_angsuran = $this->rekening_mod->get_shu_stats_angsuran();
                $shu_deposito = $this->rekening_mod->get_shu_stats_deposito();
                $shu_pendapatan = $this->rekening_mod->get_shu_stats_pendapatan();
                $shu_pengeluaran = $this->rekening_mod->get_shu_stats_pengeluaran();
                $data['koperasi'] = $koperasi_res->row();
                $data['shu_pinjaman'] = $shu_pinjaman->num_rows() ? $shu_pinjaman->row() : null;
                $data['shu_angsuran'] = $shu_angsuran->num_rows() ? $shu_angsuran->row() : null;
                $data['shu_deposito'] = $shu_deposito->num_rows() ? $shu_deposito->row() : null;
                $data['shu_pendapatan'] = $shu_pendapatan;
                $data['shu_pengeluaran'] = $shu_pengeluaran;
                $this->load->view('koperasi/shu_koperasi', $data);
            } else
                $this->load->view('404');
        } else
            $this->load->view('404');
    }

    function koperasi_shu(){
        if($this->session->userdata('level') != 3){
            if($this->session->userdata('level') == 1){
                $this->session->set_userdata('url_kop', 'koperasi');
                $data['no'] = 1;
                $data['title'] = "Data Koperasi Induk";
                $data['page_name']          = 'Data Koperasi';
                $data['page_sub_name']      = '';

                $keyword = $this->input->get('q');
                

                $data['keyword'] = NULL;
                if ($keyword) {
                    $data['keyword'] = $keyword;
                }

                ///// START Setting Filter /////
                // STEP. 1 : Array nama alias dan syntax db
                $keyword_by = array(
                    array(
                        'alias'=>'semua',
                        'parameter'=> array
                                (   
                                    'koperasi.nama'      => $keyword,
                                    'user_info.username' => $keyword,
                                ),
                        ),
              
                    array(
                        'alias'     =>'Nama',
                        'parameter' =>'koperasi.nama',
                        ),
                );


                $sort = array(
                    array(
                        'alias'     =>'nama',
                        'parameter' =>'koperasi.nama',
                        ),
                     array(
                        'alias'     =>'username',
                        'parameter' =>'user_info.username',
                        ),
                    );


                $sort_order = array(
                    array(
                        'alias'     =>'z-a',
                        'parameter' =>'desc',
                        ),
                    array(
                        'alias'     =>'a-z',
                        'parameter' =>'asc',
                        ),
                );

                // STEP. 2 : Masukan Array Filter ke Array Data

                $data['keyword_by'] = $keyword_by;
                $data['sort']       = $sort;
                $data['sort_order'] = $sort_order;

                
                // Filter


                // STEP. 3 : Proses Parsing array Alias dan parameter        

                $def_param_keyword_by = $keyword_by[0]['parameter'];
                $param_keyword_by   = strtolower($this->input->get('keyword_by'));
                $data['param_keyword_by'] = 'semua';
                if (isset($param_keyword_by)) {
                    $data['param_keyword_by'] = $param_keyword_by;
                    $key = array_search($param_keyword_by, array_column($keyword_by,'alias'));
                    if ($key) {
                        $param_keyword_by = $keyword_by[$key]['parameter'];
                        $data['param_keyword_by'] = $keyword_by[$key]['alias'];
                    } else{
                        $param_keyword_by = $def_param_keyword_by;
                    }
                }else{
                    $param_keyword_by = $def_param_keyword_by;
                }
                

                $def_param_sort = 'koperasi.nama';
                $param_sort         = strtolower($this->input->get('sort'));
                $data['param_sort'] = 'nama';
                if (isset($param_sort)) {
                    $data['param_sort'] = $param_sort;
                    $key = array_search($param_sort, array_column($sort,'alias'));
                    if ($key) {
                        $param_sort = $sort[$key]['parameter'];
                        $data['param_sort'] = $sort[$key]['alias'];
                    } else{
                        $param_sort = $def_param_sort;
                    }
                }else{
                    $param_sort = $def_param_sort;
                }


                $def_param_sort_order = 'desc';
                $param_sort_order   = strtolower($this->input->get('sort_order'));
                $data['param_sort_order'] = 'z-a';
                if (isset($param_sort_order)) {
                    $data['param_sort_order'] = $param_sort_order;
                    $key = array_search($param_sort_order,array_column($sort_order,'alias'));
                    if ($key) {
                        $param_sort_order = $sort_order[$key]['parameter'];
                        $data['param_sort_order'] = $sort_order[$key]['alias'];
                    } else{
                        $param_sort_order = $def_param_sort_order;
                    }
                }else{
                    $param_sort_order = $def_param_sort_order;
                }

                // STEP. 4 : Simpan hasil sbg parameter utk query di database 

                $param_query['keyword_by'] = $param_keyword_by;
                $param_query['sort']       = $param_sort;
                $param_query['sort_order'] = $param_sort_order;

                // print_r($param_query);
                
                ///// END Setting Filter /////
         





                //Setting Pagination
                $this->load->library('pagination');
                $config['base_url']             = site_url('shu_koperasi');
                $config['reuse_query_string']   = TRUE;
                $config['use_page_numbers']     = FALSE;
                
                $config['per_page']     = 50; 
                $config['num_links']    = 10;
                $config['uri_segment']  = 2;

                $config['full_tag_open']    = "<ul class='pagination'>";
                $config['full_tag_close']   = "</ul>";
                $config['num_tag_open']     = '<li>';
                $config['num_tag_close']    = '</li>';
                $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
                $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
                $config['next_tag_open']    = "<li>";
                $config['next_tagl_close']  = "</li>";
                $config['prev_tag_open']    = "<li>";
                $config['prev_tagl_close']  = "</li>";
                $config['first_tag_open']   = "<li>";
                $config['first_tagl_close'] = "</li>";
                $config['last_tag_open']    = "<li>";
                $config['last_tagl_close']  = "</li>";

                $limit = $config['per_page'];
                $offset = $this->uri->segment(2);

                //Load Data from Database
                $datadb = $this->koperasi_mod->get_all_koperasi_induk($keyword,$limit,$offset,$param_query);
                $data ['no'] = $offset+1;
                $data['datadb'] = NULL;
                if ($datadb['count']!=0) {
                    $data['datadb'] = $datadb['data'];
                }

                
                $config['total_rows']   = $datadb['count_all'];
                $this->pagination->initialize($config); 
                $data['pagination'] = $this->pagination->create_links();

                $data['title']          = 'Koperasi Induk';
                $data['is_content_header']  = TRUE;

                $this->load->view('koperasi/koperasi_shu', $data);
            } else if($this->session->userdata('level') == 2) {
                $this->load->model('rekening_mod');
                $data['title'] = "Data SHU Koperasi";

                $this->rekening_mod->id_koperasi = $this->session->userdata('id_koperasi');

                $koperasi_res = $this->koperasi_mod->get_koperasi_by_id($this->rekening_mod->id_koperasi);
                if($koperasi_res->num_rows() > 0){
                    $shu_pinjaman = $this->rekening_mod->get_shu_stats_pinjaman();
                    $shu_angsuran = $this->rekening_mod->get_shu_stats_angsuran();
                    $shu_deposito = $this->rekening_mod->get_shu_stats_deposito();
                    $shu_pendapatan = $this->rekening_mod->get_shu_stats_pendapatan();
                    $shu_pengeluaran = $this->rekening_mod->get_shu_stats_pengeluaran();
                    $data['koperasi'] = $koperasi_res->row();
                    $data['shu_pinjaman'] = $shu_pinjaman->num_rows() ? $shu_pinjaman->row() : null;
                    $data['shu_angsuran'] = $shu_angsuran->num_rows() ? $shu_angsuran->row() : null;
                    $data['shu_deposito'] = $shu_deposito->num_rows() ? $shu_deposito->row() : null;
                    $data['shu_pendapatan'] = $shu_pendapatan;
                    $data['shu_pengeluaran'] = $shu_pengeluaran;
                    $this->load->view('koperasi/shu_koperasi', $data);
                } else
                    $this->load->view('404');
            }
        } else
            $this->load->view('404');
    }

}

/* End of file Koperasi.php */
/* Location: ./application/controllers/Koperasi.php */