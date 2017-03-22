<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datacell extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  if (empty($this->session->userdata('id_user'))) {
            redirect(SMIDUMAY, 'refresh');
        }
		$this->load->model('datacell_mod');
		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}

	function datacell_data()
	{
		$data['title'] = "Data Datacell";
		$data['datacell'] = $this->datacell_mod->get_all_datacell()->result();
		$data['no'] = 1;
		$this->load->view('datacell/datacell_data', $data);

	}

	function edit_datacell(){
		$this->session->set_userdata('datacell_id', $this->uri->rsegment(3));
		redirect('update_datacell','refresh');
	}

	function update_datacell(){



		$this->form_validation->set_rules('harga_gerai', 'Harga Gerai', 'required|min_length[4]|max_length[6]|numeric');

		 if ($this->form_validation->run() == FALSE) {
		 	$data['title'] = "Edit Data Datacell";
 			$data['datacell'] = $this->datacell_mod->get_datacell_by_id($this->session->userdata('datacell_id'))->row_array();
 			$this->load->view('datacell/update_datacell', $data);

		 } else {
 			$this->datacell_mod->update_datacell($this->session->userdata('datacell_id'));
 			$this->session->set_flashdata('msg', "Data datacell berhasil diubah");
 			redirect(base_url().'datacell','refresh');
		 }
	}

}

/* End of file Datacell.php */
/* Location: ./application/controllers/Datacell.php */