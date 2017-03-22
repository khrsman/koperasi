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
        Informasi Rekening Pinjaman
        <small>Histori dan Detail Rekening Pinjaman & Angsuran</small>
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
                      <h3 class="box-title">Informasi Rekening Pinjaman</h3>
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
                      <h3 class="box-title">Rekening Pinjaman Nasabah</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Nomor Rekening Pinjaman</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->no_rekening_pinjaman ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jenis Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span>Pinjaman</span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Status Angsuran</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->tanggal_lunas ? "LUNAS" : "BELUM LUNAS" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jumlah Pinjaman</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b>Rp. <span><?php echo number_format($rek_temp->jumlah_pinjaman, 2, ".", ",") ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Tanggal Pencairan Pinjaman</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->tanggal_pencairan ? $rek_temp->tanggal_pencairan : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jumlah Angsuran</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->jumlah_angsuran ? $rek_temp->jumlah_angsuran : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Periode Pembayaran Angsuran</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->periode_jumlah ? $rek_temp->periode_jumlah . " / " . $rek_temp->periode_waktu : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Tanggal Tagihan</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->tanggal_tagihan ? $rek_temp->tanggal_tagihan : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Tanggal Jatuh Tempo</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->tanggal_jatuh_tempo ? $rek_temp->tanggal_jatuh_tempo : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Lama Penangguhan Pembayaran</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->grace_period ? $rek_temp->grace_period . " " . $rek_temp->periode_waktu : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Margin Persen</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->margin_persen ? $rek_temp->margin_persen . " %" : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Margin Rupiah</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->margin_rupiah ? "Rp. " . number_format($rek_temp->margin_rupiah, 2, ".", ",") : '-' ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Potongan Notaris</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->potongan_notaris ? "Rp. " . number_format($rek_temp->potongan_notaris, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Potongan Premi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->potongan_premi ? "Rp. " . number_format($rek_temp->potongan_premi, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Potongan Tab Wajib</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->potongan_tab_wajib ? "Rp. " . number_format($rek_temp->potongan_tab_wajib, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Potongan Materai</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->potongan_materai ? "Rp. " . number_format($rek_temp->potongan_materai, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Potongan CR</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->potongan_cr ? "Rp. " . number_format($rek_temp->potongan_cr, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Potongan Administrasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->potongan_adm ? "Rp. " . number_format($rek_temp->potongan_adm, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jumlah Terima</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->jumlah_terima ? "Rp. " . number_format($rek_temp->jumlah_terima, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Sisa Angsuran</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->sisa_angsuran ? $rek_temp->sisa_angsuran : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Sisa Angsuran Pokok</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->sisa_angsuran_pokok ? "Rp. " . number_format($rek_temp->sisa_angsuran_pokok, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Sisa Angsuran Bunga</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->sisa_angsuran_bunga ? "Rp. " . number_format($rek_temp->sisa_angsuran_bunga, 2, ".", ",") : "-" ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Status Realisasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $rek_temp->sisa_angsuran_bunga == "Y" ? "Sudah Direalisasikan" : "Belum Direalisasikan" ?></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary" id="tabungan_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Histori Transaksi Angsuran</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th class="center">Waktu</th>
                                    <th class="center">Angsuran Ke-</th>
                                    <th>Jumlah Setoran</th>
                                    <th>Jumlah Denda</th>
                                    <th>Jumlah Bunga</th>
                                    <th>Keterangan</th>
                                </tr>
                                <?php if($log_rekening->num_rows() > 0) { foreach ($log_rekening->result() as $log_temp) { ?>
                                <tr>
                                    <td class="center"><?php echo $log_temp->tanggal_bayar ?></td>
                                    <td class="center"><?php echo $log_temp->angsuran_ke ?></td>
                                    <td><?php echo $log_temp->jumlah_setoran ? "Rp. " . number_format($log_temp->jumlah_setoran, 2, ".", ",") : '-' ?></td>
                                    <td><?php echo $log_temp->jumlah_denda ? "Rp. " . number_format($log_temp->jumlah_denda, 2, ".", ",") : '-' ?></td>
                                    <td><?php echo $log_temp->jumlah_bunga ? "Rp. " . number_format($log_temp->jumlah_bunga, 2, ".", ",") : '-' ?></td>
                                    <td><?php echo $log_temp->keterangan ?></td>
                                </tr>
                                <?php } } else { ?>
                                <tr>
                                    <td colspan="7" style="text-align: center">Tidak ada histori transaksi</td>
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
<div class="modal fade" id="transaction_log" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" name="nasabah_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Detail Transaksi</h4>
            </div>
            <div class="modal-body no-padding">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script id="tmpl-log-transaction" type="text/x-tmpl">
{% if(o) { %}
    <div class="form-input-data">
        <ul class="data-information transaction-log-top">
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Nomor Transaksi</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.no_transaksi %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Waktu Transaksi</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.waktu_transaksi %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Jenis Transaksi</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.jenis_transaksi %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Saldo Sebelum Transaksi</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.saldo_awal %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Nilai Transaksi</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.nilai_transaksi %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Saldo Setelah Transaksi</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.saldo_akhir %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Dioperasikan Oleh</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.nama_operator %}</span></b></p>
            </li>
        </ul>
        {% if(o.sumber_dana == "TUNAI") { %}
        <ul class="data-information transaction-log-bottom">
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Atas Nama Pengirim</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.nama %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">No Identitas KTP</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.no_ktp ? o.pihak_kedua.no_ktp : "-" %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Jumlah Nominal Setoran</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.jumlah_dana %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Berita Acara</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.berita_acara ? o.pihak_kedua.berita_acara : "-" %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Nomor Telepon</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.no_telepon ? o.pihak_kedua.no_telepon : "-" %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Email</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.email ? o.pihak_kedua.email : "-" %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Alamat Pengirim</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.alamat ? o.pihak_kedua.alamat : "-" %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Keterangan Lainnya</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.keterangan ? o.pihak_kedua.keterangan : "-" %}</span></b></p>
            </li>
        </ul>
        {% } else { %}
        <ul class="data-information transaction-log-bottom">
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Nomor Rekening Pihak Kedua</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.no_rekening %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Atas Nama Nasabah</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%# o.pihak_kedua.nama_nasabah %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Jenis Rekening</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.jenis_rekening %}</span></b></p>
            </li>
            <li class="row">
                <p class="col-xs-5 col-md-5 no-padding">Koperasi</p>
                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.pihak_kedua.koperasi %}</span></b></p>
            </li>
        </ul>
        {% } %}
    </div>
{% } %}
</script>
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