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
        Pembuatan Rekening
        <small>Pembuatan Rekening non Member</small>
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
                <?php if($this->session->flashdata('rekening_non_member_stat')) { $rek_temp = $this->session->flashdata('rekening_non_member_stat'); ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Pembuatan Rekening non Member Berhasil!</h4>
                    Pembuatan rekening atas nama <?php echo $rek_temp['nama'] ?> telah dibuat dengan nomor rekening <?php echo $rek_temp['no_rekening'] ?> dan saldo awal sebesar Rp. <?php echo number_format($rek_temp['saldo'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>rekening_non_member">disini</a> untuk melihat rekening non member lainnya.
                </div>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir isian pembuatan rekening non member</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <?php if($this->session->userdata('level') == 2) { ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Atas Nama Pemilik</label>
                                    <input type="text" name="nama" class="form-control" id="nama">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tipe_rekening">Tipe Kepemilikan</label>
                                    <select id="tipe_rekening" class="form-control" name="tipe_rekening">
                                        <option value="">...</option>
                                        <option value="KOPERASI">KOPERASI</option>
                                        <option value="KETUA">KETUA</option>
                                        <option value="OKNUM">OKNUM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="saldo">Saldo Awal</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="saldo" class="form-control" id="saldo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="id_koperasi">Pilih Koperasi</label>
                                    <select id="id_koperasi" class="selectpicker with-ajax search-select" name="id_koperasi" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Atas Nama Pemilik(Koperasi)</label>
                                    <input type="text" name="nama" class="form-control" id="nama">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="saldo">Saldo Awal</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="saldo" class="form-control" id="saldo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
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
                        <button type="submit" class="btn btn-primary full-width">Lakukan Pembuatan Rekening</button>
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
            url     : '<?php echo base_url() ?>rekening/cari_koperasi',
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
            emptyTitle: 'Masukan Nama Koperasi atau ID Koperasi',
            errorText: 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder: 'Ketikan Nama, atau ID Koperasi...',
            statusInitialized: 'Lakukan pencarian koperasi',
            statusNoResults: 'Pencarian tidak ditemukan',
            statusSearching: 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data.data[i], {
                        text : data.data[i].nama + ' (' + data.data[i].id_koperasi + ')',
                        value: data.data[i].id_koperasi
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
    $("#saldo").inputmask({ 
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
    $("#form_customer").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_register_non_member',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Lakukan Pembuatan Rekening');
                } else {
                    $this.find('button[type=submit]').html('Mohon Tunggu...');
                    window.location.reload();
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Memproses Penyimpanan...');
            }
        });

        return false;
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