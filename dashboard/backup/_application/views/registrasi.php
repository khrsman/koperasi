<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GeraiLumrah - Registrasi</title>
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
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <?= validation_errors() ?>
                        </div>
                    </div>
                    <div class="row">
                        <form role="form" action="" method="post" class="login-form" action="<?= base_url() ?>registrasi" >
                        <div class="col-sm-8 col-sm-offset-2 form-box">
                            <div class="form-bottom" style="-moz-border-radius: 4px 4px 4px 4px; -webkit-border-radius: 4px 4px 4px 4px; border-radius: 4px 4px 4px 4px;">
                             
                                <p><b>Form Registrasi GeraiLumrah</b></p>
                                <div class="form-group">
                                    <label for="form-username">Nama Depan</label>
                                    <input type="text" name="nama_depan" placeholder="Nama Depan" value="<?= set_value('nama_depan') ?>" required class="form-control">
                                </div>
                                 <div class="form-group">
                                    <label for="form-username">Nama Belakang</label>
                                    <input type="text" name="nama_belakang" placeholder="Nama Belakang" value="<?= set_value('nama_belakang') ?>"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Username</label>
                                    <input type="text" name="username"  value="<?= set_value('username') ?>" placeholder="Username" class="form-control" required id="form-username">
                                </div>
                                <div class="form-group">
                                    <label for="form-password">Password</label>
                                    <input type="password"  value="<?= set_value('password') ?>"name="password" placeholder="Password" class="form-control" required id="form-password">
                                </div>
                                <div class="form-group">
                                    <label for="form-username">E mail</label>
                                    <input type="text" name="email" required  value="<?= set_value('email') ?>" placeholder="Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="form-username">No Telepon</label>
                                    <input type="text" name="telp"  placeholder="No Telepon" class="form-control" value="<?= set_value('telp') ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Jenis Kelamin</label>
                                    <div class="form-inline">
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="jkel" value="l" <?= set_radio('jkel', 'l', TRUE); ?>>
                                            Laki - laki
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="jkel" value="p" <?= set_radio('jkel', 'p') ?> >
                                            Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="col-sm-8 col-sm-offset-2 form-box">
                            <div class="form-bottom" style="-moz-border-radius: 4px 4px 4px 4px; -webkit-border-radius: 4px 4px 4px 4px; border-radius: 4px 4px 4px 4px;">
                            <p><b>Question And Answer</b></p>
                            <?php foreach ($question as $row){ ?>
                            <div class="form-group">
                                <label for="form-username"><?= $row->pertanyaan ?></label>
                                <div class="form-inline">
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="<?= $row->id_pertanyaan ?>" value="Ya"  <?= set_radio($row->id_pertanyaan, 'Ya', TRUE) ?> checked>
                                        Ya
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" <?= set_radio($row->id_pertanyaan, 'Tidak') ?> name="<?= $row->id_pertanyaan ?>" value="Tidak">
                                        Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php  }?>
                            
                        </div>
                        <button type="submit" class="btn btn-success">Daftar</button>
                        <button type="button" class="btn btn-info" onclick=location.href="<?= base_url() ?>">Kembali Ke Login</button>
                        <button type="button" class="btn btn-info" onclick=location.href="<?= FRONTEND;?>">Kembali Ke Gerai</button>
                        </form>

                    </div>
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