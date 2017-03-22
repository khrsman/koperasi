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
        Pembayaran Angsuran
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
    <form role="form" id="form_deposito">
        <div class="row">
            <div class="col-md-9">
                <?php if($this->session->flashdata('pembayaran_angsuran_stat')) { $rek_temp = $this->session->flashdata('pembayaran_angsuran_stat'); ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Pembayaran Angsuran Pinjaman Berhasil!</h4>
                    Pembayaran angsuran pinjaman untuk nomor rekening pinjaman <?php echo $rek_temp['no_rekening_pinjaman'] ?> dengan jumlah setoran angsuran sebesar sebesar Rp. <?php echo number_format($rek_temp['jumlah_setoran'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>rekening_pinjaman">disini</a> untuk melihat rekening pinjaman lainnya.
                </div>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir isian pembayaran angsuran pinjaman</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nasabah_id">Pilih Rekening Pinjaman</label>
                                    <select id="nasabah_id" class="select_pinjaman with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="jumlah_setoran">Nominal Setoran Angsuran</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="jumlah_setoran" class="form-control" id="jumlah_setoran">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_bayar">Tanggal Pembayaran</label>
                                    <input type="date" name="tanggal_bayar" class="form-control" id="tanggal_bayar" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="checkbox">
                                    <label for="get_charge">
                                        <input type="checkbox" name="get_charge" value="Y" id="get_charge">
                                        Kenai denda pembayaran angsuran?
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 hide" id="charge_canvas">
                                <div class="form-group">
                                    <label for="jumlah_denda">Nominal Jumlah Denda</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="jumlah_denda" class="form-control" id="jumlah_denda">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="checkbox">
                                    <label for="pelunasan">
                                        <input type="checkbox" name="pelunasan" value="Y" id="pelunasan">
                                        Transaksi untuk pelunasan angsuran?
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 hide" id="lunas_canvas">
                                <div class="form-group">
                                    <label for="diskon">Diskon Pelunasan Angsuran</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="diskon" class="form-control" id="diskon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Konfirmasi Transaksi</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                Pastikan pengisian pembayaran angsuran pinjaman nasabah sudah sesuai
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary full-width">Lakukan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/inputmask.numeric.extensions.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ajax-bootstrap-select.js"></script>
<script>
    var options = {
        ajax          : {
            url     : '<?php echo $this->rekening_mod->id_koperasi ? base_url() . "rekening/cari_nasabah?mod=pinjaman&is_koperasi=true&status=active" : base_url() . "rekening/cari_nasabah?mod=pinjaman&status=active" ?>',
            type    : 'POST',
            dataType: 'json',
            // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
            // automatically replace it with the value of the search query.
            data    : {
                keyword: '{{{q}}}'
            }
        },
        locale        : {
            currentlySelected: 'Saat ini dipilih',
            emptyTitle: 'Ketikan Nama, ID, atau No Rekening Pinjaman...',
            errorText: 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder: 'Ketikan Nama, ID, atau No Rekening Pinjaman...',
            statusInitialized: 'Lakukan pencarian nasabah',
            statusNoResults: 'Pencarian tidak ditemukan',
            statusSearching: 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data.data[i], {
                        text : data.data[i].fullname + ' (' + data.data[i].username + ')' + ' - ' + data.data[i].jenis_rekening,
                        value: data.data[i].no_rekening + data.data[i].id_jenis_rekening,
                        data : {
                            subtext: data.data[i].no_rekening
                        }
                    }));
                }
            }
            // You must always return a valid array when processing data. The
            // data argument passed is a clone and cannot be modified directly.
            return array;
        }
    };

    $('.select_pinjaman').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    $('select').trigger('change');
</script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
    $("#jumlah_denda, #jumlah_setoran").inputmask({ 
        alias: "numeric",
        radixPoint: '.', 
        placeholder: "0", 
        autoGroup: !0, 
        digits: 0, 
        groupSeparator: ',', 
        groupSize: 3, 
        repeat: 10, 
        clearMaskOnLostFocus: !1 
    });
    $("#form_deposito").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_bayar_angsuran',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Lakukan Transaksi');
                } else {
                    $this.find('button[type=submit]').html('Mohon Tunggu...');
                    window.location.href = '<?php echo base_url() ?>bayar_angsuran/success';
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Memproses Transaksi...');
            }
        });

        return false;
    });
    $('#get_charge').prop('checked', false);
    $('#pelunasan').prop('checked', false);
    $('#get_charge').change(function() {
        if($(this).is(":checked")) {
            $("#charge_canvas").removeClass('hide');
        } else {
            $("#charge_canvas").addClass('hide');
        }
    });
    $('#pelunasan').change(function() {
        if($(this).is(":checked")) {
            $("#lunas_canvas").removeClass('hide');
        } else {
            $("#lunas_canvas").addClass('hide');
        }
    });
});
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
</script>
<?php
$this->load->view('template/foot');
?>