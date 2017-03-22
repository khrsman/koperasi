<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Konten_berita_mod');
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('koperasi_mod');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		
	}

	function berita_data()
	{
		if($this->session->userdata('id_berita') != NULL){
			$this->session->unset_userdata('id_berita');
		}

		if($this->uri->rsegment(3) == "admin"){
			$this->session->set_userdata('level_data_berita', "admin");
			$data['level_data_berita'] = "1";
			$data['berita'] = $this->Konten_berita_mod->get_all_berita_admin()->result();
			$data['no'] = 1;
			$data['title'] = "Data Berita Admin";
			$this->load->view('berita/berita_data', $data);
		}
		else if($this->uri->rsegment(3) == "koperasi"){
			$this->session->set_userdata('level_data_berita', "koperasi");
			$data['berita'] = $this->Konten_berita_mod->get_all_berita_koperasi()->result();
			$data['level_data_berita'] = "2";
			$data['no'] = 1;
			$data['title'] = "Data Berita koperasi";
			$this->load->view('berita/berita_data', $data);
		}
		else if($this->uri->rsegment(3) == "komunitas"){
			$data['level_data_berita'] = "4";
			$this->session->set_userdata('level_data_berita', "komunitas");
			$data['berita'] = $this->Konten_berita_mod->get_all_berita_komunitas()->result();
			$data['no'] = 1;
			$data['title'] = "Data Berita Komunitas";
			$this->load->view('berita/berita_data', $data);
		}
		else {
			redirect(base_url().'not_found','refresh');
		}

	}


	function berita_koperasi(){
		$data['title'] = "Berita Koperasi";
		$data['no'] = 1;
		$data['koperasi'] = $this->Konten_berita_mod->get_id_nama_koperasi()->result();
		$this->load->view('berita/berita_koperasi', $data);
	}

	function berita_kop(){
		$this->session->set_userdata('id_berita_koperasi', $this->uri->rsegment(3));
		redirect('berita/koperasi','refresh');
	}

	function berita_komunitas(){
		$data['title'] = "Berita Komunitas";
		$data['no'] = 1;
		$data['komunitas'] = $this->Konten_berita_mod->get_id_nama_komunitas()->result();
		$this->load->view('berita/berita_komunitas', $data);
	}

	function berita_kom(){
		$this->session->set_userdata('id_berita_komunitas', $this->uri->rsegment(3));
		redirect('berita/komunitas','refresh');
	}


	function add_berita(){
		$id = "4".time();
		$this->session->set_userdata('id_berita', $id);
		redirect('tambah_berita','refresh');
	}

	function edit_berita(){
		$this->session->set_userdata('id_berita', $this->uri->rsegment(3));
		redirect('update_berita','refresh');
	}

	function delete_berita(){
		$this->session->set_userdata('id_berita', $this->uri->rsegment(3));
		redirect('berita_delete','refresh');
	}


	function tambah_berita(){

			if($this->session->userdata('id_berita') == NULL){
				redirect('not_found','refresh');
			}

			else {

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Berita', 'required|xss_clean');


				if ($this->form_validation->run() == FALSE) {
					$data['title'] = "Tambah Berita";
					$this->load->view('berita/add_berita', $data);
				} 
				else {

					$config['upload_path'] = 'assets/images/berita';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					
					if ( !$this->upload->do_upload('photo')){
						$this->session->set_userdata('msg', $this->upload->display_errors());
						redirect(base_url().'tambah_berita/' ,'refresh');
						// echo $this->upload->display_errors();
					}
					else {
						$this->session->set_userdata('photo', $this->upload->data()['file_name']);
						$this->Konten_berita_mod->add_berita();
						redirect(base_url().'lihat_berita/'.$this->session->userdata('id_berita'),'refresh');
						// echo "success";
					}
				}

		}
			
	}


	function berita_edit(){
		if($this->session->userdata('id_berita') == NULL){
				redirect('not_found','refresh');
			}

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Berita', 'required|xss_clean');


				$result = $this->Konten_berita_mod->get_berita_by_id()->num_rows();
					
					if($result > 0) {
						if ($this->form_validation->run() == FALSE) {
							$data['berita'] = $this->Konten_berita_mod->get_berita_by_id()->row_array();
							$data['title'] = "Edit Berita";
							$this->load->view('berita/edit_berita', $data);
						}
						else {
							$this->session->set_flashdata('msg', 'Berita berhasil diupdate');
							$this->Konten_berita_mod->edit_berita();
							redirect(base_url().'update_berita','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}

				
		}


	function edit_foto_berita(){
					$config['upload_path'] = 'assets/images/berita';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);

					$result = $this->Konten_berita_mod->get_berita_by_id()->num_rows();

					if($result > 0){
						if ( !$this->upload->do_upload('photo')){
							$this->session->set_flashdata('msg', $this->upload->display_errors());
							redirect(base_url().'update_berita/' ,'refresh');
						}
						else {
							if($this->Konten_berita_mod->get_berita_by_id()->row_array()['link_gambar'] != NULL){
							unlink(FCPATH."assets/images/berita/".$this->Konten_berita_mod->get_berita_by_id()->row_array()['link_gambar']);
						}
							$this->session->set_userdata('photo', $this->upload->data()['file_name']);
							$this->session->set_flashdata('msg', 'Berita berhasil diupdate');
							$this->Konten_berita_mod->edit_foto_berita();
							redirect(base_url().'update_berita','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}
	}


	function berita_delete(){
		$result = $this->Konten_berita_mod->get_berita_by_id()->num_rows();

		if($result > 0){
			unlink(FCPATH."assets/images/berita/".$this->Konten_berita_mod->get_berita_by_id()->row_array()['link_gambar']);
			$this->Konten_berita_mod->delete_berita();
			$this->session->set_flashdata('msg', 'Berita berhasil dihapus');
			$this->Konten_berita_mod->edit_foto_berita();

				if($this->session->userdata('level_data_berita') == "admin"){
					redirect(base_url().'berita/admin','refresh');
				}
				else if($this->session->userdata('level_data_berita') == "koperasi"){
					redirect(base_url().'berita/koperasi','refresh');
				}
				else if($this->session->userdata('level_data_berita') == "komunitas"){
					redirect(base_url().'berita/komunitas','refresh');
				}
		}

		else {
						redirect('not_found','refresh');
					}
	}

	function berita_lihat(){
		$this->session->set_userdata('id_berita', $this->uri->rsegment(3));
		redirect('news','refresh');
	}

	function lihat_berita(){
		$result = $this->Konten_berita_mod->get_berita_by_id()->num_rows();
		if($result > 0) {
			$data['title'] = "Lihat Berita";
			$data['berita'] = $this->Konten_berita_mod->get_berita_by_id()->row_array();
			$this->load->view('berita/lihat_berita', $data);
		}
		else {
			redirect('not_found','refresh');
		}
	}

}

/* End of file Berita.php */
/* Location: ./application/controllers/Berita.php */