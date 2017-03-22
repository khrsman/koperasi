<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Konten_event_mod');
		if(empty($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		
	}

	function event_data()
	{
		if($this->session->userdata('id_event') != NULL){
			$this->session->unset_userdata('id_event');
		}

		if($this->uri->rsegment(3) == "admin"){
			$this->session->set_userdata('level_data_event', "admin");
			$data['level_data_event'] = "1";
			$data['event'] = $this->Konten_event_mod->get_all_event_admin()->result();
			$data['no'] = 1;
			$data['title'] = "Data Event Admin";
			$this->load->view('event/event_data', $data);
		}
		else if($this->uri->rsegment(3) == "koperasi"){
			$this->session->set_userdata('level_data_event', "koperasi");
			$data['event'] = $this->Konten_event_mod->get_all_event_koperasi()->result();
			$data['level_data_event'] = "2";

			$data['no'] = 1;
			$data['title'] = "Data Event koperasi";
			$this->load->view('event/event_data', $data);
		}
		else if($this->uri->rsegment(3) == "komunitas"){
			$data['level_data_event'] = "4";
			$this->session->set_userdata('level_data_event', "komunitas");
			$data['event'] = $this->Konten_event_mod->get_all_event_komunitas()->result();
			$data['no'] = 1;
			$data['title'] = "Data Event Komunitas";
			$this->load->view('event/event_data', $data);
		}
		else {
			redirect(base_url().'not_found','refresh');
		}

	}

	function event_koperasi(){
		$data['title'] = "Berita Koperasi";
		$data['no'] = 1;
		$data['koperasi'] = $this->Konten_event_mod->get_id_nama_koperasi()->result();
		$this->load->view('event/event_koperasi', $data);
	}

	function event_kop(){
		$this->session->set_userdata('id_event_koperasi', $this->uri->rsegment(3));
		redirect('event/koperasi','refresh');
	}

	function event_komunitas(){
		$data['title'] = "Berita Komunitas";
		$data['no'] = 1;
		$data['komunitas'] = $this->Konten_event_mod->get_id_nama_komunitas()->result();
		$this->load->view('event/event_komunitas', $data);
	}

	function event_kom(){
		$this->session->set_userdata('id_event_komunitas', $this->uri->rsegment(3));
		redirect('event/komunitas','refresh');
	}


	function add_event(){
		$id = "5".time();
		$this->session->set_userdata('id_event', $id);
		redirect('tambah_event','refresh');
	}

	function edit_event(){
		$this->session->set_userdata('id_event', $this->uri->rsegment(3));
		redirect('update_event','refresh');
	}

	function delete_event(){
		$this->session->set_userdata('id_event', $this->uri->rsegment(3));
		redirect('event_delete','refresh');
	}


	function tambah_event(){

			if($this->session->userdata('id_event') == NULL){
				redirect('not_found','refresh');
			}

			else {

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Event', 'required|xss_clean');


				if ($this->form_validation->run() == FALSE) {
					$data['title'] = "Tambah Event";
					$this->load->view('event/add_event', $data);
				} 
				else {

					$config['upload_path'] = 'assets/images/event';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					
					if ( !$this->upload->do_upload('photo')){
						$this->session->set_userdata('msg', $this->upload->display_errors());
						redirect(base_url().'tambah_event/' ,'refresh');
						// echo $this->upload->display_errors();
					}
					else {
						$this->session->set_userdata('photo', $this->upload->data()['file_name']);
						$this->Konten_event_mod->add_event();
						redirect(base_url().'lihat_event/'.$this->session->userdata('id_event'),'refresh');
						// echo "success";
					}
				}

		}
			
	}


	function event_edit(){
		if($this->session->userdata('id_event') == NULL){
				redirect('not_found','refresh');
			}

				$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
				$this->form_validation->set_rules('isi', 'Isi Event', 'required|xss_clean');


				$result = $this->Konten_event_mod->get_event_by_id()->num_rows();
					
					if($result > 0) {
						if ($this->form_validation->run() == FALSE) {
							$data['event'] = $this->Konten_event_mod->get_event_by_id()->row_array();
							$data['title'] = "Edit Event";
							$this->load->view('event/edit_event', $data);
						}
						else {
							$this->session->set_flashdata('msg', 'Event berhasil diupdate');
							$this->Konten_event_mod->edit_event();
							redirect(base_url().'update_event','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}

				
		}


	function edit_foto_event(){
					$config['upload_path'] = 'assets/images/event';
					$config['allowed_types'] = 'jpg|png';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);

					$result = $this->Konten_event_mod->get_event_by_id()->num_rows();

					if($result > 0){
						if ( !$this->upload->do_upload('photo')){
							$this->session->set_flashdata('msg', $this->upload->display_errors());
							redirect(base_url().'update_event/' ,'refresh');
						}
						else {
							if($this->Konten_event_mod->get_event_by_id()->row_array()['link_gambar'] != NULL){
							unlink(FCPATH."assets/images/event/".$this->Konten_event_mod->get_event_by_id()->row_array()['link_gambar']);
						}
							$this->session->set_userdata('photo', $this->upload->data()['file_name']);
							$this->session->set_flashdata('msg', 'Event berhasil diupdate');
							$this->Konten_event_mod->edit_foto_event();
							redirect(base_url().'update_event','refresh');
						}
					}
					else {
						redirect('not_found','refresh');
					}
	}


	function event_delete(){
		$result = $this->Konten_event_mod->get_event_by_id()->num_rows();

		if($result > 0){
			unlink(FCPATH."assets/images/event/".$this->Konten_event_mod->get_event_by_id()->row_array()['link_gambar']);
			$this->Konten_event_mod->delete_event();
			$this->session->set_flashdata('msg', 'Event berhasil dihapus');
			$this->Konten_event_mod->edit_foto_event();

				if($this->session->userdata('level_data_event') == "admin"){
					redirect(base_url().'event/admin','refresh');
				}
				else if($this->session->userdata('level_data_event') == "koperasi"){
					redirect(base_url().'event/koperasi','refresh');
				}
				else if($this->session->userdata('level_data_event') == "komunitas"){
					redirect(base_url().'event/komunitas','refresh');
				}
		}

		else {
						redirect('not_found','refresh');
			}
	}

	function event_lihat(){
		$this->session->set_userdata('id_event', $this->uri->rsegment(3));
		redirect('event_detail','refresh');
	}

	function lihat_event(){
		$result = $this->Konten_event_mod->get_event_by_id()->num_rows();

		if($result > 0) {
			$data['title'] = "Lihat Event";
			$data['event'] = $this->Konten_event_mod->get_event_by_id()->row_array();
			$this->load->view('event/lihat_event', $data);
		}
		else {
			redirect('not_found','refresh');
		}
	}

}

/* End of file Event.php */
/* Location: ./application/controllers/Event.php */