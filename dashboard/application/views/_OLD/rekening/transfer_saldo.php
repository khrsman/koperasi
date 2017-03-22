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
$caption_title = "";
$var_ct = $this->uri->segment(2);
if($var_ct == "tabungan_virtual"){
    $caption_title = "Tabungan ke Virtual";
} else if($var_ct == "virtual_tabungan"){
    $caption_title = "Virtual ke Tabungan";
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Transfer Saldo <?php echo $caption_title ?>
        <small>Transfer Saldo antar Rekening</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_transfer">
        <div class="row">
            <div class="col-md-9">
                <?php if($this->session->flashdata('transfer_saldo_stat') == 'SUCCESS') { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Transfer Saldo Berhasil!</h4>
                    Pengiriman saldo antar rekening telah dilakukan...
                </div>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir pengisian transfer saldo</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <?php if($this->session->userdata('level') != 3){ ?>
	                        <?php if($var_ct == "tabungan_virtual") { ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nasabah_id">Pilih Rekening Nasabah Pengirim</label>
                                    <select id="nasabah_id" class="select_tabungan with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="tujuan_id">Pilih Rekening Nasabah Tujuan</label>
                                    <select id="tujuan_id" class="select_virtual with-ajax search-select" name="tujuan_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
	                        <?php } else if($var_ct == "virtual_tabungan") { ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nasabah_id">Pilih Rekening Nasabah Pengirim</label>
                                    <select id="nasabah_id" class="select_virtual with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="tujuan_id">Pilih Rekening Nasabah Tujuan</label>
                                    <select id="tujuan_id" class="select_tabungan with-ajax search-select" name="tujuan_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
	                        <?php } else { ?>
	                            <?php if($this->rekening_mod->id_koperasi) { ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="nasabah_id">Pilih Rekening Nasabah Pengirim</label>
                                        <select id="nasabah_id" class="selectpicker_from with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="tujuan_id">Pilih Rekening Nasabah Tujuan</label>
                                        <select id="tujuan_id" class="selectpicker_to with-ajax search-select" name="tujuan_id" data-live-search="true"></select>
                                    </div>
                                </div>
                            </div>
	                            <?php } else { ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="nasabah_id">Pilih Rekening Nasabah Pengirim</label>
                                        <select id="nasabah_id" class="selectpicker_all with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="tujuan_id">Pilih Rekening Nasabah Tujuan</label>
                                        <select id="tujuan_id" class="selectpicker_all with-ajax search-select" name="tujuan_id" data-live-search="true"></select>
                                    </div>
                                </div>
                            </div>
	                            <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="tujuan_id">Pilih Nasabah Tujuan Dari Daftar Rekening Favorit</label>
                                    <div id="rekening_favorit">
                                        <select id="tujuan_id" class="selectpicker" name="tujuan_id" data-live-search="true" title="Pilih dari Daftar Rekening Favorit">
                                            <?php foreach ($rekening_fav->result() as $rek_temp) { ?>
                                            <option value="<?php echo $rek_temp->no_rekening ?><?php echo $rek_temp->jenis_account == "TABUNGAN" ? "1" : ($rek_temp->jenis_account == "VIRTUAL" ? "2" : "3") ?>" data-subtext="<?php echo $rek_temp->no_rekening ?>"><?php echo strtoupper($rek_temp->nama_penerima) . ' - ' . $rek_temp->jenis_account ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nominal_transfer">Transfer Nominal</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="nominal_transfer" class="form-control" id="nominal_transfer">
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
                    <?php if($this->session->userdata('level') == 3){ ?>
                    <div class="box-body form-input-data">
                        <div class="row" style="margin-top: 5px">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group" style="margin:0">
                                    <label for="pin" style="display: none"></label>
                                    <input type="password" name="pin" class="form-control" id="pin" placeholder="PIN">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                Masukan PIN untuk keamanan transaksi dan pastikan pengisian informasi transfer saldo telah sesuai
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                Pastikan pengisian informasi transfer saldo telah sesuai
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
            url     : '<?php echo base_url() ?>rekening/cari_nasabah?status=active',
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

    $('.selectpicker_all').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    <?php if($this->session->userdata('level') == 3) { ?>
    $('.selectpicker_all').on('changed.bs.select', function (e) {
        var $this = $(this);
        if($this.val()){
            $('.selectpicker').val('').selectpicker('refresh');
            $("#tujuan_id").val($this.val());
            $('#favorit_check_id').prop('checked', false);
        }
    });
    <?php } ?>
    <?php if($this->session->userdata('level') == 3) { ?>
    $('#favorit_id').on('changed.bs.select', function (e) {
        var $this = $(this);
        if($this.val()){
            $("#tujuan_id").val($this.val());
        }
    });
    <?php } ?>

    var options = {
        ajax          : {
            url     : '<?php echo $this->rekening_mod->id_koperasi ? base_url() . "rekening/cari_nasabah?mod=from&is_koperasi=true&status=active" : base_url() . "rekening/cari_nasabah?mod=from&status=active" ?>',
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

    $('.selectpicker_from').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

    var options = {
        ajax          : {
            url     : '<?php echo base_url() ?>rekening/cari_nasabah?mod=to&status=active',
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

    $('.selectpicker_to').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

    var options = {
        ajax          : {
            url     : '<?php echo $this->rekening_mod->id_koperasi && $var_ct == "tabungan_virtual" ? base_url() . "rekening/cari_nasabah?mod=tabungan&is_koperasi=true&status=active" : base_url() . "rekening/cari_nasabah?mod=tabungan&status=active" ?>',
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
    <?php if($this->session->userdata('level') == 3) { ?>
    $('.select_tabungan').on('changed.bs.select', function (e) {
        var $this = $(this);
        if($this.val()){
            $('.selectpicker').val('').selectpicker('refresh');
            $("#tujuan_id").val($this.val());
            $('#favorit_check_id').prop('checked', false);
        }
    });
    <?php } ?>

    var options = {
        ajax          : {
            url     : '<?php echo $this->rekening_mod->id_koperasi && $var_ct == "virtual_tabungan" ? base_url() . "rekening/cari_nasabah?mod=virtual&is_koperasi=true&status=active" : base_url() . "rekening/cari_nasabah?mod=virtual&status=active" ?>',
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

    $('.select_virtual').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    <?php if($this->session->userdata('level') == 3) { ?>
    $('.select_virtual').on('changed.bs.select', function (e) {
        var $this = $(this);
        if($this.val()){
            $('.selectpicker').val('').selectpicker('refresh');
            $("#tujuan_id").val($this.val());
            $('#favorit_check_id').prop('checked', false);
        }
    });
    <?php } ?>
    $('select').trigger('change');
</script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
    $("#nominal_transfer").inputmask({ 
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
    $("#form_transfer").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_transfer_saldo<?php echo $this->uri->segment(2) ? "/" . $this->uri->segment(2,true) : "" ?>',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                        <?php if($this->session->userdata('level') == 3) { ?>
                            if(key == "tujuan_id"){
                                if($("#favorit_check_id").is(':checked')){
                                    $("#rekening_favorit").append('<span class="input-error">'+val+'</span>');
                                } else {
                                    $("label[for='tujuan_alias_id'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                                }
                            }
                        <?php } ?>
                    });
                    $this.find('button[type=submit]').html('Lakukan Transaksi');
                } else {
                    $this.find('button[type=submit]').html('Mohon Tunggu...');
                    location.reload();
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Memproses Transaksi...');
            }
        });

        return false;
    });
    <?php if($this->session->userdata('level') == 3) { ?>
    $("#favorit_check_id").bind('click', function(){
        var $this = $(this);
        if($this.is(':checked')){
            $('.selectpicker_all').val('').selectpicker('refresh');
            $('.select_virtual').val('').selectpicker('refresh');
            $('.select_tabungan').val('').selectpicker('refresh');
        }
    });
    <?php } ?>
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