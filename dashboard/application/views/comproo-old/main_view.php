<!DOCTYPE HTML>
<html>
   <head>
      <title>Gerai Lumrah</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="author" content="Pijar International - pijar-int.com">
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/LTE/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
      <link href="<?php echo base_url('assets/compro');?>/LTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />

      
      <link rel="stylesheet" href="<?php echo base_url('assets/compro');?>/multi-columns-row.css">

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

      <script src="<?php echo base_url('assets/compro');?>/LTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

      <link href='http://fonts.googleapis.com/css?family=Neuton&subset=latin' rel='stylesheet' type='text/css'>
      <link href="<?php echo base_url('assets/compro/and9');?>/style.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/compro');?>/new_kibi.css" rel="stylesheet" type="text/css" />



     
   </head>

   <body>


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
              <!-- <li><a href="<?php //echo site_url('home/feature'); ?>">Fitur Kami</a></li> -->
              <li><a href="<?php echo site_url('home/aboutus'); ?>">Tentang Kami</a></li>
              <li><a href="<?php echo site_url('home/contact'); ?>">Kontak</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li><a href="http://localhost/adminkop/login">Login</a></li>
              <li><a href="http://localhost/adminkop/registrasi">Daftar</a></li>
              <li><a href="<?php echo site_url('store/cart'); ?>"><i class="fa fa-shopping-cart"></i> Cart</a></li>
            </ul>

          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <?php 
         $this->load->view(@$page);
      ?> 

      <section class="footer_top_general">
        <div class="container">
          <center>
            <div class="col-md-6 col-xs-12 ">
              <h2 class="contentHead large h3">Bayar kepada siapa pun, di mana pun.</h2>
              <p class="contentPara">Bayar barang atau jasa dengan mudah dan lebih aman, cukup dengan alamat email atau nomor telepon. Di mana pun mereka berada, pembayaran Anda akan diterima dengan senang hati.</p>
            </div>
            <div class="col-md-6 col-xs-12 ">
              <h2 class="contentHead large h3">Minta pembayaran dengan mudah.</h2>
              <p class="contentPara">Meminta pembayaran adalah pengingat untuk pekerjaan yang telah diselesaikan. Mereka akan memperoleh undangan untuk membayar dengan cara yang diinginkan tanpa harus memikirkannya.</p>
            </div>
          </center>
        </div>
      </section>
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