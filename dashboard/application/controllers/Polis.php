<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polis extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('polis_mod');	
	}

	function data_polis(){	
		$data['title'] = "Data Polis";
		$data['no'] = 1;
        $data['page_sub_name']      = '';


        if($this->session->userdata('id_polis') != NULL and $this->session->userdata('id_polis') != ""){
            $this->session->unset_userdata('id_polis');
        }



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
                            'ref_polis.id_polis'     => $keyword,
                            'ref_polis.deskripsi'     => $keyword,
                        ),
                ),
            array(
                'alias'=>'Nama',
                'parameter'=> array
                        (   
                            'ref_polis.deskripsi'     => $keyword,
                        ),
                )
        );


        $sort = array(
            array(
                'alias'     =>'Nama',
                'parameter' =>'ref_polis.deskripsi',
                )
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


        $def_param_sort = 'ref_polis.id_polis';
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
        
        ///// END Setting Filter /////
 

        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = site_url('polis');
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
        $datadb = $this->polis_mod->get_all_polis($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        $data ['no'] = 1;
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['is_content_header']  = TRUE;

        
        $this->load->view('polis/polis_data',$data);
	}


	function edit_polis(){
		$this->session->set_userdata('id_polis', $this->uri->rsegment(3));
		redirect(base_url().'update_polis','refresh');

	}


    function update_logo_polis(){
            $polis = $this->polis_mod->get_polis_by_id($this->session->userdata('id_polis'));

            $config['upload_path'] = 'assets/images/user';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('logo_polis')){
                $this->session->set_flashdata('msg', $this->upload->display_errors());
                redirect(base_url().'update_polis/', 'refresh');
            }
            else{
                unlink(FCPATH."assets/images/user/".$polis->row_array()['logo']);
                $this->session->set_flashdata('msg', "Data Berhasil Diubah");
                $this->polis_mod->update_logo_polis($this->upload->data()['file_name'], $this->session->userdata('id_polis'));
                redirect(base_url().'polis','refresh');
            }
    }


	function update_polis(){

		if($this->session->userdata('id_polis') != NULL AND $this->session->userdata('id_polis') != ""){
				$polis = $this->polis_mod->get_polis_by_id($this->session->userdata('id_polis'));
				if($polis){
						$data['polis'] = $polis->row_array();
						$data['title'] = "Edit Polis";
						$this->load->view('polis/edit_polis', $data);
				}
				else{
					redirect(base_url().'not_found','refresh');
				}
		}
		else{
			redirect(base_url().'not_found','refresh');
		}
	}


    function edit_data_polis(){
        if($this->session->userdata('id_polis') != NULL AND $this->session->userdata('id_polis') != ""){
            $post = $this->input->post();

            if($post != NULL){
                $this->form_validation->set_rules('nama_polis', 'Nama Polis', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('msg', validation_errors());
                    redirect(base_url().'update_polis','refresh');
                } else {
                    $this->polis_mod->update_polis($this->session->userdata('id_polis'));
                    $this->session->set_flashdata('msg', "Data Berhasil Diubah");
                    redirect(base_url().'polis','refresh');
                }
            }
            else{
                redirect(base_url().'not_found','refresh');
            }

        }
        else{
            redirect(base_url().'not_found','refresh');
        }
    }

    function add_polis(){

        $this->form_validation->set_rules('nama_polis', 'Nama Polis', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Tambah Polis";
            $this->load->view('polis/add_polis', $data);
        } else {

            $config['upload_path'] = 'assets/images/user';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;



            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('photo')){
                $this->session->set_flashdata('msg', $this->upload->display_errors());
                redirect(base_url().'add_polis/', 'refresh');
            }
            else{
                $this->session->set_flashdata('msg', "Data Berhasil Ditambahkan");
                $this->polis_mod->add_polis($this->upload->data()['file_name']);
                redirect(base_url().'polis','refresh');
            }
            
        }

    }

    function delete_polis(){
        $this->session->set_userdata('id_polis', $this->uri->rsegment(3));
        redirect(base_url().'hapus_polis','refresh');
    }

    function hapus_polis(){
        if($this->session->userdata('id_polis') != NULL AND $this->session->userdata('id_polis') != ""){
                $polis = $this->polis_mod->get_polis_by_id($this->session->userdata('id_polis'));
                if($polis){
                    // unlink(FCPATH."assets/images/user/".$polis->row_array()['logo']);
                    $this->polis_mod->delete_polis($this->session->userdata('id_polis'));
                    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus');
                    redirect(base_url()."polis",'refresh');
                }
                else{
                    redirect(base_url().'not_found','refresh');
                }
            }
             else{
                redirect(base_url().'not_found','refresh');
            }
    }

     function get_polis(){
      $search = strip_tags(trim($this->input->get('q')));
      $query = $this->polis_mod->get_polis($search);

      if($query->num_rows() > 0){
        foreach ($query->result() as $r) {
            $data[] = array('id' => $r->id_polis,
                          'text' =>$r->deskripsi,
                          'logo' =>$r->logo );   
        }
      }
      else {
        $data[] = array('id' => '0',
                      'text'=>'Polis Tidak Ditemukan' );
      }
      echo json_encode($data);
    }

}

/* End of file Polis.php */
/* Location: ./application/controllers/Polis.php */