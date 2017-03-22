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
        Cek Saldo
        <small>Pengecekan Saldo Rekening Nasabah</small>
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
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir pengecekan rekening saldo</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nasabah_id">Masukan Identitas Rekening Nasabah</label>
                                    <select id="nasabah_id" class="selectpicker with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary hide" id="check_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Hasil Pengecekan Nasabah</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Nomor Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding">
                                            <b><a href="" id="res_no_rekening">-</a></b>
                                        </p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Atas Nama Pemilik</p>
                                        <p class="col-xs-7 col-md-7 no-padding">
                                            <b><a href="" id="res_nama_nasabah">-</a></b>
                                        </p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Jenis Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding">
                                            <b><span id="res_jenis_rekening">-</span></b>
                                        </p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Koperasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span id="res_nama_koperasi">-</span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Saldo Rekening</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b>Rp. <span id="res_saldo">0.00</span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Transaksi Terakhir</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span id="res_transaksi_terakhir">-</span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Histori Transaksi</p>
                                        <p class="col-xs-7 col-md-7 no-padding">
                                            <b><a href="" id="res_lihat_histori">Lihat Histori Transaksi</a></b>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Konfirmasi Pengecekan</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                Pastikan pengisian informasi pengecekan saldo telah sesuai
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary full-width">Cek Saldo</button>
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
            url     : '<?php echo base_url() ?>rekening/cari_nasabah_all_rek',
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

    $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    $('select').trigger('change');
</script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
    $("#form_cek_saldo").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_cek_saldo',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Cek Saldo');
                } else {
                    $this.find('button[type=submit]').html('Cek Saldo');

                    if(data.data){
                        $("#res_no_rekening").html(data.data.no_rekening).attr('href', data.data.nasabah_link);                        
                        $("#res_jenis_rekening").html(data.data.jenis_rekening);                        
                        $("#res_saldo").html(data.data.saldo);                        
                        $("#res_nama_nasabah").html(data.data.nama_nasabah).attr('href', data.data.nasabah_link);
                        $("#res_nama_koperasi").html(data.data.nama_koperasi);
                        $("#res_lihat_histori").attr('href', data.data.rekening_link);
                        if(data.data.tanggal_transaksi_terakhir)          
                            $("#res_transaksi_terakhir").html(data.data.tanggal_transaksi_terakhir);                        
                        else
                            $("#res_transaksi_terakhir").html('-');                        
                    }
                    $("#check_result").removeClass('hide');
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $("#check_result").addClass('hide');
                $this.find('button[type=submit]').html('Memproses Pengecekan...');
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