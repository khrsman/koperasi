<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!($this->session->userdata('id_user'))){
			redirect(SMIDUMAY,'refresh');
		}

		$this->load->library('form_validation');
        $this->load->model('menu_mod');
	}

	function settings(){
		if($this->session->userdata('level') == 1){
			$data['title'] = "Pengaturan Menu";
            if($this->uri->segment(3))
                $this->menu_mod->group_id = $this->uri->segment(3, true);
            else
    			$this->menu_mod->group_id = 1;
			$data['menu_group'] = $this->menu_mod->get_menu_group();
			$menu = $this->menu_mod->get_menu();

			$data['menu_ul'] = '<ul id="easymm"></ul>';
			if($menu->num_rows() > 0){
				foreach ($menu->result() as $row) {
					$this->menu_mod->add_row(
						$row->id,
						$row->parent_id,
						' id="menu-'.$row->id.'" class="sortable"',
						$this->get_label($row)
					);
				}
				$data['menu_ul'] = $this->menu_mod->generate_list('id="easymm"');
			}

// echo '<pre>';
// 			print_r($data);
// 			die;

			$this->load->view('menu/settings', $data);
		} else
			$this->load->view('404');
	}

	public function ajax_create_menu(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'group_id',
                'label' => 'group ID',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'title',
                'label' => 'nama menu',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'url',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'class',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'image',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'auth_visibility',
                'label' => 'nama vendor',
                'rules' => 'callback_check_is_exist'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $group_id = $this->input->post('group_id', true) ? $this->input->post('group_id', true) : null;
            $menu_title = $this->input->post('title', true) ? $this->input->post('title', true) : null;
            $menu_url = $this->input->post('url', true) ? $this->input->post('url', true) : null;
            $menu_class = $this->input->post('class', true) ? $this->input->post('class', true) : null;
            $menu_image = $this->input->post('image', true) ? $this->input->post('image', true) : null;
            $auth_visibility = $this->input->post('auth_visibility') ? $this->input->post('auth_visibility') : null;

            if (is_array($auth_visibility)) {
                $auth_visibility = json_encode(array_map('intval', $auth_visibility));
            } else if ($auth_visibility) {
                $auth_visibility = json_encode(array_map('intval', array($auth_visibility)));
            } else {
                $auth_visibility = null;
            }

            $data = array(
            	'title' => $menu_title,
            	'url' => $menu_url,
            	'class' => $menu_class,
            	'image' => $menu_image,
                'parent_id' => 0,
            	'group_id' => $group_id,
                'auth_visibility' => $auth_visibility,
            	'position' => $this->menu_mod->get_last_position()
            );

            if($this->menu_mod->create_menu($data)){
            	$data['id'] = $this->menu_mod->insert_id;
            	$response['li'] = '<li id="menu-'.$this->menu_mod->insert_id.'" class="sortable">'.$this->get_label((object) $data).'</li>';
				$response['li_id'] = $this->menu_mod->insert_id;
            	$info->data = $response;
            	$info->msg = "Menu telah Dibuat";
            } else {
            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
				$info->errorcode = 2;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	public function ajax_edit_menu(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id',
                'label' => 'menu ID',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'title',
                'label' => 'nama menu',
                'rules' => 'trim|xss_clean|required'
            ),
            array(
                'field' => 'url',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'class',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'image',
                'label' => 'nama vendor',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'auth_visibility',
                'label' => 'nama vendor',
                'rules' => 'callback_check_is_exist'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $menu_id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
            $menu_title = $this->input->post('title', true) ? $this->input->post('title', true) : null;
            $menu_url = $this->input->post('url', true) ? $this->input->post('url', true) : null;
            $menu_class = $this->input->post('class', true) ? $this->input->post('class', true) : null;
            $menu_image = $this->input->post('image', true) ? $this->input->post('image', true) : null;
            $auth_visibility = $this->input->post('auth_visibility') ? $this->input->post('auth_visibility') : null;

            if (is_array($auth_visibility)) {
                $auth_visibility = json_encode(array_map('intval', $auth_visibility));
            } else if ($auth_visibility) {
                $auth_visibility = json_encode(array_map('intval', array($auth_visibility)));
            } else {
                $auth_visibility = null;
            }

            $data = array(
            	'title' => $menu_title,
            	'url' => $menu_url,
            	'class' => $menu_class,
            	'image' => $menu_image,
                'auth_visibility' => $auth_visibility
            );

            if($this->menu_mod->save_menu($menu_id, $data)){
            	$info->data = $data;
            	$info->msg = "Perubahan menu telah disimpan";
            } else {
            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
				$info->errorcode = 2;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

    public function check_is_exist($data){
        $data = $this->input->post('auth_visibility');
        if(is_array($data)){
            if (count($data) > 0)
                return TRUE;
            else {
                $this->form_validation->set_message('check_is_exist', 'Role harus dipilih');
                return FALSE;
            }
        } else if($data) {
        	return TRUE;
        } else {
            $this->form_validation->set_message('check_is_exist', 'Role harus dipilih');
            return FALSE;
        }
    }

	public function ajax_delete_menu(){
		header('Content-Type: application/json');
		$info = new stdClass();
        $info->msg = "";
        $info->errorcode = 0;

        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'id',
                'label' => 'menu ID',
                'rules' => 'trim|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Input %s harus diisi');
        $this->form_validation->set_message('is_unique', 'Maaf, %s yang Anda dimasukan sudah digunakan');

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            $menu_id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

            $this->menu_mod->ids = array($menu_id);
            $this->menu_mod->get_descendants($menu_id);

            if($this->menu_mod->delete_menu()){
            	$info->msg = "Menu telah dihapus";
            } else {
            	$info->msg = "Terjadi kesalahan ketika melakukan transaksi. Silahkan ulangi kembali";
				$info->errorcode = 2;
            }
        } else {
            $info->msg = array("form_error" => validation_errors_array());
            $info->errorcode = 1;
        }

        echo json_encode($info);
	}

	function ajax_save_menu(){
		if (isset($_POST['easymm'])) {
			header('Content-Type: application/json');

			$info = new stdClass();
	        $info->msg = "";
	        $info->errorcode = 0;
			$easymm = $_POST['easymm'];
			$this->update_position(0, $easymm);

			$info->msg = "Perubahan telah disimpan...";

			echo json_encode($info);
		}
	}

	private function update_position($parent, $children) {
		$i = 1;
		foreach ($children as $k => $v) {
			$id = (int)$children[$k]['id'];
			$data['parent_id'] = $parent;
			$data['position'] = $i;
			$this->db->where('id', $id);
			$this->db->update('menu', $data);
			if (isset($children[$k]['children'][0])) {
				$this->update_position($id, $children[$k]['children']);
			}
			$i++;
		}
	}

	private function get_label($row) {
		$label =
			'<div class="ns-row" data-class="'.$row->class.'" data-auth="'.$row->auth_visibility.'">' .
				'<div class="ns-title">'.$row->title.'</div>' .
				'<div class="ns-url">'.$row->url.'</div>' .
				'<div class="ns-roles">'.$row->auth_visibility.'</div>' .
				'<div class="ns-image">'.$row->image.'</div>' .
				'<div class="ns-actions">' .
					'<a href="#" class="edit-menu" title="Edit Menu">' .
						'<i class="fa fa-pencil"></i>' .
					'</a>' .
					'<a href="#" class="delete-menu">' .
						'<i class="fa fa-trash"></i>' .
					'</a>' .
					'<input type="hidden" name="menu_id" value="'.$row->id.'">' .
				'</div>' .
			'</div>';
		return $label;
	}

}
