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
        Pembuatan Rekening Kredit Cicilan
        <small>Pembuatan Rekening Kredit Cicilan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_kredit_cicilan">
        <div class="row">
            <div class="col-md-9">
                <?php if($this->session->flashdata('rekening_kredit_cicilan_stat')) { $rek_temp = $this->session->flashdata('rekening_kredit_cicilan_stat'); ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Pembuatan Rekening Kredit Cicilan Berhasil!</h4>
                    Pembuatan rekening kredit cicilan baru telah dibuat dengan nomor rekening <?php echo $rek_temp['no_rekening_kredit'] ?> dengan jumlah kredit cicilan sebesar Rp. <?php echo number_format($rek_temp['jumlah_kredit'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>rekening_kredit_cicilan">disini</a> untuk melihat rekening kredit cicilan lainnya.
                </div>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir isian pembuatan rekening kredit cicilan</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nasabah_id">Pilih Calon Nasabah</label>
                                    <select id="nasabah_id" class="selectpicker with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-7 col-lg-7">
                                <div class="form-group">
                                    <label for="jumlah_kredit_cicilan">Nominal Jumlah Kredit</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="jumlah_kredit_cicilan" class="form-control" id="jumlah_kredit_cicilan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-lg-5">
                                <div class="form-group">
                                    <label for="tanggal_kredit">Tanggal Kredit</label>
                                    <input type="date" name="tanggal_kredit" class="form-control" id="tanggal_kredit" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="ket_kredit">Keterangan Kredit</label>
                                    <input type="text" name="ket_kredit" class="form-control" id="ket_kredit">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-lg-3">
                                <div class="form-group">
                                    <label for="jumlah_angsuran">Jumlah Angsuran</label>
                                    <input type="number" name="jumlah_angsuran" class="form-control" id="jumlah_angsuran">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-lg-3">
                                <div class="form-group">
                                    <label for="tanggal_tagihan">Tanggal Tagihan</label>
                                    <input type="number" name="tanggal_tagihan" class="form-control" id="tanggal_tagihan">
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
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="periode_jumlah">Periode Angsuran</label>
                                    <div class="input-group">
                                        <input type="number" name="periode_jumlah" class="form-control" id="periode_jumlah">
                                        <span class="input-group-addon">Kali</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="periode_waktu">&nbsp;</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">per</span>
                                        <select name="periode_waktu" id="periode_waktu" class="form-control">
                                            <option value="HARI">HARI</option>
                                            <option value="TAHUN">TAHUN</option>
                                            <option value="BULAN">BULAN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="grace_period">Lama Penangguhan Pembayaran</label>
                                    <input type="number" name="grace_period" class="form-control" id="grace_period">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="margin_rupiah">Margin Rupiah</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="margin_rupiah" class="form-control" id="margin_rupiah">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="margin_persen">Margin Persen</label>
                                    <div class="input-group">
                                        <input type="text" name="margin_persen" class="form-control" id="margin_persen">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Informasi Jaminan Kredit Cicilan</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <label>Upload Jaminan Kredit Cicilan.</label><br/>
                                <div class="caption-label">Format gambar yang diijinkan dalam bentuk JPG, JPEG, PNG, GIF (Max. 2MB)</div>
                            </div>
                            <div class="attached-photos" id="jaminan"></div>
                            <div class="form-group col-xs-12 col-sm-6 col-lg-3">
                                <button onclick="add_photo();" type="button" class="">
                                    <i class="fa fa-upload" style="margin-right: 10px"></i> Tambahkan Jaminan
                                </button>
                            </div>
                            <div class="upload-error hide" id="scan_ktp_notification"></div>
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
                                Pastikan pengisian pembuatan rekening kredit cicilan nasabah sudah sesuai
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
    <div class="upload-user-photo" style="display:none">
        <form method="POST" action="" id="upload_user_photo" enctype="multipart/form-data">
            <input style="display:none;" type="file" name="user_photo" multiple="" id="attach-user-photo">
        </form>
    </div>
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
            url     : '<?php echo base_url() ?>rekening/cari_anggota',
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
            emptyTitle: 'Masukan Nama atau ID Anggota',
            errorText: 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder: 'Ketikan Nama, ID, atau Username Anggota...',
            statusInitialized: 'Lakukan pencarian anggota',
            statusNoResults: 'Pencarian tidak ditemukan',
            statusSearching: 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data.data[i], {
                        text : data.data[i].fullname + ' (' + data.data[i].username + ')',
                        value: data.data[i].id_user,
                        data : {
                            subtext: data.data[i].id_user
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
    $("#jumlah_kredit_cicilan, #margin_rupiah, #potongan_adm, #potongan_cr, #potongan_materai, #potongan_premi, #potongan_notaris, #potongan_tab_wajib").inputmask({ 
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
    $("#form_kredit_cicilan").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_register_kredit_cicilan',
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
                    window.location.href = '<?php echo base_url() ?>buat_rekening_kredit_cicilan/success';
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Memproses Transaksi...');
            }
        });

        return false;
    });

    // Initialize the jQuery File Upload widget:
    $('#upload_user_photo').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '<?php echo base_url() ?>rekening/ajax_upload_jaminan',
        maxFileSize: 2000000 //2MB,
    });

    // Enable iframe cross-domain access via redirect option:
    $('#upload_user_photo').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    )
    .bind('fileuploadadd', function(e, data){
        data.submit();
    })
    .bind('fileuploaddone', function (e, data) {
        $(".progress .bar").css("width", "0%");
        if(data.result.errorcode > 0){
            $("#scan_ktp_notification").html(data.result.msg).removeClass('hide');
        } else {
            $("#jaminan").append(tmpl('tmpl-attached-photo', data.result.data));
            $("#scan_ktp_notification").html("").addClass('hide');
            $(".remove-uploaded-photo").unbind().bind('click', function(e){
                e.preventDefault();
                var $this = $(this);
                $this.parents('.canvas_ap').remove();
            });
            // $(".remove-uploaded-photo").removeClass('hide');
            // $('#button_scan_ktp').css("background-image", "url(" + data.result.data.url + ")");
        }
    });

    // Load existing files:
    $('#upload_user_photo').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#upload_user_photo').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#upload_user_photo')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, null, {result: result});
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
function add_photo(){
    document.getElementById("attach-user-photo").click();
}
</script>
<script id="tmpl-attached-photo" type="text/x-tmpl">
{% if(o) { %}
<div class="row canvas_ap" style="margin-right: 5px;margin-left: 15px;margin-bottom: 15px;">
    <div class=" attached-photo col-xs-12 col-sm-6 col-lg-3">
        <img src="{%= o.url %}" class="uploaded-photo"/>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-9">
        <input type="text" name="desk_jaminan[]" class="form-control" value="">
        <a class="remove-uploaded-photo">hapus</a>
        <input type="hidden" value="{%= o.name %}" name="foto_jaminan[]">
    </div>
</div>
{% } %}
</script>
<script id="template-upload" type="text/x-tmpl">
</script>
<script id="template-download" type="text/x-tmpl">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tmpl.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/load-image.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/vendor/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload-process.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload-image.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload-audio.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload-audio.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload-video.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload-validate.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blueimp/jquery.fileupload-ui.js"></script>
<?php
$this->load->view('template/foot');
?>