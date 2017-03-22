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
        Pembuatan Rekening Pinjaman
        <small>Pembuatan Rekening Pinjaman</small>
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
            <?php if($this->session->flashdata('rekening_pinjaman_stat')) { $rek_temp = $this->session->flashdata('rekening_pinjaman_stat'); ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Pembuatan Rekening Pinjaman Berhasil!</h4>
                Pembuatan rekening pinjaman baru telah dibuat dengan nomor rekening <?php echo $rek_temp['no_rekening_pinjaman'] ?> dengan jumlah pinjaman sebesar Rp. <?php echo number_format($rek_temp['jumlah_pinjaman'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>buat_rekening_pinjaman">disini</a> untuk kembali ke halaman registrasi rekening pinjaman.
            </div>
            <div class="box box-primary" id="nasabah_result">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Rekening Pinjaman</h3>
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
                                    <p class="col-xs-5 col-md-5 no-padding">Nominal Jumlah Pinjaman</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['jumlah_pinjaman'] ? "Rp. ".number_format($rek_temp['jumlah_pinjaman'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Tanggal Pencairan Pinjaman</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['tanggal_pencairan'] ? $rek_temp['tanggal_pencairan'] : '-' ?></b></p>
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
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Notaris</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['potongan_notaris'] ? "Rp. ".number_format($rek_temp['potongan_notaris'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Premi</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['potongan_premi'] ? "Rp. ".number_format($rek_temp['potongan_premi'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Tab Wajib</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['potongan_tab_wajib'] ? "Rp. ".number_format($rek_temp['potongan_tab_wajib'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Materai</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['potongan_materai'] ? "Rp. ".number_format($rek_temp['potongan_materai'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan CR</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['potongan_cr'] ? "Rp. ".number_format($rek_temp['potongan_cr'],2,".",",") : '-' ?></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Administrasi</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $rek_temp['potongan_adm'] ? "Rp. ".number_format($rek_temp['potongan_adm'],2,".",",") : '-' ?></b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { redirect('buat_rekening_pinjaman'); } ?>
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