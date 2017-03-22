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
<div class="col-md-5">
    <?php
    if($this->session->flashdata('msg') != NULL){
    echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
        echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
    echo '</div>';
    }?>
</div>
<div class="col-md-7"><?= validation_errors() ?></div>
        <div class="col-md-7">
            <div class="box">
            <form method="post" action="<?= base_url() ?>update_datacell">
                <div class="box-header with-border">
                   Edit Harga Gerai
                </div>
                <div class="box-body">
                     <div class="form-group">
                        <label>Operator : <?= $datacell['id_operator'] ?></label>
                    </div>
                     <div class="form-group">
                        <label>Kode Operator : <?= $datacell['kode_operator'] ?></label>
                    </div>
                     <div class="form-group">
                        <label>Haga Datacell : <?= $datacell['harga_datacell'] ?></label>
                    </div>
                     <div class="form-group">
                    <div class="form-group">
                    <label>Harga Gerai</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                            Rp.
                      </div>
                      <input type="text" class="form-control" placeholder="Harga Gerai" name="harga_gerai"value="<?= $datacell['harga_gerai'] ?>" />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
                </div>
            </form>
            </div>
        </div>
</section>
<div class="clear-both"></div>
<!-- /.content -->
<?php
$this->load->view('template/js');
?>
<?php
$this->load->view('template/foot');
?>