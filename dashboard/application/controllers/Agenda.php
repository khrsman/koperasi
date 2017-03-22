<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->model('Konten_agenda_mod');
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		
	}

	function agenda_data()
	{
		if($this->session->userdata('id_agenda') != NULL){
			$this->session->unset_userdata('id_agenda');
		}

		if($this->uri->rsegment(3) == "admin"){
			$this->session->set_userdata('level_data_agenda', "admin");
			$data['level_data_agenda'] = "1";
			$data['agenda'] = $this->Konten_agenda_mod->get_all_agenda_admin()->result();
			$data['no'] = 1;
			$data['title'] = "Data Agenda Admin";
			$this->load->view('agenda/agenda_data', $data);
		}
		else if($this->uri->rsegment(3) == "koperasi"){
			$this->session->set_userdata('level_data_agenda', "koperasi");
			$data['agenda'] = $this->Konten_agenda_mod->get_all_agenda_koperasi()->result();
			$data['level_data_agenda'] = "2";

			$data['no'] = 1;
			$data['title'] = "Data Agenda koperasi";
			$this->load->view('agenda/agenda_data', $data);
		}
		else if($this->uri->rsegment(3) == "komunitas"){
			$data['level_data_agenda'] = "4";
			$this->session->set_userdata('level_data_agenda', "komunitas");
			$data['agenda'] = $this->Konten_agenda_mod->get_all_agenda_komunitas()->result();
			$data['no'] = 1;
			$data['title'] = "Data Agenda Komunitas";
			$this->load->view('agenda/agenda_data', $data);
		}
		else {
			redirect(base_url().'not_found','refresh');
		}

	}

	function agenda_koperasi(){
		$data['title'] = "Berita Koperasi";
		$data['no'] = 1;
		$data['koperasi'] = $this->Konten_agenda_mod->get_id_nama_koperasi()->result();
		$this->load->view('agenda/agenda_koperasi', $data);
	}

	function agenda_kop(){
		$this->session->set_userdata('id_agenda_koperasi', $this->uri->rsegment(3));
		redirect('agenda/koperasi','refresh');
	}

	function agenda_komunitas(){
		$data['title'] = "Berita Komunitas";
		$data['no'] = 1;
		$data['komunitas'] = $this->Konten_agenda_mod->get_id_nama_komunitas()->result();
		$this->load->view('agenda/agenda_komunitas', $data);
	}

	function agenda_kom(){
		$this->session->set_userdata('id_agenda_komunitas', $this->uri->rsegment(3));
		redirect('agenda/komunitas','refresh');
	}


	function add_agenda(){
		$id = "5".time();
		$this->session->set_userdata('id_agenda', $id);
		redirect('tambah_agenda','refresh');
	}

	function edit_agenda(){
		$this->session->set_userdata('id_agenda', $this->uri->rsegment(3));
		redirect('update_agenda','refresh');
	}

	function delete_agenda(){
		$this->session->set_userdata('id_agenda', $this->uri->rsegment(3));
		redirect('agenda_delete','refresh');
	}


	function tambah_agenda(){

			if($this->session->userdata('id_agenda') == NULL){
				redirect('not_found','refresh');
			}

			else {

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Agenda', 'required|xss_clean');


				if ($this->form_validation->run() == FALSE) {
					$data['title'] = "Tambah Agenda";
					$this->load->view('agenda/add_agenda', $data);
				} 
				else {

					$config['upload_path'] = 'assets/images/agenda';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					
					if ( !$this->upload->do_upload('photo')){
						$this->session->set_userdata('msg', $this->upload->display_errors());
						redirect(base_url().'tambah_agenda/' ,'refresh');
						// echo $this->upload->display_errors();
					}
					else {
						$this->session->set_userdata('photo', $this->upload->data()['file_name']);
						$this->Konten_agenda_mod->add_agenda();
						redirect(base_url().'lihat_agenda/'.$this->session->userdata('id_agenda'),'refresh');
						// echo "success";
					}
				}

		}
			
	}


	function agenda_edit(){
		if($this->session->userdata('id_agenda') == NULL){
				redirect('not_found','refresh');
			}

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Agenda', 'required|xss_clean');


				$result = $this->Konten_agenda_mod->get_agenda_by_id()->num_rows();
					
					if($result > 0) {
						if ($this->form_validation->run() == FALSE) {
							$data['agenda'] = $this->Konten_agenda_mod->get_agenda_by_id()->row_array();
							$data['title'] = "Edit Agenda";
							$this->load->view('agenda/edit_agenda', $data);
						}
						else {
							$this->session->set_flashdata('msg', 'Agenda berhasil diupdate');
							$this->Konten_agenda_mod->edit_agenda();
							redirect(base_url().'update_agenda','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}

				
		}


	function edit_foto_agenda(){
					$config['upload_path'] = 'assets/images/agenda';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);

					$result = $this->Konten_agenda_mod->get_agenda_by_id()->num_rows();

					if($result > 0){
						if ( !$this->upload->do_upload('photo')){
							$this->session->set_flashdata('msg', $this->upload->display_errors());
							redirect(base_url().'update_agenda/' ,'refresh');
						}
						else {
							if($this->Konten_agenda_mod->get_agenda_by_id()->row_array()['link_gambar'] != NULL){
							unlink(FCPATH."assets/images/agenda/".$this->Konten_agenda_mod->get_agenda_by_id()->row_array()['link_gambar']);
						}
							$this->session->set_userdata('photo', $this->upload->data()['file_name']);
							$this->session->set_flashdata('msg', 'Agenda berhasil diupdate');
							$this->Konten_agenda_mod->edit_foto_agenda();
							redirect(base_url().'update_agenda','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}
	}


	function agenda_delete(){
		$result = $this->Konten_agenda_mod->get_agenda_by_id()->num_rows();

		if($result > 0){
			unlink(FCPATH."assets/images/agenda/".$this->Konten_agenda_mod->get_agenda_by_id()->row_array()['link_gambar']);
			$this->Konten_agenda_mod->delete_agenda();
			$this->session->set_flashdata('msg', 'Agenda berhasil dihapus');

				if($this->session->userdata('level_data_agenda') == "admin"){
					redirect(base_url().'agenda/admin','refresh');
				}
				else if($this->session->userdata('level_data_agenda') == "koperasi"){
					redirect(base_url().'agenda/koperasi','refresh');
				}
				else if($this->session->userdata('level_data_agenda') == "komunitas"){
					redirect(base_url().'agenda/komunitas','refresh');
				}
		}

		else {
						redirect('not_found','refresh');
					}
	}

	function agenda_lihat(){
		$this->session->set_userdata('id_agenda', $this->uri->rsegment(3));
		redirect('agenda_detail','refresh');
	}

	function lihat_agenda(){
		$result = $this->Konten_agenda_mod->get_agenda_by_id()->num_rows();

		if($result > 0) {
			$data['title'] = "Lihat Agenda";
			$data['agenda'] = $this->Konten_agenda_mod->get_agenda_by_id()->row_array();
			$this->load->view('agenda/lihat_agenda', $data);
		}
		else {
			redirect('not_found','refresh');
		}
	}

}

/* End of file Agenda.php */
/* Location: ./application/controllers/Agenda.php */