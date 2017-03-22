<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">

</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah User</h3>
        </div>
        <div class="box-body">
        <?= validation_errors() ?>
        <form action="" method="post" action="<?= base_url() ?>/add_user" enctype="multipart/form-data">
         <div class="form-group ">
            <label for="level">Role / Level</label>
            <select class="form-control" name="level">
              <option value='1'>Super Admin </option>
              <option value='2'>Admin Koperasi</option>
              <option value='6'>Manager Koperasi</option>
              <option value='7'>Kasir Koperasi</option>
              <option value='3'>Anggota Koperasi</option>
               <option selected>--- Pilih ---</option>
            </select>
          </div>
          <div class="form-group ">
             <label for="nama_depan">Nama Depan</label>
             <input type="text" class="form-control" placeholder="Nama Depan" required=""  name="nama_depan" />
           </div>
          <div class="form-group ">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" class="form-control" placeholder="Nama Belakang" name="nama_belakang" />
          </div>
          <div class="form-group ">
            <label for="Alamat">Alamat</label>
            <input type="text" class="form-control" placeholder="Alamat" required="" value="<?= set_value('alamat') ?>" name="alamat" />
          </div>
           <div class="form-group ">
           <label for="JenisKelamin">Jenis Kelamin</label><br />
            <label class="radio-inline">
              <input type="radio" name="jkel" value="L" <?= set_radio('jkel', 'L', true) ?>>Laki-Laki
            </label>
            <label class="radio-inline">
              <input type="radio" name="jkel" value="P" <?= set_radio('jkel', 'P') ?>>Perempuan
            </label>
          </div>
          <div class="form-group ">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="E-mail" value="<?= set_value('email') ?>" required=""  name="email" />
          </div>
          <div class="form-group ">
            <label for="NoHp">No HP</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= set_value('telepon') ?>" name="telepon" />
          </div>
          <div class="form-group ">
            <label for="username">Username</label>
            <input type="text" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" required="" name="username" />
          </div>

          <div class="form-group ">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Password" required="" name="password" />
          </div>
          <div class="form-group ">
            <label for="password">Ulangi Password</label>
            <input type="password" class="form-control" placeholder="Password" required="" name="confirm_password" />
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
            </div>
          </div>
        </form>
    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
