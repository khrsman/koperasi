<?php
class Pulsa extends CI_Controller {

	public function __construct()
	{
	        parent::__construct();
	        /*$this->load->model('member_model');
	        $this->load->model('auth_model');*/
	}


	function index(){
        $data['page'] = 'compro/pulsa_list_view';
        $this->load->view('compro/main_view',$data);
	}

	function topup($provider=NULL){
		if ($provider==NULL) {
			redirect('pulsa');
		}

		switch ($provider) {
			case 'indosat':
				$this->session->set_userdata('provider', 'indosat');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'indosat.png';
				$data['provider_name'] = 'Indosat';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			case 'telkomsel':
				$this->session->set_userdata('provider', 'telkomsel');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'telkomsel.png';
				$data['provider_name'] = 'Telkomsel';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			case 'xl':
				$this->session->set_userdata('provider', 'xl');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'XL.png';
				$data['provider_name'] = 'XL';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			case 'esia':
				$this->session->set_userdata('provider', 'esia');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'esia.png';
				$data['provider_name'] = 'Esia';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			case 'smartfren':
				$this->session->set_userdata('provider', 'smartfren');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'smartfren.png';
				$data['provider_name'] = 'Smartfren';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			case 'flexi':
				$this->session->set_userdata('provider', 'flexi');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'flexi.png';
				$data['provider_name'] = 'Flexi';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			case 'axis':
				$this->session->set_userdata('provider', 'axis');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'axis.png';
				$data['provider_name'] = 'Axis';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			case 'tri':
				$this->session->set_userdata('provider', 'tri');
				$data['provider_logo'] = base_url('assets/compro/IMAGE/provider').'/'.'3.png';
				$data['provider_name'] = 'Tri';
				$data['page'] = "compro/pulsa_topup_form_view";
				$this->load->view('compro/main_view',$data);
				break;
			
			default:
				redirect('pulsa');
				/*$data['page'] = "under_404";
				$this->load->view('compro/main_view',$data);*/
				break;
		}

        
	}
	
}