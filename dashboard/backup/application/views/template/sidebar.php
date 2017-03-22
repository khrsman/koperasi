<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
        <div class="pull-left image">
                       <img src="<?php
                                if(empty($this->session->userdata('foto_user'))){
                                    echo base_url()."assets/images/user/default.jpg";
                                }

                                else {
                                  echo base_url()."assets/images/user/".$this->session->userdata('foto_user');
                                }

                         ?>" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php 
            if($this->session->userdata('level') != NULL OR $this->session->userdata('level') != ""){
                if($this->session->userdata('level') == 1){
                    $this->load->view('template/sidebar_admin');
                }
                else if($this->session->userdata('level') == 2){
                    $this->load->view('template/sidebar_koperasi');
                }
                else if($this->session->userdata('level') == 3){
                    $this->load->view('template/sidebar_member');
                }
                else if($this->session->userdata('level') == 4){
                    $this->load->view('template/sidebar_komunitas');
                }
                else if($this->session->userdata('level') == 5){
                    $this->load->view('template/sidebar_anggota_komunitas');
                }

            }

            



            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">