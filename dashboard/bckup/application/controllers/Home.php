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

}