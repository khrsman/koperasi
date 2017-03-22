<?php

class Pembayaran extends CI_Controller {


	public function __construct()

	{
        parent::__construct();
	}



	function index(){
		$session = $this->session->userdata();
	
		if ($session['level']==3 || $session['level']==4 || $session['level']==5) {
			redirect('404');
		}

        $data['page'] = 'gerai/admin/pembayaran/pembayaran_list_view';
        $this->load->view('main_view',$data);
	}

	

}