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
        Pembukaan Rekening
        <small>Pembukaan Rekening Anggota</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_customer">
        <div class="row">
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir isian pembuatan rekening anggota</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="nasabah_id">Pilih Calon Nasabah</label>
                                    <select id="nasabah_id" class="selectpicker with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                  <label for="tgl_register">Tanggal Pendaftaran</label>
                                  <input type="date" name="tgl_register" class="form-control" id="tgl_register" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="saldo_min">Saldo Minimum</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="saldo_min" class="form-control" id="saldo_min" placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="setoran_min">Setoran Awal</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="setoran_min" class="form-control" id="setoran_min">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="setoran_pokok">Setoran Pokok</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="setoran_pokok" class="form-control" id="setoran_pokok">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="setoran_wajib">Setoran Wajib per Bulan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="setoran_wajib" class="form-control" id="setoran_wajib">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="setoran_virtual">Isi Rekening Virtual (Opsional)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="setoran_virtual" class="form-control" id="setoran_virtual">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="exTab3">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#1b" data-toggle="tab">Informasi Keuangan Anggota</a>
                            </li>
                            <li>
                                <a href="#2b" data-toggle="tab">Scan Identitas(KTP) Anggota</a>
                            </li>
                        </ul>
                        <div class="tab-content form-input-data clearfix">
                            <div class="tab-pane active" id="1b">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="tujuan_pembukaan_rekening_tab">Tujuan Pembukaan Rekening Tabungan</label>
                                            <input type="text" name="tujuan_pembukaan_rekening_tab" class="form-control" id="tujuan_pembukaan_rekening_tab">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="penghasilan_utama">Penghasilan Utama Per Tahun</label>
                                            <input type="text" name="penghasilan_utama" class="form-control" id="penghasilan_utama">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="kode_sumber_penghasilan">Sumber Penghasilan</label>
                                            <select name="kode_sumber_penghasilan" class="form-control" id="kode_sumber_penghasilan">
                                            <option value="">...</option>
                                            <?php foreach($sumber_penghasilan->result() as $res_temp) { ?>
                                                <option value="<?php echo $res_temp->id_sumber_penghasilan ?>"><?php echo $res_temp->deskripsi ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="kode_pemasukan_per_bulan">Pemasukan Per Bulan</label>
                                            <select name="kode_pemasukan_per_bulan" class="form-control" id="kode_pemasukan_per_bulan">
                                            <option value="">...</option>
                                            <?php foreach($pemasukan_per_bulan->result() as $res_temp) { ?>
                                                <option value="<?php echo $res_temp->id_pemasukan_per_bulan ?>"><?php echo $res_temp->deskripsi ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="kode_frek_pemasukan_per_bulan">Frekuensi Transaksi Pemasukan</label>
                                            <select name="kode_frek_pemasukan_per_bulan" class="form-control" id="kode_frek_pemasukan_per_bulan">
                                            <option value="">...</option>
                                            <?php foreach($frek_pemasukan_per_bulan->result() as $res_temp) { ?>
                                                <option value="<?php echo $res_temp->id_frek_pemasukan ?>"><?php echo $res_temp->deskripsi ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="kode_pengeluaran_per_bulan">Pengeluaran Per Bulan</label>
                                            <select name="kode_pengeluaran_per_bulan" class="form-control" id="kode_pengeluaran_per_bulan">
                                            <option value="">...</option>
                                            <?php foreach($pengeluaran_per_bulan->result() as $res_temp) { ?>
                                            <option value="<?php echo $res_temp->id_pengeluaran_per_bulan ?>"><?php echo $res_temp->deskripsi ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="kode_frek_pengeluaran_per_bulan">Frekuensi Transaksi Pengeluaran</label>
                                            <select name="kode_frek_pengeluaran_per_bulan" class="form-control" id="kode_frek_pengeluaran_per_bulan">
                                            <option value="">...</option>
                                            <?php foreach($frek_pengeluaran_per_bulan->result() as $res_temp) { ?>
                                                <option value="<?php echo $res_temp->id_frek_pengeluaran ?>"><?php echo $res_temp->deskripsi ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="kode_sumber_dana_untuk_setoran">Sumber Dana Untuk Setoran</label>
                                            <select name="kode_sumber_dana_untuk_setoran" class="form-control" id="kode_sumber_dana_untuk_setoran">
                                            <option value="">...</option>
                                            <?php foreach($sumber_dana_setoran->result() as $res_temp) { ?>
                                                <option value="<?php echo $res_temp->id_sumber_dana_untuk_setoran ?>"><?php echo $res_temp->deskripsi ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="tujuan_penggunaan_dana">Tujuan Penggunaan Dana</label>
                                            <input type="text" name="tujuan_penggunaan_dana" class="form-control" id="tujuan_penggunaan_dana">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="2b">
                                <div class="row upload-scan-ktp">
                                    <div class="col-xs-12 col-sm-12 col-lg-12">
                                        <label>Upload File Identitas KTP Anggota.</label><br/>
                                        <div class="caption-label">Format gambar yang diijinkan dalam bentuk JPG, JPEG, PNG, GIF (Max. 2MB)</div>
                                    </div>
                                    <input type="hidden" value="" name="scan_ktp" id="uploaded_photo_val">
                                    <div class="attached-photos" id="property_gallery"></div>
                                    <div class="form-group col-xs-12 col-sm-6 col-lg-3">
                                        <button onclick="add_photo();" type="button" class="btn-upload-img white waves-effect waves-red" id="button_scan_ktp">
                                            <i class="fa fa-camera"></i>
                                        </button>
                                    </div>
                                    <a class="remove-uploaded-photo hide">hapus</a>
                                    <div class="upload-error hide" id="scan_ktp_notification"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Konfirmasi Penyimpanan</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                Pastikan pengisian pembuatan rekening calon nasabah sudah sesuai
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary full-width">Lakukan Pembukaan Rekening</button>
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
    $("#saldo_min, #setoran_min, #setoran_wajib, #setoran_pokok, #setoran_virtual").inputmask({ 
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
    $("#persen_pajak, #persen_bunga").inputmask("decimal",{
        radixPoint:".",
        digits: 2,
        autoGroup: true,
        placeholder: "0", 
        max: 100,
        min: 0
    });
    $("#form_customer").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_register',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Lakukan Pembukaan Rekening');
                } else {
                    $this.find('button[type=submit]').html('Mohon Tunggu...');
                    window.location.href = '<?php echo base_url() ?>nasabah/' + data.data.id_user
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Memproses Penyimpanan...');
            }
        });

        return false;
    });

    // Initialize the jQuery File Upload widget:
    $('#upload_user_photo').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '<?php echo base_url() ?>rekening/ajax_upload_ktp',
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
            // $("#property_gallery").html(tmpl('tmpl-attached-photo', data.result.data));
            $("#scan_ktp_notification").html("").addClass('hide');
            $(".remove-uploaded-photo").removeClass('hide');
            $('#button_scan_ktp').css("background-image", "url(" + data.result.data.url + ")");
            $('#uploaded_photo_val').val(data.result.data.name);
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

    $(".remove-uploaded-photo").bind('click', function(e){
        e.preventDefault();
        var $this = $(this);
        $this.parents('.upload-scan-ktp')
            .find('button').css('background-image', 'none').end()
            .find('input[name=scan_ktp]').val('');
        $this.addClass('hide');
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
function add_photo_floor_plan(){
    document.getElementById("attach-floor-plan").click();
}
</script>
<script id="tmpl-attached-photo" type="text/x-tmpl">
{% if(o) { console.log(o); %}
    <div class="attached-photo col-xs-12 col-sm-6 col-lg-3">
        <img src="{%= o.url %}" class="uploaded-photo"/>
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