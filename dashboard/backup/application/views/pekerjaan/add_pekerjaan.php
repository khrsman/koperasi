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
            <h3 class="box-title">Add Pekerjaan</h3>
        </div>

        <div class="box-body">
        <?= validation_errors() ?>
        <form action="" method="post" action="<?= base_url() ?>/add_pekerjaan" enctype="multipart/form-data">
          <div class="form-group ">
            <label for="nama">Nama Pekerjaan</label>
            <input type="text" class="form-control" placeholder="Nama Pekerjaan" required=""  name="nama" />
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
<?php
$this->load->view('template/foot');
?>