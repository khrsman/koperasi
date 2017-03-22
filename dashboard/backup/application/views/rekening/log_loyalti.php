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
        Informasi Rekening Loyalti Nasabah
        <small>Histori dan Detail Rekening Loyalti Nasabah</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_cek_saldo">
        <div class="row">
            <div class="col-md-12">
                <?php if($rekening->num_rows() > 0) { $rek_temp = $rekening->row();?>
                <div class="box box-primary" id="nasabah_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Informasi Nasabah</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">ID Nasabah</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->id_user ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Atas Nama Pemilik</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><a href="<?php echo base_url() . 'nasabah/' . $rek_temp->id_user ?>"><?php echo $rek_temp->nama_lengkap ?></a></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Koperasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->nama_koperasi ?></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary" id="tabungan_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Rekening Virtual Nasabah</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Nomor Rekening Loyalti</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->no_rekening_loyalti ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jenis Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span>Loyalti <?php echo $rek_temp->jenis_rekening ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Status Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->status_rekening ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Saldo Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b>Rp. <span><?php echo number_format($rek_temp->saldo, 2, ".", ",") ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Transaksi Terakhir</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->tanggal_transaksi_terakhir ? $rek_temp->tanggal_transaksi_terakhir : '-' ?></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary" id="tabungan_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Histori Transaksi Rekening</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Saldo</th>
                                    <th>Ket.</th>
                                </tr>
                                <?php if($log_rekening->num_rows() > 0) { foreach ($log_rekening->result() as $log_temp) { ?>
                                <tr>
                                    <td><?php echo $log_temp->tanggal_transaksi ?></td>
                                    <td><?php echo $log_temp->no_transaksi ?></td>
                                    <td><?php echo $log_temp->tipe_transaksi == 'DEBET' ? "Rp. " . number_format($log_temp->nilai_transaksi, 2, ".", ",") : '' ?></td>
                                    <td><?php echo $log_temp->tipe_transaksi == 'KREDIT' ? "Rp. " . number_format($log_temp->nilai_transaksi, 2, ".", ",") : '' ?></td>
                                    <td><?php echo "Rp. " . number_format($log_temp->saldo_akhir, 2, ".", ",") ?></td>
                                    <td><?php echo $log_temp->jenis_transaksi ?></td>
                                </tr>
                                <?php } } else { ?>
                                <tr>
                                    <td colspan="6" style="text-align: center">Tidak ada histori transaksi</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </form>
</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>