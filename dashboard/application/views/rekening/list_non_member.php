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
            <div class="action-buttons">
                <button class="btn btn-sm btn-primary" onclick=location.href="<?= base_url() ?>buat_rekening_non_member"><i class="fa fa-plus-circle"></i> &nbsp; Buat Rekening non Member</button>
            </div><!-- /.box -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#rektabungan" data-toggle="tab">Rekening non Member</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="rektabungan">
                        <table class="dataUser table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Atas Nama Pemilik</th>
                                    <th>No Rekening</th>
                                    <th>Koperasi</th>
                                    <th>Kepemilikan</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($nasabah_rek->result() as $nasabah_temp) { ?>
                                <tr>
                                    <td><a href="#"><?php echo $nasabah_temp->nama ?></a></td>
                                    <td><a href="#"><?php echo $nasabah_temp->no_rekening ?></a></td>
                                    <td><?php echo $nasabah_temp->nama_koperasi ?></td>
                                    <td><?php echo $nasabah_temp->tipe_rekening == "KOPERASI" ? "Koperasi" : ($nasabah_temp->tipe_rekening == "KETUA" ? "Ketua Koperasi" : "Shareholder") ?></td>
                                    <td style="text-align:right;">Rp. <?php echo number_format($nasabah_temp->saldo);?>.00</td>
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