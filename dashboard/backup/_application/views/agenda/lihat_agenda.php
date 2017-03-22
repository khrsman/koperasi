<?php
$this->load->view('template/head');
?>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header"></section>
<!-- Main content -->
<section class="content">
        <div class="col-md-7"><?= validation_errors() ?></div>
        <div class="col-md-5">
            <?php
            if($this->session->flashdata('msg') != NULL){
            echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
            echo '</div>';
            }?>
        </div>
        <div class="col-md-5">
            <div class="box">
                <div class="box-body">
                    <img src="<?= base_url() ?>assets/images/agenda/<?php if ($agenda['link_gambar'] != NULL )
                    echo $agenda['link_gambar'];
                    else
                    echo 'default.png';?>" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= $agenda['judul'] ?></strong></h3>
                </div>
                <div class="box-body">
                    <?= $agenda['isi'] ?>
                </div>
                <div class="box-footer">
                    <button type="button" onClick=location.href="<?= base_url()."agenda/".$this->session->userdata('level_data_agenda'); ?>" class="btn btn-primary btn-block btn-flat">Kembali</button>
                </div>
            </div>
        </div>
</section>
<div class="clear-both"></div>

<!-- /.content -->
<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>