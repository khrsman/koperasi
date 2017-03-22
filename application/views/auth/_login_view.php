<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>

<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/landing_page/bumper.jpg');?>" class="img-responsive" style="">
   </center>
</div>
<div class="clearfix"></div>
<section class="grey-wrapper jt-shadow" style="padding: 20px 0;">
   <div class="container">
      <div class="general-title">
         <h2>LOGIN ANGGOTA</h2>
         <hr>
      </div>
      <div class="col-md-3 col-xs-12"></div>
      <div class="col-md-6 col-xs-12 login-box">
        <div class="login-logo">
          <b>LOGIN</b><br><!-- <small>GERAI MUSLIM</small> -->
        </div><!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Silahkan masukan username dan password anda, untuk melihat fitur kami sleanjutnya.</p>
          <?php
                if($this->session->flashdata('msg') != NULL){
                echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                    echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
                echo '</div>';
                }?>
          <?php echo form_open($action_form); ?>
            <input type="hidden" name="return" value="<?php echo (empty($return))?$actual_link:$return; ?>" />
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Nama Pengguna" name="username" required />
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Kata Sandi" name="password" required />
            </div>
            <div class="row">
              
              <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                <button type="button" data-toggle="modal" data-target="#option" class="btn btn-success btn-block btn-flat">Daftar</button>
                <button type="button" onclick=location.href="<?= base_url() ?>recovery" class="btn btn-info btn-block btn-flat">Lupa Password ?</button>
              </div><!-- /.col -->
              
            </div>
          <?php echo form_close(); ?>

        <br>

        
      </div><!-- /.login-box-body -->
      <div class="col-md-3 col-xs-12"></div>
    </div><!-- /.login-box -->



    </div>
</section>
          
    <!-- Modal -->
<div id="option" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pilih Instansi</h4>
      </div>
      <div class="clearfix"></div>
      <div class="modal-body">
         <div class="col-md-12" >
         silahkan pilih instansi / jenis organisasi untuk registrasi data anda.
         <br><br>
         <div class="col-md-6">
          <button type="button" class="btn btn-primary btn-block" onclick=location.href="<?= base_url() ?>auth/choose_register/1">KOPERASI</button>
         </div>
         <div class="col-md-6">
            <button type="button" class="btn btn-success btn-block" onclick=location.href="<?= base_url() ?>auth/choose_register/2">KOMUNITAS</button>
         </div>
         <div class="clearfix"></div>
         </div>
      </div>
      
      <div class="clearfix"></div>
      <div class="modal-footer">
        <div class="col-md-12" style="padding-top: 25px">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>

  </div>
</div>
