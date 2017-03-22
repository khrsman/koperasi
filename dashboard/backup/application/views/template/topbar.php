</head>
<body class="sidebar-mini skin-black-light">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <a href="#" class="logo"><b> Panel </b></a>
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
                                        <a href="<?= base_url()?>profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo anchor('logout','Sign Out','class="btn btn-danger btn-flat"');?>
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
            <div class="col-md-12 col-xs-12" style="padding: 10px 0;border-bottom:1px solid #D4D4D4;background: #1BBC9B;color: white;font-size: 18px;">
                <div class="text-center">
                   <marquee>
                      Welcome to our offical website. We gives people better ways to connect to their money and to each other.
                   </marquee>
                </div>
            </div>
        </div>
        <!-- =============================================== -->

        <div class="clear-both"></div>



        