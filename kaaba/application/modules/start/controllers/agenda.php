<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class agenda extends CI_Controller {

	function check_log_in(){
		if($this->session->userdata('level')==NULL){
                        redirect('home');
		}
	}
	
	
	// BACK END PRIVILAGES
	
	function index(){
		//echo $this->m_agenda->sys_get_all_news_1()->num_rows();
		$this->check_log_in();
		$data['a_page']	 	= "a_agenda_manage";
		$data['a_top_menu']	= "a_top_menu";
		$data['header']	 	= "a_header_adminpage";
		//$data['jumlah_datang'] = $this->m_agenda->jumlah_hadir($id);
		$data['all_news']= $this->m_agenda->get_all_agenda_att();
		$data['total'] = $this->m_agenda->num_messages();
		$this->load->vars($data);
		$this->load->view("a_generik");
	}

	function magenda(){
		$this->check_log_in();
		$data['a_page']	 	= "a_agenda_manage";
		$data['a_top_menu']	= "a_top_menu";
		$data['header']	 	= "a_header_adminpage";
		$data['all_news']= $this->m_agenda->get_all_agenda_att();
		$data['total'] = $this->m_agenda->num_messages();
		$this->load->vars($data);
		$this->load->view("a_generik");	
	}

	function myagenda(){
		$this->check_log_in();
		$data['a_page']	 	= "a_agenda_my";
		$data['a_top_menu']	= "a_top_menu";
		$data['header']	 	= "a_header_adminpage";
		$data['all_news']= $this->m_agenda->get_all_agenda_a();
		$data['total'] = $this->m_agenda->num_messages();
		$this->load->vars($data);
		$this->load->view("a_generik");		
	}

	function lihat_agenda($id){
		$this->check_log_in();
			$data['edit_news']	= $this->m_agenda->sys_get_one_news($id);
			if($data['edit_news']->num_rows() > 0){
				$data['a_page']	 	= "a_agenda_lihat";
				$data['cek'] = $this->m_agenda->cek_hadir($id,$this->session->userdata('username'));
				$data['attend'] = $this->m_agenda->attend($id);

				$data['pages'] = $id;
				$data['a_top_menu']	= "a_top_menu";
				$data['header']	 	= "a_header_adminpage";
				$data['edit_news']	= $data['edit_news']->row();
				$this->load->vars($data);
				$this->load->view("a_generik");	
			}
			else{
				redirect('agenda/magenda');
			}
	}

	function detail_agenda($id){
		$this->check_log_in();
			$data['edit_news']	= $this->m_agenda->sys_get_one_news($id);
			if($data['edit_news']->num_rows() > 0){
				$data['a_page']	 	= "a_agenda_lihat_detail";
				$data['cek'] = $this->m_agenda->cek_hadir($id,$this->session->userdata('username'));
				$data['attend'] = $this->m_agenda->attend($id);
				$data['batal'] = $this->m_agenda->batal($id);
				$data['pages'] = $id;
				$data['a_top_menu']	= "a_top_menu";
				$data['header']	 	= "a_header_adminpage";
				$data['edit_news']	= $data['edit_news']->row();
				$this->load->vars($data);
				$this->load->view("a_generik");	
			}
			else{
				redirect('agenda/magenda');
			}
	}

	function hadir($id){
		
		$cek	= $this->m_agenda->cek_hadir($id,$this->session->userdata('username'));
		if($cek->num_rows() > 0){
			$input = array(
				'status'		=> 'T',
			);
			$this->m_agenda->update_hadir($input,$id,$this->session->userdata('username'));
		}
		else{
			$input = array(
				'id_agenda'		=> $id,
				'reg_user_username'		=> $this->session->userdata('username'),
				'status'		=> 'T',
			);
			$this->m_agenda->insert_hadir($input);
		}

		$this->session->set_flashdata('msg', 'SUCCESS !, > Anda menghadiri agenda yang dijadwalkan.');
		redirect('agenda/lihat_agenda/'.$id);
	}

	function batal($id){
		
		$cek	= $this->m_agenda->cek_hadir($id,$this->session->userdata('username'));
		if($cek->num_rows() > 0){
			$input = array(
				'status'		=> 'F',
			);
			$this->m_agenda->update_hadir($input,$id,$this->session->userdata('username'));
		}
		else{
			$input = array(
				'id_agenda'		=> $id,
				'reg_user_username'		=> $this->session->userdata('username'),
				'status'		=> 'F',
			);
			$this->m_agenda->insert_hadir($input);
		}

		$this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>SUCCESS !, > Anda tidak menghadiri agenda yang dijadwalkan.');
		redirect('agenda/lihat_agenda/'.$id);
	}
	
	
	
	
	function add_agenda(){
		$this->check_log_in();
			$data['a_page']	 	= "a_agenda_add";
			$data['a_top_menu']	= "a_top_menu";
			$data['header']	 	= "a_header_adminpage";
			$this->load->vars($data);
			$this->load->view("a_generik");
	
	}

	function insert_agenda(){
		$input = array(
				'judul_agenda'		=> $this->input->post('judul_dok'),
				'isi_agenda'		=> $this->input->post('elm3'),
				'judul_agenda_en'		=> $this->input->post('judul_dok_en'),
				'isi_agenda_en'		=> $this->input->post('elm3_en'),
				'tgl_dibuat'		=> date('Y-m-d h:i:s'),
				'tgl_mulai'		=> $this->input->post('tgl_dimulai'),
				'tgl_selesai'	=> $this->input->post('tgl_selesai'),
				'jam_mulai'		=> $this->input->post('jam_mulai'),
				'jam_selesai'		=>$this->input->post('jam_selesai'),
				'reg_user_username'		=> $this->session->userdata('username')
			);
			$this->m_agenda->do_upload($input);
			$this->session->set_flashdata('msg', 'SUCCESS !,  agenda has been created');
			redirect('agenda');
	}
	
	function edit_agenda($id){
			$this->check_log_in();
			$data['edit_news']	= $this->m_agenda->sys_get_one_news($id);
			if($data['edit_news']->num_rows() > 0){
				$data['a_page']	 	= "a_agenda_edit";
				$data['pages'] = $id;
				$data['a_top_menu']	= "a_top_menu";
				$data['header']	 	= "a_header_adminpage";
				$data['edit_news']	= $data['edit_news']->row();
				$this->load->vars($data);
				$this->load->view("a_generik");	
			}
			else{
				redirect('agenda');
			}
			
	}
	
	function edit_agenda_proses($id){
		$this->check_log_in();
			$input = array(
				'judul_agenda'		=> $this->input->post('judul_dok'),
				'isi_agenda'		=> $this->input->post('elm3'),
					'judul_agenda_en'		=> $this->input->post('judul_dok_en'),
				'isi_agenda_en'		=> $this->input->post('elm3_en'),
				'tgl_mulai'		=> $this->input->post('tgl_dimulai'),
				'tgl_selesai'	=> $this->input->post('tgl_selesai'),
				'jam_mulai'		=> $this->input->post('jam_mulai'),
				'jam_selesai'		=>$this->input->post('jam_selesai'),
				'reg_user_username'		=> $this->session->userdata('username')
			);
			$hasil = $this->m_agenda->do_upload_edit($input,$this->input->post('id_news'));
			$pages = $this->input->post('pages');
			$this->session->set_flashdata('msg', 'SUCCESS !, agenda has been updated');
			redirect('agenda/edit_agenda/'.$this->input->post('id_news'));
			
	}
	
	function delete_agenda($id){
		$this->check_log_in();
		$pages = $this->input->post('page');
		$this->session->set_flashdata('msg', 'SUCCESS !, agenda has been deleted');
		$this->m_agenda->delete_news($id);
		redirect('agenda');
	}
	
	
	
	
}

