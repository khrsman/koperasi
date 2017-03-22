<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>

<div class="container" style="margin-top:80px;">
 
      <div class="login-logo">
        <b>Permintaan anda telah kami terima, silakan cek email anda untuk melakukan reset password</b><br><!-- <small>GERAI MUSLIM</small> -->
      </div><!-- /.login-logo -->

  <div class="col-md-8 col-md-offset-2">
    <div class="login-box">
      <div class="login-box-body">
            <div class="col-xs-12">
              <button type="button" onclick=location.href="<?= base_url() ?>auth" class="btn btn-primary btn-block btn-flat" id="submit">Kembali</button>
            </div><!-- /.col -->
          </div>
        <br>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </div>

</div>