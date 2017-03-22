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
            <h4>
                <strong>Nomor Transaksi</strong> : <?= $transaksi['no_transaksi'] ?> <br />
                <strong>Tanggal Transaksi</strong> : <?php $date = new DateTime($transaksi['service_time_produk']); 
                                                    echo $date->format('d M y, H:i:s'); ?><br />
                
                <strong>Total Transaksi</strong> : Rp.
                     <?php $tt = str_replace(".00", "", $transaksi['total_harga']);
                                                                    echo number_format($tt,0,".",",") ?>                                
        </h4></div><!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btn-info btn-lg" onClick=location.href="<?= base_url() ?>transaksi/commerce"> Kembali</button>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

    <div class="box">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
            <table class="table table-responsive">
                <thead>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    <?php $no = 1; 
                    foreach ($barang as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r->nama ?></td>
                        <td><?= $r->jumlah?></td>
                        <td style="text-align: right;"><?php $price_n = str_replace(".00", "", $r->price_n);
                                                                echo number_format($price_n,0,".",",") ?></td>
                        <td style="text-align:right"><?php 
                                                            $jum = $r->jumlah*$r->price_n;
                                                            $tot = str_replace(".00", "", $jum);
                                                            echo number_format($tot,0,".",",")?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>