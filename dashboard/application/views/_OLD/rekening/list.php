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
                    <button class="btn btn-sm btn-orange" onclick=location.href="<?= base_url() ?>ubah_status_rekening"><i class="fa fa-plus-circle"></i> &nbsp; Ubah Status Rekening</button>
                </div>
            </div><!-- /.box -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#rektabungan" data-toggle="tab">Rekening Anggota</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="rektabungan">
                        <table class="dataUser table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!-- <th>No Rekening</th> -->
                                    <th>Nama Nasabah / Anggota</th>
                                    <th>Saldo Tabungan</th>
                                    <th>Saldo Virtual</th>
                                    <th>Saldo Loyalti</th>
                                    <th>Tanggal Registrasi</th>
                                    <th>Transaksi Terakhir</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($nasabah_rek->result() as $nasabah_temp) { ?>
                                <tr>
   <!--                                  <td><a href="<?php echo base_url() . 'nasabah/' . $nasabah_temp->id_user . '/tabungan/' . $nasabah_temp->no_rekening ?>"><?php echo $nasabah_temp->no_rekening ?></a></td> -->
                                    <td><a href="<?php echo base_url() . 'nasabah/' . $nasabah_temp->id_user ?>"><?php echo $nasabah_temp->nama_lengkap ?></a></td>
                                    <td style="text-align:right;">Rp. <?php echo number_format($nasabah_temp->saldo_tabungan);?>.00</td>
                                    <td style="text-align:right;">Rp. <?php echo number_format($nasabah_temp->saldo_virtual);?>.00</td>
                                    <td style="text-align:right;">Rp. <?php echo number_format($nasabah_temp->saldo_loyalti);?>.00</td>
                                    <td><?php echo $nasabah_temp->tanggal_registrasi ?></td>
                                    <td><?php echo $nasabah_temp->tanggal_transaksi_terakhir ?></td>
                                    <td><a class="btn btn-primary" href="<?php echo base_url() . 'nasabah/' . $nasabah_temp->id_user ?>">Lihat</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
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
    });
</script>
<?php
$this->load->view('template/foot');
?>