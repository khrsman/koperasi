<div class="col-md-8 col-md-offset-2">

  <div class="login-box" style="margin-top:100px;">
    <div class="login-logo">
      <a href="<?php echo site_url('auth/login') ?>"><b>Login</b><br><small>User</small></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Silahkan masukan username dan password</p>
      <form action="<?php echo $action_form; ?>" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Username" name="username" />
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div><!-- /.col -->
          
        </div>
      </form>

      <!-- <br>

      <a href="<?php echo site_url('auth/forgot_password'); ?>">Saya lupa password</a><br>
      <a href="<?php echo site_url('auth/signup'); ?>" class="text-center">Pendaftaran pengguna baru</a><br>
      <a href="<?php echo site_url('auth/resend_activation'); ?>" class="text-center">Kirim ulang kode aktivasi</a>
       -->
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

</div>

