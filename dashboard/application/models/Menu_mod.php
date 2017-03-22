<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_mod extends CI_Model {

	var $group_id, $data, $menu, $insert_id, $ids = array();

	public function __construct()
	{
		parent::__construct();
	}

	function get_menu_group(){
		$this->db->from('menu_group');
		return $this->db->get();
	}

	function get_menu(){
		$this->db->from('menu m');
		if ($this->group_id)
			$this->db->where('m.group_id', $this->group_id);
			//khrsman
			//$this->db->like('m.auth_visibility','2');
		$this->db->order_by('parent_id, position');
		return $this->db->get();
	//	die($this->db->last_query());
	}

	function create_menu($data){
		if ($this->db->insert('menu', $data)){
			$this->insert_id = $this->db->insert_id();
			return TRUE;
		}
		return FALSE;
	}

	function save_menu($id, $data){
		$this->db->where('id', $id);
		if ($this->db->update('menu', $data))
			return TRUE;
		return FALSE;
	}

	function delete_menu(){
		$this->db->where_in('id', $this->ids);
		if ($this->db->delete('menu'))
			return TRUE;
		return FALSE;
	}

	function get_descendants($id) {
		$this->db->select('id');
		$this->db->from('menu');
		$this->db->where('parent_id', $id);
		$data = $this->db->get();

		foreach ($data->result() as $data_temp) {
			array_push($this->ids, $data_temp->id);
			$this->get_descendants($data_temp->id);
		}
	}

	function get_last_position(){
		$this->db->from('menu m');
		if ($this->group_id)
			$this->db->where('m.group_id', $this->group_id);
		$this->db->where('parent_id', 0);
		$this->db->order_by('position', 'desc');
		$this->db->limit(1);

		$r = $this->db->get();
		if ($r->num_rows() > 0) {
			return (int) $r->row()->position + 1;
		} else
			return 1;
	}

	function add_row($id, $parent, $li_attr, $label) {
		$this->data[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
	}

	function add_row_menu($id, $parent, $li_attr, $label) {
		$this->menu[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
	}

	function generate_list($ul_attr = '') {
		return $this->ul(0, $ul_attr);
	}

	function ul($parent = 0, $attr = '') {
		static $i = 1;
		$indent = str_repeat("\t\t", $i);
		// echo '<pre>';
		// print_r($this->data);
		// die;
		if (isset($this->data[$parent])) {
			if ($attr) {
				$attr = ' ' . $attr;
			}
			$html = "\n$indent";
			$html .= "<ul$attr>";
			$i++;
			foreach ($this->data[$parent] as $row) {
				$child = $this->ul($row['id']);
				$html .= "\n\t$indent";
				$html .= '<li'. $row['li_attr'] . '>';
				$html .= $row['label'];
				if ($child) {
					$i--;
					$html .= $child;
					$html .= "\n\t$indent";
				}
				$html .= '</li>';
			}
			$html .= "\n$indent</ul>";
			return $html;
		} else {
			return false;
		}
	}

	function clear() {
		$this->data = array();
		$this->menu = array();
	}

	function generate_front_page_menu(){
		if(count($this->menu) > 0){
			$html =
			'<div id="navbar-collapse-1" class="navbar-collapse collapse navbar-right">'.
				'<ul class="nav navbar-nav">';
			foreach ($this->menu[0] as $row) {
				$children = "";
				if(isset($this->menu[$row['id']])){
					$children =
					'<ul class="dropdown-menu">
                       	<li>
                        	<div class="yamm-content">
                            	<div class="row">';
					foreach ($this->menu[$row['id']] as $row_child) {
						$children .= $row_child['label'];
					}
					$children .=
								'</div>
							</div>
						</li>
					</ul>';
				}
				$html .= '<li class="dropdown yamm-fw">' . $row['label'] . $children .'</li>';
			}
			$html .=
				'</ul>'.
			'</div>';

			return $html;
		} else
			return null;
	}

	function generate_dashboard_menu(){
		if(count($this->menu) > 0){
			$html =
				'<ul class="sidebar-menu">';
			foreach ($this->menu[0] as $row) {
				$children = "";
				if(isset($this->menu[$row['id']])){
					$children = '<ul class="treeview-menu">';
					foreach ($this->menu[$row['id']] as $row_child) {
						$children2 = "";
						if(isset($this->menu[$row_child['id']])){
							$children2 .= '<ul class="treeview-menu">';
							foreach ($this->menu[$row_child['id']] as $row_child2) {
								$children2 .= '<li>'.$row_child2['label'].'</li>';
							}
							$children2 .= '</ul>';
							$children .= '<li class="treeview">'.$row_child['label'] . $children2 . '</li>';
						} else {
							$children .= '<li>'.$row_child['label'] .'</li>';
						}
					}
					$children .= '</ul>';
				}
				$html .= '<li class="treeview" style="color:black;">' . $row['label'] . $children .'</li>';
			}
			$html .=
				'</ul>';
			return $html;
		} else
			return null;
	}

}
