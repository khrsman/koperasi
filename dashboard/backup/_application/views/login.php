<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GeraiLumrah - Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap-login-forms/form-1/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
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


    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
              <?php
    if($this->session->flashdata('msg') != NULL){
    echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
        echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
    echo '</div>';
    }?>
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                                <?= validation_errors() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-center">
                                    <!-- <h3>Halaman Login <b>GeraiLumrah</b></h3>
                                    <p></p> -->
                                    <img src="<?=base_url() ?>assets/images/logo-kop.png" style="padding-top: 20px">
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form"  method="post" class="login-form" action="<?= base_url() ?>login" >
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="username" placeholder="Username" class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password" class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn btn-success">Masuk</button>
                                    <button type="button" class="btn btn-info" onclick=location.href="<?= base_url() ?>registrasi">Daftar Disini</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                            <h3>...or login with:</h3>
                            <div class="social-login-buttons">
                                <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/js/jquery.backstretch.min.js"></script>
        <!-- <script src="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/js/scripts.js"></script> -->
        <script>

            jQuery(document).ready(function() {

                /*
                    Fullscreen background
                */
                $.backstretch("<?= base_url()?>assets/bootstrap-login-forms/form-1/assets/img/backgrounds/1.jpg");
                
                /*
                    Form validation
                */
                $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
                    $(this).removeClass('input-error');
                });
                
                $('.login-form').on('submit', function(e) {
                    
                    $(this).find('input[type="text"], input[type="password"], textarea').each(function(){
                        if( $(this).val() == "" ) {
                            e.preventDefault();
                            $(this).addClass('input-error');
                        }
                        else {
                            $(this).removeClass('input-error');
                        }
                    });
                    
                });
                
                
            });

        </script>
        
        <!--[if lt IE 10]>
            <script src="<?= base_url() ?>assets/bootstrap-login-forms/form-1/assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>