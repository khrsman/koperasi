<?php 
   $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $actual_link = urlencode($actual_link);
   ?>
<!-- <!DOCTYPE HTML> -->
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta http-equiv="content-type" > 

      <title>CIMAHI1</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="author" content="Pijar International - pijar-int.com">
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

  <!-- Bootstrap Styles -->
  <link href="<?php echo base_url('assets/tmp');?>/css/bootstrap.css" rel="stylesheet">
  
  <!-- Styles -->
  <link href="<?php echo base_url('assets/tmp');?>/style.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/tmp');?>/style-pijarint.css" rel="stylesheet">

  
  <!-- CSS Animations -->
  <link href="<?php echo base_url('assets/tmp');?>/css/animate.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:400,300,400italic,300italic,700,700italic,900' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Exo:400,300,600,500,400italic,700italic,800,900' rel='stylesheet' type='text/css'>

 
    <link rel="alternate stylesheet" type="text/css" href="<?php echo base_url('assets/tmp');?>/switcher/css/orange.css" title="orange" media="all" />
    
    <link rel="alternate stylesheet" type="text/css" href="<?php echo base_url('assets/tmp');?>/dark-style.css" title="dark" media="all" />
  <!-- END Demo Examples -->
    <script src="<?php echo base_url('assets/tmp');?>/js/jquery.js"></script>
</head>
<body>


  <header id="">
    <div class="container menu_home">
      <div id="topbar" class="clearfix" style="padding:2px;">
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
               <a href="<?php echo base_url();?>" class="navbar-brand">
               <span class="hidden-xs hidden-sm">CIMAHI1</span></a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
               <div class="pull-right bahasa">
                  <strong><span class="pull-left " style="margin:0 10px"> Pilih Bahasa</span></strong>
                  <img src="<?php echo base_url('assets/compro/flag/eng.jpg');?>" class="pull-right" width="30">
                  <img src="<?php echo base_url('assets/compro/flag/idn.jpg');?>" class="pull-right" width="30" style="margin:0 10px">
               </div>
            </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0;box-shadow: 1px 1px 3px #979797;">
            <?php if(empty($this->session->userdata('id_user')) && empty($this->session->userdata('username'))): ?>
               <div class="login_form">
                  <span class="topbar-login" style=" color:white;"> <b>Secure Log In </b></span>
                  <form class="form-inline" action="<?= base_url('attemp'); ?>"  method="post"> 
                     <span class="topbar-cart">
                     <input type="text" class=""  name="username" id="form-username" placeholder="Username">
                     <input type="password" class="" id="form-password" name="password" placeholder="Password">
                     <button type="submit" class="btn btn-sm btn-danger" style="margin-bottom: 3px;border-radius: 0px;">Masuk</button>
                     </span>
                  </form>
               </div>
               <div class="login_form_footer">
                  <a href="<?php echo base_url('recovery');?>"><strong>Lupa Password</strong></a>
               </div>

               <?php endif;?>
         </div>
         <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding:0;">
            <?php $this->load->view('compro/main_menu');?>
         </div>



    </div><!-- end container -->
  </header><!-- end header-style-1 -->

      <div class="clearfix"></div>
      <div class="container">
      <?php 
         $this->load->view(@$page);
         ?> 
        </div>
    <div class="clearfix"></div>
    <div class="container">
    	<div class="col-md-12" style="margin:30px 0;">
	    	<center>
	    		<img src="<?php echo base_url('assets').'/adv.jpeg'; ?>" class="img-responsives" width="80%">
	    	</center>
    	</div>
    </div>
    <div class="clearfix"></div>

    <div id="copyrights" style="background-color: white;">
      <div class="container">
      <hr>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <center>
              <div class="copyright-text ">
                    <p style="color:black;"> Powered by <strong>
                      <img src="<?php echo base_url('assets/compro').'/smi-logo-lite.png'; ?>" class="img-responsives" width="50px">
                      PT SANMADA MEGA INDONESIA
                    </strong> </p>
                </div><!-- end copyright-text -->
                </center>
      </div><!-- end widget -->
      

        </div><!-- end container -->
    </div>
    
  <div class="dmtop">Scroll to Top</div>
        
  <!-- Main Scripts-->
  
  <script src="<?php echo base_url('assets/tmp');?>/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/js/menu.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/js/jquery.parallax-1.1.3.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/js/jquery.simple-text-rotator.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/js/wow.min.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/js/custom.js"></script>
    
  <script src="<?php echo base_url('assets/tmp');?>/js/jquery.isotope.min.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/js/custom-portfolio-masonry.js"></script>

 



  <script type="text/javascript" src="<?php echo base_url('assets/tmp');?>/switcher/js/fswit.js"></script>
  <script src="<?php echo base_url('assets/tmp');?>/switcher/js/bootstrap-select.js"></script>
  
</body>
</html>