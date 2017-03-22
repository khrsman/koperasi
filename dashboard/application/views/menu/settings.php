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
.content-wrapper{
    padding-top: 0px !important;
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
        Pengaturan Menu
        <small>Pengaturan Menu Aplikasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <ul id="menu-group">
        <?php foreach ($menu_group->result() as $mg_temp) : ?>
        <li<?php echo $mg_temp->id == $this->menu_mod->group_id ? " class='current'" : ""?> id="group-<?php echo $mg_temp->id; ?>">
            <a href="<?php echo base_url() . 'menu/settings/' . $mg_temp->id ?>">
                <?php echo $mg_temp->title; ?>
            </a>
        </li>
        <?php endforeach; ?>
        <li id="add-group"><a href="#" title="Add Menu Group">+</a></li>
    </ul>
    <div class="clearfix"></div>
    <button type="button" class="btn btn-sm btn-primary" style="margin-bottom: 15px" id="btn-add-menu" data-toggle="modal" data-target="#add_menu"><i class="fa fa-plus-circle" style="margin-right:5px;"></i> Buat Menu Baru</button>
    <form method="post" id="form_menu" action="<?php echo base_url() ?>menu/ajax_save_menu">
        <div class="ns-row" id="ns-header">
            <div class="ns-actions">#</div>
            <div class="ns-roles">Role</div>
            <div class="ns-url">URL</div>
            <div class="ns-image">Image</div>
            <div class="ns-title">Nama Menu</div>
        </div>
        <?php echo $menu_ul; ?>
        <div id="ns-footer">
            <button type="submit" class="btn btn-sm btn-primary" id="btn-save-menu" style="margin-right:10px;"><i class="fa fa-floppy-o" style="margin-right:5px;"></i> Simpan Perubahan</button>
            <span class="notification-msg hide"></span>
            <div class="clearfix"></div>
        </div>
    </form>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="add_menu" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_add_menu" action="<?php echo base_url() ?>menu/ajax_create_menu">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Buat Menu Baru</h4>
            </div>
            <div class="modal-body">
                <div class="form-profit-sharing">
                    <div class="row">
                        <input type="hidden" name="group_id" value="<?php echo $this->menu_mod->group_id ?>">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="menu_title">Nama Menu</label>
                                <input type="text" name="title" class="form-control" id="menu_title" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="menu_url">URL</label>
                                <input type="text" name="url" class="form-control" id="menu_url">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="menu_class">Class</label>
                                <input type="text" name="class" class="form-control" id="menu_class">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="menu_image">Image</label>
                                <input type="text" name="image" class="form-control" id="menu_image">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="auth_visibility">Role Visibility</label>
                                <select class="selectpicker" multiple title="Pilih role yang dapat melihat" name="auth_visibility" id="auth_visibility">

                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin Koperasi</option>
                                    <option value="6">Manager Koperasi</option>
                                    <option value="7">Kasir Koperasi</option>
                                    <option value="3">Anggota Koperasi</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambahkan Menu</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="edit_menu" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_edit_menu" action="<?php echo base_url() ?>menu/ajax_edit_menu">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Edit Menu</h4>
            </div>
            <div class="modal-body">
                <div class="form-profit-sharing">
                    <div class="row">
                        <input type="hidden" name="id" class="form-control" id="menu_id" required>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="emenu_title">Nama Menu</label>
                                <input type="text" name="title" class="form-control" id="emenu_title" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="emenu_url">URL</label>
                                <input type="text" name="url" class="form-control" id="emenu_url">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="emenu_class">Class</label>
                                <input type="text" name="class" class="form-control" id="emenu_class">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="emenu_image">Image</label>
                                <input type="text" name="image" class="form-control" id="emenu_image">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="eauth_visibility">Role Visibility</label>
                                <select class="selectpicker" multiple title="Pilih role yang dapat melihat" name="auth_visibility" id="eauth_visibility">
                                  <option value="1">Super Admin</option>
                                  <option value="2">Admin Koperasi</option>
                                  <option value="6">Manager Koperasi</option>
                                  <option value="7">Kasir Koperasi</option>
                                  <option value="3">Anggota Koperasi</option>
                                </select>
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
<div class="modal fade" id="delete_menu" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_delete_menu" action="<?php echo base_url() ?>menu/ajax_delete_menu">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Konfirmasi Penghapusan Menu</h4>
            </div>
            <div class="modal-body">
                <div class="form-profit-sharing">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            Apakah Anda yakin ingin menghapus menu '<span class="menu-title text-bold"></span>'?
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya, Hapus Menu</button>
            </div>
        </div>
        </form>
    </div>
<?php
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    var _BASE_URL = '<?php echo base_url(); ?>';
    var current_group_id = <?php echo $this->menu_mod->group_id ?>;
</script>
<script src="<?php echo base_url() ?>assets/js/jquery.1.4.1.min.js"></script>
<script>
var jq141 = jQuery.noConflict();
</script>
<script src="<?php echo base_url() ?>assets/js/interface-1.2.js"></script>
<script src="<?php echo base_url() ?>assets/js/inestedsortable.js"></script>
<script src="<?php echo base_url() ?>assets/js/menu.js"></script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
    /* add menu
    ------------------------------------------------------------------------- */
    $('#form_add_menu').bind('submit', function(){
        var $this = $(this);
        if ($('#menu_title').val() == '') {
            $('#menu_title').focus();
        } else {
            var json_data = $this.serializeObject();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: json_data,
                success: function(data) {
                     if(data.errorcode == 1){
                        $.each(data.msg.form_error, function(key,val){
                            $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                        });
                        $this.find('button[type=submit]').html('Tambahkan Menu');
                    } else {
                        $('#form_add_menu')[0].reset();
                        jq141('#easymm')
                            .append(data.data.li)
                            .SortableAddItem($('#menu-'+data.data.li_id)[0]);
                        $("#easymm").children('li:last-child').find('.edit-menu').bind('click', function(e){
                            e.preventDefault();
                            var $parent = $(this).parent().parent().parent('li.sortable');
                            var $form = $("#form_edit_menu");
                            $form.find('input[name=id]').val($parent.find('input[name=menu_id]').val());
                            $form.find('input[name=title]').val($parent.find('.ns-title').html());
                            $form.find('input[name=url]').val($parent.find('.ns-url').html());
                            $form.find('input[name=class]').val($parent.find('.ns-row').attr('data-class'));
                            $('#eauth_visibility').selectpicker('val',JSON.parse($parent.find('.ns-row').attr('data-auth')));
                            $('#eauth_visibility').selectpicker('refresh');
                            $form.find('input[name=image]').val($parent.find('.ns-image').html());

                            $('#edit_menu').modal('show');
                        });
                        $("#easymm").children('li:last-child').find('.delete-menu').bind('click', function(e){
                            e.preventDefault();
                            var $parent = $(this).parent().parent().parent('li.sortable');
                            var $form = $("#form_delete_menu");
                            $form.find('input[name=id]').val($parent.find('input[name=menu_id]').val());
                            $form.find('.menu-title').html($parent.find('.ns-title').html());

                            $('#delete_menu').modal('show');
                        });

                        $this.find('button[type=submit]').html('Tambahkan Menu');

                        $("#add_menu").modal('hide');
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });
        }
        return false;
    });

    /* edit menu
    ------------------------------------------------------------------------- */
    $('.edit-menu').bind('click', function(e){
        e.preventDefault();
        console.log('fuck');
        var $parent = $(this).parent().parent().parent('li.sortable');
        var $form = $("#form_edit_menu");
        $form.find('input[name=id]').val($parent.find('input[name=menu_id]').val());
        $form.find('input[name=title]').val($parent.find('.ns-title').html());
        $form.find('input[name=url]').val($parent.find('.ns-url').html());
        $form.find('input[name=class]').val($parent.find('.ns-row').attr('data-class'));
        $('#eauth_visibility').selectpicker('val',JSON.parse($parent.find('.ns-row').attr('data-auth')));
        $('#eauth_visibility').selectpicker('refresh');
        $form.find('input[name=image]').val($parent.find('.ns-image').html());

        $('#edit_menu').modal('show');
    });

    $('#form_edit_menu').bind('submit', function(){
        var $this = $(this);
        if ($('#emenu_title').val() == '') {
            $('#emenu_title').focus();
        } else {
            var json_data = $this.serializeObject();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: json_data,
                success: function(data) {
                     if(data.errorcode == 1){
                        $.each(data.msg.form_error, function(key,val){
                            $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                        });
                        $this.find('button[type=submit]').html('Simpan Perubahan');
                    } else {
                        $("#menu-"+json_data.id).children('.ns-row').children('.ns-title').html(data.data.title);
                        $("#menu-"+json_data.id).children('.ns-row').children('.ns-url').html(data.data.url);
                        $("#menu-"+json_data.id).children('.ns-row').attr('data-class',data.data.class);
                        $("#menu-"+json_data.id).children('.ns-row').children('.ns-image').html(data.data.image);
                        $("#menu-"+json_data.id).children('.ns-row').attr('data-auth', data.data.auth_visibility);
                        $("#menu-"+json_data.id).children('.ns-row').children('.ns-roles').html(data.data.auth_visibility);
                        $('#form_edit_menu')[0].reset();
                        $this.find('button[type=submit]').html('Simpan Perubahan');

                        $("#edit_menu").modal('hide');
                    }
                },
                beforeSend: function(data){
                    $('.input-error').remove();
                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');
                }
            });
        }
        return false;
    });

    /* delete menu
    ------------------------------------------------------------------------- */
    $('.delete-menu').bind('click', function(e){
        e.preventDefault();
        var $parent = $(this).parent().parent().parent('li.sortable');
        var $form = $("#form_delete_menu");
        $form.find('input[name=id]').val($parent.find('input[name=menu_id]').val());
        $form.find('.menu-title').html($parent.find('.ns-title').html());

        $('#delete_menu').modal('show');
    });

    $("#form_delete_menu").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: $(this).attr('action'),
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
                    $('#delete_menu').modal('hide');
                    $("#menu-"+json_data.id).remove();
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
