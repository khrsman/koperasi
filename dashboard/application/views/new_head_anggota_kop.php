<!DOCTYPE html>
<html>
    <head>
       <?php 
        if(isset($title)){
            $title = $title;
        }
        else{
            $title = "";
        }

        ?>
        <title>Dashboard - <?php echo $title; ?></title>
      
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="author" content="Pijar International - pijar-int.com">
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url() ?>assets/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url() ?>assets/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() ?>assets/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() ?>assets/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url() ?>assets/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url() ?>assets/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url() ?>assets/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url() ?>assets/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?= base_url() ?>assets/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
         <!-- Bootstrap Styles -->
      <link href="<?php echo base_url('assets/tmp');?>/css/bootstrap.css" rel="stylesheet">
      <!-- Styles -->
      <link href="<?php echo base_url('assets/tmp');?>/style.css" rel="stylesheet">
      <link href="<?php echo base_url('assets/tmp');?>/style-pijarint.css" rel="stylesheet">
      <!-- Carousel Slider -->
      <link href="<?php echo base_url('assets/tmp');?>/css/owl-carousel.css" rel="stylesheet">
      <!-- CSS Animations -->
      <link href="<?php echo base_url('assets/tmp');?>/css/animate.min.css" rel="stylesheet">
      <!-- Google Fonts -->
      <!-- <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Lato:400,300,400italic,300italic,700,700italic,900' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Exo:400,300,600,500,400italic,700italic,800,900' rel='stylesheet' type='text/css'> -->
      <!-- SLIDER ROYAL CSS SETTINGS -->
      <link href="<?php echo base_url('assets/tmp');?>/royalslider/royalslider.css" rel="stylesheet">
      <link href="<?php echo base_url('assets/tmp');?>/royalslider/skins/default-inverted/rs-default-inverted.css" rel="stylesheet">
      <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tmp');?>/rs-plugin/css/settings.css" media="screen" />
      <!-- Switcher Only -->
      <link rel="stylesheet" id="switcher-css" type="text/css" href="<?php echo base_url('assets/tmp');?>/switcher/css/switcher.css" media="all" />
      <!-- END Switcher Styles -->
      <link rel="alternate stylesheet" type="text/css" href="<?php echo base_url('assets/tmp');?>/switcher/css/orange.css" title="orange" media="all" />
      <link rel="alternate stylesheet" type="text/css" href="<?php echo base_url('assets/tmp');?>/dark-style.css" title="dark" media="all" />


        <!-- Main Scripts-->
      <script src="<?php echo base_url('assets/tmp');?>/js/jquery.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/menu.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/owl.carousel.min.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/jquery.parallax-1.1.3.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/jquery.simple-text-rotator.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/wow.min.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/custom.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/jquery.isotope.min.js"></script>
      <script src="<?php echo base_url('assets/tmp');?>/js/custom-portfolio-masonry.js"></script>
   </head>
      <style type="text/css">
         .ch-info-wrap {
         height: 163px;
         }
         .ch-info {
         height: 163px;
         }
        .nav-tabs > li.active > a{
          color: black !important;
        }
        .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a {
          color: black !important;
        }
        .tabbable .nav-tabs {
           background: white; 
           
         }

         body{
            color:black;
         }
      </style>


   <body>
      <div class="container menu_home">
            <div id="topbar" class="clearfix" style="padding:2px;">
               <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url();?>" class="navbar-brand">
                    <span class="hidden-xs hidden-sm">CIMAHI1</span>
                  </a>
               </div>
               <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                  <div class="pull-right bahasa">
                     <strong><span class="pull-left " style="margin:0 10px"> Pilih Bahasa</span></strong>
                     <img src="<?php echo base_url('assets/compro/flag/eng.jpg');?>" class="pull-right" width="30">
                     <img src="<?php echo base_url('assets/compro/flag/idn.jpg');?>" class="pull-right" width="30" style="margin:0 10px">
                  </div>
               </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0;">
               <?php $this->load->view('new_main_menu_anggota');?>
            </div>
            <div class="col-md-12 col-xs-12" style="margin-bottom:10px;padding-top: 5px; padding-bottom : 5px; padding-left: 0px; padding-right:0px;border-bottom:1px solid #D4D4D4;background: #064862;color: white;font-size: 18px;">
                <div class="text-center">
                   <marquee>
                                            Selamat datang di laman web ofisial kami. Kami memberikan kemudahan kepada setiap orang untuk terhubung dengan uang mereka dan yang lainnya.

                   </marquee>
                </div>
            </div>

            <div class="clearfix"></div>



      </div>

