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
        Ubah Status Rekening
        <small>Perubahan Status Rekening Nasabah</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_blokir_tutup">
        <div class="row">
            <div class="col-md-9">
                <div class="alert alert-success alert-dismissible hide" id="notification_success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Perubahan Status Rekening Berhasil!</h4>
                    Perubahan status rekening nasabah <span id="view_nasabah_profile"></span> telah disimpan.
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir pengisian perubahan status rekening nasabah</h3>
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
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div id="info_nasabah" class="data-loaded-info hide">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="status_rekening">Pilih Status Rekening</label>
                                    <select name="status_rekening" class="form-control" id="status_rekening">
                                        <option value="">...</option>
                                        <option value="ACTIVE">Aktifkan Rekening</option>
                                        <option value="BLOCKED">Blokir Rekening</option>
                                        <option value="CLOSED">Tutup Rekening</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Konfirmasi Perubahan</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                Perubahan pada status rekening akan mengubah status pada semua jenis rekening nasabah
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary full-width">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section><!-- /.content -->
<script id="tmpl-nasabah-info" type="text/x-tmpl">
{% if(o) { %}
    <ul class="data-information">
        <li class="row">
            <p class="col-xs-5 col-md-5 no-padding">ID Nasabah</p>
            <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.no_rekening %}</b></p>
        </li>
        <li class="row">
            <p class="col-xs-5 col-md-5 no-padding">Atas Nama Pemilik</p>
            <p class="col-xs-7 col-md-7 no-padding"><b><a href="{%= '<?php echo base_url() ?>nasabah/' + o.nasabah_id %}" id="nasabah_profile">{%# o.nama_nasabah %}</a></b></p>
        </li>
        <li class="row">
            <p class="col-xs-5 col-md-5 no-padding">Koperasi</p>
            <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.koperasi %}</span></b></p>
        </li>
        <li class="row">
            <p class="col-xs-5 col-md-5 no-padding">Saldo Terakhir</p>
            <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.saldo %}</span></b></p>
        </li>
        <li class="row">
            <p class="col-xs-5 col-md-5 no-padding">Status Rekening Saat Ini</p>
            <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.status_rekening %}</span></b></p>
        </li>
        <li class="row">
            <p class="col-xs-5 col-md-5 no-padding">Waktu Transaksi Terakhir</p>
            <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.tanggal_transaksi_terakhir %}</span></b></p>
        </li>
    </ul>   
{% } %}
</script>
<script id="tmpl-nasabah-error" type="text/x-tmpl">
{% if(o) { %}
    <div class="error-msg">
        {%= o %}
    </div>
{% } %}
</script>
<script id="tmpl-nasabah-loading" type="text/x-tmpl">
    <div class="progress" style="margin-bottom:10px">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
            LOADING DATA NASABAH...
        </div>
    </div>
</script>
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tmpl.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ajax-bootstrap-select.js"></script>
<script>
    var options = {
        ajax          : {
            url     : '<?php echo $this->rekening_mod->id_koperasi ? base_url() . "rekening/cari_nasabah?mod=tabungan&is_koperasi=true" : base_url() . "rekening/cari_nasabah?mod=tabungan" ?>',
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
    $('.select_tabungan').on('changed.bs.select', function (e) {
        var $this = $(this);
        if($this.val()){
            var json_data = {
                nasabah_id: $this.val()
            };
            $.ajax({
                url: '<?php echo base_url() ?>rekening/ajax_info_nasabah',
                data: json_data,
                dataType: 'JSON',
                type: 'POST',
                success: function(data){
                    if(data.errorcode > 0){
                        $("#info_nasabah").html(tmpl('tmpl-nasabah-error', data.msg)).removeClass('hide');
                        $("form_blokir_tutup").find('button[type=submit]').attr('disabled', 'disabled').html('Simpan Perubahan');
                    } else {
                        $("#info_nasabah").html(tmpl('tmpl-nasabah-info', data.data)).removeClass('hide');
                        $("form_blokir_tutup").find('button[type=submit]').removeAttr('disabled').html('Simpan Perubahan');
                    }
                },
                beforeSend: function(data){
                    $("#info_nasabah").html(tmpl('tmpl-nasabah-loading')).removeClass('hide');
                    $("form_blokir_tutup").find('button[type=submit]').attr('disabled', 'disabled');
                }
            });
        }
    });
    $('select').trigger('change');
</script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
    $("#form_blokir_tutup").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_ubah_status',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Simpan Perubahan');
                } else {
                    $("#view_nasabah_profile").html($("#nasabah_profile"));
                    $("#notification_success").removeClass('hide');
                    $("#info_nasabah").html('').addClass('hide');
                    $('.select_tabungan').val('').selectpicker('refresh');
                    $this.find('button[type=submit]').html('Simpan Perubahan');
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Menyimpan Perubahan...');
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