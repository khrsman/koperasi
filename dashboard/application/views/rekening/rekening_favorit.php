<?php 
$this->load->view('template/head');
$this->load->view('new_head_anggota_kop');
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
// $this->load->view('template/topbar');
// $this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header container">
    <h1>
        Daftar Rekening Favorit 
        <small>List Nomor Rekening Favorit Nasabah</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
    <div class="box-buttons">
        <button class="btn btn-sm btn-primary" style="color:black;font-weight:bold;" data-toggle="modal" data-target="#tambah_rekening_fav"><i class="fa fa-plus-circle"></i> &nbsp; Tambah Rekening Favorit</button>
        <a href="<?php echo base_url('banking') ?>" class="btn-sm btn btn-danger"> <b>Kembali Ke Minicore Banking</b></a>
    </div>
</section>

<!-- Main content -->
<section class="content container">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible hide" id="notification_success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Tambah Nomor Rekening Favorit Berhasil!</h4>
                Nomor rekening favorit baru telah disimpan.
            </div>
            <div class="box box-primary" id="tabungan_result">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Nomor Rekening Favorit</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered" id="list_rekening_fav">
                        <tbody>
                            <tr>
                                <th>Nomor Rekening</th>
                                <th>Nama Nasabah</th>
                                <th>Jenis Rekening</th>
                                <th>Keterangan</th>
                                <th class="center">Aksi</th>
                            </tr>
                            <?php if($rekening_fav->num_rows() > 0) { foreach ($rekening_fav->result() as $rek_temp) { ?>
                            <tr data-id="<?php echo $rek_temp->no_rekening ?>">
                                <td><?php echo $rek_temp->no_rekening ?></td>
                                <td><?php echo $rek_temp->nama_penerima ?></td>
                                <td><?php echo $rek_temp->jenis_account ?></td>
                                <td><?php echo $rek_temp->keterangan ?></td>
                                <td class="center"><a class="fa fa-trash" data-toggle="modal" data-target="#confirm_delete_rekening_fav" data-id="<?php echo $rek_temp->no_rekening ?>" data-name="<?php echo $rek_temp->nama_penerima ?>"></a></td>
                            </tr>
                            <?php } } else { ?>
                            <tr class="notify-empty">
                                <td colspan="5" style="text-align: center">Belum ada nomor rekening favorit yang disimpan</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="tambah_rekening_fav" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="form_rekening_favorit">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Rekening Favorit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="nasabah_id">Tentukan Nomor Rekening Nasabah</label>
                            <select id="nasabah_id" class="selectpicker_all with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="nama_penerima">Nama Nasabah</label>
                            <input type="text" name="nama_penerima" class="form-control" id="nama_penerima">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button style="color:black;font-weight:black;" type="submit" class="btn btn-primary">Simpan Nomor Rekening</button>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm_delete_rekening_fav" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="form_remove_rekening_fav">
            <input type="hidden" name="nasabah_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Rekening Favorit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        Apakah Anda ingin menghapus nomor rekening '<span class="delete_no_rek"></span>' dari daftar rekening favorit?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya, Hapus Rekening</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script id="tmpl-added-rekening-fav" type="text/x-tmpl">
{% if(o) { %}
    <tr data-id="{%= o.no_rekening %}">
        <td>{%= o.no_rekening %}</td>
        <td>{%= o.nama_penerima %}</td>
        <td>{%= o.jenis_account %}</td>
        <td>{%= o.keterangan %}</td>
        <td class="center"><a class="fa fa-trash" data-toggle="modal" data-target="#confirm_delete_rekening_fav" data-id="{%= o.no_rekening %}" data-name="{%= o.nama_penerima %}"></a></td>
    </tr>
{% } %}
</script>
<?php 
// $this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tmpl.min.js"></script>
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
                    text : data.data[i].fullname + ' - ' + data.data[i].jenis_rekening,
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
$(document).ready(function(){
    $("#form_rekening_favorit").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_add_rekening_fav',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Simpan Nomor Rekening');
                } else {
                    $("#list_rekening_fav").find('tbody').append(tmpl('tmpl-added-rekening-fav', data.data));
                    $("#list_rekening_fav").find('.notify-empty').addClass('hide');
                    $("#notification_success").removeClass('hide');
                    $('#tambah_rekening_fav').modal('hide');
                    $("#info_nasabah").html('').addClass('hide');
                    $('.selectpicker_all').val('').selectpicker('refresh');
                    $this.find('button[type=submit]').html('Simpan Nomor Rekening');
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Menyimpan Nomor Rekening...');
            }
        });

        return false;
    });
    $('.selectpicker_all').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    $('.selectpicker_all').on('changed.bs.select', function (e) {
        var $this = $(this);
        if($this.val()){
            var nasabah_penerima = $this.find("option:selected").text().replace(/[-].*/g, "").trim();
            $("#nama_penerima").val(nasabah_penerima);
        }
    });
    $('#confirm_delete_rekening_fav').on('show.bs.modal', function (event) {
        var $elm = $(event.relatedTarget);
        var nasabah_id = $elm.data('id');
        var nama_nasabah = $elm.data('name');
        var modal = $(this);
        modal.find('input[name=nasabah_id]').val(nasabah_id);
        modal.find('.delete_no_rek').html(nama_nasabah);
    });
    $("#form_remove_rekening_fav").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_remove_rekening_fav',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').removeAttr('disabled').html('Ya, Hapus Rekening');
                } else {
                    $("#list_rekening_fav").find('tr[data-id="' + json_data.nasabah_id + '"]').remove();
                    if($("#list_rekening_fav").find('tr').length == 2){
                        $("#list_rekening_fav").find('.notify-empty').removeClass('hide');
                    }
                    $('#confirm_delete_rekening_fav').modal('hide');
                    $this.find('button[type=submit]').removeAttr('disabled').html('Ya, Hapus Rekening');
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').attr('disabled','disabled').html('Menghapus Nomor Rekening...');
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
</script>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>