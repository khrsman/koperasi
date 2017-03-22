<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata('id_user'))) {
            redirect(SMIDUMAY , 'refresh');
        }
        if($this->session->userdata('level') != "1"){
            redirect(base_url().'home','refresh');
        }
        $this->load->model('admin_mod');
        $this->load->helper('form');
        $this->load->helper('query_string_helper');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
    }

    function admin_data(){
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
        // print_r($param_query);
        
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
        $datadb = $this->admin_mod->get_all_admin($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        $data ['no'] = 1;
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['title']          = 'Data Admin';
        $data['is_content_header']  = TRUE;

        
        $this->load->view('user/admin_data',$data);
    }

    function add_admin()
    {
        $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
        $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean|callback_cek_email');
        $this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean|alpha_numeric|callback_cek_username');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Admin";
            $this->load->view('user/add_admin', $data);
        } else {
            $this->admin_mod->insert_admin();
            $this->session->set_flashdata('msg', 'Data Admin berhasil ditambahkan');
            redirect(base_url() . 'admin', 'refresh');
        }
    }

    public function edit_admin()
    {
        $this->session->set_userdata('id', $this->uri->rsegment(3));
        redirect(base_url() . 'admin_edit', 'refresh');
    }


    function edit_basic_profile(){

                $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
                $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
                $this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
                $this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    redirect(base_url().'admin_edit','refresh');
                } else {
                    $this->admin_mod->update_basic($this->session->userdata('id'));
                    $this->session->set_flashdata('msg','Profil berhasil diubah');
                    redirect(base_url().'admin','refresh');
                }
    }


    function update_contact(){
                $this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
                $this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');


                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    redirect(base_url().'admin_edit','refresh');
                } else {
                    $this->admin_mod->update_contact($this->session->userdata('id'));
                    $this->session->set_flashdata('msg','Kontak berhasil diubah');
                    redirect(base_url().'admin','refresh');
                }
    }



    public function update_Admin()
    {

        if ($this->admin_mod->get_admin_by_id($this->session->userdata('id'))->num_rows() > 0) {
            $data['user'] = $this->admin_mod->get_admin_by_id($this->session->userdata('id'))->row_array();
            $data['title'] = "Edit Admin";
            $this->load->view('user/edit_admin', $data);
        } else {
            redirect(base_url() . 'not_found', 'refresh');
        }
    } 

    public function delete_admin()
    {
        $this->session->set_userdata('id', $this->uri->rsegment(3));
        // redirect(base_url() . 'admin_delete', 'refresh');

    }

    public function admin_delete()
    {
        if ($this->admin_mod->get_admin_by_id($this->session->userdata('id'))->num_rows() > 0) {
            $this->admin_mod->delete_admin();
            $this->session->set_flashdata('msg', 'Data Admin berhasil dihapus');
            redirect(base_url() . 'admin', 'refresh');
        } else {
            redirect(base_url() . 'not_found', 'refresh');
        }
    }

    public function cek_Username($username)
    {

        $username = $this->input->post('username');

        $result = $this->admin_mod->cek_username($username);

        if (!$result) {
            $this->form_validation->set_message('cek_username', 'Username sudah terdaftar');
            return false;
        } else {
            return true;
        }

    }

    function cek_email($email){

        $email = $this->input->post('email');

        $result = $this->admin_mod->cek_email($email);


        if(!$result){
            $this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
            return FALSE;
        }
        else{
            return TRUE;
        }

    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
