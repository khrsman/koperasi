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
        Pembuatan Rekening Kredit Cicilan
        <small>Pembuatan Rekening Kredit Cicilan</small>
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
            <?php if($this->session->flashdata('rekening_kredit_cicilan_stat')) { $rek_temp = $this->session->flashdata('rekening_kredit_cicilan_stat'); ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Pembuatan Rekening Kredit Cicilan Berhasil!</h4>
                Pembuatan rekening kredit cicilan baru telah dibuat dengan nomor rekening <?php echo $rek_temp['no_rekening_kredit'] ?> dengan jumlah kredit sebesar Rp. <?php echo number_format($rek_temp['jumlah_kredit'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>buat_rekening_kredit_cicilan">disini</a> untuk kembali ke halaman registrasi rekening kredit cicilan.
            </div>
            <div class="box box-primary" id="nasabah_result">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Rekening Kredit Cicilan</h3>
                </div>
                <div class="box-body form-input-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <ul class="data-information">
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">No Rekening Kredit Cicilan</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp['no_rekening_kredit'] ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Atas Nama Pemilik</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['nama_lengkap'] ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Nominal Jumlah Kredit Cicilan</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['jumlah_kredit'] ? "Rp. ".number_format($rek_temp['jumlah_kredit'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Tanggal Pencairan Kredit Cicilan</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['tanggal_kredit'] ? $rek_temp['tanggal_kredit'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Jumlah Angsuran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['jumlah_angsuran'] ? $rek_temp['jumlah_angsuran'] ." Kali" : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Tanggal Tagihan</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['tanggal_tagihan'] ? "Setiap Tanggal " . $rek_temp['tanggal_tagihan'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Tanggal Jatuh Tempo</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['tanggal_jatuh_tempo'] ? $rek_temp['tanggal_jatuh_tempo'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Periode Angsuran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['periode_jumlah'] ? $rek_temp['periode_jumlah'] ." Kali / " . $rek_temp['periode_waktu'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Lama Penangguhan Pembayaran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['grace_period'] ? $rek_temp['grace_period'] . " " . $rek_temp['periode_waktu'] : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Margin Rupiah</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['margin_rupiah'] ? "Rp. ".number_format($rek_temp['margin_rupiah'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Margin Persen</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['margin_persen'] ? $rek_temp['margin_persen'] . " %" : '-' ?></b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { redirect('buat_rekening_kredit_cicilan'); } ?>
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