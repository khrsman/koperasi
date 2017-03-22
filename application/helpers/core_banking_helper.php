<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( !function_exists('get_saldo_virtual'))
{
    function get_saldo_virtual()
    {
        $ci = &get_instance();
        $session_data = $ci->session->all_userdata();

        $id_user = $ci->session->userdata('id_user');
        if (!isset($id_user)) {
        	$id_user==NULL;
        }

        $ci->load->model('core_banking_model');
        $saldo_virtual = $ci->core_banking_model->get_virtual_account_by_user($id_user);

        if ($saldo_virtual==FALSE) {
           return FALSE;
        }else{
           return number_format($saldo_virtual[0]['saldo'],0,',','.');
        } 
  

    }   

}