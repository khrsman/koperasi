<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>

<div class="container" style="margin-top:80px;">
  <div class="col-md-8 col-md-offset-2">

    <div class="login-box">
      <div class="login-logo">
        <b>Reset Password</b><br><!-- <small>GERAI MUSLIM</small> -->
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <p class="login-box-msg">Silahkan masukan password baru anda.</p>
      <p><?= validation_errors() ?></p>
        <?php echo form_open($action_form); ?>
          <input type="hidden" name="return" value="<?php echo (empty($return))?$actual_link:$return; ?>" />
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Kirim</button>
            </div><!-- /.col -->
            
          </div>
        <?php echo form_close(); ?>

        <br>

        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </div>

</div>
