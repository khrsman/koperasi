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
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create_kategori_produk"><i class="fa fa-plus-circle"></i> &nbsp; Buat Kategori Produk Baru</button>&nbsp;&nbsp;
            </div>
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="tab-pane active" id="list_kategori_produk">
                        <table class="dataUser table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Kategori Produk</th>
                                    <th>Nama Kategori Produk</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($kategori_produk->result() as $kategori_produk_temp) { ?>
                                <tr id="row-<?php echo $kategori_produk_temp->kode_kategori_produk ?>">
                                    <td class="kode-kategori_produk"><?php echo $kategori_produk_temp->kode_kategori_produk ?></td>
                                    <td class="nama-kategori_produk"><?php echo $kategori_produk_temp->nama_kategori_produk ?></td>
                                    <td class="text-center"><a class="fa fa-pencil edit-kategori_produk" data-toggle="modal" data-target="#edit_kategori_produk" data-id="<?php echo $kategori_produk_temp->kode_kategori_produk ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-kategori_produk" data-toggle="modal" data-target="#delete_kategori_produk" data-id="<?php echo $kategori_produk_temp->kode_kategori_produk ?>"></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<div class="modal fade" id="create_kategori_produk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_create_kategori_produk">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Buat Kategori Produk Baru</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="kode_kategori_produk">Kode Kategori Produk</label>
                                <input type="text" name="kode_kategori_produk" class="form-control" id="kode_kategori_produk">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="nama_kategori_produk">Nama Kategori Produk</label>
                                <input type="text" name="nama_kategori_produk" class="form-control" id="nama_kategori_produk">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambahkan Kategori Produk Baru</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="edit_kategori_produk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_edit_kategori_produk">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Edit Kategori Produk</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <input type="hidden" name="kode_kategori_produk_origin">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="ekode_kategori_produk">Kode Kategori Produk</label>
                                <input type="text" name="ekode_kategori_produk" class="form-control" id="ekode_kategori_produk">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="enama_kategori_produk">Nama Kategori Produk</label>
                                <input type="text" name="enama_kategori_produk" class="form-control" id="enama_kategori_produk">
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
<div class="modal fade" id="delete_kategori_produk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_delete_kategori_produk">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Konfirmasi Penghapusan Kategori Produk</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <input type="hidden" name="kode_kategori_produk">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            Apakah Anda yakin ingin menghapus kategori produk '<span class="kode-kategori_produk text-bold"></span>'?
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya, Hapus Kategori Produk</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?php 
$this->load->view('template/js');
?>
<script id="tmpl-list-kategori_produk" type="text/x-tmpl">
{% if(o) { %}
    <tr id="row-{%= o.kode_kategori_produk %}">
        <td class="kode-kategori_produk">{%= o.kode_kategori_produk %}</td>
        <td class="nama-kategori_produk">{%= o.nama_kategori_produk %}</td>
        <td class="text-center"><a class="fa fa-pencil edit-kategori_produk" data-toggle="modal" data-target="#edit_kategori_produk" data-id="{%= o.kode_kategori_produk %}"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-kategori_produk" data-toggle="modal" data-target="#delete_kategori_produk" data-id="{%= o.kode_kategori_produk %}"></a></td>
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
        $('#edit_kategori_produk').on('show.bs.modal', function (event) {
            var $elm = $(event.relatedTarget);
            var kode_kategori_produk = $elm.attr('data-id');
            var $row = $("#row-"+kode_kategori_produk);
            var modal = $(this);

            modal.find('input[type=hidden][name=kode_kategori_produk_origin]').val(kode_kategori_produk);
            modal.find('input[type=text][name=ekode_kategori_produk]').val(kode_kategori_produk);
            modal.find('input[type=text][name=enama_kategori_produk]').val($row.find('.nama-kategori_produk').html());
        });
        $('#delete_kategori_produk').on('show.bs.modal', function (event) {
            var $elm = $(event.relatedTarget);
            var kode_kategori_produk = $elm.attr('data-id');
            var modal = $(this);

            modal.find('input[type=hidden][name=kode_kategori_produk]').val(kode_kategori_produk);
            modal.find('.kode-kategori_produk').html(kode_kategori_produk);
        });
        $("#form_edit_kategori_produk").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_edit_kategori_produk',
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
                        $('#edit_kategori_produk').modal('hide');
                        var $row = $("#row-"+json_data.kode_kategori_produk_origin);
                        $row.find('.kode-kategori_produk').html(json_data.ekode_kategori_produk);
                        $row.find('.nama-kategori_produk').html(json_data.enama_kategori_produk);
                        $row.find('.edit-kategori_produk').attr("data-id", json_data.ekode_kategori_produk);
                        $row.find('.delete-kategori_produk').attr("data-id", json_data.ekode_kategori_produk);
                        $row.attr('id', 'row-' + json_data.ekode_kategori_produk);
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });

            return false;
        });
        $("#form_create_kategori_produk").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_create_kategori_produk',
                data: json_data,
                dataType: 'JSON',
                type: 'POST',
                success: function(data){
                    if(data.errorcode == 1){
                        $.each(data.msg.form_error, function(key,val){
                            $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                        });
                        $this.find('button[type=submit]').html('Tambahkan Kategori Produk Baru');
                    } else {
                        $this.find('button[type=submit]').html('Tambahkan Kategori Produk Baru');
                        $('#create_kategori_produk').modal('hide');
                        $("#list_kategori_produk").find('tbody').append(tmpl('tmpl-list-kategori_produk', json_data));
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });

            return false;
        });
        $("#form_delete_kategori_produk").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>gerai/h2h/ajax_delete_kategori_produk',
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
                        $('#delete_kategori_produk').modal('hide');
                        $("#list_kategori_produk").find('#row-'+json_data.kode_kategori_produk).remove();
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