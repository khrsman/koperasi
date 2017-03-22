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
            <h3 class="box-title">Edit Peruntukan Produk</h3>
        </div>
        <form method="post" action="<?= base_url() ?>update_peruntukan/<?= $produk_peruntukan['id_koperasi'] ?>">
        <div class="box-body">
          <div class="form-group ">
            <label for="nama">Nama Koperasi</label>
            <input type="text" class="form-control" value="<?= $produk_peruntukan['nama_koperasi'] ?>" disabled />
          </div>
          <div class="form-group ">
            <label for="nama">Harga Normal</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?= $produk_peruntukan['price_n'] ?>" name="price_n" value="<?= set_value('price_n')?>"/>
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Harga Diskon</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?= $produk_peruntukan['price_s'] ?>" name="price_s" value="<?= set_value('price_s')?>"/>
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Jumlah stock</label>
            <input type="number" class="form-control" value="<?= $produk_peruntukan['qty'] ?>" name="qty"  value="<?= set_value('qty')?>" />
            <input type="hidden" class="form-control" value="<?= $produk_peruntukan['qty'] ?>" name="qty_hidden"  value="<?= set_value('qty_hidden')?>" />
          </div>          
          </form>
          <div class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Simpan Perubahan</button>
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