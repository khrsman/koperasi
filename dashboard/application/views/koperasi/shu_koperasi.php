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
        Informasi SHU Koperasi "<?php echo $koperasi->nama ?>"
        <small>Sisa Hasil Usaha Koperasi</small>
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
            <div class="box box-primary" id="nasabah_result">
                <div class="box-header with-border">
                  <h3 class="box-title">SHU Pengeluaran Koperasi</h3>
                </div>
                <div class="box-body form-input-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <ul class="data-information">
                                <?php if ($shu_pengeluaran->num_rows() > 0) { ?>
                                <?php foreach ($shu_pengeluaran->result() as $shu_temp) { ?>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Biaya Transaksi <?php echo $shu_temp->jenis_biaya ?></p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_temp->biaya ? "Rp. " . number_format($shu_temp->biaya, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <?php } ?>
                                <?php } ?>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Pinjaman</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_pinjaman ? "Rp. " . number_format($shu_pinjaman->jumlah_pinjaman, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary" id="nasabah_result">
                <div class="box-header with-border">
                  <h3 class="box-title">SHU Pendapatan Koperasi</h3>
                </div>
                <div class="box-body form-input-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <ul class="data-information">
                                <?php if ($shu_pendapatan->num_rows() > 0) { ?>
                                <?php foreach ($shu_pendapatan->result() as $shu_temp) { ?>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Pendapatan Transaksi <?php echo $shu_temp->sumber_dana ?></p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_temp->nilai ? "Rp. " . number_format($shu_temp->nilai, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <?php } ?>
                                <?php } ?>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Deposito</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_deposito ? "Rp. " . number_format($shu_deposito->jumlah_deposito, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Angsuran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_angsuran ? "Rp. " . number_format($shu_angsuran->jumlah_setoran, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Denda Angsuran</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_angsuran ? "Rp. " . number_format($shu_angsuran->jumlah_denda, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Notaris</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_pinjaman ? "Rp. " . number_format($shu_pinjaman->potongan_notaris, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Premi</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_pinjaman ? "Rp. " . number_format($shu_pinjaman->potongan_premi, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Materai</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_pinjaman ? "Rp. " . number_format($shu_pinjaman->potongan_materai, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Tab Wajib</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_pinjaman ? "Rp. " . number_format($shu_pinjaman->potongan_tab_wajib, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan Administrasi</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_pinjaman ? "Rp. " . number_format($shu_pinjaman->potongan_adm, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                                <li class="row">
                                    <p class="col-xs-5 col-md-5 no-padding">Potongan CR</p>
                                    <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $shu_pinjaman ? "Rp. " . number_format($shu_pinjaman->potongan_cr, 2, ".", ",") : "-" ?></span></b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tmpl.min.js"></script>
<!--tambahkan custom js disini-->
<script>
$(document).ready(function(){
    $('#transaction_log').on('show.bs.modal', function (event) {
        var $elm = $(event.relatedTarget);
        var no_transaksi = $elm.data('id');
        var modal = $(this);

        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_info_transaksi',
            data: {no_transaksi: no_transaksi},
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode > 0){
                    
                } else {
                    modal.find('.modal-body').html(tmpl('tmpl-log-transaction', data.data));
                }
            },
            beforeSend: function(data){
                modal.find('.modal-body').html('');
            }
        });
    });
});
</script>
<?php
$this->load->view('template/foot');
?>