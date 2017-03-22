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
<!--     <h1>

                  <img src="
                    <?php
                     echo base_url('assets/compro').'/smi-logo.png';
                      // if($this->session->userdata('id_user') == NULL OR $this->session->userdata('id_user') == "" OR $this->session->userdata('level') == "1"){
                      //   echo base_url('assets/compro').'/smi-logo.png';
                      // }else{
                      //   echo get_cover_logo();
                      // }
                     ?>
                  " class="img-responsive" style="width:200px;"/> -->
    <!-- <small>it all starts here</small> -->
    <!-- </h1> -->
<!--     <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
    </ol> -->
    <!-- <br> -->
    <?php  if($this->session->userdata('level')     != "1") { ?>

        <a class="btn btn-sm btn-primary" href="<?php echo site_url('about'); ?>"><strong>Tentang Kami</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('agenda'); ?>"><strong>Agenda Organisasi</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('news'); ?>"><strong>Berita / Acara</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('contact'); ?>"><strong>Kontak</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('partners'); ?>"><strong>Partners</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('faq'); ?>"><strong>FAQ SMI</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('services'); ?>"><strong>Products & Services</strong></a>
 <?php } ?>
</section>
<!-- Main content -->
<section class="content">
 <div style="max-height:300px;overflow:hidden;margin:0 0 50px 0;    border-bottom: 7px solid #FFC501;">
    <center>
            <?php
            //if($logo_cover['cover_foto']): ?>
           <!-- <img src="<?= SRC_COVER.$logo_cover['cover_foto'] ?>" alt="" class="img-responsive"> -->
            <?php //else: ?>
            <img src="<?php echo base_url('assets/compro/IMAGE'); ?>/cover_hero_smi.jpg" alt=""  class="img-responsive">
            <?php //endif; ?>
         </center>

</div>
