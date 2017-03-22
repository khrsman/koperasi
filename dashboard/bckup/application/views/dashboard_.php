<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/css/gerailumrah.css" rel="stylesheet" type="text/css" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Selamat Datang di Panel Dashboard 
    <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

<?php 

    if($this->session->userdata('level')     == "1") {
        $this->load->view('dashboard/dashboard_admin');
    }
    else if($this->session->userdata('level') == "2"){ 
        $this->load->view('dashboard/dashboard_koperasi');
    }
    else if($this->session->userdata('level') == "3"){
        $this->load->view('dashboard/dashboard_anggota_koperasi');
    }
    else if($this->session->userdata('level') == "4"){
        $this->load->view('dashboard/dashboard_komunitas');
    }
    else if($this->session->userdata('level') == "5") {
        $this->load->view('dashboard/dashboard_komunitas');
    }
    
?>



</section><!-- /.content -->
<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>