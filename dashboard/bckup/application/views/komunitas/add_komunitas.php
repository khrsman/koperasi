<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->

<link href="<?= base_url() ?>assets/AdminLTE-2.0.5//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
            <h3 class="box-title">Tambah Komunitas</h3>
        </div>

        <div class="box-body">
        <?= validation_errors() ?>
        <form action="" method="post" action="<?= base_url() ?>/add_komunitas" enctype="multipart/form-data">
            <form action="" method="post" action="<?= base_url() ?>/add_admin" enctype="multipart/form-data">
          <div class="form-group ">
            <label for="nama">Nama Komunitas</label>
            <input type="text" class="form-control" placeholder="Nama Komunitas" required=""  value="<?= set_value('nama') ?>" name="nama" />
          </div>
          <div class="form-group ">
            <label for="Alamat">Alamat</label>
            <input type="text" class="form-control" placeholder="Alamat" required="" value="<?= set_value('alamat') ?>" name="alamat" />
          </div>
          <div class="form-group ">
            <label for="NoHp">No Telepon</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= set_value('telepon') ?>" name="telepon" />
          </div>
          <div class="form-group ">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="E-mail" value="<?= set_value('email') ?>" required=""  name="email" />
          </div>
           <div class="form-group">
            <label>Tanggal Berdiri</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh/bb/tttt'" name="berdiri" value="<?= set_value('berdiri') ?>" data-mask/>
            </div><!-- /.input group -->
          </div>
          <div class="form-group ">
            <label for="Ketua">Ketua Komunitas</label>
            <input type="text" class="form-control" placeholder="Ketua Komunitas" required="" value="<?= set_value('ketua') ?>" name="ketua" />
          </div>
          <div class="form-group ">
            <label for="Ketua Telp">No Telepon Ketua Komunitas</label>
            <input type="text" class="form-control" placeholder="No Telepon Ketua Komunitas" required="" value="<?= set_value('ketua_telp') ?>" name="ketua_telp" />
          </div>
          <div class="form-group ">
            <label for="Keterangan">Keterangan</label>
            <textarea id="mytextarea" class="form-control" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= set_value('keterangan') ?></textarea>
          </div>
          <div class="form-group ">
            <label for="username">Username</label>
            <input type="text" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" required="" name="username" />
          </div>

          <div class="form-group ">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Password" required="" name="password" />
          </div>
            </select>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Tambah</button>
            </div>
          </div>
        </form>
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
     <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

<script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "hh/bb/tttt"});
        $("#mytextarea").wysihtml5();
      });
      
    </script>

  <script>
      
  </script>

<?php
$this->load->view('template/foot');
?>