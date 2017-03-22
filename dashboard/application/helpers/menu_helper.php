<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( !function_exists('generate_front_page_menu'))
{
    function generate_front_page_menu()
    {
        $ci = &get_instance();

        $ci->load->model('menu_mod');
        $ci->menu_mod->group_id = 1;
        $menu = $ci->menu_mod->get_menu();


        $data['menu_canvas'] = '<ul class="nav navbar-nav"></ul>';
        if($menu->num_rows() > 0){
            foreach ($menu->result() as $row) {
                $label = $row->parent_id ? get_desc_label_front_end($row) : get_parent_label_front_end($row);
                $ci->menu_mod->add_row_menu(
                    $row->id,
                    $row->parent_id,
                    '',
                    $label
                );
            }

            $generate_html = $ci->menu_mod->generate_menu();
            // print_r($generate_html);
        }
    }
}

if ( !function_exists('get_parent_label_front_end'))
{
    function get_parent_label_front_end($row) {
        $label =
            '<a href="'.$row->url.'" data-toggle="dropdown" class="dropdown-toggle">' .
               '<strong>'.$row->title.' </strong>' .
               '<div class="arrow-up"></div>' .
            '</a>';
        return $label;
    }
}

if ( !function_exists('get_desc_label_front_end'))
{
    function get_desc_label_front_end($row) {
        $label =
            '<div class="col-sm-4 col-xs-6">'.
               '<div class="widget">'.
                  '<a href="'.$row->url.'">'.
                     '<center>'.
                        '<img src="'.base_url().$row->title.'" class="img-responsive">'.
                    ' </center>'.
                  '</a>'.
               '</div>'.
            '</div>';
        return $label;
    }
}

if ( !function_exists('generate_dashboard_menu'))
{
    function generate_dashboard_menu()
    {
        $ci = &get_instance();

        $ci->load->model('menu_mod');
        $temp_group_id = $ci->menu_mod->group_id;
        $ci->menu_mod->group_id = 2;
        $menu = $ci->menu_mod->get_menu();

        //  print_r($menu->result());
        //  die;
        $data['menu_canvas'] = '<ul class="nav navbar-nav"></ul>';
        if($menu->num_rows() > 0){
            foreach ($menu->result() as $row) {
                $auth_visibility = json_decode($row->auth_visibility);
                if (in_array($ci->session->userdata('level'), $auth_visibility)) {
                    $label = $row->parent_id ? get_desc_label_dashboard($row) : get_parent_label_dashboard($row);
                    $ci->menu_mod->add_row_menu(
                        $row->id,
                        $row->parent_id,
                        '',
                        $label
                    );
                }
            }

            $ci->menu_mod->group_id = $temp_group_id;
            return $generate_html = $ci->menu_mod->generate_dashboard_menu();
            // print_r($generate_html);
        }
        $ci->menu_mod->group_id = $temp_group_id;
    }
}

if ( !function_exists('get_parent_label_dashboard'))
{
    function get_parent_label_dashboard($row) {
        $label =
            '<a href="'.base_url().$row->url.'">
                <img src="'.base_url().$row->image.'" class="img-responsives" width="200px" style="margin:0 22px 0 0">
            </a>';
        return $label;
    }
}

if ( !function_exists('get_desc_label_dashboard'))
{
    function get_desc_label_dashboard($row) {
        $label =
            '<a href="'.base_url().$row->url.'"><i class="fa fa-minus"></i> '.$row->title.'</a>';
        return $label;
    }
}
