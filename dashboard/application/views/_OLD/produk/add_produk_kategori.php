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
            <h3 class="box-title">Tambah Kategori Produk</h3>
        </div>
        <form method="post" action="<?= base_url() ?>add_produk_kategori">
        <div class="box-body">
        <?= validation_errors() ?>
          <div class="form-group ">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama"/>
          </div>
          </form>

          <div class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Tambah Kategori</button>
          </div>
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>