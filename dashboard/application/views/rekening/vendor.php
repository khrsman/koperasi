<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       <?php echo $title;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div style="margin-bottom: 15px;">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create_vendor"><i class="fa fa-plus-circle"></i> &nbsp; Buat Vendor Baru</button>&nbsp;&nbsp;
            </div>
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="tab-pane active" id="list_vendor">
                        <table class="dataUser table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Vendor</th>
                                    <th>Nama Vendor</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($vendor->result() as $vendor_temp) { ?>
                                <tr id="row-<?php echo $vendor_temp->kode_vendor ?>">
                                    <td class="kode-vendor"><?php echo $vendor_temp->kode_vendor ?></td>
                                    <td class="nama-vendor"><?php echo $vendor_temp->nama_vendor ?></td>
                                    <td class="text-center"><a class="fa fa-pencil edit-vendor" data-toggle="modal" data-target="#edit_vendor" data-id="<?php echo $vendor_temp->kode_vendor ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-vendor" data-toggle="modal" data-target="#delete_vendor" data-id="<?php echo $vendor_temp->kode_vendor ?>"></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<div class="modal fade" id="create_vendor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_create_vendor">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Buat Vendor Baru</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="kode_vendor">Kode Vendor</label>
                                <input type="text" name="kode_vendor" class="form-control" id="kode_vendor">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="nama_vendor">Nama Vendor</label>
                                <input type="text" name="nama_vendor" class="form-control" id="nama_vendor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambahkan Vendor Baru</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="edit_vendor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_edit_vendor">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Edit Vendor</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <input type="hidden" name="kode_vendor_origin">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="ekode_vendor">Kode Vendor</label>
                                <input type="text" name="ekode_vendor" class="form-control" id="ekode_vendor">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="enama_vendor">Nama Vendor</label>
                                <input type="text" name="enama_vendor" class="form-control" id="enama_vendor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="delete_vendor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_delete_vendor">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Konfirmasi Penghapusan Vendor</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <input type="hidden" name="kode_vendor">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            Apakah Anda yakin ingin menghapus vendor '<span class="kode-vendor text-bold"></span>'?
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya, Hapus Vendor</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?php 
$this->load->view('template/js');
?>
<script id="tmpl-list-vendor" type="text/x-tmpl">
{% if(o) { %}
    <tr id="row-{%= o.kode_vendor %}">
        <td class="kode-vendor">{%= o.kode_vendor %}</td>
        <td class="nama-vendor">{%= o.nama_vendor %}</td>
        <td class="text-center"><a class="fa fa-pencil edit-vendor" data-toggle="modal" data-target="#edit_vendor" data-id="{%= o.kode_vendor %}"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-vendor" data-toggle="modal" data-target="#delete_vendor" data-id="{%= o.kode_vendor %}"></a></td>
    </tr>
{% } %}
</script>
<!--tambahkan custom js disini-->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tmpl.min.js"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/inputmask.numeric.extensions.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/jquery.inputmask.js"></script>
<script>
    $(document).ready(function(){
        $('.dataUser').dataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false
        });
        $('#edit_vendor').on('show.bs.modal', function (event) {
            var $elm = $(event.relatedTarget);
            var kode_vendor = $elm.attr('data-id');
            var $row = $("#row-"+kode_vendor);
            var modal = $(this);

            modal.find('input[type=hidden][name=kode_vendor_origin]').val(kode_vendor);
            modal.find('input[type=text][name=ekode_vendor]').val(kode_vendor);
            modal.find('input[type=text][name=enama_vendor]').val($row.find('.nama-vendor').html());
        });
        $('#delete_vendor').on('show.bs.modal', function (event) {
            var $elm = $(event.relatedTarget);
            var kode_vendor = $elm.attr('data-id');
            var modal = $(this);

            modal.find('input[type=hidden][name=kode_vendor]').val(kode_vendor);
            modal.find('.kode-vendor').html(kode_vendor);
        });
        $("#form_edit_vendor").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_edit_vendor',
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
                        $this.find('button[type=submit]').html('Simpan Perubahan');
                        $('#edit_vendor').modal('hide');
                        var $row = $("#row-"+json_data.kode_vendor_origin);
                        $row.find('.kode-vendor').html(json_data.ekode_vendor);
                        $row.find('.nama-vendor').html(json_data.enama_vendor);
                        $row.find('.edit-vendor').attr("data-id", json_data.ekode_vendor);
                        $row.find('.delete-vendor').attr("data-id", json_data.ekode_vendor);
                        $row.attr('id', 'row-' + json_data.ekode_vendor);
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });

            return false;
        });
        $("#form_create_vendor").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_create_vendor',
                data: json_data,
                dataType: 'JSON',
                type: 'POST',
                success: function(data){
                    if(data.errorcode == 1){
                        $.each(data.msg.form_error, function(key,val){
                            $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                        });
                        $this.find('button[type=submit]').html('Tambahkan Vendor Baru');
                    } else {
                        $this.find('button[type=submit]').html('Tambahkan Vendor Baru');
                        $('#create_vendor').modal('hide');
                        $("#list_vendor").find('tbody').append(tmpl('tmpl-list-vendor', json_data));
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });

            return false;
        });
        $("#form_delete_vendor").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_delete_vendor',
                data: json_data,
                dataType: 'JSON',
                type: 'POST',
                success: function(data){
                    if(data.errorcode == 1){
                        $.each(data.msg.form_error, function(key,val){
                            $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                        });
                        $this.find('button[type=submit]').html('Ya, Hapus');
                    } else {
                        $this.find('button[type=submit]').html('Ya, Hapus');
                        $('#delete_vendor').modal('hide');
                        $("#list_vendor").find('#row-'+json_data.kode_vendor).remove();
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penghapusan...');
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