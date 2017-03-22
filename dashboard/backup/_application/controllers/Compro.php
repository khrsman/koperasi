<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compro extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Konten_compro_mod');
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		
	}

	function compro_data()
	{
		if($this->session->userdata('id_compro') != NULL){
			$this->session->unset_userdata('id_compro');
		}

		if($this->uri->rsegment(3) == "admin"){
			$this->session->set_userdata('level_data_compro', "admin");
			$data['level_data_compro'] = "1";
			$data['compro'] = $this->Konten_compro_mod->get_all_compro_admin()->result();
			$data['no'] = 1;
			$data['title'] = "Data Compro Admin";
			$this->load->view('compro/compro_data', $data);
		}
		else if($this->uri->rsegment(3) == "koperasi"){
			$this->session->set_userdata('level_data_compro', "koperasi");
			$data['compro'] = $this->Konten_compro_mod->get_all_compro_koperasi()->result();
			$data['level_data_compro'] = "2";

			$data['no'] = 1;
			$data['title'] = "Data Compro koperasi";
			$this->load->view('compro/compro_data', $data);
		}
		else if($this->uri->rsegment(3) == "komunitas"){
			$data['level_data_compro'] = "4";
			$this->session->set_userdata('level_data_compro', "komunitas");
			$data['compro'] = $this->Konten_compro_mod->get_all_compro_komunitas()->result();
			$data['no'] = 1;
			$data['title'] = "Data Compro Komunitas";
			$this->load->view('compro/compro_data', $data);
		}
		else {
			redirect(base_url().'not_found','refresh');
		}

	}

	function compro_koperasi(){
		$data['title'] = "Berita Koperasi";
		$data['no'] = 1;
		$data['koperasi'] = $this->Konten_compro_mod->get_id_nama_koperasi()->result();
		$this->load->view('compro/compro_koperasi', $data);
	}

	function compro_kop(){
		$this->session->set_userdata('id_compro_koperasi', $this->uri->rsegment(3));
		redirect('compro/koperasi','refresh');
	}

	function compro_komunitas(){
		$data['title'] = "Berita Komunitas";
		$data['no'] = 1;
		$data['komunitas'] = $this->Konten_compro_mod->get_id_nama_komunitas()->result();
		$this->load->view('compro/compro_komunitas', $data);
	}

	function compro_kom(){
		$this->session->set_userdata('id_compro_komunitas', $this->uri->rsegment(3));
		redirect('compro/komunitas','refresh');
	}


	function add_compro(){
		$id = "4".time();
		$this->session->set_userdata('id_compro', $id);
		redirect('tambah_compro','refresh');
	}

	function edit_compro(){
		$this->session->set_userdata('id_compro', $this->uri->rsegment(3));
		redirect('update_compro','refresh');
	}

	function delete_compro(){
		$this->session->set_userdata('id_compro', $this->uri->rsegment(3));
		redirect('compro_delete','refresh');
	}


	function tambah_compro(){

			if($this->session->userdata('id_compro') == NULL){
				redirect('not_found','refresh');
			}

			else {

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Compro', 'required|xss_clean');


				if ($this->form_validation->run() == FALSE) {
					$data['title'] = "Tambah Compro";
					$this->load->view('compro/add_compro', $data);
				} 
				else {

					$config['upload_path'] = 'assets/images/compro';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					
					if ( !$this->upload->do_upload('photo')){
						$this->session->set_userdata('msg', $this->upload->display_errors());
						redirect(base_url().'tambah_compro/' ,'refresh');
						// echo $this->upload->display_errors();
					}
					else {
						$this->session->set_userdata('photo', $this->upload->data()['file_name']);
						$this->Konten_compro_mod->add_compro();
						redirect(base_url().'lihat_compro/'.$this->session->userdata('id_compro'),'refresh');
						// echo "success";
					}
				}

		}
			
	}


	function compro_edit(){
		if($this->session->userdata('id_compro') == NULL){
				redirect('not_found','refresh');
			}

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Compro', 'required|xss_clean');


				$result = $this->Konten_compro_mod->get_compro_by_id()->num_rows();
					
					if($result > 0) {
						if ($this->form_validation->run() == FALSE) {
							$data['compro'] = $this->Konten_compro_mod->get_compro_by_id()->row_array();
							$data['title'] = "Edit Compro";
							$this->load->view('compro/edit_compro', $data);
						}
						else {
							$this->session->set_flashdata('msg', 'Compro berhasil diupdate');
							$this->Konten_compro_mod->edit_compro();
							redirect(base_url().'update_compro','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}

				
		}


	function edit_foto_compro(){
					$config['upload_path'] = 'assets/images/compro';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);

					$result = $this->Konten_compro_mod->get_compro_by_id()->num_rows();

					if($result > 0){
						if ( !$this->upload->do_upload('photo')){
							$this->session->set_flashdata('msg', $this->upload->display_errors());
							redirect(base_url().'update_compro/' ,'refresh');
						}
						else {
							if($this->Konten_compro_mod->get_compro_by_id()->row_array()['link_gambar'] != NULL){
							unlink(FCPATH."assets/images/compro/".$this->Konten_compro_mod->get_compro_by_id()->row_array()['link_gambar']);
						}
							$this->session->set_userdata('photo', $this->upload->data()['file_name']);
							$this->session->set_flashdata('msg', 'Compro berhasil diupdate');
							$this->Konten_compro_mod->edit_foto_compro();
							redirect(base_url().'update_compro','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}
	}


	function compro_delete(){
		$result = $this->Konten_compro_mod->get_compro_by_id()->num_rows();

		if($result > 0){
			unlink(FCPATH."assets/images/compro/".$this->Konten_compro_mod->get_compro_by_id()->row_array()['link_gambar']);
			$this->Konten_compro_mod->delete_compro();
			$this->session->set_flashdata('msg', 'Compro berhasil dihapus');
			$this->Konten_compro_mod->edit_foto_compro();

				if($this->session->userdata('level_data_compro') == "admin"){
					redirect(base_url().'compro/admin','refresh');
				}
				else if($this->session->userdata('level_data_compro') == "koperasi"){
					redirect(base_url().'compro/koperasi','refresh');
				}
				else if($this->session->userdata('level_data_compro') == "komunitas"){
					redirect(base_url().'compro/komunitas','refresh');
				}
		}

		else {
						redirect('not_found','refresh');
					}
	}

	function compro_lihat(){
		$this->session->set_userdata('id_compro', $this->uri->rsegment(3));
		redirect('compro','refresh');
	}

	function lihat_compro(){
		$result = $this->Konten_compro_mod->get_compro_by_id()->num_rows();

		if($result > 0) {
			$data['title'] = "Lihat Compro";
			$data['compro'] = $this->Konten_compro_mod->get_compro_by_id()->row_array();
			$this->load->view('compro/lihat_compro', $data);
		}
		else {
			redirect('not_found','refresh');
		}
	}

}

/* End of file Compro.php */
/* Location: ./application/controllers/Compro.php */