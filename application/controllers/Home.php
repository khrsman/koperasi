<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct(); //inherit dari parent



        
        $this->load->model('compro_model');
        $this->session->set_userdata('referred_from', current_url_full());

    }
    
    function index(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_view';
        $data['berita']      = $this->compro_model->get_berita();
        // var_dump($this->compro_model->get_logo_cover()->result());

        // die();
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array(
                'foto'          => "smi-logo.png", 
                'cover_foto'    => "" // <======== INI DIISI APA
                );
            $data['logo_cover'] = $cover;
        }
        $this->load->view('main_view',$data);
    }

    function feature(){
        $data['page_name']         = 'Feature';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_feature_view';
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }

    function aboutus(){
        $data['page_name']         = 'About Us';
        $data['page_sub_name']     = '';





        // var_dump($this->session->all_userdata());
        if($this->session->userdata('id_user') == NULL OR $this->session->userdata('id_user') == "" OR $this->session->userdata('level') == "1"){
            $data['page']          = 'compro/home_aboutus_view';
        }
        else {
            if($this->session->userdata('level') == "2" or $this->session->userdata('level') == "3"){
                $data['koperasi']      = $this->compro_model->aboutus()->row_array();
                $data['page']          = 'compro/home_aboutus_view_loggedin_koperasi';
            }
            else  {
                $data['komunitas']      = $this->compro_model->aboutus()->row_array();
                // var_dump($data['komunitas']);
                // die();
                // echo "KOMUNITAS : ".$this->session->userdata('komunitas');
                // var_dump($this->session->all_userdata());
                // die();
                $data['page']          = 'compro/home_aboutus_view_loggedin_komunitas';
            }
        }




        if($this->compro_model->get_logo_cover()){
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        else {
            $data['logo_cover']        = $this->compro_model->get_logo_cover();
            $data['source_logo']       = SRC_LOGO;
        }


        $this->load->view('main_view',$data);
    }

    function contact(){
        $data['page_name']         = 'Contact';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_contact_view';



        if($this->session->userdata('id_user') == NULL OR $this->session->userdata('id_user') == "" OR $this->session->userdata('level') == "1"){
            $data['page']          = 'compro/home_contact_view';
        }
        else 
        {
            if($this->session->userdata('level') == "2" or $this->session->userdata('level') == "3"){
                $data['koperasi']      = $this->compro_model->aboutus()->row_array();
                $data['page']          = 'compro/home_contact_view_loggedin_koperasi';
            }
            else  {
                $data['komunitas']      = $this->compro_model->aboutus()->row_array();
                $data['page']          = 'compro/home_contact_view_loggedin_komunitas';
            }
        }

        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }



    function services(){
        $data['page_name']         = 'Services';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_services_view';
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }

    function faq(){
        $data['page_name']         = 'Contact';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_faq_view';
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }


    function news(){
        $data['page_name']         = 'About Us';
        $data['page_sub_name']     = '';
        // $data['page']              = 'compro/home_news_view';


        if($this->session->userdata('id_user') == NULL OR $this->session->userdata('id_user') == "" OR $this->session->userdata('level') == "1"){
            $data['news']          = $this->compro_model->get_berita()->result();
            $data['event']         = $this->compro_model->get_event()->result();
            $data['page']          = 'compro/home_news_view';
        }
        else {
            if($this->session->userdata('level') == "2" or $this->session->userdata('level') == "3"){
                $data['koperasi']      = $this->compro_model->get_berita()->result();
                $data['event']         = $this->compro_model->get_event()->result();
                $data['page']          = 'compro/home_news_view_loggedin_koperasi';
            }
            else  {
                $data['komunitas']      = $this->compro_model->get_berita()->result();
                $data['event']          = $this->compro_model->get_event()->result();
                $data['page']           = 'compro/home_news_view_loggedin_komunitas';
            }
        }

        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }

    function partners(){
        $data['page_name']         = 'Partners';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_partners_view';
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }

    function news_detail(){
        $data['page_name']         = 'News';
        $data['page_sub_name']     = '';

        if($this->compro_model->get_berita_by_id($this->uri->rsegment(2))->num_rows() == 0){
            $data['berita'] = $this->compro_model->get_berita_by_id($this->uri->segment(2))->row_array();
            $data['page'] = 'compro/news_detail';
        }
        else {
            $data['page'] = 'compro/news_muktamar';

        }
        
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }

    function event_detail(){
        $data['page_name']         = 'Event';
        $data['page_sub_name']     = '';

        if($this->compro_model->get_event_by_id($this->uri->rsegment(2))->num_rows() == 0){
            $data['event'] = $this->compro_model->get_event_by_id($this->uri->segment(2))->row_array();
            $data['page'] = 'compro/event_detail';
        }
        else {
            $data['page'] = 'compro/news_muktamar';

        }
        
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }







    function agenda_home(){
        $data['page_name']         = 'Agenda';
        $data['page_sub_name']     = '';




        $data['agenda']            = $this->compro_model->get_agenda()->result();
        $data['page']              = 'compro/home_agenda_view';

        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }



    function agenda_detail(){
        $data['page_name']         = 'Event';
        $data['page_sub_name']     = '';

        if($this->compro_model->get_agenda_by_id($this->uri->rsegment(2))->num_rows() == 0){
            $data['agenda'] = $this->compro_model->get_agenda_by_id($this->uri->segment(2))->row_array();
            $data['page'] = 'compro/agenda_detail';
        }
        else {
            $data['page'] = 'compro/news_muktamar';
        }
        
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }







    function agenda(){
        $segment = $this->uri->segment(1);
        switch($segment){
            case 'agenda9':
            $data['page']              = 'compro/andes_9';
            break;
            case 'agenda10':
            $data['page']              = 'compro/andes_10';
            break;

            case 'agenda11':
            $data['page']              = 'compro/andes_11';
            break;

            case 'agenda13':
            $data['page']              = 'compro/andes_13';
            break;

            case 'agenda12':
            $data['page']              = 'compro/andes_12';
            break;
        }

        $data['page_name']         = 'Contact';
        $data['page_sub_name']     = '';
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);

    }


    function emag(){
        $data['page_name']         = 'E Magazine';
        $data['page_sub_name']     = '';


         if($this->session->userdata('id_user') == NULL OR $this->session->userdata('id_user') == "" OR $this->session->userdata('level') == "1"){
            $data['page']          = 'compro/andes_9';
        }
        else {
            $data['emag']            = $this->compro_model->get_emag()->result();
            $data['page']              = 'compro/home_emag_view';

        }


        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }

    function emag_detail(){
        $data['page_name']         = 'Majalah';
        $data['page_sub_name']     = '';

        if($this->compro_model->get_emag_by_id($this->uri->rsegment(2))->num_rows() == 0){
            $data['majalah'] = $this->compro_model->get_emag_by_id($this->uri->segment(2))->row_array();
            $data['page'] = 'compro/emag_detail';
        }
        else {
            $data['page'] = 'compro/news_muktamar';
        }
        
        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array('foto' => "smi-logo.png" );
            $data['logo_cover'] = $cover;
            $data['source_logo'] = base_url()."assets/compro/";
        }
        $data['source_logo']       = SRC_LOGO;
        $this->load->view('main_view',$data);
    }





    function list_kom(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_kom_view';
        $data['komunitas']         = $this->compro_model->get_all_komunitas();
      
        $this->load->view('main_view',$data);
    }

    function list_kop_jenis(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_kop_view';
        $data['koperasi']         = $this->compro_model->get_all_koperasi_group($this->uri->segment(2));
        $data['jenis_kop']         = $this->compro_model->get_all_jenis_koperasi();
      
        $this->load->view('main_view',$data);
    }

    function detail_koperasi(){
         $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_kop_detail_view';
        $data['koperasi']         = $this->compro_model->get_all_koperasi_detail($this->uri->segment(2));
        $data['jenis_kop']         = $this->compro_model->get_all_jenis_koperasi();
      
        $this->load->view('main_view',$data);
    }

    function list_kop(){
        $data['page_name']         = 'Beranda';
        $data['page_sub_name']     = '';
        $data['page']              = 'compro/home_kop_view';
        $data['koperasi']         = $this->compro_model->get_all_koperasi();
      
        $this->load->view('main_view',$data);
    }

    function view_kop_berita(){
        $this->load->helper('text');
        $this->compro_model->id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2) : null;
        $koperasi_res = $this->compro_model->get_koperasi_profile();
        if($koperasi_res->num_rows() > 0){
            $data['page_name']         = 'Beranda';
            $data['page_sub_name']     = '';
            $data['page']              = 'compro/home_kop_view_berita';
            $data['koperasi']         = $koperasi_res->row();
          
            $this->load->view('main_view',$data);
        } else {
            echo "404 Not Found";
        }
    }

    function view_kop_berita_detail(){
        $this->load->helper('text');
        $this->compro_model->id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2) : null;
        $koperasi_res = $this->compro_model->get_koperasi_profile();
        $this->compro_model->news_id = $this->uri->segment(5) ? $this->uri->segment(5) : null;
        $content_res = $this->compro_model->get_news();
        if($koperasi_res->num_rows() > 0){
            $data['page_name']         = 'Beranda';
            $data['page_sub_name']     = '';
            $data['page']              = 'compro/home_kop_view_berita_detail';
            $data['content'] = $content_res;
            $data['koperasi']         = $koperasi_res->row();
          
            $this->load->view('main_view',$data);
        } else {
            echo "404 Not Found";
        }
    }

    function view_kop_agenda(){
        $this->load->helper('text');
        $this->compro_model->id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2) : null;
        $koperasi_res = $this->compro_model->get_koperasi_profile();
        if($koperasi_res->num_rows() > 0){
            $data['page_name']         = 'Beranda';
            $data['page_sub_name']     = '';
            $data['page']              = 'compro/home_kop_view_agenda';
            $data['koperasi']         = $koperasi_res->row();
          
            $this->load->view('main_view',$data);
        } else {
            echo "404 Not Found";
        }
    }

    function view_kop_agenda_detail(){
        $this->load->helper('text');
        $this->compro_model->id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2) : null;
        $koperasi_res = $this->compro_model->get_koperasi_profile();
        $this->compro_model->agenda_id = $this->uri->segment(5) ? $this->uri->segment(5) : null;
        $content_res = $this->compro_model->get_agendas();
        if($koperasi_res->num_rows() > 0){
            $data['page_name']         = 'Beranda';
            $data['page_sub_name']     = '';
            $data['page']              = 'compro/home_kop_view_agenda_detail';
            $data['content'] = $content_res;
            $data['koperasi']         = $koperasi_res->row();
          
            $this->load->view('main_view',$data);
        } else {
            echo "404 Not Found";
        }
    }

    function view_kop_event(){
        $this->load->helper('text');
        $this->compro_model->id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2) : null;
        $koperasi_res = $this->compro_model->get_koperasi_profile();
        if($koperasi_res->num_rows() > 0){
            $data['page_name']         = 'Beranda';
            $data['page_sub_name']     = '';
            $data['page']              = 'compro/home_kop_view_event';
            $data['koperasi']         = $koperasi_res->row();
          
            $this->load->view('main_view',$data);
        } else {
            echo "404 Not Found";
        }
    }

    function view_kop_event_detail(){
        $this->load->helper('text');
        $this->compro_model->id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2) : null;
        $koperasi_res = $this->compro_model->get_koperasi_profile();
        $this->compro_model->event_id = $this->uri->segment(5) ? $this->uri->segment(5) : null;
        $content_res = $this->compro_model->get_events();
        if($koperasi_res->num_rows() > 0){
            $data['page_name']         = 'Beranda';
            $data['page_sub_name']     = '';
            $data['page']              = 'compro/home_kop_view_event_detail';
            $data['content'] = $content_res;
            $data['koperasi']         = $koperasi_res->row();
          
            $this->load->view('main_view',$data);
        } else {
            echo "404 Not Found";
        }
    }

    function view_kop_info(){
        $this->load->helper('text');
        $this->compro_model->id_koperasi = $this->uri->segment(2) ? $this->uri->segment(2) : null;
        $koperasi_res = $this->compro_model->get_koperasi_profile();
        if($koperasi_res->num_rows() > 0){
            $data['page_name']         = 'Beranda';
            $data['page_sub_name']     = '';
            $data['page']              = 'compro/home_kop_view_profile';
            $data['koperasi']         = $koperasi_res->row();
          
            $this->load->view('main_view',$data);
        } else {
            echo "404 Not Found";
        }
    }

    function ajax_get_news(){
        $this->load->helper('text');
        $days = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus' , 'September', 'Oktober', 'November', 'Desember');
        header('Content-Type: application/json');
        $info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id_koperasi',
                'label' => 'ID koperasi',
                'rules' => 'trim|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        if ($this->form_validation->run() === TRUE) {
            $id_koperasi = $this->input->post('id_koperasi') ? $this->input->post('id_koperasi', true) : null;
            $last = $this->input->post('last') ? $this->input->post('last', true) : null;
            if($id_koperasi) {
                $this->compro_model->last = $last;
                $this->compro_model->id_koperasi = $id_koperasi;
                $news_res = $this->compro_model->get_news();

                $news = array();
                foreach ($news_res->result() as $content_temp) {
                    $created = strtotime($content_temp->tanggal_dibuat);
                    array_push($news, array(
                        'id' => $content_temp->id_berita,
                        'title' => character_limiter($content_temp->judul, 40),
                        'title_raw' => $content_temp->judul,
                        'content' => character_limiter(strip_tags($content_temp->isi), 150),
                        'time' => $content_temp->tanggal_dibuat,
                        'time_caption' => date('d', $created) . " " . $days[date('m')-1] . " " . date('Y', $created) . " " . date('H.i', $created),
                        'thumbnail' => $content_temp->link_gambar
                    ));
                }
                $info->data = $news;
            }  else {
                $info->errorcode = 2;
                $info->msg = "Invalid request. Koperasi tidak ditemukan";
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_get_agenda(){
        $this->load->helper('text');
        $days = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus' , 'September', 'Oktober', 'November', 'Desember');
        header('Content-Type: application/json');
        $info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id_koperasi',
                'label' => 'ID koperasi',
                'rules' => 'trim|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        if ($this->form_validation->run() === TRUE) {
            $id_koperasi = $this->input->post('id_koperasi') ? $this->input->post('id_koperasi', true) : null;
            $last = $this->input->post('last') ? $this->input->post('last', true) : null;
            if($id_koperasi) {
                $this->compro_model->last = $last;
                $this->compro_model->id_koperasi = $id_koperasi;
                $agenda_res = $this->compro_model->get_agendas();

                $agenda = array();
                foreach ($agenda_res->result() as $content_temp) {
                    $created = strtotime($content_temp->tanggal_dibuat);
                    $sch_time = strtotime($content_temp->tanggal_agenda);
                    array_push($agenda, array(
                        'id' => $content_temp->id_agenda,
                        'title' => character_limiter($content_temp->judul, 40),
                        'title_raw' => $content_temp->judul,
                        'content' => character_limiter(strip_tags($content_temp->isi), 150),
                        'time' => $content_temp->tanggal_dibuat,
                        'time_caption' => date('d', $created) . " " . $days[date('m')-1] . " " . date('Y', $created) . " " . date('H.i', $created),
                        'time_agenda' => $content_temp->tanggal_agenda,
                        'time_agenda_caption' => date('d', $sch_time) . " " . $days[date('m')-1] . " " . date('Y', $sch_time) . " " . date('H.i', $sch_time),
                        'thumbnail' => $content_temp->link_gambar
                    ));
                }
                $info->data = $agenda;
            }  else {
                $info->errorcode = 2;
                $info->msg = "Invalid request. Koperasi tidak ditemukan";
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

    function ajax_get_event(){
        $this->load->helper('text');
        $days = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus' , 'September', 'Oktober', 'November', 'Desember');
        header('Content-Type: application/json');
        $info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id_koperasi',
                'label' => 'ID koperasi',
                'rules' => 'trim|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');

        if ($this->form_validation->run() === TRUE) {
            $id_koperasi = $this->input->post('id_koperasi') ? $this->input->post('id_koperasi', true) : null;
            $last = $this->input->post('last') ? $this->input->post('last', true) : null;
            if($id_koperasi) {
                $this->compro_model->last = $last;
                $this->compro_model->id_koperasi = $id_koperasi;
                $event_res = $this->compro_model->get_events();

                $event = array();
                foreach ($event_res->result() as $content_temp) {
                    $created = strtotime($content_temp->tanggal_dibuat);
                    $sch_time = strtotime($content_temp->tanggal_event);
                    array_push($event, array(
                        'id' => $content_temp->id_event,
                        'title' => character_limiter($content_temp->judul, 40),
                        'title_raw' => $content_temp->judul,
                        'content' => character_limiter(strip_tags($content_temp->isi), 150),
                        'time' => $content_temp->tanggal_dibuat,
                        'time_caption' => date('d', $created) . " " . $days[date('m')-1] . " " . date('Y', $created) . " " . date('H.i', $created),
                        'time_event' => $content_temp->tanggal_event,
                        'time_event_caption' => date('d', $sch_time) . " " . $days[date('m')-1] . " " . date('Y', $sch_time) . " " . date('H.i', $sch_time),
                        'thumbnail' => $content_temp->link_gambar
                    ));
                }
                $info->data = $event;
            }  else {
                $info->errorcode = 2;
                $info->msg = "Invalid request. Koperasi tidak ditemukan";
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
    }

}