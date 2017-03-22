<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>
<style>
.bootstrap-select {
    width: 100% !important;
}
</style>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pembayaran Angsuran Pinjaman
        <small>Pembayaran Angsuran Pinjaman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <?php if($this->session->flashdata('angsuran_stat')) { $rek_temp = $this->session->flashdata('angsuran_stat'); ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Pembayaran Angsuran Berhasil!</h4>
                Pembayaran angsuran pinjaman untuk nomor rekening <?php echo $rek_temp['no_rekening_pinjaman'] ?> dengan jumlah setoran sebesar Rp. <?php echo number_format($rek_temp['jumlah_setoran'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>bayar_angsuran">disini</a> untuk kembali ke halaman pembayaran angsuran.
            </div>
            <div class="box box-primary" id="nasabah_result">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Pembayaran Angsuran Pinjaman</h3>
                </div>
                <div class="box-body form-input-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <ul class="data-information">
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">No Rekening Pinjaman</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp['no_rekening_pinjaman'] ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Atas Nama Pemilik</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['nama_lengkap'] ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Tanggal Pembayaran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['tanggal_bayar'] ? $rek_temp['tanggal_bayar'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Nominal Jumlah Setoran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['jumlah_setoran'] ? "Rp. ".number_format($rek_temp['jumlah_setoran'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Angsuran Ke-</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['angsuran_ke'] ? $rek_temp['angsuran_ke'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Sisa Angsuran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['sisa_angsuran'] ? "Rp. ".number_format($rek_temp['sisa_angsuran'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Jumlah Bunga</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['jumlah_bunga'] ? "Rp. ".number_format($rek_temp['jumlah_bunga'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Jumlah Denda</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['jumlah_denda'] ? "Rp. ".number_format($rek_temp['jumlah_denda'],2,".",",") : '-' ?></b></p>
                                </li>
                                <?php if($rek_temp['pelunasan'] == "Y") { ?>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Diskon untuk Pelunasan</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['diskon'] ? $rek_temp['diskon'] : '-' ?></b></p>
                                </li>
                                <?php } ?>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Keterangan</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['keterangan'] ? $rek_temp['keterangan'] : '-' ?></b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { redirect('bayar_angsuran'); } ?>
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