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
            <div class="box">
                <div class="box-header with-border">
                    <button class="btn btn-sm btn-primary" onclick=location.href="<?= base_url() ?>buka_rekening"><i class="fa fa-plus-circle"></i> &nbsp; Buka Rekening Baru</button>&nbsp;&nbsp;
                    <button class="btn btn-sm btn-info" onclick=location.href="<?= base_url() ?>cek_saldo"><i class="fa fa-plus-circle"></i> &nbsp; Cek Saldo</button>&nbsp;&nbsp;
                    <button class="btn btn-sm btn-success" onclick=location.href="<?= base_url() ?>transfer_saldo"><i class="fa fa-plus-circle"></i> &nbsp; Transfer Saldo</button>&nbsp;&nbsp;
                    <button class="btn btn-sm btn-blue-purple" onclick=location.href="<?= base_url() ?>setor_tunai"><i class="fa fa-plus-circle"></i> &nbsp; Setor Tunai</button>&nbsp;&nbsp;
                    <button class="btn btn-sm btn-red-ruby" onclick=location.href="<?= base_url() ?>tarik_tunai"><i class="fa fa-plus-circle"></i> &nbsp; Penarikan Tunai</button>&nbsp;&nbsp;
                    <button class="btn btn-sm btn-orange" onclick=location.href="<?= base_url() ?>ubah_status_rekening"><i class="fa fa-plus-circle"></i> &nbsp; Ubah Status Rekening</button>&nbsp;&nbsp;
                    <button class="btn btn-sm btn-primary" onclick=location.href="<?= base_url() ?>buat_rekening_non_member"><i class="fa fa-plus-circle"></i> &nbsp; Buat Rekening non Member</button>&nbsp;&nbsp;
                </div>
            </div><!-- /.box -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#rektabungan" data-toggle="tab">Profit Sharing Rule</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="rektabungan">
                        <table class="dataUser table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Koperasi</th>
                                    <th>Share SMIDUMAY</th>
                                    <th>Share Koperasi</th>
                                    <th class="text-center">Set. Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($koperasi_res->result() as $koperasi_temp) { ?>
                                <tr id="row-<?php echo $koperasi_temp->id_koperasi ?>">
                                    <td class="koperasi-name"><?php echo $koperasi_temp->nama ?></td>
                                    <td class="shared-smidumay"><?php echo $koperasi_temp->share_smidumay ? $koperasi_temp->share_smidumay . " %" : '-' ?></td>
                                    <td class="shared-koperasi"><?php echo $koperasi_temp->share_koperasi ? $koperasi_temp->share_koperasi . " %" : '-' ?></td>
                                    <td class="text-center"><a class="fa fa-cog set-profit-sharing" data-toggle="modal" data-target="#conf_profit_rule" data-id="<?php echo $koperasi_temp->id_koperasi ?>" data-koperasi="<?php echo $koperasi_temp->share_koperasi ?>" data-smidumay="<?php echo $koperasi_temp->share_smidumay ?>"></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<div class="modal fade" id="conf_profit_rule" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" id="form_config_profit_rule">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_log_title">Pengaturan Profit Sharing <span class="text-bold">Cimahi Creative Association</span></h4>
            </div>
            <div class="modal-body no-padding">
                <div class="form-profit-sharing">
                    <input type="hidden" name="id_koperasi">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="share_smidumay">Share SMIDUMAY</label>
                                <div class="input-group">
                                    <input type="text" name="share_smidumay" class="form-control" id="share_smidumay">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="share_koperasi">Share Koperasi</label>
                                <div class="input-group">
                                    <input type="text" name="share_koperasi" class="form-control" id="share_koperasi">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
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

        $("#share_koperasi, #share_smidumay").inputmask("decimal",{
            radixPoint:".",
            digits: 2,
            autoGroup: true,
            placeholder: "0", 
            max: 100,
            min: 0
        });
        $('#conf_profit_rule').on('show.bs.modal', function (event) {
            var $elm = $(event.relatedTarget);
            var id_koperasi = $elm.attr('data-id');
            var shared_koperasi = $elm.attr('data-koperasi');
            var shared_smidumay = $elm.attr('data-smidumay');
            var id_koperasi = $elm.data('id');
            var $row = $("#row-"+id_koperasi);
            var modal = $(this);

            modal.find('input[type=hidden][name=id_koperasi]').val(id_koperasi);
            modal.find('input[type=text][name=share_koperasi]').val(shared_koperasi);
            modal.find('input[type=text][name=share_smidumay]').val(shared_smidumay);
        });
        $("#form_config_profit_rule").bind('submit', function(e){
            var $this = $(this);
            var json_data = $this.serializeObject();
            $.ajax({
                url: '<?php echo base_url() ?>rekening/ajax_set_profit_sharing_rule',
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
                        $this.find('button[type=submit]').html('Simpan Pengaturan');
                        $('#conf_profit_rule').modal('hide');
                        var $row = $("#row-"+json_data.id_koperasi);
                        $row.find('.shared-smidumay').html(json_data.share_smidumay + " %");
                        $row.find('.shared-koperasi').html(json_data.share_koperasi + " %");
                        $row.find('.set-profit-sharing').attr("data-smidumay", json_data.share_smidumay);
                        $row.find('.set-profit-sharing').attr("data-koperasi", json_data.share_koperasi);
                        // window.location.reload();
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