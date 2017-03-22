<!DOCTYPE HTML>
<html>
   <head>
      <title>Koperasi</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="keywords" content="Rasendriya, Illustrator, ANimation, Animasi, Animasi Indonesia, Film,  Production, Production House, PH">
      <meta name="author" content="Pijar International - pijar-int.com">
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/LTE/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/LTE/plugins/font-awesome-4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
      <link href="<?php echo base_url('assets/compro');?>/LTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/LTE/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/LTE/plugins/iCheck/flat/blue.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/LTE/plugins/morris/morris.css">
      
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/multi-columns-row.css">

      <script src="<?php echo base_url('assets/compro');?>/jquery.min.js"></script>

      <script src="<?php echo base_url('assets/compro');?>/LTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url('assets/compro');?>/LTE/plugins/sparkline/jquery.sparkline.min.js"></script>
      <script src="<?php echo base_url('assets/compro');?>/LTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="<?php echo base_url('assets/compro');?>/LTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <script src="<?php echo base_url('assets/compro');?>/LTE/dist/js/app.min.js"></script>
      <script src="<?php echo base_url('assets/compro');?>/panelapp.js"></script>

      <link href='http://fonts.googleapis.com/css?family=Neuton&subset=latin' rel='stylesheet' type='text/css'>
      <link href="<?php echo base_url('assets/compro');?>/new_kibi.css" rel="stylesheet" type="text/css" />
      <script>
         // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         // })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         
         // ga('create', 'UA-44204568-3', 'auto');
         // ga('send', 'pageview');
      </script>
   </head>

   <body>
      <!-- <button id="menuBtn" class="menuBtn btn--round btn--menu desktop" data-state="open" onmouseover="change_line_bg()" onclick="contact_show()">
      <span class="btn--menu__line btn_top" data-line="top"></span>
      <span class="btn--menu__line btn_mid" data-line="middle"></span>
      <span class="btn--menu__line btn_bot" data-line="bottom"></span>
      </button> -->


      <script>
         $(document).ready(function() {
           $(window).scroll(function(){
             $('.face-control').each(function(r){
               var pos = $(this).offset().top;
               var scrolled = $(window).scrollTop();
                 $('.face-control').css('top', -(scrolled * 0.5) + 'px');     
               });
         
          
           });
         });
      </script>

      <nav class="navbar navbar-inverse-custom navbar-default navbar-fixed-top" style="padding:7px">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
              <img src="<?php echo base_url('assets/compro'); ?>./logo-kop.png" class="img-responsive" style="max-width:120px; margin-top: -14px;" />
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo site_url('home'); ?>">Beranda <span class="sr-only">(current)</span></a></li>
              <li><a href="<?php echo site_url('home/feature'); ?>">Fitur Kami</a></li>
              <li><a href="<?php echo site_url('home/aboutus'); ?>">Tentang Kami</a></li>
              <li><a href="<?php echo site_url('home/contact'); ?>">Kontak</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Login</a></li>
              <li><a href="#">Daftar</a></li>
              <li><a href="<?php echo site_url('store/cart'); ?>"><i class="fa fa-shopping-cart"></i> Cart</a></li>
            </ul>

          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <?php 
         $this->load->view(@$page);
      ?> 


      <footer class="main_footer">
        
        <div class="container" style="margin-top:20px;padding:14px 0;z-index:999;">
          <div class="row">
            <div class="col-md-12">
                <hr>
                 <p class="text-center">Copyright &copy; 2016 <strong>Gerai Lumrah</strong> All Rights Reserved.</p        
            </div>
          </div>
        </div>

      </footer>
       
      
   </body>
</html>