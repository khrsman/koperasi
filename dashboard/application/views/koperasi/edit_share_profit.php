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
       Edit Share Profit
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit Share Profit</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?= validation_errors() ?>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Share Profit</h3>
        </div>
        <form method="post" action="<?= base_url() ?>update_profit">
        <div class="box-body">
            <div class="form-group">
                <label>Koperasi</label>
                <input type="text" class="form-control disabled" value="<?= $profit['nama'] ?>"  disabled>
            </div>
            <div class="form-group">
                <label>Profit</label>
                <input type="text" class="form-control" name="profit" value="<?= $profit['share_cabang'] ?>" value="<?= set_value('profit') ?>">
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btn-large btn-success"> Perbarui Data</button>
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