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
        Setor Tunai
        <small>Setor Tunai Nasabah</small>
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
            <?php if($this->session->flashdata('setor_tunai_stat')) { $tr_temp = $this->session->flashdata('setor_tunai_stat'); ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transaksi Setor Tunai Berhasil!</h4>
                Pengiriman saldo kepada rekening yang dituju telah dilakukan. Klik <a href="<?php echo base_url() ?>setor_tunai">disini</a> untuk kembali ke halaman setor tunai
            </div>
            <div class="box box-primary" id="nasabah_result">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Setor Tunai</h3>
                </div>
                <div class="box-body form-input-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <ul class="data-information">
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">No Transaksi</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $tr_temp['no_transaksi_rekening'] ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Dikirimkan Kepada</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['no_rekening_tujuan'] ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Nominal Jumlah Transfer</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['nilai_transaksi'] ? number_format($tr_temp['nilai_transaksi'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Atas Nama Pengirim</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['nama'] ? $tr_temp['nama'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">ID KTP Pengirim</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['no_ktp'] ? $tr_temp['no_ktp'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Berita Acara</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['berita_acara'] ? $tr_temp['berita_acara'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Alamat Pengirim</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['alamat'] ? $tr_temp['alamat'] : '-'  ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Email</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['email'] ? $tr_temp['email'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Nomor Telepon</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['no_telepon'] ? $tr_temp['no_telepon'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Waktu Transaksi</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['tanggal_transaksi'] ? $tr_temp['tanggal_transaksi'] : '-' ?></b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { redirect('setor_tunai'); } ?>
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