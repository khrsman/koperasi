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

                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create_vendor_produk"><i class="fa fa-plus-circle"></i> &nbsp; Buat Produk Vendor Baru</button>&nbsp;&nbsp;

            </div>

            <div class="nav-tabs-custom">

                <div class="tab-content">

                    <div class="tab-pane active" id="list_vendor_produk">

                        <table class="dataUser table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>Kode Produk Vendor</th>

                                    <th>Nama Produk Vendor</th>

                                    <th class="text-center">#</th>

                                </tr>

                            </thead>

                            <tbody>

                            <?php 

                            foreach ($vendor_produk->result() as $vendor_produk_temp) { ?>

                                <tr id="row-<?php echo $vendor_produk_temp->kode_produk ?>">

                                    <td class="kode-vendor_produk"><?php echo $vendor_produk_temp->kode_produk ?></td>

                                    <td class="nama-vendor_produk"><?php echo $vendor_produk_temp->nama_produk ?></td>

                                    <td class="text-center"><a class="fa fa-pencil edit-vendor_produk" data-toggle="modal" data-target="#edit_vendor_produk" data-id="<?php echo $vendor_produk_temp->kode_produk ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-vendor_produk" data-toggle="modal" data-target="#delete_vendor_produk" data-id="<?php echo $vendor_produk_temp->kode_produk ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-search view-vendor_produk" data-toggle="modal" data-target="#view_vendor_produk" data-id="<?php echo $vendor_produk_temp->kode_produk ?>"></a></td>

                                </tr>

                            <?php } ?>

                            </tbody>

                        </table>

                    </div>



                </div>

        </div><!-- /.col -->

    </div><!-- /.row -->

</section><!-- /.content -->

