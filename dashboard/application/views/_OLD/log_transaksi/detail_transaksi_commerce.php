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
    <h1>
        Detail Transaksi
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Transaksi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
            Nomor Transaksi : <?= $transaksi['no_transaksi'] ?> <br />
            Produk Yang dibeli : <?= $transaksi['nama'] ?> <br />
            Tanggal Transaksi : <?php $date = new DateTime($transaksi['service_time_produk']); 
                                                echo $date->format('d M y, H:i:s'); ?><br />
            Jumlah barang yang dibeli : <?= $transaksi['jumlah'] ?><br />
            Total Harga : <?= $transaksi['total_harga'] ?>                                    
        </div><!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btn-info btn-lg" onClick=location.href="<?= base_url() ?>transaksi/commerce"> Kembali</button>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>