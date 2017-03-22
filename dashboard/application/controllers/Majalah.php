<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Majalah extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Majalah_mod');
        if (empty($this->session->userdata('id_user'))) {
            redirect(SMIDUMAY, 'refresh');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
        
    }
    
    function majalah_data()
    {
        if ($this->session->userdata('id_majalah') != NULL) {
            $this->session->unset_userdata('id_majalah');
        }
        
        if ($this->uri->rsegment(3) == "admin") {
            $this->session->set_userdata('level_data_majalah', "admin");
            $data['level_data_majalah'] = "1";
            $data['majalah']            = $this->Majalah_mod->get_all_majalah_admin()->result();
            $data['no']                 = 1;
            $data['title']              = "Data Majalah Admin";
            $this->load->view('majalah/majalah_data', $data);
        } else if ($this->uri->rsegment(3) == "koperasi") {
            $this->session->set_userdata('level_data_majalah', "koperasi");
            $data['majalah']            = $this->Majalah_mod->get_all_majalah_koperasi()->result();
            $data['level_data_majalah'] = "2";
            
            $data['no']    = 1;
            $data['title'] = "Data Majalah koperasi";
            $this->load->view('majalah/majalah_data', $data);
        } else if ($this->uri->rsegment(3) == "komunitas") {
            $data['level_data_majalah'] = "4";
            $this->session->set_userdata('level_data_majalah', "komunitas");
            $data['majalah'] = $this->Majalah_mod->get_all_majalah_komunitas()->result();
            $data['no']      = 1;
            $data['title']   = "Data Majalah Komunitas";
            $this->load->view('majalah/majalah_data', $data);
        } else {
            redirect(base_url() . 'not_found', 'refresh');
        }
        
    }
    
    function majalah_koperasi()
    {
        $data['title']    = "Berita Koperasi";
        $data['no']       = 1;
        $data['koperasi'] = $this->Majalah_mod->get_id_nama_koperasi()->result();
        $this->load->view('majalah/majalah_koperasi', $data);
    }
    
    function majalah_kop()
    {
        $this->session->set_userdata('id_majalah_koperasi', $this->uri->rsegment(3));
        redirect('majalah/koperasi', 'refresh');
    }
    
    function majalah_komunitas()
    {
        $data['title']     = "Berita Komunitas";
        $data['no']        = 1;
        $data['komunitas'] = $this->Majalah_mod->get_id_nama_komunitas()->result();
        $this->load->view('majalah/majalah_komunitas', $data);
    }
    
    function majalah_kom()
    {
        $this->session->set_userdata('id_majalah_komunitas', $this->uri->rsegment(3));
        redirect('majalah/komunitas', 'refresh');
    }
    
    function add_majalah()
    {
        $id_majalah = "6" . time();
        $this->session->set_userdata('id_majalah', $id_majalah);
        redirect(base_url() . 'tambah_majalah', 'refresh');
    }
    
    function tambah_majalah()
    {
        if ($this->session->userdata('id_majalah') == NULL) {
            redirect('not_found', 'refresh');
        }
        
        else {
            
            $this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|xss_clean');

            
            
            if ($this->form_validation->run() == FALSE) {
                $data['title'] = "Tambah Majalah";
                $this->load->view('majalah/add_majalah', $data);
            } else {
                
                $config['upload_path']   = 'assets/images/majalah';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name']  = TRUE;
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('file')) {
                    $this->session->set_userdata('msg', $this->upload->display_errors());
                    redirect(base_url() . 'tambah_majalah/', 'refresh');
                    // echo $this->upload->display_errors();
                } else {
					$this->session->set_userdata('file', $this->upload->data()['file_name']);
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                    $this->Majalah_mod->add_majalah();
                    redirect(base_url() . 'lihat_majalah/' . $this->session->userdata('id_majalah'), 'refresh');
                    // echo "success";
                }
            }
        }
    }

    function delete_majalah(){
		$this->session->set_userdata('id_majalah', $this->uri->rsegment(3));
		redirect('majalah_delete','refresh');
	}

	function majalah_delete(){
		$result = $this->Majalah_mod->get_majalah_by_id()->num_rows();

		if($result > 0){
			unlink(FCPATH."assets/images/majalah/".$this->Majalah_mod->get_majalah_by_id()->row_array()['file_path']);

			$this->Majalah_mod->delete_majalah();
			$this->session->set_flashdata('msg', 'Majalah berhasil dihapus');

				if($this->session->userdata('level_data_majalah') == "admin"){
					redirect(base_url().'majalah/admin','refresh');
				}
				else if($this->session->userdata('level_data_majalah') == "koperasi"){
					redirect(base_url().'majalah/koperasi','refresh');
				}
				else if($this->session->userdata('level_data_majalah') == "komunitas"){
					redirect(base_url().'majalah/komunitas','refresh');
				}
		}

		else {
						redirect('not_found','refresh');
					}
	}

	function majalah_lihat(){
			$this->session->set_userdata('id_majalah', $this->uri->rsegment(3));
			redirect('majalah_detail','refresh');
		}

		function lihat_majalah(){
			$result = $this->Majalah_mod->get_majalah_by_id()->num_rows();

			if($result > 0) {
				$data['title'] = "Lihat Agenda";
				$data['majalah'] = $this->Majalah_mod->get_majalah_by_id()->row_array();
				$this->load->view('majalah/lihat_majalah', $data);
			}
			else {
				redirect('not_found','refresh');
			}
		}

    
}


/* End of file Majalah.php */
/* Location: ./application/controllers/Majalah.php */