<div class="modal fade" id="view_vendor_produk" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <input type="hidden" name="nasabah_id">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="modal_log_title">Detail Produk Vendor</h4>

            </div>

            <div class="modal-body no-padding">

                

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="create_vendor_produk" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg" role="document">

        <form role="form" id="form_create_vendor_produk">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="modal_log_title">Buat Produk Vendor Baru</h4>

            </div>

            <div class="modal-body no-padding">

                <div class="form-profit-sharing">

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-lg-6">

                            <div class="form-group">

                                <label for="kode_vendor">Vendor</label>

                                <select name="kode_vendor" class="form-control" id="kode_vendor">

                                    <option value="">...</option>

                                    <?php foreach ($vendor->result() as $kode_temp) { ?>

                                    <option value="<?php echo $kode_temp->kode_vendor ?>"><?php echo $kode_temp->nama_vendor ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-6">

                            <div class="form-group">

                                <label for="kode_operator">Operator</label>

                                <select name="kode_operator" class="form-control" id="kode_operator">

                                    <option value="">...</option>

                                    <?php foreach ($operator->result() as $kode_temp) { ?>

                                    <option value="<?php echo $kode_temp->kode_operator ?>"><?php echo $kode_temp->nama_operator ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-lg-6">

                            <div class="form-group">

                                <label for="kode_kategori_produk">Kategori Produk</label>

                                <select name="kode_kategori_produk" class="form-control" id="kode_kategori_produk">

                                    <option value="">...</option>

                                    <?php foreach ($kategori_produk->result() as $kode_temp) { ?>

                                    <option value="<?php echo $kode_temp->kode_kategori_produk ?>"><?php echo $kode_temp->nama_kategori_produk ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6 col-lg-6">

                            <div class="form-group">

                                <label for="jenis_transaksi">Jenis Transaksi</label>

                                <select name="jenis_transaksi" class="form-control" id="jenis_transaksi">

                                    <option value="">...</option>

                                    <option value="PEMBELIAN">Pembelian</option>

                                    <option value="PEMBAYARAN">Pembayaran</option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-lg-6">

                            <div class="form-group">

                                <label for="kode_produk">Kode Produk Vendor</label>

                                <input type="text" name="kode_produk" class="form-control" id="kode_produk">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6 col-lg-6">

                            <div class="form-group">

                                <label for="nama_produk">Nama Produk Vendor</label>

                                <input type="text" name="nama_produk" class="form-control" id="nama_produk">

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-lg-4">

                            <div class="form-group">

                                <label for="nominal_produk">Nominal Produk</label>

                                <div class="input-group">

                                    <span class="input-group-addon">Rp</span>

                                    <input type="text" name="nominal_produk" class="form-control" id="nominal_produk" placeholder="0">

                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-4">

                            <div class="form-group">

                                <label for="harga_vendor">Harga Vendor</label>

                                <div class="input-group">

                                    <span class="input-group-addon">Rp</span>

                                    <input type="text" name="harga_vendor" class="form-control" id="harga_vendor" placeholder="0">

                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-4">

                            <div class="form-group">

                                <label for="harga_gerai">Harga Gerai</label>

                                <div class="input-group">

                                    <span class="input-group-addon">Rp</span>

                                    <input type="text" name="harga_gerai" class="form-control" id="harga_gerai" placeholder="0">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

                <button type="submit" class="btn btn-primary">Tambahkan Produk Vendor Baru</button>

            </div>

        </div>

        </form>

    </div>

</div>

<div class="modal fade" id="edit_vendor_produk" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg" role="document">

        <form role="form" id="form_edit_vendor_produk">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="modal_log_title">Buat Produk Vendor Baru</h4>

            </div>

            <div class="modal-body no-padding">

                <div class="form-profit-sharing">

                    <input type="hidden" name="kode_produk_origin"/>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-lg-6">

                            <div class="form-group">

                                <label for="ekode_vendor">Vendor</label>

                                <select name="ekode_vendor" class="form-control" id="ekode_vendor">

                                    <option value="">...</option>

                                    <?php foreach ($vendor->result() as $kode_temp) { ?>

                                    <option value="<?php echo $kode_temp->kode_vendor ?>"><?php echo $kode_temp->nama_vendor ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-6">

                            <div class="form-group">

                                <label for="ekode_operator">Operator</label>

                                <select name="ekode_operator" class="form-control" id="ekode_operator">

                                    <option value="">...</option>

                                    <?php foreach ($operator->result() as $kode_temp) { ?>

                                    <option value="<?php echo $kode_temp->kode_operator ?>"><?php echo $kode_temp->nama_operator ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-lg-6">

                            <div class="form-group">

                                <label for="ekode_kategori_produk">Kategori Produk</label>

                                <select name="ekode_kategori_produk" class="form-control" id="ekode_kategori_produk">

                                    <option value="">...</option>

                                    <?php foreach ($kategori_produk->result() as $kode_temp) { ?>

                                    <option value="<?php echo $kode_temp->kode_kategori_produk ?>"><?php echo $kode_temp->nama_kategori_produk ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6 col-lg-6">

                            <div class="form-group">

                                <label for="ejenis_transaksi">Jenis Transaksi</label>

                                <select name="ejenis_transaksi" class="form-control" id="ejenis_transaksi">

                                    <option value="">...</option>

                                    <option value="PEMBELIAN">Pembelian</option>

                                    <option value="PEMBAYARAN">Pembayaran</option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-lg-6">

                            <div class="form-group">

                                <label for="ekode_produk">Kode Produk Vendor</label>

                                <input type="text" name="ekode_produk" class="form-control" id="ekode_produk">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6 col-lg-6">

                            <div class="form-group">

                                <label for="enama_produk">Nama Produk Vendor</label>

                                <input type="text" name="enama_produk" class="form-control" id="enama_produk">

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-lg-4">

                            <div class="form-group">

                                <label for="enominal_produk">Nominal Produk</label>

                                <div class="input-group">

                                    <span class="input-group-addon">Rp</span>

                                    <input type="text" name="enominal_produk" class="form-control" id="enominal_produk" placeholder="0">

                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-4">

                            <div class="form-group">

                                <label for="eharga_vendor">Harga Vendor</label>

                                <div class="input-group">

                                    <span class="input-group-addon">Rp</span>

                                    <input type="text" name="eharga_vendor" class="form-control" id="eharga_vendor" placeholder="0">

                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-4">

                            <div class="form-group">

                                <label for="eharga_gerai">Harga Gerai</label>

                                <div class="input-group">

                                    <span class="input-group-addon">Rp</span>

                                    <input type="text" name="eharga_gerai" class="form-control" id="eharga_gerai" placeholder="0">

                                </div>

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

<div class="modal fade" id="delete_vendor_produk" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

        <form role="form" id="form_delete_vendor_produk">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="modal_log_title">Konfirmasi Penghapusan Produk Vendor</h4>

            </div>

            <div class="modal-body no-padding">

                <div class="form-profit-sharing">

                    <input type="hidden" name="kode_produk">

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-lg-12">

                            Apakah Anda yakin ingin menghapus produk vendor '<span class="kode-vendor_produk text-bold"></span>'?

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>

                <button type="submit" class="btn btn-primary">Ya, Hapus Produk Vendor</button>

            </div>

        </div>

        </form>

    </div>

</div>

<script id="tmpl-view-produk-vendor" type="text/x-tmpl">

{% if(o) { %}

    <div class="form-input-data">

        <ul class="data-information transaction-log-top">

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Vendor</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.nama_vendor %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Operator</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.nama_operator %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Kategori Produk</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.nama_kategori_produk %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Jenis Transaksi</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.jenis_transaksi %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Kode Produk Vendor</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.kode_produk %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Nama Produk Vendor</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.nama_produk %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Nominal Produk</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.nominal_produk_caption %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Harga Vendor</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.harga_vendor_caption %}</span></b></p>

            </li>

            <li class="row">

                <p class="col-xs-5 col-md-5 no-padding">Harga Gerai</p>

                <p class="col-xs-7 col-md-7 no-padding"><b><span>{%= o.harga_gerai_caption %}</span></b></p>

            </li>

        </ul>

    </div>

{% } %}

</script>

<?php 

$this->load->view('template/js');

?>

<script id="tmpl-list-vendor_produk" type="text/x-tmpl">

{% if(o) { %}

    <tr id="row-{%= o.kode_produk %}">

        <td class="kode-vendor_produk">{%= o.kode_produk %}</td>

        <td class="nama-vendor_produk">{%= o.nama_produk %}</td>

        <td class="text-center"><a class="fa fa-pencil edit-vendor_produk" data-toggle="modal" data-target="#edit_vendor_produk" data-id="{%= o.kode_produk %}"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash delete-vendor_produk" data-toggle="modal" data-target="#delete_vendor_produk" data-id="{%= o.kode_produk %}"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash view-vendor_produk" data-toggle="modal" data-target="#view_vendor_produk" data-id="{%= o.kode_produk %}"></a></td>

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

        $("#nominal_produk, #harga_gerai, #harga_vendor, #enominal_produk, #eharga_gerai, #eharga_vendor").inputmask({ 

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

        $('#view_vendor_produk').on('show.bs.modal', function (event) {

            var $elm = $(event.relatedTarget);

            var kode_produk = $elm.data('id');

            var modal = $(this);



            $.ajax({

                url: '<?php echo base_url() ?>gerai/h2h/ajax_view_vendor_produk',

                data: {kode_produk: kode_produk},

                dataType: 'JSON',

                type: 'POST',

                success: function(data){

                    if(data.errorcode > 0){

                        

                    } else {

                        modal.find('.modal-body').html(tmpl('tmpl-view-produk-vendor', data.data));

                    }

                },

                beforeSend: function(data){

                    modal.find('.modal-body').html('');

                }

            });

        });

        $('#edit_vendor_produk').on('show.bs.modal', function (event) {

            var $elm = $(event.relatedTarget);

            var kode_produk = $elm.attr('data-id');

            var $row = $("#row-"+kode_produk);

            var modal = $(this);



            $.ajax({

                url: '<?php echo base_url() ?>gerai/h2h/ajax_view_vendor_produk',

                type: 'POST',

                dataType: 'JSON',

                data: {kode_produk: kode_produk},

                success: function(data){

                    modal.find('input[type=hidden][name=kode_produk_origin]').val(data.data.kode_produk);

                    modal.find('select[name=ekode_vendor]').val(data.data.kode_vendor);

                    modal.find('select[name=ekode_operator]').val(data.data.kode_operator);

                    modal.find('select[name=ekode_kategori_produk]').val(data.data.kode_kategori_produk);

                    modal.find('select[name=ejenis_transaksi]').val(data.data.jenis_transaksi);

                    modal.find('input[type=text][name=ekode_produk]').val(data.data.kode_produk);

                    modal.find('input[type=text][name=enama_produk]').val(data.data.nama_produk);

                    modal.find('input[type=text][name=enominal_produk]').val(data.data.nominal_produk);

                    modal.find('input[type=text][name=eharga_vendor]').val(data.data.harga_vendor);

                    modal.find('input[type=text][name=eharga_gerai]').val(data.data.harga_gerai);

                },

                beforeSend: function(){



                }

            });

        });

        $('#delete_vendor_produk').on('show.bs.modal', function (event) {

            var $elm = $(event.relatedTarget);

            var kode_produk = $elm.attr('data-id');

            var modal = $(this);



            modal.find('input[type=hidden][name=kode_produk]').val(kode_produk);

            modal.find('.kode-vendor_produk').html(kode_produk);

        });

        $("#form_edit_vendor_produk").bind('submit', function(e){

            var $this = $(this);

            var json_data = $this.serializeObject();

            $.ajax({

                url: '<?php echo base_url() ?>gerai/h2h/ajax_edit_vendor_produk',

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

                        $('#edit_vendor_produk').modal('hide');

                        var $row = $("#row-"+json_data.kode_produk_origin);

                        $row.find('.kode-vendor_produk').html(json_data.ekode_produk);

                        $row.find('.nama-vendor_produk').html(json_data.enama_produk);

                        $row.find('.edit-vendor_produk').attr("data-id", json_data.ekode_produk);

                        $row.find('.view-vendor_produk').attr("data-id", json_data.ekode_produk);

                        $row.find('.delete-vendor_produk').attr("data-id", json_data.ekode_produk);

                        $row.attr('id', 'row-' + json_data.ekode_produk);

                    }

                },

                beforeSend: function(data){

                    $('.input-error').remove();

                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');

                }

            });



            return false;

        });

        $("#form_create_vendor_produk").bind('submit', function(e){

            var $this = $(this);

            var json_data = $this.serializeObject();

            $.ajax({

                url: '<?php echo base_url() ?>gerai/h2h/ajax_create_vendor_produk',

                data: json_data,

                dataType: 'JSON',

                type: 'POST',

                success: function(data){

                    if(data.errorcode == 1){

                        $.each(data.msg.form_error, function(key,val){

                            $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');

                        });

                        $this.find('button[type=submit]').html('Tambahkan Produk Vendor Baru');

                    } else {

                        $this.find('button[type=submit]').html('Tambahkan Produk Vendor Baru');

                        $('#create_vendor_produk').modal('hide');

                        $("#list_vendor_produk").find('tbody').append(tmpl('tmpl-list-vendor_produk', json_data));

                    }

                },

                beforeSend: function(data){

                    $('.input-error').remove();

                    $this.find('button[type=submit]').html('Memproses Penyimpanan...');

                }

            });



            return false;

        });

        $("#form_delete_vendor_produk").bind('submit', function(e){

            var $this = $(this);

            var json_data = $this.serializeObject();

            $.ajax({

                url: '<?php echo base_url() ?>gerai/h2h/ajax_delete_vendor_produk',

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

                        $('#delete_vendor_produk').modal('hide');

                        $("#list_vendor_produk").find('#row-'+json_data.kode_produk).remove();

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