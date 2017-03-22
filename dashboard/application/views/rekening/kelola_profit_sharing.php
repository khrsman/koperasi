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
        Kelola Profit Sharing
        <small>Pengaturan Profit Sharing Komponen Koperasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_setting_profit">
        <div class="row">
            <div class="col-md-9">
                <?php if($this->session->flashdata('setting_profit_stat')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Pengaturan Persentase Profit Telah Disimpan!</h4>
                    Perubahan pengaturan profit sharing koperasi telah disimpan
                </div>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir pengaturan profit sharing koperasi</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="profit_koperasi">Profit Rek. Koperasi</label>
                                    <div class="input-group">
                                        <input type="text" value="<?php echo isset($profit_koperasi) ? $profit_koperasi : 0 ?>" name="profit_koperasi" class="form-control" id="profit_koperasi">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="profit_ketua">Profit Ketua Koperasi</label>
                                    <div class="input-group">
                                        <input type="text" value="<?php echo isset($profit_ketua) ? $profit_ketua : 0 ?>" name="profit_ketua" class="form-control" id="profit_ketua">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="profit_anggota">Profit Anggota Koperasi</label>
                                    <div class="input-group">
                                        <input type="text" value="<?php echo isset($profit_anggota) ? $profit_anggota : 0 ?>" name="profit_anggota" class="form-control" id="profit_anggota">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shareholders">
                            <?php $count_sh = 0; foreach ($profit_rekening->result() as $pr_temp) { if($pr_temp->group == "OKNUM") { $count_sh++; ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-lg-8">
                                        <div class="form-group">
                                            <label for="shareholder<?php echo $count_sh ?>">Shareholder Koperasi</label> - <a class="remove-shareholder">Hapus</a>
                                            <select name="shareholder[]" id="shareholder<?php echo $count_sh ?>" class="form-control">
                                            <option value="">...</option>
                                                <?php foreach ($shareholder->result() as $shareholder_temp) { ?>
                                                <option value="<?php echo $shareholder_temp->no_rekening ?>"<?php echo $shareholder_temp->no_rekening == $pr_temp->no_rekening ? " selected" : "" ?>><?php echo $shareholder_temp->nama ?> - <?php echo $shareholder_temp->no_rekening ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="profit_shareholder<?php echo $count_sh ?>">Profit Shareholder Koperasi</label>
                                            <div class="input-group">
                                                <input type="text" name="profit_shareholder[]" class="form-control" id="profit_shareholder<?php echo $count_sh ?>" value="<?php echo $pr_temp->share ?>">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } } ?>
                            <?php if($count_sh < 1) { ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-lg-8">
                                    <div class="form-group">
                                        <label for="shareholder1">Shareholder Koperasi</label> - <a class="remove-shareholder">Hapus</a>
                                        <select name="shareholder[]" id="shareholder1" class="form-control">
                                        <option value="">...</option>
                                            <?php foreach ($shareholder->result() as $shareholder_temp) { ?>
                                            <option value="<?php echo $shareholder_temp->no_rekening ?>"><?php echo $shareholder_temp->nama ?> - <?php echo $shareholder_temp->no_rekening ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="profit_shareholder1">Profit Shareholder Koperasi</label>
                                        <div class="input-group">
                                            <input type="text" name="profit_shareholder[]" class="form-control" id="profit_shareholder1">
                                            <span class="input-group-addon">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <button class="casual-button" id="add_shareholder">Tambahkan Shareholder</a>
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
                                Pastikan pengisian informasi pengaturan profit sharing telah benar
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary full-width">Simpan Pengaturan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section><!-- /.content -->
<script id="tmpl-new-shareholder" type="text/x-tmpl">
{% if(o) { %}
    <div class="row" data-sort="{%= o %}" id="shareholder-{%= o %}">
        <div class="col-xs-12 col-sm-8 col-lg-8">
            <div class="form-group">
                <label for="shareholder{%= o %}">Shareholder Koperasi</label> - <a class="remove-shareholder">Hapus</a>
                <select name="shareholder[]" id="shareholder{%= o %}" class="form-control">
                <option value="">...</option>
                    <?php foreach ($shareholder->result() as $shareholder_temp) { ?>
                    <option value="<?php echo $shareholder_temp->no_rekening ?>"><?php echo $shareholder_temp->nama ?> - <?php echo $shareholder_temp->no_rekening ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-lg-4">
            <div class="form-group">
                <label for="profit_shareholder{%= o %}">Profit Shareholder Koperasi</label>
                <div class="input-group">
                    <input type="text" name="profit_shareholder[]" class="form-control" id="profit_shareholder{%= o %}">
                    <span class="input-group-addon">%</span>
                </div>
            </div>
        </div>
    </div>
{% } %}
</script>
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tmpl.min.js"></script>
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
    $("#add_shareholder").bind('click', function(e){
        e.preventDefault();
        var id = Math.floor((Math.random() * 999999) + 100000);
        $(".shareholders").append(tmpl('tmpl-new-shareholder', id));

        $(".shareholders").find('#shareholder-'+id).find('.remove-shareholder').bind('click', function(e){
            e.preventDefault();

            $(this).parent().parent().parent().remove();
        });
    });
    $(".remove-shareholder").bind('click', function(e){
        e.preventDefault();

        $(this).parent().parent().parent().remove();
    })
    $("#form_setting_profit").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_setting_profit',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Simpan Pengaturan');
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
</script>
<?php
$this->load->view('template/foot');
?>