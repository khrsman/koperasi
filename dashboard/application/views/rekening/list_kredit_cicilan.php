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
                <button class="btn btn-sm btn-primary" onclick=location.href="<?= base_url() ?>buat_rekening_kredit_cicilan"><i class="fa fa-plus-circle"></i> &nbsp; Buat Rekening Kredit Cicilan</button>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#rektabungan" data-toggle="tab">Rekening Kredit Cicilan</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="rektabungan">
                        <table class="dataUser table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Atas Nama Pemilik</th>
                                    <th>No Rekening</th>
                                    <th>Angsuran Ke-</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Sisa Angsuran</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($nasabah_rek->result() as $nasabah_temp) { ?>
                                <tr>
                                    <td><a href="nasabah/<?php echo $nasabah_temp->id_user ?>/kredit/<?php echo $nasabah_temp->no_rekening_kredit ?>"><?php echo $nasabah_temp->nama_lengkap ?></a></td>
                                    <td><a href="nasabah/<?php echo $nasabah_temp->id_user ?>/kredit/<?php echo $nasabah_temp->no_rekening_kredit ?>"><?php echo $nasabah_temp->no_rekening_kredit ?></a></td>
                                    <td><?php echo $nasabah_temp->count_angsuran ?></td>
                                    <td style="text-align:right;">Rp. <?php echo number_format($nasabah_temp->jumlah_kredit);?>.00</td>
                                    <td style="text-align:right;">Rp. <?php echo number_format($nasabah_temp->sisa_angsuran_pokok);?>.00</td>
                                    <td><a class="btn btn-primary" href="nasabah/<?php echo $nasabah_temp->id_user ?>/kredit/<?php echo $nasabah_temp->no_rekening_kredit ?>">Lihat</a></td>
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