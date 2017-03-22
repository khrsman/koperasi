<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/select2-4.0.2/dist/css/select2.min.css" rel="stylesheet" />

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
            <h3 class="box-title">Tambah Produk</h3>
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
<script src="<?= base_url() ?>assets/select2-4.0.2/dist/js/select2.js"></script>

<script type="text/javascript">
  $(".data-koperasi").select2({
    ajax: {
    url: "<?= base_url() ?>koperasi/get_koperasi",
    dataType: 'json',
    delay: 250,
    data: function (params) {
    return {
    q: params.term // search term
    };
    },
    processResults: function (data) {
    return {
    results: data
    };
    },
    cache: true
    },
    minimumInputLength: 2,

    placeholder: {
    id: '0', // the value of the option
    text: 'Cari Koperasi'}
    });
</script>
<?php
$this->load->view('template/foot');
?>