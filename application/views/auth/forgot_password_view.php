<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>
<section class="grey-wrapper jt-shadow" style="padding: 0px 0;">
   <div class="container">
      <div class="general-title">
         <h2>LUPA PASSWORD / KATA SANDI</h2>
         <hr>
      </div>
      <br><br><br>
      <div class="col-md-3 col-xs-12"></div>
      <div class="col-md-6 col-xs-12 login-box">
        <div class="login-logo">
          <b>LUPA PASSWORD / KATA SANDI</b><br><!-- <small>GERAI MUSLIM</small> -->
        </div><!-- /.login-logo -->
        <div class="login-box-body">
        <?= validation_errors() ?>
        <?php
              if($this->session->flashdata('msg') != NULL){
              echo '<div class="alert alert-danger" role="alert" style="padding: 6px 12px;height:34px;">';
                  echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
              echo '</div>';
              }?>
        <p class="login-box-msg">Silakan masukkan email anda, untuk melakukan reset password. Kami akan mengirim link untuk melakukan reset password melalui email anda<br /></p>
        <img style="width: 50px; height: 50px; display: none; margin: 20px auto;" id="loading" src="<?= base_url() ?>assets/compro/loading.gif" class="img-responsive">
        <form method="POST" action="<?= site_url('recovery') ?>" id="form_forgot" style="display: block">
          <input type="hidden" name="return" value="<?php echo (empty($return))?$actual_link:$return; ?>" />
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" required />
          </div>
          <div class="row">
            
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit">Kirim</button>
            </div><!-- /.col -->
            
          </div>
        </form>

        <br>

        
      </div><!-- /.login-box-body -->

        
      </div><!-- /.login-box-body -->
      <div class="col-md-3 col-xs-12"></div>
    </div><!-- /.login-box -->



    </div>
</section>

   <div class="container">
     

      <div class="col-md-12 col-xs-12" style="padding:80px 0;">


  

      </div>

</div>



<script type="text/javascript">
      $('#form_forgot').submit(function(){
      $('#loading').css('display', 'block');
      $('#form_forgot').css('display', 'none'); //<----here
      return true;
    });
</script>
