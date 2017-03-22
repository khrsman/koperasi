<div class="login-box" style="margin-top:0px;">
  <div class="login-logo">
    <a href="../../index2.html"><b>Lupa</b> Password</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Kami akan mengirimkan password ke email Anda. Silahkan masukan alamat email yang telah terdaftar.</p>
    <form action="<?php echo $action_form; ?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="row">
        
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Kirim</button>
        </div><!-- /.col -->
      </div>
    </form>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->