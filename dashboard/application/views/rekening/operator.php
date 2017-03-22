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
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create_operator"><i class="fa fa-plus-circle"></i> &nbsp; Buat Operator Baru</button>&nbsp;&nbsp;
            </div>
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="tab-pane active" id="list_operator">
                        <table class="dataUser table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Operator</th>
                                    <th>Nama Operator</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($operator->result() as $operator_temp) { ?>
                                <tr id="row-<?php echo $operator_temp->kode_operator ?>">
                                    <td class="kode-operator"><?php echo $operator_temp->kode_operator ?></td>
                                    <td class="nama-operator"><?php echo $operator_temp->nama_operator ?></td>
                                    <td class="text-center"><a class="fa fa-pencil edit-operator" data-toggle="modal" data-target="#edit_operator" data-id="<?php echo $operator_temp->kode_operator ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-operator" data-toggle="modal" data-target="#delete_operator" data-id="<?php echo $operator_temp->kode_operator ?>"></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<div class="modal fade" id="create_operator" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_create_operator">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Buat Operator Baru</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="kode_operator">Kode Operator</label>
                                <input type="text" name="kode_operator" class="form-control" id="kode_operator">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="nama_operator">Nama Operator</label>
                                <input type="text" name="nama_operator" class="form-control" id="nama_operator">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambahkan operator Baru</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="edit_operator" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_edit_operator">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Edit Operator</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <input type="hidden" name="kode_operator_origin">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="ekode_operator">Kode Operator</label>
                                <input type="text" name="ekode_operator" class="form-control" id="ekode_operator">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="enama_operator">Nama Operator</label>
                                <input type="text" name="enama_operator" class="form-control" id="enama_operator">
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
<div class="modal fade" id="delete_operator" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_delete_operator">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Konfirmasi Penghapusan Operator</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <input type="hidden" name="kode_operator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            Apakah Anda yakin ingin menghapus operator '<span class="kode-operator text-bold"></span>'?
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya, Hapus Operator</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?php 
$this->load->view('template/js');
?>
<script id="tmpl-list-operator" type="text/x-tmpl">
{% if(o) { %}
    <tr id="row-{%= o.kode_operator %}">
        <td class="kode-operator">{%= o.kode_operator %}</td>
        <td class="nama-operator">{%= o.nama_operator %}</td>
        <td class="text-center"><a class="fa fa-pencil edit-operator" data-toggle="modal" data-target="#edit_operator" data-id="{%= o.kode_operator %}"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-operator" data-toggle="modal" data-target="#delete_operator" data-id="{%= o.kode_operator %}"></a></td>
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
        $('#edit_operator').on('show.bs.modal', function (event) {
            var $elm = $(event.relatedTarget);
            var kode_operator = $elm.attr('data-id');
            var $row = $("#row-"+kode_operator);
            var modal = $(this);

            modal.find('input[type=hidden][name=kode_operator_origin]').val(kode_operator);
            modal.find('input[type=text][name=ekode_operator]').val(kode_operator);
            modal.find('input[type=text][name=enama_operator]').val($row.find('.nama-operator').html());
        });
        $('#delete_operator').on('show.bs.modal', function (event) {
            var $elm = $(event.relatedTarget);
            var kode_operator = $elm.attr('data-id');
            var modal = $(this);

            modal.find('input[type=hidden][name=kode_operator]').val(kode_operator);
            modal.find('.kode-operator').html(kode_operator);
        });
        $("#form_edit_operator").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_edit_operator',
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
                        $('#edit_operator').modal('hide');
                        var $row = $("#row-"+json_data.kode_operator_origin);
                        $row.find('.kode-operator').html(json_data.ekode_operator);
                        $row.find('.nama-operator').html(json_data.enama_operator);
                        $row.find('.edit-operator').attr("data-id", json_data.ekode_operator);
                        $row.find('.delete-operator').attr("data-id", json_data.ekode_operator);
                        $row.attr('id', 'row-' + json_data.ekode_operator);
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });

            return false;
        });
        $("#form_create_operator").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_create_operator',
                data: json_data,
                dataType: 'JSON',
                type: 'POST',
                success: function(data){
                    if(data.errorcode == 1){
                        $.each(data.msg.form_error, function(key,val){
                            $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                        });
                        $this.find('button[type=submit]').html('Tambahkan operator Baru');
                    } else {
                        $this.find('button[type=submit]').html('Tambahkan operator Baru');
                        $('#create_operator').modal('hide');
                        $("#list_operator").find('tbody').append(tmpl('tmpl-list-operator', json_data));
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });

            return false;
        });
        $("#form_delete_operator").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_delete_operator',
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
                        $('#delete_operator').modal('hide');
                        $("#list_operator").find('#row-'+json_data.kode_operator).remove();
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