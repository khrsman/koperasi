<?php
$this->load->view('template/head');
?>
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header"></section>
<!-- Main content -->
<section class="content">
<div class="col-md-5">
    <?php
    if($this->session->flashdata('msg') != NULL){
    echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
        echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
    echo '</div>';
    }?>
</div>
<div class="col-md-7"><?= validation_errors() ?></div>
<div class="col-md-12">
        <div class="col-md-5">
            <div class="box">
                <div class="box-body">
                    <img src="<?= base_url() ?>assets/images/event/<?php if ($event['link_gambar'] != NULL )
                                                                    echo $event['link_gambar']; 
                                                                    else 
                                                                    echo 'default.png';?>" class="img-responsive">
                    <form method="post" action="<?= base_url() ?>edit_foto_event" enctype="multipart/form-data">
                     <div class="form-group ">
                        <div class="input-group input-group-sm">
                            <input type="file" class="form-control" name="photo" accept="image/*" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat">Upload</button>
                            </span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="box">
            <form method="post" action="<?= base_url() ?>update_event">
                <div class="box-header with-border">
                   <div class="form-group ">
                    <input type="text" class="form-control" placeholder="Judul Event" required=""  name="judul" value="<?= $event['judul'] ?>" />
                  </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                    <label for="tanggal_event">Tanggal Event</label>
                    <input type='text' class="form-control" name ="tanggal_event" id='datetimepicker1' value="<?php 
                        $date = new DateTime($event['tanggal_event']); 
                        echo $date->format('m/d/Y H:i A'); ?>"/>
                </div>
                    <div class="form-group ">
                        <textarea id="mytextarea" class="form-control" name="isi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $event['isi'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
                </div>
            </form>
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
<script src="<?= base_url() ?>assets/js/moment.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
    //Datemask dd/mm/yyyy
    $('#datetimepicker1').datetimepicker({
        minDate: moment(),
        useCurrent : false
    });
    $("#mytextarea").wysihtml5();
    });
</script>
<?php
$this->load->view('template/foot');
?>