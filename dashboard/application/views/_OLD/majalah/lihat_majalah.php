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
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $majalah['judul'] ?></h3> -- <small><?php
                                  $date = new DateTime($majalah['tanggal_dibuat']); 
                                  echo $date->format('d M y, H:i:s'); 
                                                  ?></small>
                </div>
                <div class="box-body">
                   <object data="<?= base_url() ?>assets/images/majalah/<?= $majalah['file_path'] ?>" type="application/pdf" internalinstanceid="120" style="width: 100%; height: 50vh"></object>
                </div>
                <div class="box-footer">
                    <?= $majalah['deskripsi'] ?>
                    <button type="button" onClick=location.href="<?= base_url()."majalah/".$this->session->userdata('level_data_majalah'); ?>" class="btn btn-primary btn-block btn-flat">Kembali</button>
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
<script type="text/javascript" src="<?= base_url() ?>assets/js/pdfobject.js"></script>
<?php
$this->load->view('template/foot');
?>