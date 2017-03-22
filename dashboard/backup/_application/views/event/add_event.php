<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />



<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header"></section>
<!-- Main content -->
<section class="content">
<div class="col-md-7"><?= validation_errors() ?><?php
    if($this->session->userdata('msg') != NULL){
    echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
        echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
    echo '</div>';
    }?></div>
<div class="col-md-7">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Event <?= strtotime("20 September 2000"); ?>
</h3>
        </div>
        <div class="box-body">
            <form method="post" action="<?= base_url() ?>tambah_event" enctype="multipart/form-data">
                 <div class="form-group ">
                    <label for="judul">Judul Event</label>
                    <input type="text" class="form-control" placeholder="Judul Event" required="" focused name="judul" />
                  </div>
                 <div class="form-group">
                    <label for="tanggal_event">Tanggal Event</label>
                    <input type='text' class="form-control" name ="tanggal_event" id='datetimepicker1'/>
                </div>
                   <div class="form-group ">
                        <label for="isi_event">Isi Event</label>
                        <textarea id="mytextarea" class="form-control" name="isi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                     <div class="form-group ">
                        <label for="foto">Upload Foto</label>
                        <div class="input-group input-group-sm">
                            <input type="file" class="form-control" name="photo" accept="image/*" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
                </form>
            </div>
        </div>
    </div>
    <div class="clear-both"></div>
</section>
<!-- /.content -->
<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/js/moment.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
    //Datemask dd/mm/yyyy
    $('#datetimepicker1').datetimepicker({
        minDate: moment()
    });
    $("#mytextarea").wysihtml5();
    });
</script>
<?php
$this->load->view('template/foot');
?>