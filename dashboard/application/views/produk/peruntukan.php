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
        <?= validation_errors() ?>
           <?php
                        if($this->session->flashdata('msg') !=NULL){
                            echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                            echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
                            echo '</div>';
                        }?>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Peruntukan Produk</h3>
        </div>
        <form method="post" action="update_produk">
        <div class="box-body">
          <div class="form-group ">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" value="<?= $produk['nama'] ?>" disabled />
          </div>
          <div class="form-group ">
            <label for="nama">Deskripsi</label>
            <textarea class="form-control" value="" disabled style="height:200px;" ><?= $produk['desk'] ?></textarea>
          </div>
          <div class="form-group ">
            <label for="nama">Harga Normal</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?= $produk['price_n'] ?>" disabled/>
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Harga Diskon</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?= $produk['price_s'] ?>" disabled/>
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Jumlah stock</label>
            <input type="number" class="form-control" value="<?= $produk['qty'] ?>" disabled/>
          </div>          
          </form>

    </div><!-- /.box -->

    <div class="box">
      <div class="box-header with-border">
        <h3>Distribusi Produk</h3>
      </div>
      <div class="box-body">
                   <button class="btn btn-default" type="submit" data-toggle="modal" data-target="#myModal"> TAMBAH PERUNTUKAN</button>
              <hr>
                <table id="dataUser" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Koperasi</th>
                      <th>Harga Normal</th>
                      <th>Harga Diskon</th>
                      <th>Stock</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($peruntukan->result() as $r): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r->nama_koperasi ?></td>
                        <td><?= $r->price_n ?></td>
                        <td><?= $r->price_s ?></td>
                        <td><?= $r->qty ?></td>
                        <td><button type="button" class="btn btn-info" onclick=location.href="<?= base_url()?>update_peruntukan/<?=$r->id_koperasi ?>"><i class="fa fa-pencil"></i></button></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
      </div>
    </div>

</section><!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <form method="post" action="<?= base_url() ?>peruntukan">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">  
                  <label>Koperasi</label>
                  <select name="koperasi" class="data-koperasi input-medium">
                  </select>
                </div>
                <div class="form-group">
                  <label>Harga Normal</label>
                  <input type="text" name="price_n" value="<?= $produk['price_n'] ?>"  class="form-control">
                </div>
                <div class="form-group">
                  <label>Harga Diskon</label>
                  <input type="text" name="price_s" value="<?= $produk['price_s'] ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Stock</label>
                  <input type="text" name="qty" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>

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
    text: 'Cari Koperasi'},
    width:'100%'

    });
</script>
<?php
$this->load->view('template/foot');
?>