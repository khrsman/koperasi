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
        Informasi Rekening Nasabah
        <small>Histori dan Detail Rekening Nasabah</small>
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
                <?php if($this->session->flashdata('register_rek_stat') == 'SUCCESS') { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Penyimpanan Berhasil!</h4>
                    Pembukaan rekening nasabah telah disimpan... Klik <a href="<?php echo base_url() ?>buka_rekening">disini</a> untuk kembali ke halaman pendaftaran nasabah.
                </div>
                <?php } $this->session->set_flashdata('register_rek_stat', 'DONE'); ?>
            
            

                <?php if($rekening_tabungan->num_rows() > 0) { $rek_temp = $rekening_tabungan->row();?>
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
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Tanggal Registrasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->tanggal_registrasi ?></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
      
            </div>

            <div class="col-md-4">
                <div class="box box-primary" id="tabungan_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Rekening Tabungan Nasabah</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Nomor Rekening Tabungan</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->no_rekening ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jenis Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span>Tabungan</span></b></p>
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
                                        <p class="col-xs-5 col-md-5 no-padding">Histori Transaksi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><a href="<?php echo base_url() .'nasabah/'. $rek_temp->id_user . '/tabungan/' . $rek_temp->no_rekening ?>">Lihat Histori Transaksi</a></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <?php if($rekening_virtual->num_rows() > 0) { $rek_temp = $rekening_virtual->row();?>
                <div class="box box-danger" id="virtual_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Rekening Virtual Nasabah</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Nomor Rekening Tabungan</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->no_rekening_virtual ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jenis Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span>Virtual</span></b></p>
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
                                        <p class="col-xs-5 col-md-5 no-padding">Histori Transaksi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><a href="<?php echo base_url() .'nasabah/'. $rek_temp->id_user . '/virtual/' . $rek_temp->no_rekening_virtual ?>">Lihat Histori Transaksi</a></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <?php if($rekening_loyalti->num_rows() > 0) { 
                    $total = 0; foreach ($rekening_loyalti->result() as $rek_temp) { $total = $total + $rek_temp->saldo;};?>
                <div class="box box-success" id="insurance_result">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rekening Loyalti <?php echo $rek_temp->jenis_rekening ?> Nasabah</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Status Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->status_rekening ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Saldo Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b>Rp. <span><?php echo number_format($total, 2, ".", ",") ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Histori Transaksi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><a href="<?php echo base_url() .'nasabah/'. $rek_temp->id_user . '/loyalti/' . $rek_temp->no_rekening_loyalti ?>">Lihat Histori Transaksi</a></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  } ?>
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