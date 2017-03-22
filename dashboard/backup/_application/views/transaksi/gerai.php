<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Transaksi Gerai
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transaksi Gerai</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">    
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <th>No</th>
                        <th>User</th>
                        <th>Operator</th>
                        <th>Kode Operator</th>
                        <th>Tanggal Transaksi</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $row) { ?>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_lengkap']?></td>
                            <td><?= $row['id_operator'] ?></td>
                            <td><?= $row['kode_operator']?></td>
                            <td><?php  $date = new DateTime($row['tanggal_transaksi']); 
                                        echo $date->format('d M y, H:i:s');  ?></td>
                            <td><?= $row['keterangan'] ?></td>

                        <?php } ?>
                    </tbody>
                </table> 
        </div><!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btnlg btn-info"><i class="fa fa-print"></i> Cetak</button>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>