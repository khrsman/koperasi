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
            <h3 class="box-title">Detail Produk</h3>
        </div>
        <form method="post" action="<?= base_url() ?>add_produk">
        <div class="box-body">
        <?= validation_errors() ?>
          <div class="form-group ">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama"/>
          </div>
          <div class="form-group ">
            <label for="nama">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" style="height:200px;"></textarea> 
          </div>
          <div class="form-group ">
            <label for="nama">Warna</label>
            <input type="text" class="form-control" name="warna"/>
          </div>
          <div class="form-group ">
            <label for="nama">Tipe</label>
            <input type="text" class="form-control"  name="tipe"/>
          </div>

          <div class="form-group ">
            <label for="nama">Kategori</label>
            <select class="form-control" name="kategori">
              <?php
                  foreach ($kategori as $r) { ?>
                    <option value="<?= $r->id_kategori ?>"><?= $r->nama ?></option>
                <?php }  ?>
            </select>
          </div>

          <div class="form-group ">
            <label for="nama">Berat</label>
            <div class="input-group">
                    <input type="text" class="form-control" name="berat"/>
                    <span class="input-group-addon">Kg</span>
            </div>
          </div>

          <div class="form-group ">
            <label for="nama">Harga Normal</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" name="price_n" />
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Harga Diskon</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" name="price_s"/>
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Jumlah stock</label>
            <input type="text" class="form-control" name="qty"/>
          </div>
         <!--  <div class="form-group ">
            <label for="nama">Jumlah Terjual</label>
            <input type="text" class="form-control" name="terjual"/>
          </div> -->
          

          </form>

          <div class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Tambah Produk</button>
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