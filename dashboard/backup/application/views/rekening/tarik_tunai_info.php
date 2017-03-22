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
        Penarikan Tunai
        <small>Penarikan Tunai oleh Nasabah</small>
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
            <?php if($this->session->flashdata('tarik_tunai_stat')) { $tr_temp = $this->session->flashdata('tarik_tunai_stat'); ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transaksi Penarikan Tunai Berhasil!</h4>
                Penarikan tunai oleh nasabah telah dilakukan. Klik <a href="<?php echo base_url() ?>tarik_tunai">disini</a> untuk kembali ke halaman penarikan
            </div>
            <div class="box box-primary" id="nasabah_result">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Tarik Tunai</h3>
                </div>
                <div class="box-body form-input-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <ul class="data-information">
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">No Transaksi</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $tr_temp['no_transaksi'] ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Dikirimkan Kepada</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['no_rekening_primary'] ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Nominal Jumlah Penarikan</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $tr_temp['nilai_transaksi'] ? number_format($tr_temp['nilai_transaksi'],2,".",",") : '-' ?></b></p>
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
            <?php } else { redirect('tarik_tunai'); } ?>
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