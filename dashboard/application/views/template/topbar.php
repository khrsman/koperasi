</head>

<style type="text/css">
    @media (max-width: 767px){
.skin-black-light .main-header>.logo {
    background-color: #FFFFFF;
}
.skin-black-light .main-header>.logo:hover {
    background-color: #FFFFFF;
}
}

.skin-black-light .main-header>.navbar {
    background-color: #F9A714;
}

@media (max-width: 991px){
.main-header .btn-danger {
    background: #D73925;
    
}
}

</style>
<body class="sidebar-mini skin-black-light fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <a href="#" class="logo"> 
            <img src="<?php echo base_url('assets/tmp/images').'/logo.png'; ?>" class="img-responsives"></a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <b> Menu Aplikasi</b>
                </a>

               

               <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <?php
                            switch ($this->session->userdata('level')) {
                                case '1':
                                        $level = "Administrator";
                                    break;
                                 case '2':
                                        $level = "Koperasi";
                                    break;
                                 case '3':
                                        $level = "Anggota";
                                    break;
                                
                                default:
                                        $level = "NONE";
                                    break;
                            }
                        ?>

                        <li style="text-align:right; padding:10px 30px 0px 0px"><h6  style="color:#fff"><strong>Page for <?= $level ?></strong> </h6></li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php
                                if($this->session->userdata('foto_user') == NULL){
                                    echo base_url()."assets/images/user/default.jpg";
                                }

                                else {
                                  echo base_url()."assets/images/user/".$this->session->userdata('foto_user');
                                }

                         ?>" class="user-image image-profile" alt="User Image"/>
                                <span class="hidden-xs"> <?= $this->session->userdata('nama'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php
                                if($this->session->userdata('foto_user') == NULL){
                                    echo base_url()."assets/images/user/default.jpg";
                                }

                                else {
                                  echo base_url()."assets/images/user/".$this->session->userdata('foto_user');
                                }

                         ?>" class="img-circle" alt="User Image" />
                                    <p>
                                            <?= $this->session->userdata('nama'); ?>
                                  </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                        </div>
                                        <div class="col-xs-12">
                                            Login Terakhir : <?php
                                                $date = new DateTime($this->session->userdata('last_login')); 
                                                echo $date->format('d M y, H:i:s'); 
                                                ?>
                                        </div>
                                         <div class="col-xs-12">
                                            Level Login : <?php
                                                                if($this->session->userdata('level')==1){
                                                                    echo "Admin";
                                                                }
                                                                else if($this->session->userdata('level')==2){
                                                                    echo "Koperasi";
                                                                }
                                                                else if($this->session->userdata('level')==3){
                                                                    echo "Anggota Koperasi";
                                                                }
                                                                else if($this->session->userdata('level')==4){
                                                                    echo "Komunitas";
                                                                }
                                                                else if($this->session->userdata('level')==5){
                                                                    echo "Anggota Komunitas";
                                                                }
                                                              ?>
                                        </div>
                                        <?php if($this->session->userdata('level') == 3){ ?>

                                        <div class="col-xs-12">
                                            Koperasi : 
                                        </div>
                                        <?php } ?>
                                    </div>
                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url()?>profile" class="btn btn-info btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo anchor('logout','Keluar','class="btn btn-danger btn-flat"');?>
                                        <!-- <a href="<?= base_url()?>logout" class="btn btn-danger btn-flat">Sign out</a> -->
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="run-text">
            <div class="col-md-12 col-xs-12" style="margin-top:50px;padding-top: 5px; padding-bottom : 5px; padding-left: 0px; padding-right:0px;border-bottom:1px solid #D4D4D4;background: #064862;color: white;font-size: 18px;">
                <div class="text-center">
                   <marquee>
                      Welcome to our offical website. We gives people better ways to connect to their money and to each other.
                   </marquee>
                </div>
            </div>
        </div>
        <!-- =============================================== -->

        <div class="clear-both"></div>



        