<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( !function_exists('is_login')){
    function is_login()
    {

    	$ci = &get_instance();
        $session_data = $ci->session->all_userdata();

        if (!isset($session_data['id_user'])&&!isset($session_data['username'])&&!isset($session_data['last_login'])) {
            return FALSE;
        }else{
            return TRUE;
        }
    }   

}


if ( !function_exists('is_pin_valid'))
{
    function is_pin_valid($pin_raw)
    {
        $ci = &get_instance();
        $session_data = $ci->session->all_userdata();

        if (empty($pin_raw) || !isset($session_data['id_user'])) {
            return FALSE;
        }else{
            $pin = sha1(md5(strrev($pin_raw)));
            $ci->load->model('auth_model');
            $data_user = $ci->auth_model->get_user_detail_by_id($session_data['id_user']);

            if ($data_user==FALSE) {
                return FALSE;
            }else{
                if ($data_user['user_ver']!=$pin) {
                    return FALSE;
                }else{
                    return TRUE;
                }
            } 
        }
  

    }   

}



if ( !function_exists('has_koperasi'))
{
    function has_koperasi()
    {
        $ci = &get_instance();
        $session_data = $ci->session->all_userdata();

        if (!isset($session_data['id_user']) || empty($session_data['id_user'])) {
            return FALSE;
        }else{
            $ci = &get_instance();
            $ci->load->model('auth_model');
            $data_user = $ci->auth_model->get_user_info_by_id($session_data['id_user']);

            if ($data_user==FALSE) {
                return FALSE;
            }else{
                if ($data_user['koperasi']!=NULL) {
                    return TRUE;
                }else{
                    return FALSE;
                }
            } 
        }
  

    }   

}



if ( !function_exists('get_cover_logo'))
{

    function get_cover_logo()
    {
        $ci = &get_instance();
        $ci->load->model('compro_model');

       // if(empty($ci->compro_model->get_logo_cover()->row_array()['foto']) AND empty($ci->compro_model->get_logo_cover()->row_array()['cover_foto'])){ 

if(!$ci->compro_model->get_logo_cover()){
            $url_logo = base_url()."assets/compro/";
            return $url_logo.'smi-logo.png';

        }
        else {
            $get_logo_cover = $ci->compro_model->get_logo_cover()->row_array();
            return SRC_LOGO.$get_logo_cover['foto'];

        }  

        // if($ci->compro_model->get_logo_cover()){
        //     $get_logo_cover = $ci->compro_model->get_logo_cover()->row_array();
        //     return SRC_LOGO.$get_logo_cover['foto'];
        // }
        // else {
        //     $url_logo = base_url()."assets/compro/";
        //     return $url_logo.'smi-logo.png';
        // }
    }   

}

