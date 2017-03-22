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
        Pembuatan Rekening Deposito
        <small>Pembuatan Rekening Deposito</small>
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
                <?php if($this->session->flashdata('rekening_deposito_stat')) { $rek_temp = $this->session->flashdata('rekening_deposito_stat'); ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Pembuatan Rekening Deposito Berhasil!</h4>
                    Pembuatan rekening deposito baru telah dibuat dengan nomor rekening <?php echo $rek_temp['no_rekening_deposito'] ?> dengan jumlah deposito sebesar Rp. <?php echo number_format($rek_temp['jumlah_deposito'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>rekening_deposito">disini</a> untuk melihat rekening deposit lainnya.
                </div>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir isian pembuatan rekening deposito</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nasabah_id">Pilih Rekening Nasabah</label>
                                    <select id="nasabah_id" class="select_tabungan with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-7 col-lg-7">
                                <div class="form-group">
                                    <label for="jumlah_deposito">Nominal Jumlah Deposito</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="jumlah_deposito" class="form-control" id="jumlah_deposito">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-lg-5">
                                <div class="form-group">
                                    <label for="jangka_waktu">Jangka Waktu (dalam Bulan)</label>
                                    <input type="number" name="jangka_waktu" class="form-control" id="jangka_waktu">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_register">Tanggal Register</label>
                                    <input type="date" name="tanggal_register" class="form-control" id="tanggal_register" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" id="tanggal_jatuh_tempo" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="no_bilyet">Nomor Bilyet</label>
                                    <input type="text" name="no_bilyet" class="form-control" id="no_bilyet">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-lg-3">
                                <div class="form-group">
                                    <label for="margin_rupiah">Margin Rupiah</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="margin_rupiah" class="form-control" id="margin_rupiah">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-lg-3">
                                <div class="form-group">
                                    <label for="margin_persen">Margin Persen</label>
                                    <div class="input-group">
                                        <input type="text" name="margin_persen" class="form-control" id="margin_persen">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="perlakuan_jatuh_tempo">Perlakuan Jatuh Tempo</label>
                                    <select name="perlakuan_jatuh_tempo" id="perlakuan_jatuh_tempo" class="form-control">
                                        <option value="TUNAI">TUNAI</option>
                                        <option value="OB_TABUNGAN">OB TABUNGAN</option>
                                        <option value="ARO">ARO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="perlakuan_margin_perbulan">Perlakuan Margin Perbulan</label>
                                    <select name="perlakuan_margin_perbulan" id="perlakuan_margin_perbulan" class="form-control">
                                        <option value="OB_TUNAI">OB TUNAI</option>
                                        <option value="OB_DEPOSITO">OB TABUNGAN</option>
                                        <option value="OB_TABUNGAN">OB TABUNGAN</option>
                                        <option value="OB_TITIPAN">OB TITIPAN</option>
                                    </select>
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
                                Pastikan pengisian pembuatan rekening deposito nasabah sudah sesuai
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
            url     : '<?php echo $this->rekening_mod->id_koperasi ? base_url() . "rekening/cari_nasabah?mod=tabungan&is_koperasi=true&status=active" : base_url() . "rekening/cari_nasabah?mod=tabungan&status=active" ?>',
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
            emptyTitle: 'Ketikan Nama, ID, atau No Rekening Anggota...',
            errorText: 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder: 'Ketikan Nama, ID, atau No Rekening Anggota...',
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

    $('.select_tabungan').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    $('select').trigger('change');
</script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
    $("#jumlah_deposito, #margin_rupiah").inputmask({ 
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
    $("#margin_persen").inputmask("decimal",{
        radixPoint:".",
        digits: 2,
        autoGroup: true,
        placeholder: "0", 
        max: 100,
        min: 0
    });
    $("#form_deposito").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_register_deposito',
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
                    window.location.href = '<?php echo base_url() ?>buat_rekening_deposito/success';
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Memproses Transaksi...');
            }
        });

        return false;
    })
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