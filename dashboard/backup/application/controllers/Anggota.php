<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->model('anggota_mod');
		$this->load->model('koperasi_mod');
		$this->load->model('pekerjaan_mod');
		$this->load->model('alamat_mod');
		$this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('query_string_helper');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}

	function data_anggota_()
	{
		$data['anggota'] = $this->anggota_mod->get_all_anggota()->result();
		$data['title'] = "Data Anggota Koperasi";
		$data['no'] = 1;
		$this->load->view('user/anggota_data', $data);
	}



	function data_anggota(){
		$data['title'] = "Data Anggota Koperasi";
		$data['no'] = 1;
		$data['page_name']          = 'Data Admin';
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
                            'user_detail.nama_lengkap'     => $keyword,
                        ),
                ),
             array(
                'alias'=>'Nama',
                'parameter'=> array
                        (   
                            'user_detail.nama_lengkap'     => $keyword,
                        ),
                ),
        );


        $sort = array(
            array(
                'alias'     =>'Nama',
                'parameter' =>'user_detail.nama_lengkap',
                ),
             array(
                'alias'     =>'Username',
                'parameter' =>'user_info.username',
                ),
              array(
                'alias'     =>'Email',
                'parameter' =>'user_detail.email',
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

        // Filter
        
        $get_id_koperasi = $this->input->get('filter_koperasi');
        $get_nama_koperasi = $this->koperasi_mod->get_nama_koperasi($get_id_koperasi);

        

        if($get_nama_koperasi){
            
                $filter_koperasi = array( array(
                    'alias'     => $get_nama_koperasi[0]['nama'],
                    'parameter' => $get_id_koperasi,
                ));
            
        }
        else {
            $filter_koperasi = array(array(
                'alias'     => 'Cari Berdasarkan Koperasi',
                'parameter' => NULL,
            ));
        }
        $data['koperasi'] = $filter_koperasi;

        $data['filter_koperasi'] = $filter_koperasi;
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


        $def_param_sort = 'user_detail.nama_lengkap';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'semua';
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
        

        $def_param_filter_koperasi = $filter_koperasi;
        $get_filter_koperasi = $this->input->get('filter_koperasi');
        $param_filter_koperasi   = strtoupper($get_filter_koperasi);
        $data['param_filter_koperasi'] = $filter_koperasi;
        if (isset($param_filter_koperasi)) {
            $data['param_filter_koperasi'] = $param_filter_koperasi;
            $key = array_search($param_filter_koperasi,array_column($filter_koperasi,'alias'));
            if ($key) {
                $param_filter_koperasi = $filter_koperasi[$key]['parameter'];
                $data['param_filter_koperasi'] = $filter_koperasi[$key]['alias'];
            } else{
                $param_filter_koperasi = $def_param_filter_koperasi;
            }
        }else{
            $param_filter_koperasi = $def_param_filter_koperasi;
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


        // Filter

        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;

        // Filter
        $param_query['filter_koperasi'] = $param_filter_koperasi;
        
        ///// END Setting Filter /////
 

        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('admin');
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
        $datadb = $this->anggota_mod->get_all_anggota($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        $data ['no'] = 1;
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['is_content_header']  = TRUE;

        
        $this->load->view('user/anggota_koperasi_data',$data);
	}

	public function agama(){
		$agama = array(		   'Islam' => "Islam",
							   'Kristen Katolik' => "Kristen Katolik",
							   'Kristen Protestan' => "Kristen Protestan",
							   'Hindu' => "Hindu",
							   'Budha' => "Budha");

		return $agama;
	}

	function add_anggota(){
		


		$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
		$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean|callback_cek_email');
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|callback_cek_username');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('noktp', 'No Ktp', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$data['question'] = $this->anggota_mod->get_question()->result();
			$data['agama'] = $this->agama();
			$data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
			$data['koperasi'] = $this->koperasi_mod->get_all_koperasi()->result();
			$data['title'] = "Tambah Anggota";
			$this->load->view('user/add_anggota', $data);
		} 
		else {
			$this->anggota_mod->add_anggota();
			$this->session->set_flashdata('msg','Data Anggota berhasil ditambahkan');
			redirect(base_url().'anggota','refresh');
		}

	}


	function edit_anggota(){
			$this->session->set_userdata('id',$this->uri->rsegment(3));
			redirect(base_url().'update_anggota','refresh');
	}


	function anggota_edit(){
		if($this->anggota_mod->get_anggota_by_id($this->session->userdata('id'))->num_rows() > 0){
			$data['no'] = 1;
			$data['agama'] = $this->agama();
			$data['question'] = $this->anggota_mod->get_question()->result();
			$data['provinsi'] = $this->alamat_mod->get_provinsi();
			$data['alamat'] = $this->alamat_mod->get_alamat_by_id($this->session->userdata('id'))->result();
			$data['user'] = $this->anggota_mod->get_anggota_by_id($this->session->userdata('id'))->row_array();
			$data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
			$data['koperasi'] = $this->koperasi_mod->get_all_koperasi()->result();
			$data['title'] = "Edit Anggota";
			$this->load->view('user/edit_anggota', $data);
		}
		else {
			redirect(base_url().'not_found','refresh');
		}
	}



	function update_basic_profile(){
				$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
				$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
				$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'xss_clean|required');
				$this->form_validation->set_rules('noktp', 'Nomor KTP', 'xss_clean|required|numeric|min_length[10]|max_length[20]');
				$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'xss_clean');
				$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'min_length[10]');
				$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|xss_clean');

				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('validation_errors', validation_errors());
					redirect(base_url().'update_anggota','refresh');
				} else {
					$this->anggota_mod->update_basic($this->session->userdata('id'));
					$this->session->set_flashdata('msg','Profil berhasil diubah');
					redirect(base_url().'anggota','refresh');
				}
	}

	function update_contact(){
				$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
				$this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');

				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('validation_errors', validation_errors());
					redirect(base_url().'update_anggota','refresh');
				} else {
					$this->anggota_mod->update_contact($this->session->userdata('id'));
					$this->session->set_flashdata('msg','Kontak berhasil diubah');
					redirect(base_url().'anggota','refresh');
				}
	}




	function select_kabupaten($id_provinsi){
		 $kab=$this->alamat_mod->get_kabupaten($id_provinsi);
		   echo"<option value=''>Pilih Kota/Kab</option>";
		  foreach($kab as $k){
		    echo "<option value='{$k->id_kabupaten}'>{$k->nama}</option>";
		  }
	}

	function select_kecamatan(){
		$kec=$this->alamat_mod->get_kecamatan($id_kabupaten);
		   echo"<option value=''>Pilih Kecamatan</option>";
		  foreach($kec as $k){
		    echo "<option value='{$k->id_kecamatan}'>{$k->nama}</option>";
		  }
	}

	function select_kelurahan(){
		$kel=$this->alamat_mod->get_kelurahan($id_kecamtan);
		   echo"<option value=''>Pilih Kelurahan</option>";
		  foreach($kab as $k){
		    echo "<option value='{$k->id_kelurahan}'>{$k->nama}</option>";
		  }
	}



	function add_alamat(){
		$this->alamat_mod->add_alamat($this->session->userdata('id_user'));
		$this->session->set_flashdata('msg', 'Alamat Berhasil Ditambahkan');
		redirect(base_url().'profile','refresh');
	}


	function tambah_alamat(){
		$this->alamat_mod->add_alamat($this->session->userdata('id'));
		$this->session->set_flashdata('msg', 'Alamat berhasil ditambahkan');
		// echo "HI";
		redirect(base_url().'update_anggota','refresh');
	}

	function set_default(){
		$this->session->set_userdata('id_alamat', $this->uri->rsegment(3));
		redirect(base_url().'anggota/set_default_alamat','refresh');
	}
	function set_default_alamat(){
		if($this->alamat_mod->get_alamat($this->session->userdata('id_alamat'))->num_rows() > 0){
			$this->alamat_mod->set_default($this->session->userdata('id_alamat'), $this->session->userdata('id'));
			$this->session->set_flashdata('msg', 'Alamat Default Berhasil Diubah');
			redirect(base_url().'update_anggota','refresh');
		}
		else {
			// echo $this->session->userdata('id_alamat');;
			redirect(base_url().'not_found','refresh');
		}
	}

	function hapus_alamat(){
		$this->session->set_userdata('id_alamat', $this->uri->rsegment(3));
		redirect(base_url().'anggota/delete_alamat','refresh');
	}

	function delete_alamat(){
		if($this->alamat_mod->get_alamat($this->session->userdata('id_alamat'))->num_rows() > 0){
			$this->alamat_mod->delete_alamat($this->session->userdata('id_alamat'));
			$this->session->set_flashdata('msg', 'Alamat Berhasil Dihapus');
			redirect(base_url().'update_anggota','refresh');
		}
		else {
			redirect(base_url().'not_found','refresh');
		}
	}


	function delete_anggota(){
			$this->session->set_userdata('id',$this->uri->rsegment(3));
			redirect(base_url().'anggota_delete','refresh');
	}

	function anggota_delete(){
		if($this->anggota_mod->get_anggota_by_id($this->session->userdata('id'))->row_array() > 0){
			$this->anggota_mod->delete_anggota();
			$this->session->set_flashdata('msg','Data Anggota berhasil dihapus');

			redirect(base_url().'anggota','refresh');
		}
		else {
			redirect(base_url().'not_found','refresh');
		}
	}



	public function cek_username($username){

		$username = $this->input->post('username');
		$result = $this->anggota_mod->cek_username($username);


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

		$result = $this->anggota_mod->cek_email($email);


		if(!$result){
			$this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
     		return FALSE;
		}
		else{
			return TRUE;
		}

	}








}

/* End of file Anggota.php */
/* Location: ./application/controllers/Anggota.php */