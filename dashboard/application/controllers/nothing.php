<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nothing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	function index(){
		$data['title'] = 'Page not Found';
		$this->load->view('hallo',$data);
	}

}
?>