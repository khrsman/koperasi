<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css"/>
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
        Informasi Profit Koperasi '<?php echo $koperasi->nama ?>'
        <small>Detail Profit Koperasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_cek_saldo">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" id="nasabah_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Informasi Koperasi</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="data-information">
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">ID Koperasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $koperasi->id_koperasi ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Koperasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><?php echo $koperasi->nama ?></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Alamat</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $koperasi->alamat ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">No Telp</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $koperasi->telp ?></span></b></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-xs-5 col-md-5 no-padding">Ketua Koperasi</p>
                                        <p class="col-xs-7 col-md-7 no-padding"><b><span><?php echo $koperasi->ketua_koperasi ?></span></b></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary" id="nasabah_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Informasi Akumulasi Profit Koperasi</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th>Jenis Akun</th>
                                    <th>Sumber Profit</th>
                                    <th>Nilai Profit</th>
                                </tr>
                                <?php if($profit_koperasi->num_rows() > 0) { foreach ($profit_koperasi->result() as $log_temp) { ?>
                                <tr>
                                    <td><?php echo $log_temp->account ?></td>
                                    <td><?php echo $log_temp->sumber_dana ? $log_temp->sumber_dana : '' ?></td>
                                    <td><?php echo $log_temp->nilai ? "Rp. " . number_format($log_temp->nilai, 2, ".", ",") : '' ?></td>
                                </tr>
                                <?php } } else { ?>
                                <tr>
                                    <td colspan="3" style="text-align: center">Tidak ada akumulasi profit yang dapat ditampilkan</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box box-primary" id="tabungan_result">
                    <div class="box-header with-border">
                      <h3 class="box-title">Histori Profit Transaksi</h3>
                      <div class="action-filter"><a href="#" class="filter-profit">Filter Histori Profit <i class="fa fa-filter"></i></a></div>
                    </div>
                    <div class="box-filter hide">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <label>Jenis Akun </label>
                                <select class="form-control" id="jenis_akun">
                                    <option value="">...</option>
                                    <option value="KOPERASI INDUK">Koperasi Induk</option>
                                    <option value="KOPERASI CABANG">Koperasi Cabang</option>
                                    <option value="KETUA">Ketua</option>
                                    <option value="OKNUM">Oknum</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <label>Sumber Profit </label>
                                <select class="form-control" id="sumber_dana">
                                    <option value="">...</option>
                                    <option value="GERAI">Transaksi Gerai</option>
                                    <option value="COMMERCE">Transaksi Commerce</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <label>Dari Tanggal </label>
                                <div class='input-group date datetimepicker'>
                                    <input type="text" class="form-control" id="date_from" placeholder="YYYY-MM-DD">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <label>Hingga Tanggal </label>
                                <div class='input-group date datetimepicker'>
                                    <input type="text" class="form-control" id="date_to" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d'); ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tbody id="log_profit">
                                <tr class="header-row">
                                    <th>Waktu</th>
                                    <th>Jenis Akun</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Sumber Profit</th>
                                    <th>Nilai</th>
                                </tr>
                                <?php if($log_profit->num_rows() > 0) { foreach ($log_profit->result() as $log_temp) { ?>
                                <tr data-time="<?php echo $log_temp->tanggal_transaksi ?>">
                                    <td><?php echo $log_temp->tanggal_transaksi ?></td>
                                    <td><?php echo $log_temp->account ?></td>
                                    <td><?php echo $log_temp->no_transaksi ?></td>
                                    <td><?php echo $log_temp->sumber_dana ? $log_temp->sumber_dana : '' ?></td>
                                    <td><?php echo $log_temp->nilai ? "Rp. " . number_format($log_temp->nilai, 2, ".", ",") : '' ?></td>
                                </tr>
                                <?php } } else { ?>
                                <tr>
                                    <td colspan="5" style="text-align: center">Tidak ada histori profit transaksi</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="load-more<?php echo $log_profit->num_rows() > 0 ? "" : " hide" ?>"><button type="button"><i class="fa fa-refresh"></i>Muat Lebih Banyak</button></div>
            </div>
        </div>
    </form>
</section><!-- /.content -->
<script id="tmpl-log-profit" type="text/x-tmpl">
{% if(o.length > 0) { %}
{% for(var i = 0; res=o[i]; i++) { %}
<tr data-time="{%= res.tanggal_transaksi %}">
    <td>{%= res.tanggal_transaksi %}</td>
    <td>{%= res.jenis_akun %}</td>
    <td>{%= res.no_transaksi %}</td>
    <td>{%= res.sumber_dana %}</td>
    <td>{%= res.nilai_caption %}</td>
</tr>
{% } %}
{% } else { %}
<tr>
    <td colspan="5" style="text-align: center">Tidak ada histori profit transaksi</td>
</tr>
{% } %}
</script>
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tmpl.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
    $(document).ready(function(){
        $('.datetimepicker').datetimepicker({format: 'YYYY-MM-DD'}).on('dp.change',function(event){
            load_log_profit();
        });
        $('.filter-profit').bind('click', function(e){
            e.preventDefault();

            if($('.box-filter').hasClass('hide')){
                $('.box-filter').removeClass('hide');
                $(this).html('Tutup Filter <i class="fa fa-times"></i>');
            } else {
                $('.box-filter').addClass('hide');
                $(this).html('Filter Histori Profit <i class="fa fa-filter"></i>');
            }
        });
        $("#jenis_akun, #sumber_dana, #date_from, #date_to").bind('change', function(e){
            e.preventDefault();

            load_log_profit();
        });
        $(".load-more > button").bind('click', function(e){
            e.preventDefault();

            load_log_profit($("#log_profit").children('tr').last().attr('data-time'));
        });
        var load_log_profit = function(offset){
            var json_data = {
                id_koperasi: "<?php echo $koperasi->id_koperasi ?>",
                jenis_akun: $("#jenis_akun").val(),
                sumber_dana: $("#sumber_dana").val(),
                date_to: $("#date_to").val(),
                date_from: $("#date_from").val(),
                offset: offset
            };

            $.ajax({
                url: '<?php echo base_url() ?>rekening/ajax_load_profit_koperasi',
                data: json_data,
                dataType: 'JSON',
                type: 'POST',
                success: function(data){
                    if(data.errorcode > 0){
                        
                    } else {
                        if(offset)
                            $("#log_profit").append(tmpl('tmpl-log-profit', data.data));
                        else {
                            $("#log_profit").find('tr').not('.header-row').remove();
                            $("#log_profit").append(tmpl('tmpl-log-profit', data.data));
                        }
                        if(data.data.length < 10)
                            $(".load-more").addClass('hide');
                        else
                            $(".load-more").removeClass('hide');
                    }
                    $(".load-more > button").html('<i class="fa fa-refresh"></i>Muat Lebih Banyak');
                },
                beforeSend: function(data){
                    $(".load-more > button").html('<i class="fa fa-refresh loading"></i>Memuat Data...');
                }
            });
        };
    });
</script>
<?php
$this->load->view('template/foot');
?>